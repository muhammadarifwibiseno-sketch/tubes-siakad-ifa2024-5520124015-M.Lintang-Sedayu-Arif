<?php
namespace App\Http\Controllers\Mahasiswa;
use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KrsController extends Controller
{
    public function index()
    {
        $npm = auth()->user()->npm;
        $krs = Krs::with("matakuliah")->where("npm", $npm)->get();
        $matakuliahs = Matakuliah::all();
        $taken = $krs->pluck("kode_matakuliah")->toArray();
        $totalSks = 0;
        foreach ($krs as $k) {
            $totalSks += $k->matakuliah->sks;
        }
        return view("mahasiswa.krs.index", compact("krs", "matakuliahs", "taken", "totalSks"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "kode_matakuliah" => "required|exists:matakuliah,kode_matakuliah"
        ]);
        $npm = auth()->user()->npm;
        if (Krs::where("npm", $npm)->where("kode_matakuliah", $request->kode_matakuliah)->exists()) {
            return back()->with("error", "Mata kuliah sudah diambil.");
        }
        Krs::create([
            "npm" => $npm,
            "kode_matakuliah" => $request->kode_matakuliah
        ]);
        return back()->with("success", "Berhasil mengambil mata kuliah.");
    }

    public function destroy(Krs $krs)
    {
        if ($krs->npm !== auth()->user()->npm) {
            abort(403);
        }
        $krs->delete();
        return back()->with("success", "Berhasil menghapus mata kuliah dari KRS.");
    }

    public function pdf()
    {
        $npm = auth()->user()->npm;
        $user = auth()->user();
        $krs = Krs::with("matakuliah")->where("npm", $npm)->get();
        $totalSks = 0;
        foreach ($krs as $k) {
            $totalSks += $k->matakuliah->sks;
        }
        $pdf = Pdf::loadView("mahasiswa.krs.pdf", compact("krs", "user", "totalSks"));
        return $pdf->download("KRS_".$npm.".pdf");
    }
}
