<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PerpusID - Sistem Perpustakaan')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen antialiased">
    <!-- Backdrop Overlay for Mobile -->
    <div id="sidebar-backdrop" 
         class="fixed inset-0 bg-gray-900/60 z-40 hidden md:hidden transition-opacity"
         onclick="toggleSidebar(false)"></div>

    <div class="min-h-screen flex flex-col">
        <!-- Sidebar -->
        <aside id="sidebar" 
               class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 text-white transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col shadow-xl md:shadow-none">
            <!-- Sidebar Header / Brand -->
            <div class="p-5 flex items-center justify-between border-b border-gray-800">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white font-bold shadow-md shadow-blue-500/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold tracking-tight text-white leading-none">PerpusID</h1>
                        <p class="text-gray-400 text-xs mt-1">Sistem Perpustakaan</p>
                    </div>
                </div>

                <!-- Mobile close button -->
                <button type="button" 
                        class="md:hidden text-gray-400 hover:text-white p-1.5 rounded-lg hover:bg-gray-800 focus:outline-none"
                        onclick="toggleSidebar(false)"
                        aria-label="Tutup navigasi">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <!-- Nav links -->
            <nav class="mt-4 px-3 space-y-1 flex-1 overflow-y-auto">
                <a href="{{ route('books.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('books.*') ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span>Manajemen Buku</span>
                </a>
                
                <div class="pt-4 pb-1 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Menu Segera Hadir
                </div>

                <div class="flex items-center justify-between px-4 py-2.5 rounded-lg text-sm font-medium text-gray-500 cursor-not-allowed">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>Anggota</span>
                    </div>
                    <span class="text-[10px] uppercase font-semibold bg-gray-800 px-2 py-0.5 rounded text-gray-400">Soon</span>
                </div>
                
                <div class="flex items-center justify-between px-4 py-2.5 rounded-lg text-sm font-medium text-gray-500 cursor-not-allowed">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span>Peminjaman</span>
                    </div>
                    <span class="text-[10px] uppercase font-semibold bg-gray-800 px-2 py-0.5 rounded text-gray-400">Soon</span>
                </div>
            </nav>

            <div class="p-4 border-t border-gray-800 text-xs text-gray-500 text-center">
                &copy; {{ date('Y') }} PerpusID
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="md:pl-64 flex-1 flex flex-col w-full">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 sticky top-0 z-30 shadow-xs">
                <div class="px-4 sm:px-6 py-3.5 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3 min-w-0">
                        <!-- Mobile Hamburger Button -->
                        <button type="button" 
                                class="md:hidden inline-flex items-center justify-center p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                onclick="toggleSidebar(true)"
                                aria-label="Buka menu navigasi">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                        
                        <div class="min-w-0">
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 truncate">@yield('header')</h2>
                        </div>
                    </div>

                    <div class="hidden sm:flex items-center gap-2 text-xs sm:text-sm text-gray-500 font-medium">
                        <span class="inline-block w-2 h-2 rounded-full bg-green-500"></span>
                        <span>Sistem Aktif</span>
                    </div>
                </div>
            </header>

            <!-- Main Content Container -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8 w-full max-w-7xl mx-auto">
                @if(session('success'))
                    <div class="mb-5 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-start gap-3 shadow-xs" role="alert">
                        <svg class="w-5 h-5 text-green-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-5 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-start gap-3 shadow-xs" role="alert">
                        <svg class="w-5 h-5 text-red-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Responsive Sidebar Toggle Script -->
    <script>
        function toggleSidebar(open) {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            if (!sidebar || !backdrop) return;
            
            if (open) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        }

        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                toggleSidebar(false);
            }
        });

        // Close on window resize past md breakpoint
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                toggleSidebar(false);
            }
        });
    </script>
</body>
</html>
