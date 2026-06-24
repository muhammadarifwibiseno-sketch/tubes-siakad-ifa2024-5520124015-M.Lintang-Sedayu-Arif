<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Kehadiran;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiMahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        
        // --- SYNC MISSING KEHADIRAN ---
        // Find all Jadwals the student should be in (based on KRS, kelas, angkatan)
        $krsMhs = \App\Models\Krs::where('npm', $mahasiswa->npm)->pluck('kode_matakuliah')->toArray();
        $jadwals = Jadwal::where('kelas', $mahasiswa->kelas)
            ->where('angkatan', $mahasiswa->angkatan)
            ->whereIn('kode_matakuliah', $krsMhs)
            ->get();
            
        // For each valid jadwal, check if there are absensi sessions missing a kehadiran record for this student
        foreach($jadwals as $jadwal) {
            $absensis = Absensi::where('jadwal_id', $jadwal->id)->get();
            foreach($absensis as $absensi) {
                $exists = Kehadiran::where('absensi_id', $absensi->id)
                                   ->where('npm', $mahasiswa->npm)
                                   ->exists();
                if (!$exists) {
                    Kehadiran::create([
                        'absensi_id' => $absensi->id,
                        'npm' => $mahasiswa->npm,
                        'status' => 'Alpa',
                    ]);
                }
            }
        }
        // --- END SYNC ---

        // Find all Kehadiran for this Mahasiswa
        $kehadirans = Kehadiran::with(['absensi.jadwal.matakuliah', 'absensi.jadwal.dosen'])
            ->where('npm', $mahasiswa->npm)
            ->get()
            ->sortByDesc(function($k) {
                return $k->absensi->tanggal . ' ' . $k->absensi->waktu_mulai;
            });

        return view('mahasiswa.absensi.index', compact('kehadirans', 'mahasiswa'));
    }

    public function store(Request $request, $kehadiran_id)
    {
        $request->validate([
            'status' => 'required|in:Hadir,Izin,Sakit'
        ]);

        $mahasiswa = Auth::user()->mahasiswa;
        $kehadiran = Kehadiran::where('id', $kehadiran_id)->where('npm', $mahasiswa->npm)->firstOrFail();
        $absensi = $kehadiran->absensi;

        $now = Carbon::now();
        $tanggalSekarang = $now->format('Y-m-d');
        $waktuSekarang = $now->format('H:i:s');
        
        $absensiTanggal = Carbon::parse($absensi->tanggal)->format('Y-m-d');
        $absensiWaktuMulai = Carbon::parse($absensi->waktu_mulai)->format('H:i:s');
        $absensiWaktuSelesai = Carbon::parse($absensi->waktu_selesai)->format('H:i:s');

        // Check if the current date and time are within the allowed range
        if ($absensiTanggal == $tanggalSekarang && $waktuSekarang >= $absensiWaktuMulai && $waktuSekarang <= $absensiWaktuSelesai) {
            $kehadiran->update([
                'status' => $request->status,
                'waktu_absen' => $now
            ]);
            return redirect()->back()->with('success', 'Berhasil mencatat absensi dengan status: ' . $request->status);
        }

        return redirect()->back()->with('error', "Gagal absen. Sesi ini belum dimulai atau sudah ditutup. Debug: $absensiTanggal == $tanggalSekarang, $waktuSekarang >= $absensiWaktuMulai, $waktuSekarang <= $absensiWaktuSelesai");
    }
}
