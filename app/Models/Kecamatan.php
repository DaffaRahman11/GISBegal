<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kecamatan extends Model
{
    /** @use HasFactory<\Database\Factories\KecamatanFactory> */
    use HasFactory;

    protected $guarded =['id'];

    public function kecamatanCuras(): HasOne {
        return $this->hasOne(Curas::class);   
    }
    
    public function kecamatanCuranmor(): HasOne {
        return $this->hasOne(Curanmor::class);   
    }
}
