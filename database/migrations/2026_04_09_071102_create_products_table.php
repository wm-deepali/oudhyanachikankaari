<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();

        $table->string('name');
         $table->string('product_code')->nullable();
        $table->string('slug')->nullable();
        $table->string('sub_title')->nullable();

        $table->string('sku')->nullable();
        $table->integer('min_qty')->default(1);
        $table->string('delivery_time')->nullable();

        $table->boolean('quality')->default(0);
        $table->boolean('pan_india')->default(0);

        $table->decimal('mrp', 10, 2)->nullable();
        $table->decimal('discount', 10, 2)->nullable();
        $table->string('discount_type')->nullable();
        $table->decimal('price', 10, 2)->nullable();


        $table->text('details')->nullable();
        $table->text('delivery_returns')->nullable();

        $table->text('meta_title')->nullable();
        $table->text('meta_description')->nullable();

        $table->boolean('cart')->default(1);
        $table->boolean('whatsapp')->default(0);

        $table->boolean('status')->default(1);
        $table->string('added_by')->nullable();

        $table->timestamps();
        $table->softDeletes();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
