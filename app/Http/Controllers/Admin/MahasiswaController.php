<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $query = Mahasiswa::with('dosenWali');
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where("nama", "like", "%{$search}%")->orWhere("npm", "like", "%{$search}%");
            });
        }
        
        if ($request->filled('nidn')) {
            $query->where('nidn', $request->nidn);
        }
        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }
        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
        }

        $mahasiswas = $query->paginate(10)->withQueryString();
        
        $dosens = Dosen::all();
        $kelas_list = Mahasiswa::whereNotNull('kelas')->distinct()->orderBy('kelas')->pluck('kelas');
        $angkatan_list = Mahasiswa::whereNotNull('angkatan')->distinct()->orderBy('angkatan', 'desc')->pluck('angkatan');
        
        return view("admin.mahasiswa.index", compact("mahasiswas", "dosens", "kelas_list", "angkatan_list"));
    }

    public function create()
    {
        $dosens = Dosen::all();
        return view("admin.mahasiswa.create", compact("dosens"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "npm" => "required|string|size:10|unique:mahasiswa,npm",
            "nama" => "required|string|max:50",
            "kelas" => "nullable|string|max:10",
            "angkatan" => "nullable|integer|min:2000|max:2099",
            "nidn" => "nullable|exists:dosen,nidn",
            "email" => "nullable|email|unique:users,email",
            "password" => "nullable|string|min:8",
        ]);
        
        Mahasiswa::create($request->only(["npm", "nama", "nidn", "kelas", "angkatan"]));
        
        // Buat user untuk login
        $userData = [
            "name" => $request->nama,
            "role" => "mahasiswa",
            "npm" => $request->npm,
            "email" => $request->filled('email') ? $request->email : strtolower($request->npm) . "@siakad.com",
            "password" => $request->filled('password') ? Hash::make($request->password) : Hash::make("password"),
        ];
        User::create($userData);

        return redirect()->route("admin.mahasiswa.index")->with("success", "Data Mahasiswa dan akun login berhasil ditambahkan.");
    }

    public function edit($npm)
    {
        $mahasiswa = Mahasiswa::findOrFail($npm);
        $dosens = Dosen::all();
        return view("admin.mahasiswa.edit", compact("mahasiswa", "dosens"));
    }

    public function update(Request $request, $npm)
    {
        $request->validate([
            "npm" => "required|string|size:10|unique:mahasiswa,npm," . $npm . ",npm",
            "nama" => "required|string|max:50",
            "kelas" => "nullable|string|max:10",
            "angkatan" => "nullable|integer|min:2000|max:2099",
            "nidn" => "nullable|exists:dosen,nidn",
            "email" => "nullable|email|unique:users,email," . User::where('npm', $npm)->value('id'),
            "password" => "nullable|string|min:8",
        ]);
        
        \Illuminate\Support\Facades\DB::table('mahasiswa')->where('npm', $npm)->update([
            'npm' => $request->npm,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'angkatan' => $request->angkatan,
            'nidn' => $request->nidn,
            'updated_at' => now(),
        ]);
        
        // Update user account details (sync identity)
        $userData = [
            'name' => $request->nama,
            'npm' => $request->npm,
            'updated_at' => now(),
        ];

        if ($request->filled('email')) {
            $userData['email'] = $request->email;
        } else {
            $userData['email'] = strtolower($request->npm) . "@siakad.com";
        }

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        \Illuminate\Support\Facades\DB::table('users')->where('npm', $npm)->update($userData);

        return redirect()->route("admin.mahasiswa.index")->with("success", "Data Mahasiswa berhasil diupdate.");
    }

    public function destroy($npm)
    {
        Mahasiswa::findOrFail($npm)->delete();
        // User account is cascaded by foreign key constraint ideally, or manually deleted
        User::where("npm", $npm)->delete();
        
        return redirect()->route("admin.mahasiswa.index")->with("success", "Data Mahasiswa berhasil dihapus.");
    }
}
