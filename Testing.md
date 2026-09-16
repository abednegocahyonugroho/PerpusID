# Laporan Hasil Testing Fitur CRUD PerpusID

Dokumen ini memuat laporan lengkap hasil pengujian otomatis (*automated feature testing*) dan validasi fungsional terhadap fitur **CRUD (Create, Read, Update, Delete) Manajemen Buku** pada aplikasi **PerpusID**.

---

## 1. Ringkasan Eksekutif

| Parameter | Nilai / Keterangan |
| :--- | :--- |
| **Aplikasi** | PerpusID (Sistem Manajemen Perpustakaan Digital) |
| **Modul Diuji** | Fitur CRUD Buku (`BookController`, Model `Book`, Routing, Database) |
| **Tanggal Pengujian** | 16 September 2026 |
| **Lingkungan Pengujian** | PHP 8.5.10, Laravel 11, MariaDB/MySQL 10.4, PHPUnit 12.5.34 |
| **Total Test Case (CRUD)** | 15 Test Cases |
| **Total Assertions** | 66 Assertions |
| **Hasil Akhir** | **15 Lolos (100% PASS)**, 0 Gagal, 0 Eror |
| **Waktu Eksekusi** | ~1.36 detik |

---

## 2. Ruang Lingkup Pengujian

Pengujian mencakup seluruh rute sumber daya (*resource routes*) dan interaksi basis data untuk entitas buku:

1. **Create (C)**:
   - Akses form input penambahan buku baru (`GET /books/create` - `books.create`).
   - Penyimpanan data buku baru yang valid ke basis data (`POST /books` - `books.store`).
   - Validasi data masukan (field wajib, format numerik, batas tahun terbit, minimal halaman/stok).
   - Validasi keunikan nomor ISBN agar tidak terjadi duplikasi data.
2. **Read (R)**:
   - Menampilkan daftar koleksi buku dengan pagination (`GET /books` - `books.index`).
   - Menampilkan kondisi tampilan kosong (*empty state*) ketika belum ada buku tersimpan.
   - Menampilkan halaman detail informasi buku lengkap (`GET /books/{id}` - `books.show`).
   - Penanganan respons error 404 ketika ID buku tidak ditemukan.
3. **Update (U)**:
   - Akses form pengubahan data buku (`GET /books/{id}/edit` - `books.edit`).
   - Pembaruan data buku dengan input valid (`PUT /books/{id}` - `books.update`).
   - Pengujian pembaruan buku dengan mempertahankan nomor ISBN yang sama (*ignore current ID on unique rule*).
   - Penolakan pembaruan jika nomor ISBN yang dimasukkan sudah digunakan oleh buku lain.
4. **Delete (D)**:
   - Penghapusan data buku dari basis data (`DELETE /books/{id}` - `books.destroy`).
   - Penanganan respons error 404 ketika mencoba menghapus buku dengan ID yang tidak terdaftar.

---

## 3. Metodologi Pengujian

Pengujian dilakukan menggunakan **Automated Feature Testing** berbasis PHPUnit dan framework pengujian terintegrasi Laravel (`Tests\Feature\BookCrudTest`).

* **Database Isolation**: Menggunakan `Illuminate\Foundation\Testing\DatabaseTransactions` sehingga seluruh operasi manipulasi data (insert, update, delete) dibungkus dalam transaksi basis data dan di-*rollback* otomatis setelah setiap skenario uji selesai. Data riil perpustakaan di database tetap aman dan konsisten.
* **Tipe Pengujian**:
  * **Positive Testing (Happy Path)**: Memastikan alur normal berjalan dengan kode status HTTP yang tepat (200, 302 redirect), data tersimpan di basis data, dan pesan flash session muncul.
  * **Negative Testing**: Memastikan sistem menolak masukan kosong, data bertipe salah, nilai di luar rentang valid, atau duplikasi ISBN.
  * **Edge Cases & Error Handling**: Penanganan ID buku fiktif (HTTP 404) dan pengujian rule keunikan saat pembaruan data buku sendiri.

---

## 4. Rincian Kasus Uji (Test Cases)

