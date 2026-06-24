<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Absensi;
use App\Models\Kehadiran;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiDosenController extends Controller
{
    public function index($jadwal_id)
    {
        $dosen = Auth::user()->dosen;
        $jadwal = Jadwal::where('id', $jadwal_id)->where('nidn', $dosen->nidn)->firstOrFail();
        $absensis = Absensi::where('jadwal_id', $jadwal_id)->orderBy('tanggal', 'desc')->orderBy('waktu_mulai', 'desc')->get();

        return view('dosen.absensi.index', compact('jadwal', 'absensis'));
    }

    public function create($jadwal_id)
    {
        $dosen = Auth::user()->dosen;
        $jadwal = Jadwal::where('id', $jadwal_id)->where('nidn', $dosen->nidn)->firstOrFail();
        $nextPertemuan = Absensi::where('jadwal_id', $jadwal_id)->max('pertemuan_ke') + 1;

        return view('dosen.absensi.create', compact('jadwal', 'nextPertemuan'));
    }

    public function store(Request $request, $jadwal_id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'pertemuan_ke' => 'required|integer|min:1',
        ]);

        $dosen = Auth::user()->dosen;
        $jadwal = Jadwal::where('id', $jadwal_id)->where('nidn', $dosen->nidn)->firstOrFail();

        // 1. Create Absensi
        $absensi = Absensi::create([
            'jadwal_id' => $jadwal->id,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'pertemuan_ke' => $request->pertemuan_ke,
        ]);

        // 2. Find eligible Mahasiswa (match kelas, angkatan, and has KRS for this matakuliah)
        $mahasiswas = Mahasiswa::where('kelas', $jadwal->kelas)
            ->where('angkatan', $jadwal->angkatan)
            ->whereHas('krs', function($q) use ($jadwal) {
                $q->where('kode_matakuliah', $jadwal->kode_matakuliah);
            })->get();

        // 3. Create default Kehadiran (Alpa) for each
        foreach ($mahasiswas as $mhs) {
            Kehadiran::create([
                'absensi_id' => $absensi->id,
                'npm' => $mhs->npm,
                'status' => 'Alpa',
            ]);
        }

        return redirect()->route('dosen.absensi.index', $jadwal->id)->with('success', 'Sesi absensi berhasil dibuat.');
    }

    public function show($jadwal_id, $absensi_id)
    {
        $dosen = Auth::user()->dosen;
        $jadwal = Jadwal::where('id', $jadwal_id)->where('nidn', $dosen->nidn)->firstOrFail();
        $absensi = Absensi::where('id', $absensi_id)->where('jadwal_id', $jadwal->id)->firstOrFail();
        
        // --- SYNC MISSING KEHADIRAN FOR THIS SESSION ---
        // Catch students who might have added the KRS after the session was created
        $mahasiswas = Mahasiswa::where('kelas', $jadwal->kelas)
            ->where('angkatan', $jadwal->angkatan)
            ->whereHas('krs', function($q) use ($jadwal) {
                $q->where('kode_matakuliah', $jadwal->kode_matakuliah);
            })->get();

        foreach ($mahasiswas as $mhs) {
            $exists = Kehadiran::where('absensi_id', $absensi->id)
                               ->where('npm', $mhs->npm)
                               ->exists();
            if (!$exists) {
                Kehadiran::create([
                    'absensi_id' => $absensi->id,
                    'npm' => $mhs->npm,
                    'status' => 'Alpa',
                ]);
            }
        }
        // --- END SYNC ---

        $kehadirans = Kehadiran::with('mahasiswa')
            ->where('absensi_id', $absensi->id)
            ->get()
            ->sortBy(function($k) {
                return $k->mahasiswa->nama ?? '';
            });

        return view('dosen.absensi.show', compact('jadwal', 'absensi', 'kehadirans'));
    }

    public function updateStatus(Request $request, $jadwal_id, $absensi_id, $kehadiran_id)
    {
        $request->validate([
            'status' => 'required|in:Hadir,Izin,Sakit,Alpa'
        ]);

        $dosen = Auth::user()->dosen;
        $jadwal = Jadwal::where('id', $jadwal_id)->where('nidn', $dosen->nidn)->firstOrFail();
        $absensi = Absensi::where('id', $absensi_id)->where('jadwal_id', $jadwal->id)->firstOrFail();
        
        $kehadiran = Kehadiran::where('id', $kehadiran_id)->where('absensi_id', $absensi->id)->firstOrFail();
        $kehadiran->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status absensi berhasil diperbarui.');
    }

    public function edit($jadwal_id, $absensi_id)
    {
        $dosen = Auth::user()->dosen;
        $jadwal = Jadwal::where('id', $jadwal_id)->where('nidn', $dosen->nidn)->firstOrFail();
        $absensi = Absensi::where('id', $absensi_id)->where('jadwal_id', $jadwal->id)->firstOrFail();

        return view('dosen.absensi.edit', compact('jadwal', 'absensi'));
    }

    public function update(Request $request, $jadwal_id, $absensi_id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'pertemuan_ke' => 'required|integer|min:1',
        ]);

        $dosen = Auth::user()->dosen;
        $jadwal = Jadwal::where('id', $jadwal_id)->where('nidn', $dosen->nidn)->firstOrFail();
        $absensi = Absensi::where('id', $absensi_id)->where('jadwal_id', $jadwal->id)->firstOrFail();

        $absensi->update([
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'pertemuan_ke' => $request->pertemuan_ke,
        ]);

        return redirect()->route('dosen.absensi.index', $jadwal->id)->with('success', 'Sesi absensi berhasil diperbarui.');
    }

    public function destroy($jadwal_id, $absensi_id)
    {
        $dosen = Auth::user()->dosen;
        $jadwal = Jadwal::where('id', $jadwal_id)->where('nidn', $dosen->nidn)->firstOrFail();
        $absensi = Absensi::where('id', $absensi_id)->where('jadwal_id', $jadwal->id)->firstOrFail();

        // Delete associated Kehadiran first
        Kehadiran::where('absensi_id', $absensi->id)->delete();
        $absensi->delete();

        return redirect()->route('dosen.absensi.index', $jadwal->id)->with('success', 'Sesi absensi berhasil dihapus.');
    }
}
