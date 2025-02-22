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
        Schema::create('curanmors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kecamatan_id')->constrained(
                table: 'kecamatans', indexName: 'curanmor_kecamatan_id');
            $table->float('jumlah_curanmor');
            $table->foreignId('klaster_id')->nullable()->constrained(
                table: 'klasters', indexName: 'klaster_kecamata_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curanmors');
    }
};
