<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarPenerimaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'penerimaan_id',
        'gambar',
    ];

    public function penerimaan()
    {
        return $this->belongsTo(Penerimaan::class);
    }
}
