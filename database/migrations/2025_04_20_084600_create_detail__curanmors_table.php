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
        Schema::create('detail__curanmors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curanmor_id')->constrained(
                table: 'curanmors', indexName: 'detailCuranmor_curanmor_id');
            $table->float('tambahan_curanmor');
            $table->foreignId('detailCuranmor_kecamatan_Id')->constrained(
                table: 'kecamatans', indexName: 'detailCuranmor_kecamatan_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail__curanmors');
    }
};
