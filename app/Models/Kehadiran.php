<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $table = 'kehadirans';
    protected $fillable = [
        'absensi_id',
        'npm',
        'status',
        'waktu_absen'
    ];

    public function absensi()
    {
        return $this->belongsTo(Absensi::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'npm', 'npm');
    }
}
