-- Setup Database untuk PerpusID
-- Jalankan script ini untuk membuat database

-- Hapus database jika sudah ada (opsional)
-- DROP DATABASE IF EXISTS perpusid;

-- Buat database baru
CREATE DATABASE IF NOT EXISTS perpusid 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Gunakan database
USE perpusid;

-- Informasi:
-- Setelah membuat database, jalankan migration Laravel dengan perintah:
-- php artisan migrate

-- Untuk membuat user baru (opsional):
-- CREATE USER 'perpusid_user'@'localhost' IDENTIFIED BY 'password_anda';
-- GRANT ALL PRIVILEGES ON perpusid.* TO 'perpusid_user'@'localhost';
-- FLUSH PRIVILEGES;
