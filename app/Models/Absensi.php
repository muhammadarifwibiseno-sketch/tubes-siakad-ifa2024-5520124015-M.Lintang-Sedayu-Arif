<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis';
    protected $fillable = [
        'jadwal_id',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'pertemuan_ke'
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function kehadirans()
    {
        return $this->hasMany(Kehadiran::class);
    }
}
