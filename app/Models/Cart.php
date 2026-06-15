<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [

        'user_id',
        'session_id',

        'total_amount',

        // Coupon
        'coupon_id',
        'coupon_code',

        // Calculations
        'subtotal',
        'discount',
        'tax_amount',
        'grand_total',
    ];

    public function items()
    {
        return $this->hasMany(
            CartItem::class
        );
    }

    public function user()
    {
        return $this->belongsTo(
            Customer::class
        );
    }

    public function coupon()
    {
        return $this->belongsTo(
            Coupon::class
        );
    }

    public function recalculateTotals()
    {
        $invoiceSetting = InvoiceSetting::first();

        $subtotal = $this->items()->sum('total');

        $discount = $this->discount ?? 0;

        $taxableAmount = max(
            $subtotal - $discount,
            0
        );

        $taxAmount = 0;

        if (
            $invoiceSetting &&
            $invoiceSetting->gst_enabled
        ) {

            $gstPercentage =
                ($invoiceSetting->cgst ?? 0) +
                ($invoiceSetting->sgst ?? 0);

            $taxAmount =
                ($taxableAmount * $gstPercentage) / 100;
        }

        $grandTotal =
            $taxableAmount + $taxAmount;

        $this->update([
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'grand_total' => $grandTotal,
            'total_amount' => $grandTotal,
        ]);
    }
}