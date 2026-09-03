<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('collections', function (Blueprint $table) {
            $table->string('h1_heading')->nullable()->after('name');
            $table->string('image')->nullable()->after('slug');
            $table->string('image_alt')->nullable()->after('image');
            $table->string('canonical')->nullable()->after('meta_description');
            $table->string('og_title')->nullable()->after('canonical');
            $table->text('og_description')->nullable()->after('og_title');
        });
    }

    public function down(): void
    {
        Schema::table('collections', function (Blueprint $table) {
            $table->dropColumn([
                'h1_heading',
                'image',
                'image_alt',
                'canonical',
                'og_title',
                'og_description',
            ]);
        });
    }
};