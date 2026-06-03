<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attributes', function (Blueprint $table) {

            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            // select, radio, checkbox, text, number, textarea, color
            $table->string('type')->default('select');

            // 1 = predefined values exist
            // 0 = free input by user
            $table->boolean('has_values')->default(true);

            // 1 = generates product variants
            // 0 = normal product attribute
            $table->boolean('is_variant')->default(false);

            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};