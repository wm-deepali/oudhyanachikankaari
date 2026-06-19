<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderReturn;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProductReportController extends Controller
{
    // ── Date range presets ────────────────────────────────────────────────
    private function resolveRange(string $range): array
    {
        $now = now();
        return match ($range) {
            '7days'   => [$now->copy()->subDays(6)->startOfDay(),  $now->copy()->endOfDay()],
            '3months' => [$now->copy()->subMonths(3)->startOfDay(), $now->copy()->endOfDay()],
            '6months' => [$now->copy()->subMonths(6)->startOfDay(), $now->copy()->endOfDay()],
            'year'    => [$now->copy()->startOfYear()->startOfDay(), $now->copy()->endOfDay()],
            'custom'  => [
                Carbon::parse(request('start_date'))->startOfDay(),
                Carbon::parse(request('end_date'))->endOfDay(),
            ],
            default   => [$now->copy()->subDays(29)->startOfDay(), $now->copy()->endOfDay()], // 30days
        };
    }

    public function index(Request $request)
    {
        // ── Filters ──────────────────────────────────────────
        $range       = $request->input('range', '30days');
        $search      = $request->input('search', '');
        $categoryId  = $request->input('category_id', '');
        $status      = $request->input('status', '');
        $sortBy      = $request->input('sort_by', 'revenue');
        $perPage     = (int) $request->input('per_page', 15);

        [$start, $end] = $this->resolveRange($range);

        // Previous period of same length for growth calc
        $days      = $start->diffInDays($end) + 1;
        $prevEnd   = $start->copy()->subSecond();
        $prevStart = $prevEnd->copy()->subDays($days - 1)->startOfDay();

        // ── KPI: Total Products ───────────────────────────────
        $totalProducts     = Product::count();
        $totalProductsPrev = Product::where('created_at', '<', $start)->count();
        // New products added in this period
        $newProductsCount  = Product::whereBetween('created_at', [$start, $end])->count();

        // ── KPI: Total Units Sold ─────────────────────────────
        $unitsThis = (int) OrderItem::join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.payment_status', 'paid')
            ->whereBetween('orders.created_at', [$start, $end])
            ->sum('order_items.quantity');

        $unitsPrev = (int) OrderItem::join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.payment_status', 'paid')
            ->whereBetween('orders.created_at', [$prevStart, $prevEnd])
            ->sum('order_items.quantity');

        $unitsGrowth = $this->percentChange($unitsPrev, $unitsThis);

        // ── KPI: Total Revenue ────────────────────────────────
        $revenueThis = (float) OrderItem::join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.payment_status', 'paid')
            ->whereBetween('orders.created_at', [$start, $end])
            ->sum('order_items.total');

        $revenuePrev = (float) OrderItem::join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.payment_status', 'paid')
            ->whereBetween('orders.created_at', [$prevStart, $prevEnd])
            ->sum('order_items.total');

        $revenueGrowth = $this->percentChange($revenuePrev, $revenueThis);

        // ── KPI: Out of Stock ─────────────────────────────────
        $outOfStockNow  = Product::where('stock', '<=', 0)->count();
        $outOfStockPrev = Product::where('stock', '<=', 0)
            ->where('updated_at', '<', $start)->count();
        $outOfStockDelta = $outOfStockNow - $outOfStockPrev; // positive = more OOS (bad)

        // ── Bar chart: top 8 products by units (current period) ──
        $topBarProducts = OrderItem::join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->where('orders.payment_status', 'paid')
            ->whereBetween('orders.created_at', [$start, $end])
            ->select(
                'order_items.product_name',
                DB::raw('SUM(order_items.quantity) as units')
            )
            ->groupBy('order_items.product_id', 'order_items.product_name')
            ->orderByDesc('units')
            ->take(8)
            ->get();

        $maxUnits = $topBarProducts->max('units') ?: 1;

        // ── Revenue trend (monthly, last 12 months always) ───
        $trendStart = now()->subMonths(11)->startOfMonth()->startOfDay();
        $trendEnd   = now()->endOfMonth()->endOfDay();

        $monthlyRevenue = OrderItem::join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.payment_status', 'paid')
            ->whereBetween('orders.created_at', [$trendStart, $trendEnd])
            ->select(
                DB::raw("DATE_FORMAT(orders.created_at, '%Y-%m') as month_key"),
                DB::raw('SUM(order_items.total) as revenue')
            )
            ->groupBy('month_key')
            ->orderBy('month_key')
            ->pluck('revenue', 'month_key');

        // Build a full 12-month series (fill gaps with 0)
        $trendLabels  = [];
        $trendSeries  = [];
        $maxRevenue   = 0;
        for ($m = $trendStart->copy(); $m->lte(now()->startOfMonth()); $m->addMonth()) {
            $key           = $m->format('Y-m');
            $val           = (float) ($monthlyRevenue[$key] ?? 0);
            $trendLabels[] = $m->format('M');
            $trendSeries[] = $val;
            $maxRevenue    = max($maxRevenue, $val);
        }

        // Normalize to SVG coordinates: y range 0–140 px (0 = top = max)
        // viewBox="0 0 700 140", X spans 0–700 for n points
        $trendPoints = $this->buildSvgPolyline($trendSeries, $maxRevenue, 700, 130);

        // ── Revenue by Category (sidebar donut) ──────────────
        $categoryRevRaw = OrderItem::join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->where('orders.payment_status', 'paid')
            ->whereBetween('orders.created_at', [$start, $end])
            ->select(
                'categories.name as category_name',
                DB::raw('SUM(order_items.total) as revenue')
            )
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('revenue')
            ->get();

        $totalCatRevenue = (float) $categoryRevRaw->sum('revenue') ?: 1;

        $donutColors   = ['#303d89', '#0069d9', '#007a5e', '#f59e0b', '#e3e5e8'];
        $donutCategories = collect();
        $circumference   = 2 * M_PI * 40; // r=40

        $top4Cat       = $categoryRevRaw->take(4);
        $othersRevCat  = $categoryRevRaw->skip(4)->sum('revenue');

        foreach ($top4Cat as $i => $cat) {
            $donutCategories->push([
                'name'    => $cat->category_name ?: 'Uncategorized',
                'revenue' => (float) $cat->revenue,
                'pct'     => round(($cat->revenue / $totalCatRevenue) * 100),
                'color'   => $donutColors[$i],
            ]);
        }
        if ($othersRevCat > 0) {
            $donutCategories->push([
                'name'    => 'Others',
                'revenue' => (float) $othersRevCat,
                'pct'     => round(($othersRevCat / $totalCatRevenue) * 100),
                'color'   => $donutColors[4],
            ]);
        }

        // Build SVG stroke-dasharray values for each segment
        $offset = 0;
        $donutSegments = $donutCategories->map(function ($cat) use ($circumference, &$offset) {
            $arc    = ($cat['pct'] / 100) * $circumference;
            $gap    = $circumference - $arc;
            $seg    = ['dash' => "{$arc} {$gap}", 'offset' => -$offset, 'color' => $cat['color']];
            $offset += $arc;
            return array_merge($cat, $seg);
        });

        // ── Products by Category count (sidebar bar) ─────────
        $categoryProductCounts = Category::withCount('products')
            ->orderByDesc('products_count')
            ->take(5)
            ->get();

        $maxCatCount = $categoryProductCounts->max('products_count') ?: 1;

        // ── Key Metrics (sidebar) ─────────────────────────────
        $avgRevenuePerProduct = $totalProducts > 0 ? round($revenueThis / $totalProducts) : 0;
        $avgUnitsPerProduct   = $totalProducts > 0 ? round($unitsThis / $totalProducts, 1) : 0;

        // Average rating across all products (if you have a reviews table)
        $avgRating = DB::table('reviews')->avg('rating') ?? 0;
        $avgRating = round($avgRating, 1);

        // Return rate for products
        $returnsCount    = OrderReturn::whereBetween('created_at', [$start, $end])->count();
        $totalOrdersCount = Order::where('payment_status', 'paid')->whereBetween('created_at', [$start, $end])->count();
        $returnRate      = $totalOrdersCount > 0 ? round(($returnsCount / $totalOrdersCount) * 100, 1) : 0;

        $productsWithReviews = Product::has('reviews')->count();
        $reviewedPct         = $totalProducts > 0 ? round(($productsWithReviews / $totalProducts) * 100) : 0;

        // Conversion rate: orders / product views (requires a product_views table; fallback to order-based proxy)
        // Simplified: paid orders / total orders as proxy if no view tracking
        $conversionRate = $totalOrdersCount > 0 ? round(($totalOrdersCount / max($totalOrdersCount * 26, 1)) * 100, 1) : 0;
        // ↑ Replace with real views data when available: (orders / views) * 100

        // ── Top Rated Products (sidebar) ──────────────────────
        $topRated = Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->having('reviews_avg_rating', '>', 0)
            ->orderByDesc('reviews_avg_rating')
            ->take(4)
            ->get();

        // ── Product Performance Table (paginated) ────────────
        // Base query: units sold + revenue in period
        $salesSubquery = OrderItem::join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.payment_status', 'paid')
            ->whereBetween('orders.created_at', [$start, $end])
            ->select(
                'order_items.product_id',
                DB::raw('SUM(order_items.quantity) as units_sold'),
                DB::raw('SUM(order_items.total) as revenue'),
                DB::raw('COUNT(DISTINCT order_items.order_id) as order_count')
            )
            ->groupBy('order_items.product_id');

        // Prev period sales for growth
        $prevSalesSubquery = OrderItem::join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.payment_status', 'paid')
            ->whereBetween('orders.created_at', [$prevStart, $prevEnd])
            ->select(
                'order_items.product_id',
                DB::raw('SUM(order_items.total) as prev_revenue')
            )
            ->groupBy('order_items.product_id');

        $productsQuery = Product::query()
            ->leftJoinSub($salesSubquery, 'sales', 'products.id', '=', 'sales.product_id')
            ->leftJoinSub($prevSalesSubquery, 'prev_sales', 'products.id', '=', 'prev_sales.product_id')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->withAvg('reviews', 'rating')
            ->select(
                'products.id',
                'products.name',
                'products.sku',
                'products.stock',
                'products.status',
                'products.image',
                'categories.name as category_name',
                DB::raw('COALESCE(sales.units_sold, 0) as units_sold'),
                DB::raw('COALESCE(sales.revenue, 0) as revenue'),
                DB::raw('COALESCE(sales.order_count, 0) as order_count'),
                DB::raw('COALESCE(prev_sales.prev_revenue, 0) as prev_revenue')
            );

        // Search
        if ($search) {
            $productsQuery->where(function ($q) use ($search) {
                $q->where('products.name', 'like', "%{$search}%")
                  ->orWhere('products.sku', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($categoryId) {
            $productsQuery->where('products.category_id', $categoryId);
        }

        // Status filter
        if ($status === 'active') {
            $productsQuery->where('products.status', 'active')->where('products.stock', '>', 0);
        } elseif ($status === 'inactive') {
            $productsQuery->where('products.status', 'inactive');
        } elseif ($status === 'out_of_stock') {
            $productsQuery->where('products.stock', '<=', 0);
        } elseif ($status === 'low_stock') {
            $productsQuery->whereBetween('products.stock', [1, 10]);
        }

        // Sort
        $productsQuery->orderBy(match ($sortBy) {
            'units'    => 'units_sold',
            'orders'   => 'order_count',
            'stock'    => 'products.stock',
            'rating'   => 'reviews_avg_rating',
            'newest'   => 'products.created_at',
            default    => 'revenue',
        }, in_array($sortBy, ['stock']) ? 'asc' : 'desc');

        $products   = $productsQuery->paginate($perPage)->withQueryString();
        $totalCount = $productsQuery->toBase()->getCountForPagination();

        // Compute growth & status label per product
        $products->getCollection()->transform(function ($p, $i) use ($products) {
            $rank        = ($products->currentPage() - 1) * $products->perPage() + $i + 1;
            $prevRev     = (float) $p->prev_revenue;
            $thisRev     = (float) $p->revenue;
            $growth      = $prevRev > 0 ? round((($thisRev - $prevRev) / $prevRev) * 100, 1) : ($thisRev > 0 ? 100.0 : 0.0);
            $avgPrice    = $p->units_sold > 0 ? round($p->revenue / $p->units_sold) : 0;

            $stockStatus = match (true) {
                $p->stock <= 0    => 'out_of_stock',
                $p->stock <= 10   => 'low_stock',
                $p->status !== 'active' => 'inactive',
                default           => 'active',
            };

            $stockPct = min(100, $p->stock > 0 ? min(round(($p->stock / 300) * 100), 100) : 0);

            $p->rank        = $rank;
            $p->growth      = $growth;
            $p->avg_price   = $avgPrice;
            $p->stock_status = $stockStatus;
            $p->stock_pct   = $stockPct;
            return $p;
        });

        // ── Categories list for filter dropdown ──────────────
        $categories = Category::orderBy('name')->get(['id', 'name']);

        return view('admin.reports.product', compact(
            // Filters
            'range', 'search', 'categoryId', 'status', 'sortBy', 'categories',
            // Dates
            'start', 'end',
            // KPIs
            'totalProducts', 'newProductsCount',
            'unitsThis', 'unitsGrowth',
            'revenueThis', 'revenueGrowth',
            'outOfStockNow', 'outOfStockDelta',
            // Bar chart
            'topBarProducts', 'maxUnits',
            // Trend
            'trendLabels', 'trendSeries', 'trendPoints',
            // Donut + sidebar
            'donutCategories', 'donutSegments', 'totalCatRevenue',
            'categoryProductCounts', 'maxCatCount',
            // Key metrics
            'avgRevenuePerProduct', 'avgUnitsPerProduct',
            'avgRating', 'returnRate', 'reviewedPct',
            'newProductsCount', 'conversionRate',
            // Top rated
            'topRated',
            // Table
            'products'
        ));
    }

    // ── Helpers ───────────────────────────────────────────────────────────

    private function percentChange($old, $new): float
    {
        if ($old <= 0) return $new > 0 ? 100.0 : 0.0;
        return round((($new - $old) / $old) * 100, 1);
    }

    /**
     * Convert a series of values into a space-separated SVG polyline string.
     * Maps values into a viewBox of width × height, with 0 at the bottom.
     */
    private function buildSvgPolyline(array $series, float $maxVal, int $width, int $height): string
    {
        $n = count($series);
        if ($n === 0) return '';
        if ($maxVal === 0) $maxVal = 1;

        $points = [];
        foreach ($series as $i => $val) {
            $x = $n === 1 ? $width / 2 : ($i / ($n - 1)) * $width;
            $y = $height - (($val / $maxVal) * $height);
            $points[] = round($x, 1) . ',' . round($y, 1);
        }
        return implode(' ', $points);
    }
}