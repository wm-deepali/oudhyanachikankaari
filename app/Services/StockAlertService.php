<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Setting;
use App\Models\StockSetting;
use App\Services\Email\EmailDispatcher;
use Illuminate\Support\Facades\Log;

class StockAlertService
{
    public function __construct(protected StockService $stock) {}

    public function sendAlertEmailIfNeeded(): void
    {
        $settings = StockSetting::current();

        if (!$settings->notify_email) {
            return;
        }

        [$critical, $low] = $this->stock->thresholds();

        $criticalProducts = Product::with('category')
            ->where('stock', '<=', $critical)
            ->orderBy('stock')
            ->get();

        $lowProducts = Product::with('category')
            ->where('stock', '>', $critical)
            ->where('stock', '<=', $low)
            ->orderBy('stock')
            ->get();

        if ($criticalProducts->isEmpty() && $lowProducts->isEmpty()) {
            return;
        }

        $adminEmail = Setting::first()?->admin_email;

        if (!$adminEmail) {
            return;
        }

        try {
            EmailDispatcher::send(
                'low-stock-alert',
                $adminEmail,
                [
                    '{report_date}' => now()->format('l, d F Y — g:i A'),

                    '{total_count}' => $criticalProducts->count() + $lowProducts->count(),
                    '{critical_count}' => $criticalProducts->count(),
                    '{low_count}' => $lowProducts->count(),
                    '{critical_threshold}' => $critical,
                    '{low_threshold}' => $low,

                    '{critical_products}' => $this->renderProductList(
                        $criticalProducts,
                        '🔴 Out of Stock (≤ ' . $critical . ' units)',
                        'critical'
                    ),
                    '{low_products}' => $this->renderProductList(
                        $lowProducts,
                        '🟡 Low Stock (≤ ' . $low . ' units)',
                        'low'
                    ),

                    '{admin_stock_url}' => route('admin.stock.alerts'),
                ]
            );
        } catch (\Exception $e) {
            Log::error('Stock alert email failed: ' . $e->getMessage());
        }
    }

    /**
     * Render a list of colored product rows matching the original
     * StockAlertMail design, used to fill the {critical_products} /
     * {low_products} smart blocks.
     */
    protected function renderProductList($products, string $sectionTitle, string $variant): string
    {
        if ($products->isEmpty()) {
            return '';
        }

        $isCritical = $variant === 'critical';

        $rowBg = $isCritical ? '#fff8f8' : '#fffcf2';
        $rowBorder = $isCritical ? '#f5c6c6' : '#f0d060';
        $badgeBg = $isCritical ? '#fce8e8' : '#fff5cc';
        $badgeColor = $isCritical ? '#b22222' : '#916a00';
        $titleColor = $isCritical ? '#b22222' : '#916a00';

        $rows = '';

        foreach ($products as $product) {
            $sku = $product->sku ?? '—';
            $category = $product->category->name ?? 'Uncategorized';

            $rows .= "
        <tr>
            <td style='padding:10px 14px;background:{$rowBg};border:1px solid {$rowBorder};border-radius:8px 0 0 8px'>
                <div style='font-size:13px;font-weight:600;color:#202223'>{$product->name}</div>
                <div style='font-size:11.5px;color:#8c9196;margin-top:2px;font-family:\"Courier New\",monospace'>SKU: {$sku} · {$category}</div>
            </td>
            <td style='padding:10px 14px;background:{$rowBg};border:1px solid {$rowBorder};border-left:none;border-radius:0 8px 8px 0;text-align:right;white-space:nowrap'>
                <span style='font-size:13px;font-weight:700;padding:3px 10px;border-radius:20px;background:{$badgeBg};color:{$badgeColor}'>{$product->stock} left</span>
            </td>
        </tr>
        <tr><td colspan='2' style='height:6px;line-height:6px;font-size:0'>&nbsp;</td></tr>";
        }

        return "
    <div style='font-size:12px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:{$titleColor};margin:20px 0 10px'>{$sectionTitle}</div>
    <table style='width:100%;border-collapse:separate;border-spacing:0' cellpadding='0' cellspacing='0'>
        <tbody>{$rows}
        </tbody>
    </table>";
    }
}