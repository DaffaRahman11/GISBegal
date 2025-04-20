<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail_Curas extends Model
{
    /** @use HasFactory<\Database\Factories\DetailCurasFactory> */
    use HasFactory;

    protected $guarded =['id'];

    public function detailCuras_Curas(): BelongsTo{
        return $this->belongsTo(Curas::class, 'curas_id');
    }
    
    public function detailCuras_Kecamatan(): BelongsTo{
        return $this->belongsTo(Kecamatan::class, 'detailCuras_kecamatan_Id');
    }

    protected $with = ['detailCuras_Curas', 'detailCuras_Kecamatan'];

}
