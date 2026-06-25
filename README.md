# SIAKAD — Sistem Informasi Akademik Sederhana

# LINK HOSTING #
https://lintang.ifalgorithm24.web.id/






> Tugas Besar Mata Kuliah Web II   
> **Nama:** M. Lintang Sedayu Arif  
> **NPM:** 5520124015  
> **Kelas:** IF-A  

---

## Deskripsi Aplikasi

SIAKAD adalah aplikasi web berbasis **Laravel** yang mensimulasikan Sistem Informasi Akademik sederhana. Aplikasi ini memungkinkan pengelolaan data dosen, mahasiswa, mata kuliah, jadwal perkuliahan, dan Kartu Rencana Studi (KRS) dengan sistem **role-based access control** (Admin & Mahasiswa).

---

## Fitur Utama

| Fitur | Admin | Mahasiswa |
|-------|-------|-----------|
| Login / Logout | ✅ | ✅ |
| Kelola Data Dosen | ✅ | ❌ |
| Kelola Data Mahasiswa | ✅ | ❌ |
| Kelola Mata Kuliah | ✅ | ❌ |
| Kelola Jadwal | ✅ | ❌ |
| Lihat Semua KRS | ✅ | ❌ |
| Ambil / Drop KRS | ❌ | ✅ |
| Lihat Jadwal Kuliah | ❌ | ✅ |
| Dashboard Statistik | ✅ | ✅ |

---

## Penjelasan Halaman

| Halaman | Deskripsi |
|---------|-----------|
| `/login` | Halaman login untuk semua user |
| `/dashboard` | Dashboard utama (berbeda per role) |
| `/dosen` | CRUD data dosen (Admin) |
| `/mahasiswa` | CRUD data mahasiswa (Admin) |
| `/matakuliah` | CRUD data mata kuliah (Admin) |
| `/jadwal` | CRUD jadwal perkuliahan (Admin) |
| `/krs` | Lihat semua KRS mahasiswa (Admin) |
| `/mhs/jadwal` | Lihat jadwal perkuliahan (Mahasiswa) |
| `/mhs/krs` | Ambil/drop mata kuliah KRS (Mahasiswa) |

---

## Teknologi yang Digunakan

- **Framework:** Laravel 11
- **Auth & Role:** Spatie Laravel Permission
- **Database:** MySQL
- **Frontend:** Bootstrap 5 + Font Awesome 6
- **ORM:** Eloquent Laravel

---

## Cara Instalasi

```bash
git clone https://github.com/muhammadarifwibiseno-sketch/tubes-siakad-ifa2024-5520124015-M.Lintang-Sedayu-Arif.git
cd tubes-siakad-ifa2024-5520124015-M.Lintang-Sedayu-Arif
composer install
cp .env.example .env
php artisan key:generate
# Setting database di .env
php artisan migrate --seed
php artisan serve
```

---

## Akun Default

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@siakad.com | password |
| Mahasiswa | arif@siakad.com | password |

---

## Screenshots

Lihat folder [`screenshots/`](./screenshots/) untuk tampilan setiap halaman.
