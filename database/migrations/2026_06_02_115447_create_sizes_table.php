<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sizes', function (Blueprint $table) {

            $table->id();

            $table->foreignId('size_group_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');

            $table->integer('sort_order')->default(0);

            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sizes');
    }
};