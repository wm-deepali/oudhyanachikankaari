<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\StockHistory;
use App\Services\StockService;
use Illuminate\Http\Request;

class StockManagementController extends Controller
{
    public function __construct(protected StockService $stock)
    {
    }

    /**
     * Main Stock Management listing page.
     */
    public function index(Request $request)
    {
        $query = Product::with('category')->select('products.*');

        // Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhere('product_code', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($categoryId = $request->input('category_id')) {
            $query->where('category_id', $categoryId);
        }

        // Stock status filter
        [$criticalThreshold, $lowThreshold] = $this->stock->thresholds();
        if ($status = $request->input('stock_status')) {
            $query->when($status === 'out', fn($q) => $q->where('stock', '<=', $criticalThreshold))
                ->when($status === 'low', fn($q) => $q->where('stock', '>', $criticalThreshold)->where('stock', '<=', $lowThreshold))
                ->when($status === 'in', fn($q) => $q->where('stock', '>', $lowThreshold));
        }

        // Sorting
        match ($request->input('sort', 'stock_asc')) {
            'stock_desc' => $query->orderByDesc('stock'),
            'name_asc' => $query->orderBy('name'),
            'recent' => $query->orderByDesc('updated_at'),
            default => $query->orderBy('stock'),   // stock_asc
        };

        $products = $query->paginate(20)->withQueryString();
        $categories = Category::with('products:id,name,sku,stock,category_id')
            ->orderBy('name')
            ->get();

        // KPI stats
        $all = Product::all();
        $stats = [
            'total' => $all->count(),
            'in_stock' => $all->filter(fn($p) => $this->stock->simpleStatus($p) === 'in')->count(),
            'low' => $all->filter(fn($p) => $this->stock->simpleStatus($p) === 'low')->count(),
            'out' => $all->filter(fn($p) => $this->stock->simpleStatus($p) === 'out')->count(),
            'units' => $all->sum('stock'),
        ];

