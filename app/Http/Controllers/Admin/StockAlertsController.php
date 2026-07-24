<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\StockSetting;
use App\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StockAlertsController extends Controller
{
    public function __construct(protected StockService $stock)
    {
    }

    /**
     * Stock Alerts listing page.
     */
    public function index(Request $request)
    {
        [$critical, $low, $watch] = $this->stock->thresholds();

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

        // Severity tab / filter
        $severity = $request->input('severity');
        match ($severity) {
            'critical' => $query->where('stock', '<=', $critical),
            'low' => $query->where('stock', '>', $critical)->where('stock', '<=', $low),
            'watch' => $query->where('stock', '>', $low)->where('stock', '<=', $watch),
            default => $query->where('stock', '<=', $watch), // all alerts
        };

        // Sort
        match ($request->input('sort', 'severity')) {
            'stock_asc' => $query->orderBy('stock'),
            'recent' => $query->orderByDesc('updated_at'),
            'name_asc' => $query->orderBy('name'),
            default => $query->orderByRaw("CASE
                                WHEN stock <= {$critical} THEN 0
                                WHEN stock <= {$low}      THEN 1
                                ELSE 2
                           END")->orderBy('stock'),
        };

        $products = $query->paginate(20)->withQueryString();
        $categories = Category::orderBy('name')->get();

        // KPI counts (DB-level, no collection load)
        $kpi = [
            'critical' => Product::where('stock', '<=', $critical)->count(),
            'low' => Product::where('stock', '>', $critical)->where('stock', '<=', $low)->count(),
            'watch' => Product::where('stock', '>', $low)->where('stock', '<=', $watch)->count(),
        ];

        // Sidebar: top 5 most critical products
        $topCritical = Product::where('stock', '<=', $low)
            ->orderBy('stock')
            ->limit(5)
            ->get(['id', 'name', 'stock']);

        // Sidebar: alerts by category
        $byCategory = Category::withCount([
            'products as critical_count' => fn($q) => $q->where('stock', '<=', $critical),
            'products as low_count' => fn($q) => $q->where('stock', '>', $critical)->where('stock', '<=', $low),
        ])->having('critical_count', '>', 0)
            ->orHaving('low_count', '>', 0)
            ->orderByDesc('critical_count')
            ->get();

        $settings = StockSetting::current();

        return view('admin.stock.alerts', compact(
            'products',
            'categories',
            'kpi',
            'topCritical',
            'byCategory',
            'settings',
            'critical',
            'low',
            'watch'
        ));
    }

    /**
     * Quick Restock from the alert table row — fetch() call, returns JSON.
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

        $product->refresh();
        [$critical, $low, $watch] = $this->stock->thresholds();

        return response()->json([
            'stock' => $product->stock,
            'severity' => $this->severity($product->stock, $critical, $low, $watch),
            'active' => (bool) $product->status,
        ]);
    }

    /**
     * Save Thresholds (sidebar form).
     */
    public function updateThresholds(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'critical_threshold' => 'required|integer|min:0',
                'low_stock_threshold' => 'required|integer|min:0|gte:critical_threshold',
                'watch_list_threshold' => 'required|integer|min:0|gte:low_stock_threshold',
            ],
            [
                'low_stock_threshold.gte' => 'Low Stock must be ≥ Critical threshold.',
                'watch_list_threshold.gte' => 'Watch List must be ≥ Low Stock threshold.',
            ]
        );

        if ($validator->fails()) {
            dd($validator->errors()->all()); // remove after debugging

            // or:
            // return back()->withErrors($validator)->withInput();
        }

        StockSetting::current()->update($validator->validated());
        // Re-evaluate and notify if new products are now in alert range
        app(\App\Services\StockAlertService::class)->sendAlertEmailIfNeeded();


        return back()->with('success', 'Alert thresholds updated.');
    }

    /**
     * Notification toggles (sidebar).
     */
    public function updateNotifications(Request $request)
    {
        StockSetting::current()->update([
            'notify_email' => $request->boolean('notify_email'),
            'notify_dashboard' => $request->boolean('notify_dashboard'),
            'auto_disable_out_of_stock' => $request->boolean('auto_disable_out_of_stock'),
        ]);

        return back()->with('success', 'Notification preferences updated.');
    }

    // ── Helpers ────────────────────────────────────────────────────────────

    private function severity(int $stock, int $critical, int $low, int $watch): string
    {
        if ($stock <= $critical)
            return 'critical';
        if ($stock <= $low)
            return 'low';
        if ($stock <= $watch)
            return 'watch';
        return 'in_stock';
    }


    public function export(Request $request)
    {
        [$critical, $low, $watch] = $this->stock->thresholds();

        $query = Product::with('category')
            ->where('stock', '<=', $watch)
            ->orderByRaw("CASE
            WHEN stock <= {$critical} THEN 0
            WHEN stock <= {$low}      THEN 1
            ELSE 2
        END")
            ->orderBy('stock');

        // Respect active filters
        if ($search = $request->input('search')) {
            $query->where(fn($q) => $q->where('name', 'like', "%{$search}%")
                ->orWhere('sku', 'like', "%{$search}%")
                ->orWhere('product_code', 'like', "%{$search}%"));
        }
        if ($categoryId = $request->input('category_id')) {
            $query->where('category_id', $categoryId);
        }
        if ($severity = $request->input('severity')) {
            match ($severity) {
                'critical' => $query->where('stock', '<=', $critical),
                'low' => $query->where('stock', '>', $critical)->where('stock', '<=', $low),
                'watch' => $query->where('stock', '>', $low)->where('stock', '<=', $watch),
                default => null,
            };
        }

        $products = $query->get();

        $filename = 'stock-alerts-' . now()->format('Y-m-d-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($products, $critical, $low) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['ID', 'Product Name', 'SKU', 'Product Code', 'Category', 'Stock', 'Min Qty', 'Severity', 'Last Updated']);

            foreach ($products as $p) {
                $sev = match (true) {
                    $p->stock <= $critical => 'Critical',
                    $p->stock <= $low => 'Low Stock',
                    default => 'Watch',
                };

                fputcsv($handle, [
                    $p->id,
                    $p->name,
                    $p->sku,
                    $p->product_code,
                    $p->category->name ?? 'Uncategorized',
                    $p->stock,
                    $p->min_qty,
                    $sev,
                    $p->updated_at->format('d M Y, g:i A'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function restockAllCritical(Request $request)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        [$critical] = $this->stock->thresholds();

        $products = Product::where('stock', '<=', $critical)->get();

        foreach ($products as $product) {
            $this->stock->credit(
                $product,
                $validated['quantity'],
                'restock',
                null,
                auth()->id()
            );
        }

        return back()->with(
            'success',
            "Added {$validated['quantity']} units to {$products->count()} critical products."
        );
    }

}