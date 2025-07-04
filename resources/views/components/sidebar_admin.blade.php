@vite('resources/css/app.css')


<style>
    /* Sidebar base styling */
    .sidebar-assessor {
        background: linear-gradient(to bottom, #ffffff 0%, #fefefe 100%);
        border-right: 1px solid #e5e7eb;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        display: flex !important;
        flex-direction: column !important;
        height: 100vh !important;
        overflow: hidden;
    }

    /* Navigation scrollable area */
    .sidebar-assessor nav {
        flex: 1;
        overflow-y: auto;
        overflow-x: hidden;
        max-height: calc(100vh - 200px);
        padding-bottom: 1rem;
        scrollbar-width: thin;
        scrollbar-color: rgba(99, 102, 241, 0.3) transparent;
    }

    .sidebar-assessor nav::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-assessor nav::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-assessor nav::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, rgba(99, 102, 241, 0.3), rgba(99, 102, 241, 0.5));
        border-radius: 3px;
    }

    .sidebar-assessor nav::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, rgba(99, 102, 241, 0.5), rgba(99, 102, 241, 0.7));
    }

    /* Enhanced Mobile responsive styles */
    @media (max-width: 1023px) {
        .sidebar-assessor {
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            width: 280px;
            max-width: 85vw;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 50;
        }

        .sidebar-assessor.show {
            transform: translateX(0);
        }

        .sidebar-assessor nav {
            max-height: calc(100vh - 160px);
            padding: 0.75rem 1rem 0.5rem 1rem;
        }

        .sidebar-assessor nav a {
            padding: 0.875rem 1rem;
            font-size: 0.95rem;
            margin-bottom: 3px;
            border-radius: 8px;
            min-height: 44px;
        }
    }

    /* Extra small screens */
    @media (max-width: 374px) {
        .sidebar-assessor {
            width: 260px;
            max-width: 90vw;
        }

        .sidebar-assessor nav {
            padding: 0.5rem 0.75rem 0.5rem 0.75rem;
        }

        .sidebar-assessor nav a {
            padding: 0.75rem 0.875rem;
            font-size: 0.9rem;
        }
    }

    /* Tablet specific styles */
    @media (min-width: 641px) and (max-width: 1023px) {
        .sidebar-assessor {
            width: 320px;
        }

        .sidebar-assessor nav {
            max-height: calc(100vh - 180px);
            padding: 1rem 1.25rem 0.75rem 1.25rem;
        }

        .sidebar-assessor nav a {
            padding: 1rem 1.25rem;
            font-size: 1rem;
        }
    }

    /* Desktop responsive improvements */
    @media (min-width: 1024px) {
        .sidebar-assessor {
            transform: translateX(0);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 40;
        }

        .sidebar-assessor nav {
            max-height: calc(100vh - 200px);
            padding: 0.5rem 1rem 0.75rem 1rem;
        }

        .sidebar-assessor nav a {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            margin-bottom: 2px;
        }
    }

    /* Better focus styles for accessibility */
    .sidebar-assessor a:focus,
    .sidebar-assessor button:focus {
        outline: 2px solid #3b82f6;
        outline-offset: 2px;
        border-radius: 8px;
    }

    /* Smooth scrolling */
    html {
        scroll-behavior: smooth;
    }

    /* Collapsed state for desktop */
    .sidebar-assessor.collapsed {
        width: 4rem;
        /* 64px */
    }

    .sidebar-assessor.collapsed .sidebar-label,
    .sidebar-assessor.collapsed .logo-container .text-sm,
    .sidebar-assessor.collapsed .logo-container .text-xs {
        display: none;
    }

    .sidebar-assessor.collapsed .logo-container {
        padding-top: 1rem;
        padding-bottom: 1rem;
    }

    .sidebar-assessor.collapsed .logo-container img {
        width: 2.5rem;
        /* 40px */
        height: 2.5rem;
        /* 40px */
    }

    .sidebar-assessor.collapsed nav a {
        justify-content: center;
    }

    .sidebar-assessor.collapsed .text-xs.font-semibold.text-gray-400.uppercase.tracking-wider {
        display: none;
    }

    .sidebar-assessor.collapsed .text-xs.font-semibold.text-gray-400.uppercase.tracking-wider::before {
        content: '...';
        display: block;
        text-align: center;
        font-weight: bold;
    }
