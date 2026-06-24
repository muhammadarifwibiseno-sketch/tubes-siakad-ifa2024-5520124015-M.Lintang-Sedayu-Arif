<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\MatakuliahController;
use App\Http\Controllers\Admin\JadwalController as AdminJadwal;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboard;
use App\Http\Controllers\Mahasiswa\KrsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role === 'dosen') {
        return redirect()->route('dosen.dashboard');
    }
    return redirect()->route('mahasiswa.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('dosen', DosenController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('matakuliah', MatakuliahController::class);
    Route::resource('jadwal', AdminJadwal::class);
    Route::get('krs', [\App\Http\Controllers\Admin\KrsAdminController::class, 'index'])->name('krs.index');
    Route::get('krs/{npm}', [\App\Http\Controllers\Admin\KrsAdminController::class, 'show'])->name('krs.show');
});

Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Dosen\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/jadwal', [\App\Http\Controllers\Dosen\JadwalController::class, 'index'])->name('jadwal.index');
    
    // Absensi Dosen Routes
    Route::get('/jadwal/{jadwal}/absensi', [\App\Http\Controllers\Dosen\AbsensiDosenController::class, 'index'])->name('absensi.index');
    Route::get('/jadwal/{jadwal}/absensi/create', [\App\Http\Controllers\Dosen\AbsensiDosenController::class, 'create'])->name('absensi.create');
    Route::post('/jadwal/{jadwal}/absensi', [\App\Http\Controllers\Dosen\AbsensiDosenController::class, 'store'])->name('absensi.store');
    Route::get('/jadwal/{jadwal}/absensi/{absensi}', [\App\Http\Controllers\Dosen\AbsensiDosenController::class, 'show'])->name('absensi.show');
    Route::get('/jadwal/{jadwal}/absensi/{absensi}/edit', [\App\Http\Controllers\Dosen\AbsensiDosenController::class, 'edit'])->name('absensi.edit');
    Route::put('/jadwal/{jadwal}/absensi/{absensi}', [\App\Http\Controllers\Dosen\AbsensiDosenController::class, 'update'])->name('absensi.update');
    Route::delete('/jadwal/{jadwal}/absensi/{absensi}', [\App\Http\Controllers\Dosen\AbsensiDosenController::class, 'destroy'])->name('absensi.destroy');
    Route::post('/jadwal/{jadwal}/absensi/{absensi}/kehadiran/{kehadiran}', [\App\Http\Controllers\Dosen\AbsensiDosenController::class, 'updateStatus'])->name('absensi.update_status');
});

Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [MahasiswaDashboard::class, 'index'])->name('dashboard');
    Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');
    Route::post('/krs', [KrsController::class, 'store'])->name('krs.store');
    Route::delete('/krs/{krs}', [KrsController::class, 'destroy'])->name('krs.destroy');
    Route::get('/krs/pdf', [KrsController::class, 'pdf'])->name('krs.pdf');

    // Absensi Mahasiswa Routes
    Route::get('/absensi', [\App\Http\Controllers\Mahasiswa\AbsensiMahasiswaController::class, 'index'])->name('absensi.index');
    Route::post('/absensi/{kehadiran}', [\App\Http\Controllers\Mahasiswa\AbsensiMahasiswaController::class, 'store'])->name('absensi.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
