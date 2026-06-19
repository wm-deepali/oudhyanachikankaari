<?php

namespace App\Services;

use App\Mail\StockAlertMail;
use App\Models\Product;
use App\Models\Setting;
use App\Models\SmtpSetting;
use App\Models\StockSetting;
use App\Helpers\MailHelper;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class StockAlertService
{
    public function __construct(protected StockService $stock) {}

    /**
     * Send stock alert email to admin if enabled.
     * Call this after any stock debit (order placement, bulk update, etc.)
     */
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

        // Nothing to alert about
        if ($criticalProducts->isEmpty() && $lowProducts->isEmpty()) {
            return;
        }

        $criticalData = $criticalProducts->map(fn ($p) => [
            'name'     => $p->name,
            'sku'      => $p->sku,
            'stock'    => $p->stock,
            'category' => $p->category->name ?? 'Uncategorized',
        ])->toArray();

        $lowData = $lowProducts->map(fn ($p) => [
            'name'     => $p->name,
            'sku'      => $p->sku,
            'stock'    => $p->stock,
            'category' => $p->category->name ?? 'Uncategorized',
        ])->toArray();

        try {
            $smtpSetting = SmtpSetting::first();

            if (!$smtpSetting) {
                return;
            }

            MailHelper::configure();

            $adminEmail = Setting::first()?->admin_email;

            if (!$adminEmail) {
                return;
            }

            Mail::to($adminEmail)->send(new StockAlertMail(
                critical:           $criticalData,
                low:                $lowData,
                criticalThreshold:  $critical,
                lowThreshold:       $low,
            ));

        } catch (\Exception $e) {
            Log::error('Stock alert email failed: ' . $e->getMessage());
        }
    }
}