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
        Schema::create('histori_kawasan', function (Blueprint $table) {
            $table->unsignedInteger('id',11)->primary();
            $table->unsignedInteger('id_kawasan',11);
            $table->string('status');
            $table->dateTime('waktu')->default(DB::raw('CURRENT_TIMESTAMP'));
            
            // Menambahkan foreign key constraint
            $table->foreign('id_kawasan')->references('id_kawasan')->on('kawasan')->onDelete('cascade');
        });
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('histori_kawasan');
    }
};