| No | ID Test | Kategori | Skenario Pengujian | Hasil Ekspektasi | Status |
| :---: | :--- | :---: | :--- | :--- | :---: |
| 1 | `TC-READ-01` | Read | Menampilkan halaman daftar buku saat basis data kosong (*empty state*) | Status 200, melihat pesan "Belum ada buku" dan tombol "Tambah Buku" | **PASS** |
| 2 | `TC-READ-02` | Read | Menampilkan daftar buku ketika ada data di basis data | Status 200, judul, penulis, penerbit, kategori, dan stok buku tampil | **PASS** |
| 3 | `TC-CREATE-01` | Create | Menampilkan halaman form penambahan buku baru | Status 200, memuat form dengan field judul, penulis, ISBN, sinopsis, dsb. | **PASS** |
| 4 | `TC-CREATE-02` | Create | Menyimpan buku baru dengan seluruh input data valid | Redirect ke `books.index`, pesan sukses muncul di session, data tersimpan di tabel `books` | **PASS** |
| 5 | `TC-CREATE-03` | Create | Menyimpan buku dengan data kosong (validasi field wajib) | Session memuat error validasi untuk semua field wajib, data tidak bertambah | **PASS** |
| 6 | `TC-CREATE-04` | Create | Menyimpan buku dengan nilai numerik tidak valid (`pages < 1`, `stock < 0`, tahun di masa depan) | Session memuat error validasi pada field terkait, data tidak masuk ke database | **PASS** |
| 7 | `TC-CREATE-05` | Create | Menyimpan buku dengan nomor ISBN yang sudah terdaftar sebelumnya | Session memuat error validasi unik pada `isbn`, penambahan ditolak | **PASS** |
| 8 | `TC-READ-03` | Read | Menampilkan halaman detail buku yang valid | Status 200, menampilkan judul, penulis, ISBN, sinopsis lengkap, status stok | **PASS** |
| 9 | `TC-READ-04` | Read | Mengakses detail buku dengan ID yang tidak ada (`/books/99999`) | Menghasilkan HTTP Response 404 (Not Found) | **PASS** |
| 10 | `TC-UPDATE-01` | Update | Menampilkan halaman form edit buku | Status 200, memuat form dengan data buku yang ingin disunting | **PASS** |
| 11 | `TC-UPDATE-02` | Update | Memperbarui data buku dengan informasi baru yang valid | Redirect ke `books.index`, pesan sukses muncul, database terupdate dengan data baru | **PASS** |
| 12 | `TC-UPDATE-03` | Update | Memperbarui buku tanpa mengubah nomor ISBN (ISBN tetap sama) | Update berhasil tanpa terbentur aturan unique ISBN milik buku itu sendiri | **PASS** |
| 13 | `TC-UPDATE-04` | Update | Memperbarui buku menggunakan nomor ISBN milik buku lain | Ditolak dengan pesan error validasi unik `isbn`, database tidak berubah | **PASS** |
| 14 | `TC-DELETE-01` | Delete | Menghapus buku yang ada di database | Redirect ke `books.index`, pesan sukses di session, record terhapus dari tabel `books` | **PASS** |
| 15 | `TC-DELETE-02` | Delete | Menghapus buku dengan ID yang tidak terdaftar di database | Menghasilkan HTTP Response 404 (Not Found) | **PASS** |

---

## 5. Log Hasil Eksekusi Pengujian

Hasil eksekusi otomatis menggunakan perintah:
`php artisan test --filter=BookCrudTest --testdox`

```text
PHPUnit 12.5.34 by Sebastian Bergmann and contributors.
Runtime: PHP 8.5.10
Configuration: E:\Backend project\PerpusID\phpunit.xml
Time: 00:01.368, Memory: 44.00 MB

Book Crud (Tests\Feature\BookCrud)
 ✔ Can display empty books index page
 ✔ Can display books index with books list
 ✔ Can display create book page
 ✔ Can store new book with valid data
 ✔ Cannot store book with missing required fields
 ✔ Cannot store book with invalid numeric values
 ✔ Cannot store book with duplicate isbn
 ✔ Can display book detail page
 ✔ Returns 404 when book not found on show
 ✔ Can display edit book page
 ✔ Can update book with valid data
 ✔ Can update book retaining same isbn
 ✔ Cannot update book with isbn belonging to another book
 ✔ Can delete book
 ✔ Returns 404 when deleting non existent book

OK (15 tests, 66 assertions)
```

Hasil eksekusi seluruh pengujian aplikasi (*Full Test Suite*):
`php artisan test --testdox`

```text
Book Crud (Tests\Feature\BookCrud)
 ✔ Can display empty books index page
 ✔ Can display books index with books list
 ✔ Can display create book page
 ✔ Can store new book with valid data
 ✔ Cannot store book with missing required fields
 ✔ Cannot store book with invalid numeric values
 ✔ Cannot store book with duplicate isbn
 ✔ Can display book detail page
 ✔ Returns 404 when book not found on show
 ✔ Can display edit book page
 ✔ Can update book with valid data
 ✔ Can update book retaining same isbn
 ✔ Cannot update book with isbn belonging to another book
 ✔ Can delete book
 ✔ Returns 404 when deleting non existent book

Example (Tests\Feature\Example)
 ✔ The application returns a successful response

Example (Tests\Unit\Example)
 ✔ That true is true

OK (17 tests, 69 assertions)
```

---

## 6. Analisis Hasil & Temuan

1. **Integritas Data & Validasi Controller**:
   - Aturan validasi pada `BookController::store` dan `BookController::update` bekerja secara akurat. Field esensial seperti `title`, `author`, `publisher`, `publication_year`, `pages`, `isbn`, `category`, `synopsis`, dan `stock` terproteksi dengan baik dari input kosong maupun nilai tidak logis (misalnya stok negatif).
   - Validasi keunikan ISBN berjalan optimal dengan pengecualian ID buku yang sedang diedit (`unique:books,isbn,' . $book->id`), mencegah terjadinya eror integritas pada level database MySQL.
2. **User Experience & Feedback**:
   - Setiap aksi modifikasi data (Store, Update, Delete) selalu mengembalikan pengalihan (*redirect*) ke rute daftar buku dengan membawa session flash message (`Buku berhasil ditambahkan!`, `Buku berhasil diupdate!`, `Buku berhasil dihapus!`).
   - Tampilan antarmuka menangani kondisi koleksi kosong secara informatif (*empty state*) dan responsif.
3. **Robustness & Error Handling**:
   - Upaya mengakses rute model yang tidak ada (`show` dan `destroy` pada ID 99999) ditangani secara anggun oleh *Implicit Model Binding* Laravel dengan respon 404 tanpa menyebabkan *unhandled fatal exception*.

---

## 7. Kesimpulan

Seluruh fungsi pada modul **CRUD Buku PerpusID** telah berhasil diuji dan dinyatakan **100% Berfungsi Normal (PASS)** tanpa kendala. Sistem aman dari duplikasi data buku, memvalidasi input pengguna secara ketat, serta menjaga kestabilan alur kerja perpustakaan.
