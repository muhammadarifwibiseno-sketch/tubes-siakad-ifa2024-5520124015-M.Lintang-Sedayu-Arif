<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dosen = $user->dosen;
        
        $totalJadwal = Jadwal::where('nidn', $user->nidn)->count();
        $totalBimbingan = \App\Models\Mahasiswa::where('nidn', $user->nidn)->count();

        // Get schedules for today
        $hariIni = \Carbon\Carbon::now()->locale('id')->isoFormat('dddd');
        $jadwalsHariIni = Jadwal::where('nidn', $user->nidn)
            ->where('hari', $hariIni)
            ->with('matakuliah')
            ->orderBy('jam', 'asc')
            ->get();

        return view('dosen.dashboard', compact('dosen', 'totalJadwal', 'totalBimbingan', 'jadwalsHariIni', 'hariIni'));
    }
}
