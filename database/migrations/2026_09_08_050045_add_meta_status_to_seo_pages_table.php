<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('seo_pages', function (Blueprint $table) {
            $table->enum('meta_status', ['index_follow', 'noindex_unfollow'])
                ->default('index_follow')
                ->after('page_name');
        });
    }

    public function down()
    {
        Schema::table('seo_pages', function (Blueprint $table) {
            $table->dropColumn('meta_status');
        });
    }
};