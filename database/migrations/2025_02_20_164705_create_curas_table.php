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
        Schema::create('curas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kecamatan_id')->constrained(
                table: 'kecamatans', indexName: 'curas_kecamatan_id');
            $table->float('jumlah_curas');
            $table->foreignId('klaster_id')->nullable()->constrained(
                table: 'klasters', indexName: 'curas_klaster_id')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curas');
    }
};
