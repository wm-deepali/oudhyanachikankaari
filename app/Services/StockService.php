<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockHistory;
use App\Models\StockSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class StockService
{
    /**
     * Add stock — admin restock, bulk import, customer return, etc.
     */
    public function credit(
        Product $product,
        int $quantity,
        string $reason,
        ?Model $reference = null,
        ?int $createdBy = null,
        ?string $note = null
    ): StockHistory {
        if ($quantity <= 0) {
            throw new RuntimeException('Credit quantity must be a positive number.');
        }

        return DB::transaction(function () use ($product, $quantity, $reason, $reference, $createdBy, $note) {
            $product = Product::whereKey($product->id)->lockForUpdate()->first();

            $before = $product->stock;
            $product->stock = $before + $quantity;
            $product->save();

            $history = $this->logHistory($product, 'credit', $quantity, $before, $product->stock, $reason, $reference, $createdBy, $note);

            $this->syncListingVisibility($product);

            return $history;
        });
    }

    /**
     * Remove stock — customer order, damage write-off, etc.
     * Throws if there isn't enough stock unless $allowNegative is true.
     */
    public function debit(
        Product $product,
        int $quantity,
        string $reason,
        ?Model $reference = null,
        ?int $createdBy = null,
        ?string $note = null,
        bool $allowNegative = false
    ): StockHistory {
        if ($quantity <= 0) {
            throw new RuntimeException('Debit quantity must be a positive number.');
        }

        return DB::transaction(function () use ($product, $quantity, $reason, $reference, $createdBy, $note, $allowNegative) {
            // Locks the row so two simultaneous orders can't both pass a stock
            // check against the same starting quantity and oversell the product.
            $product = Product::whereKey($product->id)->lockForUpdate()->first();

            $before = $product->stock;

            if (!$allowNegative && $quantity > $before) {
                throw new RuntimeException(
                    "Insufficient stock for \"{$product->name}\". Available: {$before}, requested: {$quantity}."
                );
            }

            $product->stock = $before - $quantity;
            $product->save();

            $history = $this->logHistory($product, 'debit', $quantity, $before, $product->stock, $reason, $reference, $createdBy, $note);

            $this->syncListingVisibility($product);

            return $history;
        });
    }

    /**
     * Set stock to an exact value — used by the inline "Update Stock" field on
     * the Stock Management table. Records the difference as a credit/debit.
     */
    public function setStock(
        Product $product,
        int $newStock,
        string $reason,
        ?int $createdBy = null,
        ?string $note = null
    ): ?StockHistory {
        return DB::transaction(function () use ($product, $newStock, $reason, $createdBy, $note) {
            $product = Product::whereKey($product->id)->lockForUpdate()->first();

            $before = $product->stock;
            $diff = $newStock - $before;

            if ($diff === 0) {
                return null;
            }

            $product->stock = $newStock;
            $product->save();

            $history = $this->logHistory(
                $product,
                $diff > 0 ? 'credit' : 'debit',
                abs($diff),
                $before,
                $newStock,
                $reason,
                null,
                $createdBy,
                $note
            );

            $this->syncListingVisibility($product);

            return $history;
        });
    }

    /**
     * critical | low | watch | in_stock — purely based on the global thresholds.
     */
    public function status(Product $product): string
    {
        [$critical, $low, $watch] = $this->thresholds();

        if ($product->stock <= $critical) {
            return 'critical';
        }

        if ($product->stock <= $low) {
            return 'low';
        }

        if ($product->stock <= $watch) {
            return 'watch';
        }

        return 'in_stock';
    }

    public function thresholds(): array
    {
        $settings = StockSetting::current();

        return [
            $settings->critical_threshold,
            $settings->low_stock_threshold,
            $settings->watch_list_threshold,
        ];
    }

    protected function logHistory(
        Product $product,
        string $type,
        int $quantity,
        int $before,
        int $after,
        string $reason,
        ?Model $reference,
        ?int $createdBy,
        ?string $note
    ): StockHistory {
        return StockHistory::create([
            'product_id' => $product->id,
            'type' => $type,
            'quantity' => $quantity,
            'stock_before' => $before,
            'stock_after' => $after,
            'reason' => $reason,
            'reference_type' => $reference ? $reference::class : null,
            'reference_id' => $reference?->getKey(),
            'created_by' => $createdBy,
            'note' => $note,
        ]);
    }

    /**
     * Mirrors the "Auto-Disable Listings" toggle on the Stock Alerts page —
     * hides a product from the storefront once it hits the critical threshold,
     * and brings it back once restocked above it.
     */
    protected function syncListingVisibility(Product $product): void
    {
        if (!StockSetting::current()->auto_disable_out_of_stock) {
            return;
        }

        [$critical] = $this->thresholds();
        $shouldBeActive = $product->stock > $critical;

        if ((bool) $product->status !== $shouldBeActive) {
            $product->update(['status' => $shouldBeActive]);
        }
    }

    /**
     * Simplified 3-state status for the Stock Management UI.
     * Returns 'out' | 'low' | 'in'
     */
    public function simpleStatus(Product $product): string
    {
        [$critical, $low] = $this->thresholds();

        if ($product->stock <= $critical)
            return 'out';
        if ($product->stock <= $low)
            return 'low';

        return 'in';
    }
}