</style>

<aside id="sidebar-asesor" class="sidebar-assessor flex flex-col h-screen w-64 bg-white shadow-lg fixed z-40 transition-all duration-300">
    <!-- Logo Section -->
    <div class="logo-container flex flex-col items-center py-4 sm:py-6 lg:py-8 cursor-pointer border-b border-gray-100" id="sidebar-logo-btn">
        <div class="relative group">
            <img src="{{ asset('assets/Logo.png') }}"
                alt="Logo TI"
                class="w-10 h-10 sm:w-12 sm:h-12 rounded-full shadow-md hover:shadow-lg transition-all duration-300 group-hover:scale-105">
            <div class="absolute inset-0 rounded-full bg-blue-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
        </div>
        <div class="sidebar-label text-sm font-bold text-gray-800 mt-2 text-center">Admin Panel</div>
        <div class="sidebar-label text-xs text-gray-500 font-medium">Management System</div>
    </div>

    <!-- Navigation Menu - Responsive Scrollable -->
    <nav class="flex-1 flex flex-col gap-1 px-3 sm:px-4 overflow-y-auto scrollbar-thin"
        style="max-height: calc(100vh - 200px);">

        <!-- Dashboard -->
        <a href="/admin/dashboard"
            id="admin-dashboard-link"
            class="group flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition-all duration-200 font-semibold text-sm text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 hover:text-indigo-700 active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="flex-shrink-0 transition-colors duration-200 group-hover:text-indigo-600" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7" />
                <rect x="14" y="3" width="7" height="7" />
                <rect x="14" y="14" width="7" height="7" />
                <rect x="3" y="14" width="7" height="7" />
            </svg>
            <span class="sidebar-label">Dashboard</span>
        </a>

        @if(Auth::user()->role_id == 5)
        <a href="{{ route('assesor.pendaftar') }}"
            class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition font-semibold text-sm font-nunito hover:bg-indigo-50 text-gray-700">
            <!-- Registration icon from icons8 -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 64 64" class="sm:w-5 sm:h-5 flex-shrink-0">
                <path stroke="#000" stroke-miterlimit="10" stroke-width="2" d="M 33 7 C 26.074181 7 21.060547 11.765239 21.060547 18.048828 C 21.060547 27.768298 25.091401 33.02136 29.759766 35.857422 C 27.530237 36.656039 25.17395 37.385277 22.556641 38.029297 C 19.308768 38.828621 16.229176 40.285356 13.90625 42.304688 C 11.583324 44.324019 10 46.967322 10 50 L 10 56 A 1.0001 1.0001 0 0 0 11 57 L 48.125 57 A 1.0001 1.0001 0 1 0 48.125 55 L 12 55 L 12 50 C 12 47.657678 13.199473 45.568122 15.216797 43.814453 C 17.23412 42.060784 20.052076 40.704379 23.033203 39.970703 C 26.355504 39.153212 29.442682 38.24694 32.234375 37.109375 C 36.566042 38.994639 40.945772 39.435384 42.716797 39.958984 C 45.386254 40.747818 47.983027 42.123804 49.878906 44.103516 C 51.774786 46.083227 53 48.637519 53 52 L 53 56 A 1.0001 1.0001 0 1 0 55 56 L 55 52 C 55 48.139481 53.527339 45.021242 51.324219 42.720703 C 49.121098 40.420165 46.217746 38.908182 43.283203 38.041016 C 41.305925 37.456436 38.036406 37.142011 34.675781 35.996094 C 36.081433 35.283807 37.413518 34.506214 38.587891 33.578125 C 42.576044 30.426346 45 25.787643 45 19 C 45 19 45.013788 16.041248 43.519531 13.052734 C 42.025274 10.06422 38.833333 7 33 7 z M 33 9 C 38.166667 9 40.474726 11.43578 41.730469 13.947266 C 42.986212 16.458752 43 19 43 19 C 43 25.329357 40.915003 29.190544 37.347656 32.009766 C 35.901639 33.152531 34.134119 34.078421 32.208984 34.916016 C 31.894499 34.762762 31.571556 34.671986 31.261719 34.498047 C 26.861206 32.027654 23.060547 27.593013 23.060547 18.048828 C 23.060547 12.794418 26.953819 9 33 9 z">
                    </pathc>
            </svg>
            <span class="sidebar-label">Pendaftar</span>
        </a>
        @endif

        @if(Auth::user()->role_id == 3 || Auth::user()->role_id == 5)


        <!-- User Management -->
        <a href="/admin/user"
            id="admin-user-link"
            class="group flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition-all duration-200 font-semibold text-sm text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 hover:text-indigo-700 active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="flex-shrink-0 transition-colors duration-200 group-hover:text-indigo-600" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
            <span class="sidebar-label">User Management</span>
        </a>

        <!-- Academic Records Section -->
        <div class="space-y-1 mt-2">
            <div class="px-3 sm:px-4 py-1">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Academic Records</span>
            </div>

            <!-- Transkrip -->
            <a href="/admin/transkrip"
                id="admin-transkrip-link"
                class="group flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition-all duration-200 font-semibold text-sm text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 hover:text-indigo-700 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="flex-shrink-0 transition-colors duration-200 group-hover:text-indigo-600" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <polyline points="14,2 14,8 20,8" />
                    <line x1="16" y1="13" x2="8" y2="13" />
                    <line x1="16" y1="17" x2="8" y2="17" />
                    <polyline points="10,9 9,9 8,9" />
                </svg>
                <span class="sidebar-label">Transkrip Nilai</span>
            </a>

            <!-- Data Diri -->
            <a href="/admin/data-diri"
                id="admin-datadiri-link"
                class="group flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition-all duration-200 font-semibold text-sm text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 hover:text-indigo-700 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="flex-shrink-0 transition-colors duration-200 group-hover:text-indigo-600" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                <span class="sidebar-label">Data Diri</span>
            </a>

            <!-- Sisa MK -->
            <a href="/admin/sisa-mk"
                id="admin-sisamk-link"
                class="group flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition-all duration-200 font-semibold text-sm text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 hover:text-indigo-700 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="flex-shrink-0 transition-colors duration-200 group-hover:text-indigo-600" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                </svg>
                <span class="sidebar-label">Sisa Mata Kuliah</span>
            </a>
        </div>
        @endif

        @if(Auth::user()->role_id == 2 || Auth::user()->role_id == 5)
        <!-- Assessment Section -->
        <div class="space-y-1 mt-4">
            <div class="px-3 sm:px-4 py-1">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Assessment</span>
            </div>

            <!-- Assessor -->
            <a href="/admin/user/assessor"
                id="admin-assessor-link"
                class="group flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition-all duration-200 font-semibold text-sm text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 hover:text-indigo-700 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="flex-shrink-0 transition-colors duration-200 group-hover:text-indigo-600" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
                <span class="sidebar-label">Assessor</span>
            </a>

            <!-- Pertanyaan -->
            <a href="/admin/question"
                id="admin-question-link"
                class="group flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition-all duration-200 font-semibold text-sm text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 hover:text-indigo-700 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="flex-shrink-0 transition-colors duration-200 group-hover:text-indigo-600" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                    <path d="M12 17h.01" />
                </svg>
                <span class="sidebar-label">Bank Pertanyaan</span>
            </a>
        </div>
        @endif

        @if(Auth::user()->role_id == 3 || Auth::user()->role_id == 5)
        <!-- Curriculum Section -->
        <div class="space-y-1 mt-4">
            <div class="px-3 sm:px-4 py-1">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Curriculum</span>
            </div>

            <!-- Kurikulum -->
            <a href="/admin/kurikulum"
                id="admin-kurikulum-link"
                class="group flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition-all duration-200 font-semibold text-sm text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 hover:text-indigo-700 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="flex-shrink-0 transition-colors duration-200 group-hover:text-indigo-600" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                </svg>
                <span class="sidebar-label">Kurikulum</span>
            </a>

            <!-- Mata Kuliah -->
            <a href="/admin/mata-kuliah"
                id="admin-matakuliah-link"
                class="group flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition-all duration-200 font-semibold text-sm text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 hover:text-indigo-700 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="flex-shrink-0 transition-colors duration-200 group-hover:text-indigo-600" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                </svg>
                <span class="sidebar-label">Mata Kuliah</span>
            </a>

            <!-- Kelas -->
            <a href="/admin/kelas"
                id="admin-kelas-link"
                class="group flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition-all duration-200 font-semibold text-sm text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 hover:text-indigo-700 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="flex-shrink-0 transition-colors duration-200 group-hover:text-indigo-600" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    <polyline points="9,22 9,12 15,12 15,22" />
                </svg>
                <span class="sidebar-label">Kelas</span>
            </a>
        </div>

        <!-- Results & Reports Section -->
        <div class="space-y-1 mt-4">
            <div class="px-3 sm:px-4 py-1">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Results & Reports</span>
            </div>

            <!-- Transfer Hasil -->
            <a href="/admin/transfer-hasil"
                id="admin-transfer-link"
                class="group flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition-all duration-200 font-semibold text-sm text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 hover:text-indigo-700 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="flex-shrink-0 transition-colors duration-200 group-hover:text-indigo-600" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="16 18 22 12 16 6" />
                    <polyline points="8 6 2 12 8 18" />
                </svg>
                <span class="sidebar-label">Transfer Hasil</span>
            </a>

            <!-- Keputusan -->
            <a href="/admin/keputusan"
                id="admin-keputusan-link"
                class="group flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition-all duration-200 font-semibold text-sm text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 hover:text-indigo-700 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="flex-shrink-0 transition-colors duration-200 group-hover:text-indigo-600" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9,11 12,14 22,4" />
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                </svg>
                <span class="sidebar-label">Keputusan</span>
            </a>
        </div>

        <!-- Staff Section -->
        <div class="space-y-1 mt-4">
            <div class="px-3 sm:px-4 py-1">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Staff & Content</span>
            </div>

            <!-- Dosen -->
            <a href="/admin/dosen"
                id="admin-dosen-link"
                class="group flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition-all duration-200 font-semibold text-sm text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 hover:text-indigo-700 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="flex-shrink-0 transition-colors duration-200 group-hover:text-indigo-600" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                    <path d="M6 12v5c3 3 9 3 12 0v-5" />
                </svg>
                <span class="sidebar-label">Dosen</span>
            </a>

            <!-- Berita -->
            <a href="/admin/berita"
                id="admin-berita-link"
                class="group flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition-all duration-200 font-semibold text-sm text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 hover:text-indigo-700 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="flex-shrink-0 transition-colors duration-200 group-hover:text-indigo-600" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2" />
                    <path d="M18 14h-8" />
                    <path d="M15 18h-5" />
                    <path d="M10 6h8v4h-8V6Z" />
                </svg>
                <span class="sidebar-label">Berita & Pengumuman</span>
            </a>
        </div>
        @endif
    </nav>

    <!-- Logout Section - Fixed at bottom -->
    <div class="sidebar-logout mt-auto px-3 sm:px-4 py-4 sm:py-6 border-t border-gray-100">
        <form method="POST" action="{{ route('auth.logout') }}">
            @csrf
            <button type="submit"
                class="group w-full flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition-all duration-200 font-semibold text-sm text-red-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-red-100 hover:text-red-700 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="flex-shrink-0 transition-colors duration-200 group-hover:text-red-700" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16,17 21,12 16,7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>
                <span class="sidebar-label">Sign Out</span>
            </button>
        </form>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Active link management
        const dashboardLink = document.getElementById('admin-dashboard-link');
        const userLink = document.getElementById('admin-user-link');
        const transkripLink = document.getElementById('admin-transkrip-link');
        const datadiriLink = document.getElementById('admin-datadiri-link');
        const sisaMkLink = document.getElementById('admin-sisamk-link');
        const assessorLink = document.getElementById('admin-assessor-link');
        const questionLink = document.getElementById('admin-question-link');
        const kurikulumLink = document.getElementById('admin-kurikulum-link');
        const transferLink = document.getElementById('admin-transfer-link');
        const keputusanLink = document.getElementById('admin-keputusan-link');
        const dosenLink = document.getElementById('admin-dosen-link');
        const matakuliahLink = document.getElementById('admin-matakuliah-link');
        const kelasLink = document.getElementById('admin-kelas-link');
        const beritaLink = document.getElementById('admin-berita-link');

        // Function to remove active classes
        function removeActiveClasses() {
            const links = [dashboardLink, userLink, transkripLink, datadiriLink, sisaMkLink, assessorLink, questionLink, kurikulumLink, transferLink, keputusanLink, dosenLink, matakuliahLink, kelasLink, beritaLink];
            links.forEach(link => {
                if (link) {
                    link.classList.remove('bg-indigo-100', 'text-indigo-700');
                    link.classList.add('text-gray-700');
                }
            });
        }

        // Function to add active class
        function setActiveLink(activeLink) {
            removeActiveClasses();
            if (activeLink) {
                activeLink.classList.add('bg-indigo-100', 'text-indigo-700');
                activeLink.classList.remove('text-gray-700');
            }
        }

        const currentPath = window.location.pathname;
        if (currentPath.includes('/admin/user') && !currentPath.includes('/admin/user/assessor')) {
            setActiveLink(userLink);
        } else if (currentPath.includes('/admin/user/assessor')) {
            setActiveLink(assessorLink);
        } else if (currentPath.includes('/admin/dosen')) {
            setActiveLink(dosenLink);
        } else if (currentPath.includes('/admin/berita')) {
            setActiveLink(beritaLink);
        } else if (currentPath.includes('/admin/transkrip')) {
            setActiveLink(transkripLink);
        } else if (currentPath.includes('/admin/sisa-mk')) {
            setActiveLink(sisaMkLink);
        } else if (currentPath.includes('/admin/data-diri')) {
            setActiveLink(datadiriLink);
        } else if (currentPath.includes('/admin/question')) {
            setActiveLink(questionLink);
        } else if (currentPath.includes('/admin/kurikulum')) {
            setActiveLink(kurikulumLink);
        } else if (currentPath.includes('/admin/transfer-hasil')) {
            setActiveLink(transferLink);
        } else if (currentPath.includes('/admin/keputusan')) {
            setActiveLink(keputusanLink);
        } else if (currentPath.includes('/admin/mata-kuliah')) {
            setActiveLink(matakuliahLink);
        } else if (currentPath.includes('/admin/kelas')) {
            setActiveLink(kelasLink);
        } else if (currentPath.includes('/admin') || currentPath.includes('/admin/dashboard')) {
            setActiveLink(dashboardLink);
        }

        // Add smooth scroll behavior for navigation
        const nav = document.querySelector('.sidebar-assessor nav');
        if (nav) {
            nav.style.scrollBehavior = 'smooth';
        }
    });
</script>