        return view('admin.stock.index', compact('products', 'categories', 'stats'));
    }

    /**
     * Inline "Update Stock" — called via fetch() from the table row.
     * Returns JSON so the front-end can update the row without a page reload.
     */
    public function updateStock(Request $request, Product $product)
    {
        $validated = $request->validate([
            'stock' => 'required|integer|min:0',
            'note' => 'nullable|string|max:255',
        ]);

        $this->stock->setStock(
            $product,
            $validated['stock'],
            'admin_adjustment',
            auth()->id(),
            $validated['note'] ?? null,
        );

        $product->refresh();
        $status = $this->stock->simpleStatus($product);

        return response()->json([
            'stock' => $product->stock,
            'status' => $status,                        // 'in' | 'low' | 'out'
            'active' => (bool) $product->status,
        ]);
    }

    /**
     * "Quick Restock" — adds units on top of current stock.
     */
    public function restock(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $this->stock->credit(
            $product,
            $validated['quantity'],
            'restock',
            null,
            auth()->id(),
        );

        return back()->with('success', "{$validated['quantity']} units added to {$product->name}.");
    }

    /**
     * Stock history modal — returns JSON consumed by loadHistory() in the Blade view.
     */
    public function history(Product $product)
    {
        $entries = StockHistory::where('product_id', $product->id)
            ->with('creator:id,name')
            ->latest()
            ->take(50)
            ->get();

        $added = $entries->where('type', 'credit')->sum('quantity');
        $removed = $entries->where('type', 'debit')->sum('quantity');

        $history = $entries->map(fn($h) => [
            'type' => $h->type,                          // 'credit' | 'debit'
            'reason' => $h->reason,
            'quantity' => $h->quantity,
            'stock_before' => $h->stock_before,
            'stock_after' => $h->stock_after,
            'note' => $h->note,
            'creator' => $h->creator?->name,
            'created_at' => $h->created_at->format('d M Y, g:i a'),
        ]);

        return response()->json([
            'summary' => [
                'added' => $added,
                'removed' => $removed,
                'current' => $product->stock,
            ],
            'history' => $history,
        ]);
    }

    public function export(Request $request)
    {
        [$criticalThreshold, $lowThreshold] = $this->stock->thresholds();

        $query = Product::with('category')->select('products.*');

        // Respect active filters
        if ($search = $request->input('search')) {
            $query->where(fn($q) => $q->where('name', 'like', "%{$search}%")
                ->orWhere('sku', 'like', "%{$search}%")
                ->orWhere('product_code', 'like', "%{$search}%"));
        }
        if ($categoryId = $request->input('category_id')) {
            $query->where('category_id', $categoryId);
        }
        if ($status = $request->input('stock_status')) {
            match ($status) {
                'out' => $query->where('stock', '<=', $criticalThreshold),
                'low' => $query->where('stock', '>', $criticalThreshold)->where('stock', '<=', $lowThreshold),
                'in' => $query->where('stock', '>', $lowThreshold),
                default => null,
            };
        }

        $products = $query->orderBy('stock')->get();
        $filename = 'stock-' . now()->format('Y-m-d-His') . '.csv';

        return response()->stream(function () use ($products, $criticalThreshold, $lowThreshold) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['ID', 'Product Name', 'SKU', 'Product Code', 'Category', 'Stock', 'Min Qty', 'Status', 'Visibility', 'Last Updated']);

            foreach ($products as $p) {
                $status = match (true) {
                    $p->stock <= $criticalThreshold => 'Out of Stock',
                    $p->stock <= $lowThreshold => 'Low Stock',
                    default => 'In Stock',
                };

                fputcsv($handle, [
                    $p->id,
                    $p->name,
                    $p->sku,
                    $p->product_code,
                    $p->category->name ?? 'Uncategorized',
                    $p->stock,
                    $p->min_qty,
                    $status,
                    $p->status ? 'Active' : 'Inactive',
                    $p->updated_at->format('d M Y, g:i A'),
                ]);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $handle = fopen($request->file('csv_file')->getRealPath(), 'r');
        $header = fgetcsv($handle); // skip header row
        $updated = 0;
        $skipped = 0;
        $errors = [];

        while (($row = fgetcsv($handle)) !== false) {
            // Expected columns: ID, (anything...), Stock  — match by position
            // CSV format: ID, Product Name, SKU, Product Code, Category, Stock, Min Qty, ...
            $id = trim($row[0] ?? '');
            $stock = trim($row[5] ?? '');

            if (!is_numeric($id) || !is_numeric($stock) || (int) $stock < 0) {
                $skipped++;
                continue;
            }

            $product = Product::find((int) $id);

            if (!$product) {
                $errors[] = "Product ID {$id} not found.";
                $skipped++;
                continue;
            }

            $this->stock->setStock(
                $product,
                (int) $stock,
                'bulk_import',
                auth()->id(),
                'Bulk CSV update',
            );

            $updated++;
        }

        fclose($handle);

        $message = "{$updated} products updated.";
        if ($skipped)
            $message .= " {$skipped} rows skipped.";

        return back()->with('success', $message)->with('bulk_errors', $errors);
    }


    public function addStockEntry(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:credit,debit',
            'reason' => 'required|in:restock,admin_adjustment,bulk_import,damage,return,initial_stock',
            'note' => 'nullable|string|max:255',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($validated['type'] === 'credit') {
            $this->stock->credit(
                $product,
                $validated['quantity'],
                $validated['reason'],
                null,
                auth()->id(),
                $validated['note'] ?? null,
            );
        } else {
            $this->stock->debit(
                $product,
                $validated['quantity'],
                $validated['reason'],
                null,
                auth()->id(),
                $validated['note'] ?? null,
                allowNegative: false,
            );
        }

        return back()->with('success', "Stock entry recorded for {$product->name}.");
    }

    public function downloadTemplate()
{
    $filename = 'stock-bulk-update-template.csv';

    return response()->stream(function () {
        $handle = fopen('php://output', 'w');

        // Header row
        fputcsv($handle, ['ID', 'Product Name', 'SKU', 'Product Code', 'Category', 'Stock', 'Min Qty']);

        // Example rows
        fputcsv($handle, [1,  'Example Product A', 'SKU-00001', 'CODE-001', 'Electronics', 50,  5]);
        fputcsv($handle, [2,  'Example Product B', 'SKU-00002', 'CODE-002', 'Clothing',    100, 10]);
        fputcsv($handle, [99, 'Example Product C', 'SKU-00099', 'CODE-099', 'Footwear',    0,   3]);

        fclose($handle);
    }, 200, [
        'Content-Type'        => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        'Cache-Control'       => 'no-cache, no-store, must-revalidate',
    ]);
}

}