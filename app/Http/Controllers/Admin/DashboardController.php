<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Jadwal;
use App\Models\Krs;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama dari database
        $totalDosen      = Dosen::count();
        $totalMahasiswa  = Mahasiswa::count();
        $totalMatakuliah = Matakuliah::count();
        $totalJadwal     = Jadwal::count();
        $totalKrs        = Krs::count();

        // Chart 1: Jadwal per hari
        $hariLabels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $jadwalPerHari = Jadwal::select('hari', DB::raw('count(*) as total'))
            ->groupBy('hari')
            ->pluck('total', 'hari')->toArray();
        $jadwalData = array_map(fn($h) => $jadwalPerHari[$h] ?? 0, $hariLabels);

        // Chart 2: Top 5 Matakuliah paling banyak diambil di KRS
        $topMatkul = Krs::select('kode_matakuliah', DB::raw('count(*) as total'))
            ->groupBy('kode_matakuliah')
            ->orderByDesc('total')
            ->limit(5)
            ->with('matakuliah')
            ->get();
        $matkulLabels = $topMatkul->map(fn($k) => $k->matakuliah->nama_matakuliah ?? $k->kode_matakuliah)->toArray();
        $matkulData   = $topMatkul->pluck('total')->toArray();

        // Chart 3: Mahasiswa per angkatan
        $mhsPerAngkatan = Mahasiswa::select('angkatan', DB::raw('count(*) as total'))
            ->whereNotNull('angkatan')
            ->groupBy('angkatan')
            ->orderBy('angkatan')
            ->pluck('total', 'angkatan')->toArray();
        $angkatanLabels = array_keys($mhsPerAngkatan);
        $angkatanData   = array_values($mhsPerAngkatan);

        // Daftar jadwal hari ini
        $hariIni = now()->locale('id')->dayName;
        $jadwalHariIni = Jadwal::with(['dosen', 'matakuliah'])
            ->where('hari', $hariIni)
            ->orderBy('jam')
            ->limit(5)
            ->get();

        // Mahasiswa baru (5 terbaru)
        $mahasiswaBaru = Mahasiswa::orderByDesc('created_at')->limit(5)->get();

        return view("admin.dashboard", compact(
            'totalDosen', 'totalMahasiswa', 'totalMatakuliah', 'totalJadwal', 'totalKrs',
            'hariLabels', 'jadwalData',
            'matkulLabels', 'matkulData',
            'angkatanLabels', 'angkatanData',
            'jadwalHariIni', 'mahasiswaBaru'
        ));
    }
}
