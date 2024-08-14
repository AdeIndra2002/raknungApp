<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarPembelian extends Model
{
    use HasFactory;

    protected $fillable = [
        'pembelian_id',
        'supplier_id',
        'gambar',
    ];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
