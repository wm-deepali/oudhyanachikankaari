<?php
// database/migrations/xxxx_xx_xx_add_seo_fields_to_seo_pages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('seo_pages', function (Blueprint $table) {
            $table->string('canonical_url')->nullable()->after('meta_description');
            $table->string('og_title')->nullable()->after('canonical_url');
            $table->text('og_description')->nullable()->after('og_title');
            $table->string('og_image')->nullable()->after('og_description');
            $table->string('og_url')->nullable()->after('og_image');
            $table->string('twitter_card')->nullable()->after('og_url');
            $table->string('twitter_image')->nullable()->after('twitter_card');
        });
    }

    public function down()
    {
        Schema::table('seo_pages', function (Blueprint $table) {
            $table->dropColumn([
                'canonical_url', 'og_title', 'og_description',
                'og_image', 'og_url', 'twitter_card', 'twitter_image',
            ]);
        });
    }
};