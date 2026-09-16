<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'PerpusID') }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 py-10 sm:py-16">
        <!-- Header -->
        <div class="text-center mb-8 sm:mb-12">
            <h1 class="text-3xl sm:text-5xl md:text-6xl font-bold text-gray-800 mb-3 sm:mb-4 tracking-tight">
                Selamat Datang di <span class="text-indigo-600">PerpusID</span>
            </h1>
            <p class="text-base sm:text-xl text-gray-600 max-w-2xl mx-auto">
                Sistem Perpustakaan Digital Modern untuk pengelolaan koleksi buku yang cepat dan efisien
            </p>
            <div class="mt-6 flex justify-center">
                <a href="{{ route('books.index') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-base font-semibold rounded-xl shadow-md transition-all hover:shadow-lg">
                    <span>Masuk ke Manajemen Buku</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8 max-w-6xl mx-auto">
            <!-- Card 1 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 hover:shadow-md transition-shadow duration-300">
                <div class="text-indigo-600 text-4xl sm:text-5xl mb-4">📚</div>
                <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-2 sm:mb-3">Koleksi Digital</h3>
                <p class="text-sm sm:text-base text-gray-600">
                    Akses ribuan buku digital dengan mudah, terstruktur, dan cepat
                </p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 hover:shadow-md transition-shadow duration-300">
                <div class="text-indigo-600 text-4xl sm:text-5xl mb-4">🔍</div>
                <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-2 sm:mb-3">Pencarian Cepat</h3>
                <p class="text-sm sm:text-base text-gray-600">
                    Temukan buku yang Anda cari dengan nomor ISBN dan kategori lengkap
                </p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 hover:shadow-md transition-shadow duration-300">
                <div class="text-indigo-600 text-4xl sm:text-5xl mb-4">👥</div>
                <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-2 sm:mb-3">Manajemen User</h3>
                <p class="text-sm sm:text-base text-gray-600">
                    Kelola data anggota perpustakaan dan riwayat peminjaman dengan efisien
                </p>
            </div>
        </div>

        <!-- Tech Stack Info -->
        <div class="mt-12 sm:mt-16 max-w-4xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6 text-center">Tech Stack</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
                <div class="text-center p-3">
                    <div class="bg-red-50 rounded-xl p-4 mb-3 inline-block w-16 h-16 flex items-center justify-center mx-auto">
                        <span class="text-3xl">⚡</span>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-1">Laravel 11</h4>
                    <p class="text-xs sm:text-sm text-gray-600">PHP Framework</p>
                </div>
                <div class="text-center p-3">
                    <div class="bg-blue-50 rounded-xl p-4 mb-3 inline-block w-16 h-16 flex items-center justify-center mx-auto">
                        <span class="text-3xl">🗄️</span>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-1">MariaDB</h4>
                    <p class="text-xs sm:text-sm text-gray-600">Database</p>
                </div>
                <div class="text-center p-3">
                    <div class="bg-cyan-50 rounded-xl p-4 mb-3 inline-block w-16 h-16 flex items-center justify-center mx-auto">
                        <span class="text-3xl">🎨</span>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-1">Tailwind CSS</h4>
                    <p class="text-xs sm:text-sm text-gray-600">CSS Framework</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-10 sm:mt-12 text-center text-xs sm:text-sm text-gray-600">
            <p>© {{ date('Y') }} PerpusID. Built with ❤️ using Laravel & Tailwind CSS</p>
        </div>
    </div>
</body>
</html>
