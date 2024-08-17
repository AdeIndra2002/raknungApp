<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_id',
        'total_harga',
        'status',
        'note',
        'verif_by',
    ];

    public function penerimaan()
    {
        return $this->hasMany(Penerimaan::class);
    }

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verif_by');
    }

    public function GambarPembelian()
    {
        return $this->hasMany(GambarPembelian::class);
    }
}
