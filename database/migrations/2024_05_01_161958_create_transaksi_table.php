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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->unsignedInteger('id_transaksi',11)->primary();
            $table->dateTime('waktu');
            $table->unsignedInteger('id_kawasan',11);
            $table->unsignedInteger('jumlah_muatan',11);
            $table->text('keterangan');

            $table->foreign('id_kawasan')->references('id_kawasan')->on('kawasan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
