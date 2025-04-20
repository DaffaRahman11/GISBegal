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
        Schema::create('detail__curas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curas_id')->constrained(
                table: 'curas', indexName: 'detailCuras_curas_id');
            $table->float('tambahan_curas');
            $table->foreignId('detailCuras_kecamatan_Id')->constrained(
                table: 'kecamatans', indexName: 'detailCuras_kecamatan_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail__curas');
    }
};
