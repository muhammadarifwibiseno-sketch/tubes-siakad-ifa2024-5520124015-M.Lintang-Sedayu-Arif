<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $query = Matakuliah::query();
        if ($search) {
            $query->where("nama_matakuliah", "like", "%{$search}%")->orWhere("kode_matakuliah", "like", "%{$search}%");
        }
        $matakuliahs = $query->paginate(10);
        return view("admin.matakuliah.index", compact("matakuliahs"));
    }

    public function create()
    {
        return view("admin.matakuliah.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "kode_matakuliah" => "required|string|size:8|unique:matakuliah,kode_matakuliah",
            "nama_matakuliah" => "required|string|max:50",
            "sks" => "required|integer|min:1|max:6",
        ]);
        Matakuliah::create($request->all());
        return redirect()->route("admin.matakuliah.index")->with("success", "Data Mata Kuliah berhasil ditambahkan.");
    }

    public function edit($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        return view("admin.matakuliah.edit", compact("matakuliah"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "kode_matakuliah" => "required|string|size:8|unique:matakuliah,kode_matakuliah," . $id . ",kode_matakuliah",
            "nama_matakuliah" => "required|string|max:50",
            "sks" => "required|integer|min:1|max:6",
        ]);
        
        \Illuminate\Support\Facades\DB::table('matakuliah')->where('kode_matakuliah', $id)->update([
            'kode_matakuliah' => $request->kode_matakuliah,
            'nama_matakuliah' => $request->nama_matakuliah,
            'sks' => $request->sks,
            'updated_at' => now(),
        ]);

        return redirect()->route("admin.matakuliah.index")->with("success", "Data Mata Kuliah berhasil diupdate.");
    }

    public function destroy($id)
    {
        Matakuliah::findOrFail($id)->delete();
        return redirect()->route("admin.matakuliah.index")->with("success", "Data Mata Kuliah berhasil dihapus.");
    }
}
