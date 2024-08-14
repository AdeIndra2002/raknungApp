<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pengaju',
        'divisi_id',
        'tanggal_pengajuan',
        'status',
        'no_surat',
        'note',
        'assign_by',
        'verif_by',
    ];


    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assign_by');
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verif_by');
    }

    public function pengajuanBarang()
    {
        return $this->hasMany(PengajuanBarang::class);
    }

    public function Pembelian()
    {
        return $this->hasMany(Pembelian::class);
    }
}
