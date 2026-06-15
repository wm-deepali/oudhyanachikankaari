<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('carts', function (Blueprint $table) {

            $table->decimal('subtotal', 12, 2)
                ->default(0)
                ->after('total_amount');

            $table->decimal('discount', 12, 2)
                ->default(0);

            $table->decimal('tax_amount', 12, 2)
                ->default(0);

            $table->decimal('grand_total', 12, 2)
                ->default(0);

            $table->foreignId('coupon_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('coupon_code')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            //
        });
    }
};
