<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('colour_customization')->default(false)->after('pan_india');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->string('custom_colour_code', 50)->nullable();
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->string('custom_colour_code', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('colour_customization');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropColumn('custom_colour_code');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('custom_colour_code');
        });
    }
};