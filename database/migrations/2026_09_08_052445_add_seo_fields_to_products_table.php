<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'meta_status')) {
                $table->enum('meta_status', ['index_follow', 'noindex_unfollow'])
                    ->default('index_follow')
                    ->after('h1_heading');
            }
            if (!Schema::hasColumn('products', 'og_title')) {
                $table->string('og_title')->nullable()->after('meta_status');
            }
            if (!Schema::hasColumn('products', 'og_description')) {
                $table->text('og_description')->nullable()->after('og_title');
            }
            if (!Schema::hasColumn('products', 'og_image')) {
                $table->string('og_image')->nullable()->after('og_description');
            }
            if (!Schema::hasColumn('products', 'twitter_card')) {
                $table->string('twitter_card')->default('summary_large_image')->after('og_image');
            }
            if (!Schema::hasColumn('products', 'twitter_title')) {
                $table->string('twitter_title')->nullable()->after('twitter_card');
            }
            if (!Schema::hasColumn('products', 'twitter_description')) {
                $table->text('twitter_description')->nullable()->after('twitter_title');
            }
            if (!Schema::hasColumn('products', 'twitter_image')) {
                $table->string('twitter_image')->nullable()->after('twitter_description');
            }
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'meta_status', 'og_title', 'og_description', 'og_image',
                'twitter_card', 'twitter_title', 'twitter_description', 'twitter_image',
            ]);
        });
    }
};