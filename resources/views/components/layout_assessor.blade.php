<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Assessor Panel</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex min-h-screen bg-gray-100">
        {{-- Overlay untuk mobile --}}
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden hidden"></div>

        {{-- Sidebar --}}
        <x-sidebar_assessor />

        <div id="main-content" class="flex-1 flex flex-col transition-all duration-300 ml-0 lg:ml-64">
            {{-- Navbar --}}
            <x-navbar_assessor />

            {{-- Main Content --}}
            <main class="flex-1 p-2 sm:p-4 md:p-6 lg:p-8 overflow-auto">
                {{-- Flash Messages --}}
                @if (session('sukses'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('sukses') }}
                </div>
                @endif
                @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
                @endif

                {{ $slot }}
            </main>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const sidebar = document.getElementById('sidebar-asesor');
                const mainContent = document.getElementById('main-content');
                const logoBtn = document.getElementById('sidebar-logo-btn');
                const overlay = document.getElementById('sidebar-overlay');
                const mobileMenuBtn = document.getElementById('mobile-menu-btn');

                // Desktop sidebar toggle
                if (logoBtn) {
                    logoBtn.addEventListener('click', function() {
                        // Only toggle on desktop
                        if (window.innerWidth >= 1024) {
                            setTimeout(function() {
                                if (sidebar.classList.contains('w-16')) {
                                    mainContent.classList.remove('lg:ml-64');
                                    mainContent.classList.add('lg:ml-16');
                                } else {
                                    mainContent.classList.remove('lg:ml-16');
                                    mainContent.classList.add('lg:ml-64');
                                }
                            }, 10);
                        }
                    });
                }

                // Mobile menu toggle
                if (mobileMenuBtn) {
                    mobileMenuBtn.addEventListener('click', function() {
                        sidebar.classList.toggle('-translate-x-full');
                        overlay.classList.toggle('hidden');
                    });
                }

                // Close mobile menu when clicking overlay
                if (overlay) {
                    overlay.addEventListener('click', function() {
                        sidebar.classList.add('-translate-x-full');
                        overlay.classList.add('hidden');
                    });
                }

                // Handle window resize
                window.addEventListener('resize', function() {
                    if (window.innerWidth >= 1024) {
                        sidebar.classList.remove('-translate-x-full');
                        overlay.classList.add('hidden');
                        mainContent.classList.remove('ml-0');
                        if (!sidebar.classList.contains('w-16')) {
                            mainContent.classList.add('lg:ml-64');
                        } else {
                            mainContent.classList.add('lg:ml-16');
                        }
                    } else {
                        mainContent.classList.remove('lg:ml-64', 'lg:ml-16');
                        mainContent.classList.add('ml-0');
                    }
                });
            });
        </script>
    </div>
</body>

</html>