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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories_properties');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->float('square_meters');
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->default('Portugal');
            $table->integer('bathrooms')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->boolean('kitchen')->default(false);
            $table->boolean('garage')->default(false);
            $table->integer('parking_spaces')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
