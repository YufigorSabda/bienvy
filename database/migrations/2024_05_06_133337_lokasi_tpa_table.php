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
        Schema::create('lokasi_tpa', function (Blueprint $table) {
            $table->unsignedInteger('id_tpa')->primary();
            $table->unsignedBigInteger('luas_tpa',11);
            $table->string('lokasi_tpa',10);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi_tpa');
    }
};
