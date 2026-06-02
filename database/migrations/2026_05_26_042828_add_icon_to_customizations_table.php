<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customizations', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('short_description');
        });
    }

    public function down(): void
    {
        Schema::table('customizations', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }
};