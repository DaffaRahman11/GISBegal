<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curanmor extends Model
{
    /** @use HasFactory<\Database\Factories\CuranmorFactory> */
    use HasFactory;

    protected $guarded =['id'];

    public function punyaKlasterCuranmor(): BelongsTo{
        return $this->belongsTo(Klaster::class, 'klaster_id');
    }
    
    public function punyaKecamatanCuranmor(): BelongsTo{
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    protected $with = ['punyaKecamatanCuranmor', 'punyaKlasterCuranmor'];

}
