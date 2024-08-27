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
        Schema::create('histori_perkiraan', function (Blueprint $table) {
            $table->unsignedInteger('id',11)->primary();
            $table->dateTime('waktu')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('keterangan');
            $table->unsignedInteger('id_parameter',11);
            $table->double('nilai_parameter', 6, 2);
            
            // Menambahkan foreign key constraint
            $table->foreign('id_parameter')->references('id')->on('parameter_kualitas_udara')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histori_perkiraan');
    }
};
