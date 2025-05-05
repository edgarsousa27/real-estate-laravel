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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nationality')->nullable();
            $table->enum('document', ['passport', 'identity_card'])->nullable();
            $table->integer('identification_number')->unique()->nullable();
            $table->integer('passport_number')->unique()->nullable();
            $table->integer('NIF')->unique()->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('phone_number')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
