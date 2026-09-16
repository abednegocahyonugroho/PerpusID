<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BookCrudTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test menampilkan halaman daftar buku saat database kosong (Empty State).
     */
    public function test_can_display_empty_books_index_page(): void
    {
        Book::query()->delete();

        $response = $this->get(route('books.index'));

        $response->assertStatus(200);
        $response->assertSee('Daftar Buku Perpustakaan');
        $response->assertSee('Belum ada buku');
    }

    /**
     * Test menampilkan daftar buku ketika ada data di database (Read - Index).
     */
    public function test_can_display_books_index_with_books_list(): void
    {
        $book = Book::create([
            'title' => 'Buku Uji Index Eksklusif',
            'author' => 'Penulis Uji Index',
            'publisher' => 'Penerbit Uji Index',
            'publication_year' => 2024,
            'pages' => 350,
            'isbn' => '978-999-777-111-0',
            'category' => 'Fiksi Ilmiah',
            'synopsis' => 'Kisah sinopsis buku pengujian daftar index.',
            'stock' => 7,
        ]);

        $response = $this->get(route('books.index'));

        $response->assertStatus(200);
        $response->assertSee('Buku Uji Index Eksklusif');
        $response->assertSee('Penulis Uji Index');
        $response->assertSee('Penerbit Uji Index');
        $response->assertSee('Fiksi Ilmiah');
    }

    /**
     * Test menampilkan halaman form pembuatan buku baru (Create - Form).
     */
    public function test_can_display_create_book_page(): void
    {
        $response = $this->get(route('books.create'));

        $response->assertStatus(200);
        $response->assertSee('Tambah Buku Baru');
        $response->assertSee('Informasi Buku');
        $response->assertSee('Simpan Buku');
    }

    /**
     * Test menyimpan buku baru dengan data yang valid (Create - Store).
     */
    public function test_can_store_new_book_with_valid_data(): void
    {
        $payload = [
            'title' => 'Bumi Manusia',
            'author' => 'Pramoedya Ananta Toer',
            'publisher' => 'Hasta Mitra',
            'publication_year' => 1980,
            'pages' => 535,
            'isbn' => '978-979-97312-3-4',
            'category' => 'Novel Sejarah',
            'synopsis' => 'Kisah perjuangan Minke di era kolonial Hindia Belanda.',
            'stock' => 12,
        ];

        $response = $this->post(route('books.store'), $payload);

        $response->assertRedirect(route('books.index'));
        $response->assertSessionHas('success', 'Buku berhasil ditambahkan!');

        $this->assertDatabaseHas('books', [
            'title' => 'Bumi Manusia',
            'isbn' => '978-979-97312-3-4',
            'author' => 'Pramoedya Ananta Toer',
            'stock' => 12,
        ]);
    }

    /**
     * Test validasi kolom wajib saat menambahkan buku baru.
     */
    public function test_cannot_store_book_with_missing_required_fields(): void
    {
        $initialCount = Book::count();

        $response = $this->post(route('books.store'), []);

        $response->assertSessionHasErrors([
            'title',
            'author',
            'publisher',
            'publication_year',
            'pages',
            'isbn',
            'category',
            'synopsis',
            'stock',
        ]);
        $this->assertDatabaseCount('books', $initialCount);
    }

    /**
     * Test validasi tipe data numerik dan batasan (pages < 1, stock < 0, tahun terbit di masa depan).
     */
    public function test_cannot_store_book_with_invalid_numeric_values(): void
    {
        $initialCount = Book::count();

        $payload = [
            'title' => 'Buku Invalid',
            'author' => 'Penulis X',
            'publisher' => 'Penerbit Y',
            'publication_year' => (int) date('Y') + 10, // Masa depan
            'pages' => 0, // Kurang dari 1
            'isbn' => '978-0-00-000000-0',
            'category' => 'Teknologi',
            'synopsis' => 'Sinopsis percobaan',
            'stock' => -5, // Kurang dari 0
        ];

        $response = $this->post(route('books.store'), $payload);

        $response->assertSessionHasErrors(['publication_year', 'pages', 'stock']);
        $this->assertDatabaseCount('books', $initialCount);
    }

    /**
     * Test validasi keunikan nomor ISBN saat menambahkan buku baru.
     */
    public function test_cannot_store_book_with_duplicate_isbn(): void
    {
        $book = Book::create([
            'title' => 'Buku Pertama',
            'author' => 'Penulis Satu',
            'publisher' => 'Penerbit Satu',
            'publication_year' => 2020,
            'pages' => 200,
            'isbn' => '978-1-111-11111-1',
            'category' => 'Sains',
            'synopsis' => 'Sinopsis buku pertama',
            'stock' => 5,
        ]);

        $countBefore = Book::count();

        $payload = [
            'title' => 'Buku Kedua ISBN Sama',
            'author' => 'Penulis Dua',
            'publisher' => 'Penerbit Dua',
            'publication_year' => 2021,
            'pages' => 250,
            'isbn' => '978-1-111-11111-1', // Duplikat
            'category' => 'Sains',
            'synopsis' => 'Sinopsis buku kedua',
            'stock' => 3,
        ];

        $response = $this->post(route('books.store'), $payload);

        $response->assertSessionHasErrors(['isbn']);
        $this->assertDatabaseCount('books', $countBefore);
    }

    /**
     * Test menampilkan detail buku (Read - Show).
     */
    public function test_can_display_book_detail_page(): void
    {
        $book = Book::create([
            'title' => 'Panduan Pemrograman Modern',
            'author' => 'Robert C. Martin Test',
            'publisher' => 'Prentice Hall Test',
            'publication_year' => 2023,
            'pages' => 464,
            'isbn' => '978-999-888-222-0',
            'category' => 'Teknologi Informasi',
            'synopsis' => 'Panduan praktik terbaik dalam rekayasa perangkat lunak yang bersih dan terstruktur.',
            'stock' => 15,
        ]);

        $response = $this->get(route('books.show', $book));

        $response->assertStatus(200);
        $response->assertSee('Detail Buku');
        $response->assertSee('Panduan Pemrograman Modern');
        $response->assertSee('Robert C. Martin Test');
        $response->assertSee('978-999-888-222-0');
        $response->assertSee('Panduan praktik terbaik dalam rekayasa perangkat lunak');
        $response->assertSee('15');
    }

    /**
     * Test respon 404 ketika melihat detail buku yang tidak ada.
     */
    public function test_returns_404_when_book_not_found_on_show(): void
    {
        $response = $this->get('/books/99999');

        $response->assertStatus(404);
    }

    /**
     * Test menampilkan halaman form edit buku (Update - Form).
     */
    public function test_can_display_edit_book_page(): void
    {
        $book = Book::create([
            'title' => 'Filosofi Teras',
            'author' => 'Henry Manampiring',
            'publisher' => 'Kompas',
            'publication_year' => 2018,
            'pages' => 344,
            'isbn' => '978-602-412-518-9',
            'category' => 'Pengembangan Diri',
            'synopsis' => 'Filsafat Stoa untuk ketenangan mental dalam kehidupan modern.',
            'stock' => 20,
        ]);

        $response = $this->get(route('books.edit', $book));

        $response->assertStatus(200);
        $response->assertSee('Edit Buku');
        $response->assertSee('Filosofi Teras');
        $response->assertSee('Henry Manampiring');
        $response->assertSee('Update Buku');
    }

    /**
     * Test memperbarui data buku dengan input valid (Update - Update).
     */
    public function test_can_update_book_with_valid_data(): void
    {
        $book = Book::create([
            'title' => 'Buku Lama',
            'author' => 'Penulis Lama',
            'publisher' => 'Penerbit Lama',
            'publication_year' => 2019,
            'pages' => 150,
            'isbn' => '978-1-234-56789-0',
            'category' => 'Umum',
            'synopsis' => 'Sinopsis lama',
            'stock' => 5,
        ]);

        $updatedPayload = [
            'title' => 'Buku Diperbarui',
            'author' => 'Penulis Baru',
            'publisher' => 'Penerbit Baru',
            'publication_year' => 2022,
            'pages' => 220,
            'isbn' => '978-9-876-54321-0',
            'category' => 'Edukasi',
            'synopsis' => 'Sinopsis baru yang lebih lengkap.',
            'stock' => 18,
        ];

        $response = $this->put(route('books.update', $book), $updatedPayload);

        $response->assertRedirect(route('books.index'));
        $response->assertSessionHas('success', 'Buku berhasil diupdate!');

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Buku Diperbarui',
            'isbn' => '978-9-876-54321-0',
            'stock' => 18,
        ]);

        $this->assertDatabaseMissing('books', [
            'title' => 'Buku Lama',
        ]);
    }

    /**
     * Test memperbarui buku dengan mempertahankan ISBN yang sama (Rule unique ignore current id).
     */
    public function test_can_update_book_retaining_same_isbn(): void
    {
        $book = Book::create([
            'title' => 'Buku Tetap ISBN',
            'author' => 'Penulis Asli',
            'publisher' => 'Penerbit Asli',
            'publication_year' => 2021,
            'pages' => 300,
            'isbn' => '978-5-555-55555-5',
            'category' => 'Teknologi',
            'synopsis' => 'Sinopsis asli.',
            'stock' => 8,
        ]);

        $updatePayload = [
            'title' => 'Buku Tetap ISBN (Edisi 2)',
            'author' => 'Penulis Asli',
            'publisher' => 'Penerbit Asli',
            'publication_year' => 2023,
            'pages' => 320,
            'isbn' => '978-5-555-55555-5', // ISBN sama
            'category' => 'Teknologi',
            'synopsis' => 'Sinopsis edisi kedua.',
            'stock' => 10,
        ];

        $response = $this->put(route('books.update', $book), $updatePayload);

        $response->assertRedirect(route('books.index'));
        $response->assertSessionHas('success', 'Buku berhasil diupdate!');
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Buku Tetap ISBN (Edisi 2)',
            'publication_year' => 2023,
        ]);
    }

    /**
     * Test validasi bahwa ISBN tidak boleh bertabrakan dengan ISBN buku lain saat update.
     */
    public function test_cannot_update_book_with_isbn_belonging_to_another_book(): void
    {
        $book1 = Book::create([
            'title' => 'Buku Pertama',
            'author' => 'Penulis A',
            'publisher' => 'Penerbit A',
            'publication_year' => 2020,
            'pages' => 100,
            'isbn' => '978-1-000-00000-1',
            'category' => 'Umum',
            'synopsis' => 'Sinopsis A',
            'stock' => 4,
        ]);

        $book2 = Book::create([
            'title' => 'Buku Kedua',
            'author' => 'Penulis B',
            'publisher' => 'Penerbit B',
            'publication_year' => 2021,
            'pages' => 120,
            'isbn' => '978-2-000-00000-2',
            'category' => 'Umum',
            'synopsis' => 'Sinopsis B',
            'stock' => 6,
        ]);

        $payload = [
            'title' => 'Buku Kedua Diubah',
            'author' => 'Penulis B',
            'publisher' => 'Penerbit B',
            'publication_year' => 2021,
            'pages' => 120,
            'isbn' => '978-1-000-00000-1', // ISBN milik book1
            'category' => 'Umum',
            'synopsis' => 'Sinopsis B',
            'stock' => 6,
        ];

        $response = $this->put(route('books.update', $book2), $payload);

        $response->assertSessionHasErrors(['isbn']);
        $this->assertDatabaseHas('books', [
            'id' => $book2->id,
            'isbn' => '978-2-000-00000-2',
        ]);
    }

    /**
     * Test menghapus data buku yang ada (Delete - Destroy).
     */
    public function test_can_delete_book(): void
    {
        $book = Book::create([
            'title' => 'Buku Yang Akan Dihapus',
            'author' => 'Penulis Hapus',
            'publisher' => 'Penerbit Hapus',
            'publication_year' => 2020,
            'pages' => 150,
            'isbn' => '978-9-999-99999-9',
            'category' => 'Arsip',
            'synopsis' => 'Buku ini akan segera dihapus.',
            'stock' => 2,
        ]);

        $this->assertDatabaseHas('books', ['id' => $book->id]);

        $response = $this->delete(route('books.destroy', $book));

        $response->assertRedirect(route('books.index'));
        $response->assertSessionHas('success', 'Buku berhasil dihapus!');

        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    /**
     * Test respon 404 ketika mencoba menghapus buku dengan ID yang tidak ada.
     */
    public function test_returns_404_when_deleting_non_existent_book(): void
    {
        $response = $this->delete('/books/99999');

        $response->assertStatus(404);
    }
}
