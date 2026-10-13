<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->enum('meta_status', ['index_follow', 'noindex_unfollow'])
                ->default('index_follow')
                ->after('h1_heading'); // adjust based on your actual column order
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('meta_status');
        });
    }
};