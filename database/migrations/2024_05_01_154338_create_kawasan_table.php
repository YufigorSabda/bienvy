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
        Schema::create('kawasan', function (Blueprint $table) {
            $table->unsignedInteger('id_kawasan',11)->primary();
            $table->unsignedInteger('luas_kawasan',11);
            $table->unsignedInteger('id_tpa',11);

            $table->foreign('id_tpa')->references('lokasi_tpa')->on('id_tpa');

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kawasan');
    }
};
