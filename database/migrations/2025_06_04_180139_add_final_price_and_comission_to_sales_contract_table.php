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
        Schema::table('sales_contract', function (Blueprint $table) {
            $table->decimal('final_price_for_seller', 10, 2);
            $table->integer('commission');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales_contract', function (Blueprint $table) {
            //
        });
    }
};
