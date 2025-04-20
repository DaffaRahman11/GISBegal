<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail_Curanmor extends Model
{
    /** @use HasFactory<\Database\Factories\DetailCuranmorFactory> */
    use HasFactory;

    protected $guarded =['id'];

    public function detailCuranmor_Curanmor(): BelongsTo{
        return $this->belongsTo(Curanmor::class, 'curanmor_id');
    }
    
    public function detailCuranmor_Kecamatan(): BelongsTo{
        return $this->belongsTo(Kecamatan::class, 'detailCuranmor_kecamatan_Id');
    }

    protected $with = ['detailCuranmor_Curanmor', 'detailCuranmor_Kecamatan'];
}
