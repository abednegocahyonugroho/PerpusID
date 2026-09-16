<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'publisher' => 'Bentang Pustaka',
                'publication_year' => 2005,
                'pages' => 529,
                'isbn' => '978-979-3062-79-2',
                'category' => 'Fiksi',
                'synopsis' => 'Laskar Pelangi adalah novel pertama karya Andrea Hirata yang diterbitkan oleh Bentang Pustaka pada tahun 2005. Novel ini bercerita tentang kehidupan 10 anak dari keluarga miskin yang bersekolah di SD Muhammadiyah di Belitung Timur. Mereka memiliki kecerdasan, keterbatasan, dan keunikan masing-masing. Novel ini mengisahkan perjuangan mereka dalam menempuh pendidikan di tengah keterbatasan ekonomi dan fasilitas.',
                'stock' => 15,
            ],
            [
                'title' => 'Atomic Habits: Perubahan Kecil yang Memberikan Hasil Luar Biasa',
                'author' => 'James Clear',
                'publisher' => 'Gramedia Pustaka Utama',
                'publication_year' => 2018,
                'pages' => 320,
                'isbn' => '978-602-06-2525-6',
                'category' => 'Self-Improvement',
                'synopsis' => 'Atomic Habits adalah buku panduan praktis tentang bagaimana membangun kebiasaan baik dan menghilangkan kebiasaan buruk. James Clear menguraikan strategi sederhana yang berbasis pada psikologi dan ilmu perilaku untuk membantu siapa pun membuat perubahan kecil yang konsisten dan berdampak besar dalam hidup. Buku ini mengajarkan bahwa kesuksesan bukanlah hasil dari satu tindakan besar, tetapi dari akumulasi kebiasaan kecil setiap hari.',
                'stock' => 25,
            ],
                        [
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'publisher' => 'Hasta Mitra',
                'publication_year' => 1980,
                'pages' => 535,
                'isbn' => '978-979-1000-00-0',
                'category' => 'Fiksi Sejarah',
                'synopsis' => 'Bumi Manusia adalah novel pertama dari Tetralogi Pulau Buru karya Pramoedya Ananta Toer. Novel ini mengisahkan tentang perjalanan tokoh Minke, seorang pribumi muda Jawa yang mendapat pendidikan Eropa dan idealismenya dalam menghadapi kolonialisme Belanda. Buku ini adalah potret kehidupan masyarakat pribumi di bawah kolonialisme Belanda pada akhir abad ke-19.',
                'stock' => 8,
            ],
            [
                'title' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'author' => 'Robert C. Martin',
                'publisher' => 'Prentice Hall',
                'publication_year' => 2008,
                'pages' => 464,
                'isbn' => '978-0-13-235088-4',
                'category' => 'Teknologi',
                'synopsis' => 'Clean Code adalah buku panduan tentang bagaimana menulis kode yang bersih, mudah dibaca, dan mudah dipelihara. Ditulis oleh Robert C. Martin (Uncle Bob), buku ini berisi prinsip-prinsip, pola, dan praktik terbaik dalam menulis kode yang berkualitas. Buku ini wajib dibaca oleh setiap programmer yang ingin meningkatkan kualitas kode mereka.',
                'stock' => 12,
            ],
            [
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'publisher' => 'Harvill Secker',
                'publication_year' => 2011,
                'pages' => 443,
                'isbn' => '978-0-06-231609-7',
                'category' => 'Non-Fiksi',
                'synopsis' => 'Sapiens mengeksplorasi sejarah manusia dari evolusi Homo sapiens di Afrika hingga abad ke-21. Harari membahas tiga revolusi besar yang membentuk sejarah manusia: Revolusi Kognitif, Revolusi Pertanian, dan Revolusi Sains. Buku ini memberikan perspektif unik tentang bagaimana manusia menjadi spesies dominan di planet ini.',
                'stock' => 20,
            ],
            [
                'title' => 'The Psychology of Money',
                'author' => 'Morgan Housel',
                'publisher' => 'Harriman House',
                'publication_year' => 2020,
                'pages' => 256,
                'isbn' => '978-0-85719-868-9',
                'category' => 'Keuangan',
                'synopsis' => 'The Psychology of Money mengeksplorasi hubungan kompleks antara uang dan perilaku manusia. Melalui 19 cerita pendek, Morgan Housel menjelaskan bagaimana kita berpikir tentang uang dan mengapa orang sering membuat keputusan keuangan yang tidak rasional. Buku ini bukan tentang rumus atau strategi investasi, tetapi tentang bagaimana kita berpikir tentang uang.',
                'stock' => 0,
            ],
        ];

        foreach ($books as $book) {
            \App\Models\Book::create($book);
        }
    }
}
