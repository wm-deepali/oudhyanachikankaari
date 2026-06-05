<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            $table->foreignId('subcategory_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();

            $table->string('name');

            $table->string('slug')->unique();

            $table->string('sku')->nullable();

            $table->text('short_description')->nullable();

            $table->longText('description')->nullable();

            $table->decimal('base_price', 12, 2)->default(0);

            $table->integer('stock')->default(0);

            $table->string('featured_image')->nullable();

            $table->boolean('is_featured')->default(false);

            $table->integer('sort_order')->default(0);

            $table->boolean('status')->default(true);

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
