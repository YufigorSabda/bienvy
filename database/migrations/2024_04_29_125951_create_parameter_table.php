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
        Schema::create('parameter_kualitas_udara', function (Blueprint $table) {
            $table->unsignedInteger('id', 11)->primary();
            $table->string('nama_parameter', 10)->unique();
            $table->double('batas_parameter_atas', 6, 2);
            $table->double('batas_parameter_bawahan', 6, 2);
            $table->string('satuan', 10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameter_kualitas_udara');
    }
};
