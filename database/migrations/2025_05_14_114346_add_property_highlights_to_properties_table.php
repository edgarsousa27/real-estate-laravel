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
        Schema::table('properties', function (Blueprint $table) {
            $table->boolean('heating')->default(false);
            $table->boolean('cooling')->default(false); 
            $table->boolean('kitchen_equipped')->default(false); 
            $table->boolean('double_glazing')->default(false); 
            $table->boolean('security_alarm_system')->default(false); 
            $table->boolean('fire_alarm_system')->default(false); 
            $table->boolean('garden')->default(false); 
            $table->boolean('balcony')->default(false);
            $table->boolean('terrace')->default(false);
            $table->boolean('solar_panels')->default(false); 
            $table->boolean('thermal_insulation')->default(false);
            $table->boolean('fireplace')->default(false); 
            $table->boolean('elevator')->default(false);
            $table->boolean('storage')->default(false);
            $table->boolean('swimming_pool')->default(false);
            $table->boolean('sea_view')->default(false);
            $table->boolean('mountain_view')->default(false);
            $table->boolean('open_plan_kitchen')->default(false);
            $table->boolean('smart_home')->default(false);
            $table->boolean('furnished')->default(false);
            $table->boolean('building_pool')->default(false);
            $table->boolean('building_gym')->default(false);
            $table->boolean('wheelchair_access')->default(false);
            $table->boolean('well_water')->default(false);
            $table->boolean('electricity')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            //
        });
    }
};
