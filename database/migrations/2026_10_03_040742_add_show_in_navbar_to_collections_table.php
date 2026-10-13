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
    Schema::table('collections', function (Blueprint $table) {
        $table->boolean('show_in_navbar')->default(0)->after('status');
    });
}

public function down()
{
    Schema::table('collections', function (Blueprint $table) {
        $table->dropColumn('show_in_navbar');
    });
}

};
