<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_id',
        'barang_id',
        'jumlah',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
