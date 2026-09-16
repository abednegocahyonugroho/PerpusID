<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul buku
            $table->string('author'); // Nama penulis
            $table->string('publisher'); // Penerbit
            $table->year('publication_year'); // Tahun terbit
            $table->integer('pages'); // Jumlah halaman
            $table->string('isbn')->unique(); // Nomor ISBN
            $table->string('category'); // Kategori/Genre
            $table->text('synopsis'); // Sinopsis buku
            $table->integer('stock')->default(0); // Stok buku
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
