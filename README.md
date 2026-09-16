# 📚 PerpusID

Aplikasi web sederhana untuk **manajemen data buku (CRUD)** perpustakaan berbasis **Laravel 11**, **Tailwind CSS v4**, dan **MySQL**.

---

## ⚡ Fitur Utama

- **Tambah Buku (Create)**: Menambahkan koleksi buku baru lengkap dengan informasi ISBN, penulis, stok, dan sinopsis.
- **Lihat Buku (Read)**: Menampilkan daftar buku (dengan tabel di desktop dan kartu di mobile) serta halaman detail buku.
- **Edit Buku (Update)**: Memperbarui informasi buku yang sudah ada.
- **Hapus Buku (Delete)**: Menghapus data buku dengan dialog konfirmasi.
- **Tampilan Responsif**: Nyaman digunakan di HP, tablet, maupun laptop.

---

## 🛠️ Tech Stack

- **Framework**: Laravel 11 (PHP 8.4+)
- **Database**: MySQL
- **Frontend**: Tailwind CSS v4 & Blade
- **Build Tool**: Vite

---

## 🚀 Cara Instalasi & Menjalankan

### 1. Masuk ke Folder Proyek
```bash
cd PerpusID
```

### 2. Install Dependensi
```bash
composer install
npm install
```

### 3. Konfigurasi Database (.env)
Pastikan file `.env` sudah ada (jika belum, salin dari `.env.example` dan jalankan `php artisan key:generate`).

Sesuaikan kredensial database Anda di `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpusid
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Setup Database & Data Awal
Buat database bernama `perpusid` di MySQL/MariaDB, lalu jalankan:
```bash
php artisan migrate --seed
```

### 5. Build Aset & Jalankan Server
```bash
# Build tampilan
npm run build

# Jalankan server
php artisan serve
```

Buka browser di: **`http://localhost:8000`**

*(Opsional: Jika ingin mode development dengan live-reload, jalankan `npm run dev` di terminal terpisah).*

---

## 📖 Cara Penggunaan

1. **Melihat Buku**: Buka `http://localhost:8000`, Anda langsung diarahkan ke halaman daftar buku.
2. **Menambah Buku**: Klik tombol **"Tambah Buku"** di pojok kanan atas, isi formulir, lalu klik **"Simpan Buku"**.
3. **Melihat Detail**: Klik ikon mata / tombol **"Detail"** pada buku yang dipilih.
4. **Mengubah Buku**: Klik tombol **"Edit"** (ikon pensil), ubah data yang diperlukan, lalu klik **"Update Buku"**.
5. **Menghapus Buku**: Klik tombol **"Hapus"** (ikon tempat sampah), lalu konfirmasi **OK**.

---

## 🧪 Testing

Untuk menjalankan automated test:
```bash
php artisan test
```
*(Detail laporan pengujian tersedia di berkas [`Testing.md`](Testing.md)).*

---

