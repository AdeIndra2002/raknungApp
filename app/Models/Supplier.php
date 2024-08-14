<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_supplier',
        'no_hp',
    ];

    public function GambarPembelian()
    {
        return $this->hasMany(GambarPembelian::class, 'gambar_pembelian_supplier');
    }
}
