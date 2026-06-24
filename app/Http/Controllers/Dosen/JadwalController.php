<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $jadwals = Jadwal::where('nidn', $user->nidn)->with('matakuliah')->get();

        return view('dosen.jadwal', compact('jadwals'));
    }
}
