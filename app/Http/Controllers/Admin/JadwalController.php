<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Dosen;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $query = Jadwal::with(["dosen", "matakuliah"]);
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas("matakuliah", function($q2) use ($search) {
                    $q2->where("nama_matakuliah", "like", "%{$search}%");
                })->orWhereHas("dosen", function($q2) use ($search) {
                    $q2->where("nama", "like", "%{$search}%");
                })->orWhere("hari", "like", "%{$search}%");
            });
        }

        if ($request->filled('hari')) {
            $query->where('hari', $request->hari);
        }
        if ($request->filled('nidn')) {
            $query->where('nidn', $request->nidn);
        }
        if ($request->filled('kode_matakuliah')) {
            $query->where('kode_matakuliah', $request->kode_matakuliah);
        }
        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
        }

        $jadwals = $query->paginate(10)->withQueryString();
        
        $dosens = Dosen::all();
        $matakuliahs = Matakuliah::all();
        $hari_list = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return view("admin.jadwal.index", compact("jadwals", "dosens", "matakuliahs", "hari_list"));
    }

    public function create()
    {
        $dosens = Dosen::all();
        $matakuliahs = Matakuliah::all();
        return view("admin.jadwal.create", compact("dosens", "matakuliahs"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "kode_matakuliah" => "required|exists:matakuliah,kode_matakuliah",
            "nidn" => "required|exists:dosen,nidn",
            "kelas" => "required|string|max:1",
            "angkatan" => "required|integer|min:2000|max:2099",
            "hari" => "required|string|max:10",
            "jam" => "required", // time format
        ]);
        Jadwal::create($request->all());
        return redirect()->route("admin.jadwal.index")->with("success", "Jadwal berhasil ditambahkan.");
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $dosens = Dosen::all();
        $matakuliahs = Matakuliah::all();
        return view("admin.jadwal.edit", compact("jadwal", "dosens", "matakuliahs"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "kode_matakuliah" => "required|exists:matakuliah,kode_matakuliah",
            "nidn" => "required|exists:dosen,nidn",
            "kelas" => "required|string|max:1",
            "angkatan" => "required|integer|min:2000|max:2099",
            "hari" => "required|string|max:10",
            "jam" => "required",
        ]);
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($request->all());
        return redirect()->route("admin.jadwal.index")->with("success", "Jadwal berhasil diupdate.");
    }

    public function destroy($id)
    {
        Jadwal::findOrFail($id)->delete();
        return redirect()->route("admin.jadwal.index")->with("success", "Jadwal berhasil dihapus.");
    }
}
