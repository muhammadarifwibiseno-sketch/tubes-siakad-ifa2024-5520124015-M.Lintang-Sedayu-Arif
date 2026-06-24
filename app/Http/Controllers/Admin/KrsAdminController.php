<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class KrsAdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $query = Mahasiswa::with(['krs.matakuliah']);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('npm', 'like', "%{$search}%");
            });
        }

        $mahasiswas = $query->paginate(10)->withQueryString();
        return view('admin.krs.index', compact('mahasiswas'));
    }

    public function show($npm)
    {
        $mahasiswa = Mahasiswa::with(['krs.matakuliah'])->findOrFail($npm);
        $krs = $mahasiswa->krs;
        $totalSks = $krs->sum(fn($k) => $k->matakuliah->sks ?? 0);
        return view('admin.krs.show', compact('mahasiswa', 'krs', 'totalSks'));
    }
}
