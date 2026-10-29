<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // php artisan make:migration add_dye_price_to_products_table --table=products
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('dye_price', 10, 2)->default(0)->after('colour_customization');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('dye_price');
        });
    }
};
