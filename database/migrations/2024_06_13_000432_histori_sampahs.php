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
        //
        Schema::create('histori_sampahs', function (Blueprint $table) {
            $table->unsignedInteger('id',11)->primary();
            $table->unsignedInteger('ketinggian_sampah');
            $table->dateTime('waktu')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->double('volume', 6,2);
            $table->unsignedInteger('id_alat',11);
            $table->text('keterangan');
            
            // Menambahkan foreign key constraint
            $table->foreign('id_alat')->references('id')->on('referensi_alat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('histori_sampahs');
    }
};
