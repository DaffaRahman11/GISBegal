<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curas extends Model
{
    /** @use HasFactory<\Database\Factories\CurasFactory> */
    use HasFactory;

    protected $guarded =['id'];

    public function punyaKlasterCuras(): BelongsTo{
        return $this->belongsTo(Klaster::class, 'klaster_id');
    }

    
    public function punyaKecamatanCuras(): BelongsTo {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id'); // Pastikan FK benar
    }
    

    
}
