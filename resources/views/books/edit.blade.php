@extends('layouts.app')

@section('title', 'Edit Buku - PerpusID')

@section('header', 'Edit Buku')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-4 sm:mb-6">
        <a href="{{ route('books.index') }}" class="text-blue-600 hover:text-blue-800 inline-flex items-center text-sm font-medium py-1">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Buku
        </a>
    </div>

    <form action="{{ route('books.update', $book) }}" method="POST" class="bg-white rounded-xl shadow-xs border border-gray-200 overflow-hidden">
        @csrf
        @method('PUT')
        
        <div class="p-4 sm:p-6 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
            <h3 class="text-lg sm:text-xl font-semibold">Edit Informasi Buku</h3>
            <p class="text-indigo-100 text-xs sm:text-sm mt-1 truncate">Perbarui informasi buku: {{ $book->title }}</p>
        </div>

        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
            <!-- Judul -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Judul Buku <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" required
                    class="w-full px-3.5 sm:px-4 py-2 sm:py-2.5 text-base sm:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Penulis & Penerbit -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label for="author" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Nama Penulis <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" required
                        class="w-full px-3.5 sm:px-4 py-2 sm:py-2.5 text-base sm:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('author') border-red-500 @enderror">
                    @error('author')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="publisher" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Penerbit <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="publisher" id="publisher" value="{{ old('publisher', $book->publisher) }}" required
                        class="w-full px-3.5 sm:px-4 py-2 sm:py-2.5 text-base sm:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('publisher') border-red-500 @enderror">
                    @error('publisher')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Tahun Terbit, Halaman, Stok -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
                <div>
                    <label for="publication_year" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Tahun Terbit <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="publication_year" id="publication_year" value="{{ old('publication_year', $book->publication_year) }}" required min="1900" max="{{ date('Y') }}"
                        class="w-full px-3.5 sm:px-4 py-2 sm:py-2.5 text-base sm:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('publication_year') border-red-500 @enderror">
                    @error('publication_year')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="pages" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Jumlah Halaman <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="pages" id="pages" value="{{ old('pages', $book->pages) }}" required min="1"
                        class="w-full px-3.5 sm:px-4 py-2 sm:py-2.5 text-base sm:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('pages') border-red-500 @enderror">
                    @error('pages')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Stok Buku <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $book->stock) }}" required min="0"
                        class="w-full px-3.5 sm:px-4 py-2 sm:py-2.5 text-base sm:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('stock') border-red-500 @enderror">
                    @error('stock')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- ISBN & Kategori -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label for="isbn" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Nomor ISBN <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $book->isbn) }}" required
                        class="w-full px-3.5 sm:px-4 py-2 sm:py-2.5 text-base sm:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-mono @error('isbn') border-red-500 @enderror">
                    @error('isbn')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Kategori / Genre <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="category" id="category" value="{{ old('category', $book->category) }}" required
                        class="w-full px-3.5 sm:px-4 py-2 sm:py-2.5 text-base sm:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('category') border-red-500 @enderror">
                    @error('category')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Sinopsis -->
            <div>
                <label for="synopsis" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Sinopsis Buku <span class="text-red-500">*</span>
                </label>
                <textarea name="synopsis" id="synopsis" rows="5" required
                    class="w-full px-3.5 sm:px-4 py-2 sm:py-2.5 text-base sm:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('synopsis') border-red-500 @enderror">{{ old('synopsis', $book->synopsis) }}</textarea>
                @error('synopsis')
                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="px-4 sm:px-6 py-4 bg-gray-50 flex flex-col-reverse sm:flex-row justify-end gap-3 sm:space-x-3 border-t border-gray-100">
            <a href="{{ route('books.index') }}" class="w-full sm:w-auto text-center px-5 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">
                Batal
            </a>
            <button type="submit" class="w-full sm:w-auto text-center px-6 py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition-colors shadow-xs">
                Update Buku
            </button>
        </div>
    </form>
</div>
@endsection
