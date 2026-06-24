<?php
namespace App\Http\Controllers\Mahasiswa;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Krs;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $npm = auth()->user()->npm;
        $krsMatakuliah = Krs::where("npm", $npm)->pluck("kode_matakuliah");
        $jadwals = Jadwal::with(["dosen", "matakuliah"])->whereIn("kode_matakuliah", $krsMatakuliah)->get();
        return view("mahasiswa.dashboard", compact("jadwals"));
    }
}
