# SIAKAD — Sistem Informasi Akademik Sederhana

> Tugas Besar Mata Kuliah Web II (IF53413)  
> **Nama:** Reza Puda Julianda  
> **NPM:** 5520122139  
> **Kelas:** IF-A  

---

## Deskripsi Aplikasi

SIAKAD adalah aplikasi web berbasis **Laravel** yang mensimulasikan Sistem Informasi Akademik sederhana. Aplikasi ini memungkinkan pengelolaan data dosen, mahasiswa, mata kuliah, jadwal perkuliahan, dan Kartu Rencana Studi (KRS) dengan sistem **role-based access control** (Admin, Dosen, Mahasiswa).

---

## Teknologi yang Digunakan

| Teknologi | Keterangan |
|-----------|------------|
| Laravel 11 | Framework PHP utama |
| Tailwind CSS | Styling frontend |
| Alpine.js | Interaktivitas UI |
| MySQL | Database |
| Laravel Breeze | Authentication |
| DomPDF | Export KRS ke PDF |
| Chart.js | Dashboard statistik |

---

## Akun Default (Seeder)

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@siakad.com | password |
| Dosen | 1111111111@siakad.com | password |
| Mahasiswa | reza@siakad.com | password |

---

## Fitur & Penjelasan Halaman

### 🔐 Authentication
| Halaman | URL | Fungsi |
|---------|-----|--------|
| Login | `/login` | Halaman login untuk semua role (Admin, Dosen, Mahasiswa) |
| Logout | — | Tombol logout di navbar kanan atas |

Sistem dilindungi middleware `RoleMiddleware` — setiap halaman hanya bisa diakses role yang sesuai.

---

### 👨‍💼 Admin

| Halaman | URL | Fungsi |
|---------|-----|--------|
| Dashboard | `/admin/dashboard` | Statistik real-time: total mahasiswa, dosen, matakuliah, KRS. Grafik jadwal per hari, matakuliah terpopuler, mahasiswa per angkatan, jadwal hari ini |
| Kelola Dosen | `/admin/dosen` | CRUD dosen + otomatis buat akun login dosen. Fitur search |
| Kelola Mahasiswa | `/admin/mahasiswa` | CRUD mahasiswa + filter kelas & angkatan. Fitur search |
| Kelola Mata Kuliah | `/admin/matakuliah` | CRUD mata kuliah (kode, nama, SKS). Fitur search |
| Kelola Jadwal | `/admin/jadwal` | CRUD jadwal (relasi ke dosen & matakuliah, filter hari). Fitur search |
| Data KRS | `/admin/krs` | Lihat KRS seluruh mahasiswa + detail KRS per mahasiswa |

---

### 🎓 Mahasiswa

| Halaman | URL | Fungsi |
|---------|-----|--------|
| Dashboard | `/mahasiswa/dashboard` | Ringkasan KRS dan info akademik |
| KRS | `/mahasiswa/krs` | Ambil/drop mata kuliah, lihat total SKS, **export PDF** |
| Absensi | `/mahasiswa/absensi` | Lihat status kehadiran per kelas & konfirmasi kehadiran |

---

### 👨‍🏫 Dosen

| Halaman | URL | Fungsi |
|---------|-----|--------|
| Dashboard | `/dosen/dashboard` | Ringkasan jadwal mengajar |
| Jadwal Mengajar | `/dosen/jadwal` | Lihat semua jadwal mengajar |
| Kelola Absensi | `/dosen/jadwal/{id}/absensi` | Buat sesi absensi & kelola status kehadiran mahasiswa |

---

## Ketentuan Teknis yang Dipenuhi

- ✅ **Migration** — 11 file migration untuk semua tabel
- ✅ **Seeder** — Data dummy admin, dosen, mahasiswa, matakuliah
- ✅ **Eloquent ORM** — Digunakan di semua controller
- ✅ **Eloquent Relationship** — hasMany, belongsTo pada semua model
- ✅ **Middleware** — `RoleMiddleware` untuk proteksi route per role
- ✅ **Validasi Laravel** — `$request->validate()` di semua form

---

## Bonus

- ✅ **Export KRS ke PDF** (barryvdh/laravel-dompdf)
- ✅ **Pencarian & Filter** di semua halaman data
- ✅ **Dashboard Statistik** dengan data real dari database + Chart.js

---

## Cara Instalasi

```bash
# 1. Clone repository
git clone https://github.com/Rezap1/tubes-siakad-ifa2024-5520122139-reza-pudaj.git
cd tubes-siakad-ifa2024-5520122139-reza-pudaj

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di .env
# DB_CONNECTION=mysql
# DB_DATABASE=siakad
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Migrasi & seeder
php artisan migrate --seed

# 6. Jalankan aplikasi (2 terminal berbeda)
npm run dev        # Terminal 1 — asset compiler
php artisan serve  # Terminal 2 — web server

# 7. Buka browser
# http://127.0.0.1:8000
```

---

## Struktur Database (ERD)

```
dosen          (nidn PK, nama)
mahasiswa      (npm PK, nama, nidn FK→dosen, kelas, angkatan)
matakuliah     (kode_matakuliah PK, nama_matakuliah, sks)
jadwal         (id PK, kode_matakuliah FK, nidn FK, kelas, hari, jam, angkatan)
krs            (id PK, npm FK→mahasiswa, kode_matakuliah FK→matakuliah)
absensi        (id PK, jadwal_id FK, tanggal, pertemuan)
kehadiran      (id PK, absensi_id FK, npm FK, status)
```

---

## Screenshots

Lihat folder [`screenshots/`](./screenshots/) untuk tangkapan layar setiap halaman.

| Halaman | File |
|---------|------|
| Login | `screenshots/login.png` |
| Dashboard Admin | `screenshots/admin-dashboard.png` |
| Kelola Dosen | `screenshots/admin-dosen.png` |
| Kelola Mahasiswa | `screenshots/admin-mahasiswa.png` |
| Kelola Mata Kuliah | `screenshots/admin-matakuliah.png` |
| Kelola Jadwal | `screenshots/admin-jadwal.png` |
| Data KRS (Admin) | `screenshots/admin-krs.png` |
| KRS Mahasiswa | `screenshots/mahasiswa-krs.png` |
| Absensi Mahasiswa | `screenshots/mahasiswa-absensi.png` |
| Dashboard Dosen | `screenshots/dosen-dashboard.png` |

---

## Aspek Penilaian

| No | Aspek | Bobot | Status |
|----|-------|-------|--------|
| 1 | Fungsionalitas (CRUD + Auth + KRS) | 40% | ✅ |
| 2 | Laravel (ORM, Relasi, Auth, Middleware) | 30% | ✅ |
| 3 | UI/UX (Tailwind CSS, Responsive) | 15% | ✅ |
| 4 | Kerapihan Kode | 10% | ✅ |
| 5 | Dokumentasi (README) | 5% | ✅ |
| B | Bonus: Export PDF | — | ✅ |
| B | Bonus: Search & Filter | — | ✅ |
| B | Bonus: Dashboard Statistik | — | ✅ |
