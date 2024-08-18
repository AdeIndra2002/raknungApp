<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_id',
        'status',
        'verif_by',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verif_by');
    }
}
