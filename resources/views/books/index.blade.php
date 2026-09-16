@extends('layouts.app')

@section('title', 'Manajemen Buku - PerpusID')

@section('header', 'Manajemen Buku')

@section('content')
<!-- Header & Action -->
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h3 class="text-lg sm:text-xl font-bold text-gray-900">Daftar Buku Perpustakaan</h3>
        <p class="text-xs sm:text-sm text-gray-600 mt-1">Kelola koleksi buku perpustakaan Anda</p>
    </div>
    <a href="{{ route('books.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg transition-colors flex items-center justify-center text-sm font-medium w-full sm:w-auto shadow-sm">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Buku
    </a>
</div>

@if($books->count() > 0)
    <!-- Mobile Card View (shown on screens < md) -->
    <div class="block md:hidden space-y-4">
        @foreach($books as $book)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
            <div class="flex items-start justify-between gap-2">
                <div class="min-w-0 flex-1">
                    <a href="{{ route('books.show', $book) }}" class="text-base font-semibold text-gray-900 hover:text-blue-600 line-clamp-2">
                        {{ $book->title }}
                    </a>
                    <p class="text-xs text-gray-500 mt-0.5">{{ $book->publisher }} ({{ $book->publication_year }})</p>
                </div>
                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 shrink-0">
                    {{ $book->category }}
                </span>
            </div>

            <div class="mt-3 pt-3 border-t border-gray-100 grid grid-cols-2 gap-2 text-xs">
                <div>
                    <span class="text-gray-500 block">Penulis:</span>
                    <span class="font-medium text-gray-900 truncate block">{{ $book->author }}</span>
                </div>
                <div>
                    <span class="text-gray-500 block">Stok:</span>
                    <span class="font-semibold {{ $book->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $book->stock }}
                    </span>
                </div>
                <div class="col-span-2">
                    <span class="text-gray-500">ISBN:</span>
                    <span class="font-mono text-gray-700 ml-1">{{ $book->isbn }}</span>
                </div>
            </div>

            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-end gap-2">
                <a href="{{ route('books.show', $book) }}" class="px-3 py-1.5 text-xs font-medium text-blue-700 bg-blue-50 rounded-md hover:bg-blue-100 transition-colors inline-flex items-center">
                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Detail
                </a>
                <a href="{{ route('books.edit', $book) }}" class="px-3 py-1.5 text-xs font-medium text-indigo-700 bg-indigo-50 rounded-md hover:bg-indigo-100 transition-colors inline-flex items-center">
                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1.5 text-xs font-medium text-red-700 bg-red-50 rounded-md hover:bg-red-100 transition-colors inline-flex items-center">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Desktop Table View (shown on md and up) -->
    <div class="hidden md:block bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penulis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ISBN</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($books as $book)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $book->title }}</div>
                            <div class="text-sm text-gray-500">{{ $book->publisher }} ({{ $book->publication_year }})</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $book->author }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $book->category }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-semibold {{ $book->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $book->stock }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $book->isbn }}</td>
                        <td class="px-6 py-4 text-right text-sm font-medium space-x-2 whitespace-nowrap">
                            <a href="{{ route('books.show', $book) }}" class="text-blue-600 hover:text-blue-900 inline-flex items-center p-1" title="Detail">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('books.edit', $book) }}" class="text-indigo-600 hover:text-indigo-900 inline-flex items-center p-1" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 inline-flex items-center p-1" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $books->links() }}
    </div>
@else
    <div class="bg-white rounded-lg shadow p-8 sm:p-12 text-center">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
        </svg>
        <h3 class="mt-2 text-lg font-medium text-gray-900">Belum ada buku</h3>
        <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan buku pertama Anda.</p>
        <div class="mt-6">
            <a href="{{ route('books.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Buku
            </a>
        </div>
    </div>
@endif
@endsection
