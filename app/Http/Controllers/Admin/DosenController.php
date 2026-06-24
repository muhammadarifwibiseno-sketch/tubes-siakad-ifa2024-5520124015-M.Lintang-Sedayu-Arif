<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $query = Dosen::query();
        if ($search) {
            $query->where("nama", "like", "%{$search}%")->orWhere("nidn", "like", "%{$search}%");
        }
        $dosens = $query->paginate(10);
        return view("admin.dosen.index", compact("dosens"));
    }

    public function create()
    {
        return view("admin.dosen.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "nidn" => "required|string|size:10|unique:dosen,nidn",
            "nama" => "required|string|max:50",
            "email" => "nullable|email|unique:users,email",
            "password" => "nullable|string|min:8",
        ]);
        Dosen::create($request->only(["nidn", "nama"]));

        $userData = [
            "name" => $request->nama,
            "role" => "dosen",
            "nidn" => $request->nidn,
            "email" => $request->filled('email') ? $request->email : strtolower($request->nidn) . "@siakad.com",
            "password" => $request->filled('password') ? Hash::make($request->password) : Hash::make("password"),
        ];
        User::create($userData);

        return redirect()->route("admin.dosen.index")->with("success", "Data Dosen dan akun login berhasil ditambahkan.");
    }

    public function edit($nidn)
    {
        $dosen = Dosen::findOrFail($nidn);
        return view("admin.dosen.edit", compact("dosen"));
    }

    public function update(Request $request, $nidn)
    {
        $request->validate([
            "nidn" => "required|string|size:10|unique:dosen,nidn," . $nidn . ",nidn",
            "nama" => "required|string|max:50",
            "email" => "nullable|email|unique:users,email," . User::where('nidn', $nidn)->value('id'),
            "password" => "nullable|string|min:8",
        ]);
        
        \Illuminate\Support\Facades\DB::table('dosen')->where('nidn', $nidn)->update([
            'nidn' => $request->nidn,
            'nama' => $request->nama,
            'updated_at' => now(),
        ]);

        // Update user account details (sync identity)
        $userData = [
            'name' => $request->nama,
            'nidn' => $request->nidn,
            'updated_at' => now(),
        ];

        if ($request->filled('email')) {
            $userData['email'] = $request->email;
        } else {
            $userData['email'] = strtolower($request->nidn) . "@siakad.com";
        }

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        \Illuminate\Support\Facades\DB::table('users')->where('nidn', $nidn)->update($userData);

        return redirect()->route("admin.dosen.index")->with("success", "Data Dosen berhasil diupdate.");
    }

    public function destroy($nidn)
    {
        Dosen::findOrFail($nidn)->delete();
        User::where("nidn", $nidn)->delete();
        return redirect()->route("admin.dosen.index")->with("success", "Data Dosen berhasil dihapus.");
    }
}
