@extends('layouts.app')

@section('title', $book->title . ' - PerpusID')

@section('header', 'Detail Buku')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Top Action Bar -->
    <div class="mb-4 sm:mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <a href="{{ route('books.index') }}" class="text-blue-600 hover:text-blue-800 inline-flex items-center text-sm font-medium py-1">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Buku
        </a>
        
        <div class="flex items-center gap-2 sm:space-x-3 w-full sm:w-auto">
            <a href="{{ route('books.edit', $book) }}" class="flex-1 sm:flex-initial justify-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center text-sm font-medium shadow-xs">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit
            </a>
            <form action="{{ route('books.destroy', $book) }}" method="POST" class="flex-1 sm:flex-initial" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full justify-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center text-sm font-medium shadow-xs">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-xs border border-gray-200 overflow-hidden">
        <!-- Header Banner -->
        <div class="p-6 sm:p-8 bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                <div class="flex-1 min-w-0">
                    <span class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold bg-white/20 text-white mb-2">
                        {{ $book->category }}
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-bold break-words leading-tight">{{ $book->title }}</h1>
                    <p class="text-blue-100 text-base sm:text-lg mt-1">oleh {{ $book->author }}</p>
                </div>
                <div class="bg-white/10 sm:bg-transparent backdrop-blur-xs sm:backdrop-blur-none p-3 sm:p-0 rounded-xl sm:rounded-none flex sm:block items-center justify-between sm:text-right shrink-0">
                    <div class="text-xs sm:text-sm text-blue-100 sm:mb-1">Stok Tersedia</div>
                    <div class="text-2xl sm:text-4xl font-bold">{{ $book->stock }}</div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6 sm:p-8">
            <!-- Informasi Utama -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <div class="space-y-4">
                    <div class="border-l-4 border-blue-500 pl-3 sm:pl-4">
                        <h3 class="text-xs sm:text-sm font-medium text-gray-500 mb-0.5">Penerbit</h3>
                        <p class="text-base sm:text-lg font-medium text-gray-900">{{ $book->publisher }}</p>
                    </div>
                    
                    <div class="border-l-4 border-indigo-500 pl-3 sm:pl-4">
                        <h3 class="text-xs sm:text-sm font-medium text-gray-500 mb-0.5">Tahun Terbit</h3>
                        <p class="text-base sm:text-lg font-medium text-gray-900">{{ $book->publication_year }}</p>
                    </div>
                    
                    <div class="border-l-4 border-purple-500 pl-3 sm:pl-4">
                        <h3 class="text-xs sm:text-sm font-medium text-gray-500 mb-0.5">Jumlah Halaman</h3>
                        <p class="text-base sm:text-lg font-medium text-gray-900">{{ $book->pages }} halaman</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="border-l-4 border-green-500 pl-3 sm:pl-4">
                        <h3 class="text-xs sm:text-sm font-medium text-gray-500 mb-0.5">Nomor ISBN</h3>
                        <p class="text-base sm:text-lg font-mono text-gray-900 break-all">{{ $book->isbn }}</p>
                    </div>
                    
                    <div class="border-l-4 border-yellow-500 pl-3 sm:pl-4">
                        <h3 class="text-xs sm:text-sm font-medium text-gray-500 mb-0.5">Kategori / Genre</h3>
                        <p class="text-base sm:text-lg text-gray-900">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs sm:text-sm font-medium bg-blue-100 text-blue-800">
                                {{ $book->category }}
                            </span>
                        </p>
                    </div>
                    
                    <div class="border-l-4 border-red-500 pl-3 sm:pl-4">
                        <h3 class="text-xs sm:text-sm font-medium text-gray-500 mb-0.5">Status Stok</h3>
                        <p class="text-base sm:text-lg">
                            @if($book->stock > 10)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs sm:text-sm font-medium bg-green-100 text-green-800">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Stok Banyak
                                </span>
                            @elseif($book->stock > 0)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs sm:text-sm font-medium bg-yellow-100 text-yellow-800">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    Stok Terbatas
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs sm:text-sm font-medium bg-red-100 text-red-800">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    Habis
                                </span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Sinopsis -->
            <div class="border-t border-gray-100 pt-5 sm:pt-6">
                <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-3">Sinopsis</h3>
                <div class="prose max-w-none">
                    <p class="text-sm sm:text-base text-gray-700 leading-relaxed whitespace-pre-line">{{ $book->synopsis }}</p>
                </div>
            </div>

            <!-- Metadata -->
            <div class="border-t border-gray-100 mt-6 pt-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-4 text-xs sm:text-sm text-gray-500">
                    <div>
                        <span class="font-medium text-gray-600">Ditambahkan:</span> 
                        {{ $book->created_at->format('d M Y, H:i') }}
                    </div>
                    <div>
                        <span class="font-medium text-gray-600">Terakhir diupdate:</span> 
                        {{ $book->updated_at->format('d M Y, H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
