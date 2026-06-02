<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enquiry_items', function (Blueprint $table) {

            $table->unsignedBigInteger('customization_id')
                ->nullable()
                ->after('product_id');

            $table->foreign('customization_id')
                ->references('id')
                ->on('customizations')
                ->nullOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('enquiry_items', function (Blueprint $table) {

            $table->dropForeign(['customization_id']);
            $table->dropColumn('customization_id');

        });
    }
};