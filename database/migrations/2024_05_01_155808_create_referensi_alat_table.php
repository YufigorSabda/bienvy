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
        Schema::create('referensi_alat', function (Blueprint $table) {
            $table->unsignedInteger('id_alat',11)->primary();
            $table->string('alat',10);
            $table->string('kode_alat',10);
            $table->unsignedInteger('id_kawasan',11);
            

            $table->foreign('id_kawasan')->references('id_kawasan')->on('kawasan')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referensi_alat');
    }
};
