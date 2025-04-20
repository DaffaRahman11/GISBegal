<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function kecamatan_DetailCuras(): HasMany{
        return $this->hasMany(Detail_Curas::class);   
    }
    
    public function kecamatan_DetailCuranmor(): HasMany{
        return $this->hasMany(Detail_Curanmor::class);   
    }
}
