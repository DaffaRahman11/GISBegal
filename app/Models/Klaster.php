<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Klaster extends Model
{
    /** @use HasFactory<\Database\Factories\KlasterFactory> */
    use HasFactory;

    protected $guarded =['id'];

    public function klasterCuras(): HasMany{
        return $this->hasMany(Curas::class);   
    }
    
    public function klasterCuranmor(): HasMany{
        return $this->hasMany(Curanmor::class);   
    }
}
