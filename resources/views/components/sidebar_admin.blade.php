@vite('resources/css/app.css')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar-asesor');
        const logoBtn = document.getElementById('sidebar-logo-btn');

        if (logoBtn) {
            logoBtn.addEventListener('click', function() {
                // Only toggle on desktop
                if (window.innerWidth >= 1024) {
                    sidebar.classList.toggle('w-16');
                    sidebar.classList.toggle('w-64');
                    sidebar.classList.toggle('sidebar-collapsed');
                }
            });
        }
    });
</script>
<style>
    .sidebar-collapsed .sidebar-label {
        display: none !important;
    }

    .sidebar-collapsed .sidebar-icon {
        display: inline-block !important;
        margin-right: 0;
    }

    .sidebar-collapsed nav {
        align-items: center;
    }

    .sidebar-assessor a {
        color: #374151 !important;
        /* Tailwind text-gray-700 */
    }

    .sidebar-assessor a:hover {
        color: #1d4ed8 !important;
        /* Tailwind hover:text-indigo-700 */
    }

    .sidebar-assessor .text-red-600 {
        color: #dc2626 !important;
    }

    /* Mobile responsive styles */
    @media (max-width: 1023px) {
        .sidebar-assessor {
            transform: translateX(-100%);
        }

        .sidebar-assessor.show {
            transform: translateX(0);
        }
    }

    /* Better focus styles */
    .sidebar-assessor a:focus,
    .sidebar-assessor button:focus {
        outline: 2px solid #3b82f6;
        outline-offset: 2px;
    }

    /* Smooth transitions */
    .sidebar-assessor a,
    .sidebar-assessor button {
        transition: all 0.2s ease-in-out;
    }

    /* Improve logo appearance */
    .sidebar-assessor .logo-container {
        position: relative;
    }

    .sidebar-assessor .logo-container::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 60%;
        height: 1px;
        background: linear-gradient(to right, transparent, #e5e7eb, transparent);
    }
</style>
<aside id="sidebar-asesor" class="sidebar-assessor flex flex-col h-screen w-64 bg-white shadow-md fixed z-30 transition-all duration-300 -translate-x-full lg:translate-x-0">
    <!-- Logo -->
    <div class="logo-container flex flex-col items-center py-6 sm:py-8 cursor-pointer" id="sidebar-logo-btn">
        <img src="{{ asset('assets/Logo.png') }}" alt="Logo TI" class="w-8 h-8 sm:w-10 sm:h-10 rounded-full mb-2 shadow-lg hover:shadow-xl transition-shadow duration-200">
    </div>
    <!-- Menu -->
    <nav class="flex-1 flex flex-col gap-1 px-3 sm:px-4">
        <a href="/admin/dashboard" id="admin-dashboard-link"
            class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition font-semibold text-sm font-nunito hover:bg-indigo-50 text-gray-700">
            <!-- Dashboard icon from icons8 -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 50 50" class="sm:w-5 sm:h-5 flex-shrink-0">
                <path fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2" d="M27 29l0 14c0 1.105.895 2 2 2h14c1.105 0 2-.895 2-2V29c0-1.105-.895-2-2-2H29C27.895 27 27 27.895 27 29zM45 21V7c0-1.105-.895-2-2-2H29c-1.105 0-2 .895-2 2l0 14c0 1.105.895 2 2 2l14 0C44.105 23 45 22.105 45 21zM5 29l0 14c0 1.105.895 2 2 2h14c1.105 0 2-.895 2-2V29c0-1.105-.895-2-2-2H7C5.895 27 5 27.895 5 29zM23 21V7c0-1.105-.895-2-2-2H7C5.895 5 5 5.895 5 7l0 14c0 1.105.895 2 2 2l14 0C22.105 23 23 22.105 23 21z"></path>
            </svg>
            <span class="sidebar-label">Dashboard</span>
        </a>
        <a href="/admin/user" id="admin-user-link"
            class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition font-semibold text-sm font-nunito hover:bg-indigo-50 text-gray-700">
            <!-- Registration icon from icons8 -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 64 64" class="sm:w-5 sm:h-5 flex-shrink-0">
                <path stroke="#000" stroke-miterlimit="10" stroke-width="2" d="M 33 7 C 26.074181 7 21.060547 11.765239 21.060547 18.048828 C 21.060547 27.768298 25.091401 33.02136 29.759766 35.857422 C 27.530237 36.656039 25.17395 37.385277 22.556641 38.029297 C 19.308768 38.828621 16.229176 40.285356 13.90625 42.304688 C 11.583324 44.324019 10 46.967322 10 50 L 10 56 A 1.0001 1.0001 0 0 0 11 57 L 48.125 57 A 1.0001 1.0001 0 1 0 48.125 55 L 12 55 L 12 50 C 12 47.657678 13.199473 45.568122 15.216797 43.814453 C 17.23412 42.060784 20.052076 40.704379 23.033203 39.970703 C 26.355504 39.153212 29.442682 38.24694 32.234375 37.109375 C 36.566042 38.994639 40.945772 39.435384 42.716797 39.958984 C 45.386254 40.747818 47.983027 42.123804 49.878906 44.103516 C 51.774786 46.083227 53 48.637519 53 52 L 53 56 A 1.0001 1.0001 0 1 0 55 56 L 55 52 C 55 48.139481 53.527339 45.021242 51.324219 42.720703 C 49.121098 40.420165 46.217746 38.908182 43.283203 38.041016 C 41.305925 37.456436 38.036406 37.142011 34.675781 35.996094 C 36.081433 35.283807 37.413518 34.506214 38.587891 33.578125 C 42.576044 30.426346 45 25.787643 45 19 C 45 19 45.013788 16.041248 43.519531 13.052734 C 42.025274 10.06422 38.833333 7 33 7 z M 33 9 C 38.166667 9 40.474726 11.43578 41.730469 13.947266 C 42.986212 16.458752 43 19 43 19 C 43 25.329357 40.915003 29.190544 37.347656 32.009766 C 35.901639 33.152531 34.134119 34.078421 32.208984 34.916016 C 31.894499 34.762762 31.571556 34.671986 31.261719 34.498047 C 26.861206 32.027654 23.060547 27.593013 23.060547 18.048828 C 23.060547 12.794418 26.953819 9 33 9 z">
                    </pathc>
            </svg>
            <span class="sidebar-label">User</span>
        </a>
        <a href="/admin/transkrip" id="admin-transkrip-link"
            class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition font-semibold text-sm font-nunito hover:bg-indigo-50 text-gray-700">
            <!-- Transkrip icon -->
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18" height="18" viewBox="0 0 50 50" class="sm:w-5 sm:h-5 flex-shrink-0">
                <path d="M 25 0 C 23.152344 0 21.640625 1.289063 21.1875 3 L 9 3 C 7.355469 3 6 4.355469 6 6 L 6 45 C 6 46.644531 7.355469 48 9 48 L 41 48 C 42.644531 48 44 46.644531 44 45 L 44 6 C 44 4.355469 42.644531 3 41 3 L 32.0625 3 C 32.042969 3 32.019531 3 32 3 L 28.8125 3 C 28.359375 1.289063 26.847656 0 25 0 Z M 25 2 C 26.117188 2 27 2.882813 27 4 C 27 4.550781 27.449219 5 28 5 L 31 5 L 31 7 L 19 7 L 19 5 L 22 5 C 22.550781 5 23 4.550781 23 4 C 23 2.882813 23.882813 2 25 2 Z M 9 5 L 17 5 L 17 8 C 17 8.550781 17.449219 9 18 9 L 32 9 C 32.550781 9 33 8.550781 33 8 L 33 5 L 41 5 C 41.566406 5 42 5.433594 42 6 L 42 45 C 42 45.566406 41.566406 46 41 46 L 9 46 C 8.433594 46 8 45.566406 8 45 L 8 6 C 8 5.433594 8.433594 5 9 5 Z M 28.90625 16.96875 C 28.863281 16.976563 28.820313 16.988281 28.78125 17 C 28.40625 17.066406 28.105469 17.339844 28 17.703125 C 27.894531 18.070313 28.003906 18.460938 28.28125 18.71875 L 30.5625 21 L 28.28125 23.28125 C 27.882813 23.679688 27.882813 24.320313 28.28125 24.71875 C 28.679688 25.117188 29.320313 25.117188 29.71875 24.71875 L 32 22.4375 L 34.28125 24.71875 C 34.679688 25.117188 35.320313 25.117188 35.71875 24.71875 C 36.117188 24.320313 36.117188 23.679688 35.71875 23.28125 L 33.4375 21 L 35.71875 18.71875 C 36.042969 18.417969 36.128906 17.941406 35.933594 17.546875 C 35.742188 17.148438 35.308594 16.929688 34.875 17 C 34.652344 17.023438 34.441406 17.125 34.28125 17.28125 L 32 19.5625 L 29.71875 17.28125 C 29.511719 17.058594 29.210938 16.945313 28.90625 16.96875 Z M 13.71875 20 C 13.167969 20.078125 12.78125 20.589844 12.859375 21.140625 C 12.9375 21.691406 13.449219 22.078125 14 22 L 24 22 C 24.359375 22.003906 24.695313 21.816406 24.878906 21.503906 C 25.058594 21.191406 25.058594 20.808594 24.878906 20.496094 C 24.695313 20.183594 24.359375 19.996094 24 20 L 14 20 C 13.96875 20 13.9375 20 13.90625 20 C 13.875 20 13.84375 20 13.8125 20 C 13.78125 20 13.75 20 13.71875 20 Z M 28.90625 29.96875 C 28.863281 29.976563 28.820313 29.988281 28.78125 30 C 28.40625 30.066406 28.105469 30.339844 28 30.703125 C 27.894531 31.070313 28.003906 31.460938 28.28125 31.71875 L 30.5625 34 L 28.28125 36.28125 C 27.882813 36.679688 27.882813 37.320313 28.28125 37.71875 C 28.679688 38.117188 29.320313 38.117188 29.71875 37.71875 L 32 35.4375 L 34.28125 37.71875 C 34.679688 38.117188 35.320313 38.117188 35.71875 37.71875 C 36.117188 37.320313 36.117188 36.679688 35.71875 36.28125 L 33.4375 34 L 35.71875 31.71875 C 36.042969 31.417969 36.128906 30.941406 35.933594 30.546875 C 35.742188 30.148438 35.308594 29.929688 34.875 30 C 34.652344 30.023438 34.441406 30.125 34.28125 30.28125 L 32 32.5625 L 29.71875 30.28125 C 29.511719 30.058594 29.210938 29.945313 28.90625 29.96875 Z M 13.71875 33 C 13.167969 33.078125 12.78125 33.589844 12.859375 34.140625 C 12.9375 34.691406 13.449219 35.078125 14 35 L 24 35 C 24.359375 35.003906 24.695313 34.816406 24.878906 34.503906 C 25.058594 34.191406 25.058594 33.808594 24.878906 33.496094 C 24.695313 33.183594 24.359375 32.996094 24 33 L 14 33 C 13.96875 33 13.9375 33 13.90625 33 C 13.875 33 13.84375 33 13.8125 33 C 13.78125 33 13.75 33 13.71875 33 Z"></path>
            </svg>
            <span class="sidebar-label">Transkrip</span>
        </a>
        <a href="/admin/data-diri" id="admin-datadiri-link"
            class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition font-semibold text-sm font-nunito hover:bg-indigo-50 text-gray-700">
            <!-- Data Pribadi icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="sm:w-5 sm:h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <span class="sidebar-label">Data Pribadi</span>
        </a>
        <a href="/admin/question" id="admin-question-link"
            class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition font-semibold text-sm font-nunito hover:bg-indigo-50 text-gray-700">
            <!-- Question icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="sm:w-5 sm:h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                <path d="M12 17h.01"></path>
            </svg>
            <span class="sidebar-label">Question</span>
        </a>
        <a href="/admin/kurikulum" id="admin-kurikulum-link"
            class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition font-semibold text-sm font-nunito hover:bg-indigo-50 text-gray-700">
            <!-- Kurikulum icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="sm:w-5 sm:h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
            </svg>
            <span class="sidebar-label">Kurikulum</span>
        </a>
        <a href="/admin/transfer-hasil" id="admin-transfer-link"
            class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition font-semibold text-sm font-nunito hover:bg-indigo-50 text-gray-700">
            <!-- Hasil Transcript icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="sm:w-5 sm:h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14,2 14,8 20,8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10,9 9,9 8,9"></polyline>
            </svg>
            <span class="sidebar-label">Hasil Transcript</span>
        </a>
        <a href="/admin/keputusan" id="admin-keputusan-link"
            class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition font-semibold text-sm font-nunito hover:bg-indigo-50 text-gray-700">
            <!-- Keputusan icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="sm:w-5 sm:h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 11l3 3l8-8"></path>
                <path d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9c1.51 0 2.93.37 4.18 1.03"></path>
            </svg>
            <span class="sidebar-label">Keputusan</span>
        </a>
        <a href="/admin/kelas" id="admin-kelas-link"
            class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition font-semibold text-sm font-nunito hover:bg-indigo-50 text-gray-700">
            <!-- Kelas icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="sm:w-5 sm:h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 7h-3V6a3 3 0 0 0-3-3H6a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h11a3 3 0 0 0 3-3v-1h3a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zM5 6a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v1H5V6zm12 14a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V9h12v11zm2-2h-2V9h2v9z"></path>
                <circle cx="7.5" cy="11.5" r="0.5"></circle>
                <circle cx="7.5" cy="13.5" r="0.5"></circle>
                <circle cx="7.5" cy="15.5" r="0.5"></circle>
                <circle cx="7.5" cy="17.5" r="0.5"></circle>
            </svg>
            <span class="sidebar-label">Kelas</span>
        </a>
        <a href="/admin/mata-kuliah" id="admin-matakuliah-link"
            class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition font-semibold text-sm font-nunito hover:bg-indigo-50 text-gray-700">
            <!-- Mata Kuliah icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="sm:w-5 sm:h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                <circle cx="10" cy="8" r="2"></circle>
                <line x1="8" y1="12" x2="12" y2="12"></line>
                <line x1="8" y1="16" x2="16" y2="16"></line>
            </svg>
            <span class="sidebar-label">Mata Kuliah</span>
        </a>
        <a href="/admin/user/assessor" id="admin-user-link"
            class="flex items-center gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg transition font-semibold text-sm font-nunito hover:bg-indigo-50 text-gray-700">
            <!-- Registration icon from icons8 -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 64 64" class="sm:w-5 sm:h-5 flex-shrink-0">
                <path stroke="#000" stroke-miterlimit="10" stroke-width="2" d="M 33 7 C 26.074181 7 21.060547 11.765239 21.060547 18.048828 C 21.060547 27.768298 25.091401 33.02136 29.759766 35.857422 C 27.530237 36.656039 25.17395 37.385277 22.556641 38.029297 C 19.308768 38.828621 16.229176 40.285356 13.90625 42.304688 C 11.583324 44.324019 10 46.967322 10 50 L 10 56 A 1.0001 1.0001 0 0 0 11 57 L 48.125 57 A 1.0001 1.0001 0 1 0 48.125 55 L 12 55 L 12 50 C 12 47.657678 13.199473 45.568122 15.216797 43.814453 C 17.23412 42.060784 20.052076 40.704379 23.033203 39.970703 C 26.355504 39.153212 29.442682 38.24694 32.234375 37.109375 C 36.566042 38.994639 40.945772 39.435384 42.716797 39.958984 C 45.386254 40.747818 47.983027 42.123804 49.878906 44.103516 C 51.774786 46.083227 53 48.637519 53 52 L 53 56 A 1.0001 1.0001 0 1 0 55 56 L 55 52 C 55 48.139481 53.527339 45.021242 51.324219 42.720703 C 49.121098 40.420165 46.217746 38.908182 43.283203 38.041016 C 41.305925 37.456436 38.036406 37.142011 34.675781 35.996094 C 36.081433 35.283807 37.413518 34.506214 38.587891 33.578125 C 42.576044 30.426346 45 25.787643 45 19 C 45 19 45.013788 16.041248 43.519531 13.052734 C 42.025274 10.06422 38.833333 7 33 7 z M 33 9 C 38.166667 9 40.474726 11.43578 41.730469 13.947266 C 42.986212 16.458752 43 19 43 19 C 43 25.329357 40.915003 29.190544 37.347656 32.009766 C 35.901639 33.152531 34.134119 34.078421 32.208984 34.916016 C 31.894499 34.762762 31.571556 34.671986 31.261719 34.498047 C 26.861206 32.027654 23.060547 27.593013 23.060547 18.048828 C 23.060547 12.794418 26.953819 9 33 9 z">
                    </pathc>
            </svg>
            <span class="sidebar-label">Assessor</span>
        </a>
    </nav>
    <!-- Logout -->
    <div class="mt-auto px-3 sm:px-4 py-4 sm:py-6">
        <form method="POST" action="{{ route('auth.logout') }}">
            @csrf
            <button type="submit"
                class="flex justify-center items-center gap-3 text-red-600 hover:bg-red-50 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg w-full transition font-medium text-sm sm:text-base">
                <!-- Custom Logout icon -->
                <svg class="w-4 h-4 sm:w-5 sm:h-5 sidebar-icon min-w-[16px] sm:min-w-[20px] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0,0,255.99538,255.99538">
                    <g fill="#ff0000" fill-rule="nonzero" stroke="#ff0000" stroke-width="2" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                        <g transform="scale(5.12,5.12)">
                            <path d="M3,0c-1.64453,0 -3,1.35547 -3,3v44c0,1.64453 1.35547,3 3,3h34c1.64453,0 3,-1.35547 3,-3v-8l-2,2v6c0,0.5625 -0.4375,1 -1,1h-34c-0.5625,0 -1,-0.4375 -1,-1v-44c0,-0.56641 0.43359,-1 1,-1h34c0.5625,0 1,0.4375 1,1v6l2,2v-8c0,-1.64453 -1.35547,-3 -3,-3zM37.84375,13.09375c-0.375,0.06641 -0.67578,0.33984 -0.78125,0.70313c-0.10547,0.36719 0.00391,0.75781 0.28125,1.01563l9.1875,9.1875h-29.53125c-0.03125,0 -0.0625,0 -0.09375,0c-0.55078,0.02734 -0.98047,0.49609 -0.95312,1.04688c0.02734,0.55078 0.49609,0.98047 1.04688,0.95313h29.53125l-9.1875,9.1875c-0.29687,0.24219 -0.43359,0.62891 -0.34766,1.00391c0.08594,0.37109 0.37891,0.66406 0.75,0.75c0.375,0.08594 0.76172,-0.05078 1.00391,-0.34766l10.90625,-10.875l0.6875,-0.71875l-0.6875,-0.71875l-10.90625,-10.875c-0.20703,-0.22266 -0.50781,-0.33594 -0.8125,-0.3125c-0.03125,0 -0.0625,0 -0.09375,0z"></path>
                        </g>
                    </g>
                </svg>
                <span class="sidebar-label inline">Logout</span>
            </button>
        </form>
    </div>
</aside>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dashboardLink = document.getElementById('admin-dashboard-link');
        const userLink = document.getElementById('admin-user-link');
        const transkripLink = document.getElementById('admin-transkrip-link');
        const datadiriLink = document.getElementById('admin-datadiri-link');
        const questionLink = document.getElementById('admin-question-link');
        const kurikulumLink = document.getElementById('admin-kurikulum-link');
        const transferLink = document.getElementById('admin-transfer-link');
        const keputusanLink = document.getElementById('admin-keputusan-link');
        const kelasLink = document.getElementById('admin-kelas-link');

        // Function to remove active classes
        function removeActiveClasses() {
            const links = [dashboardLink, userLink, transkripLink, datadiriLink, questionLink, kurikulumLink, transferLink, keputusanLink, kelasLink];
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
        if (currentPath.includes('/admin/user')) {
            setActiveLink(userLink);
        } else if (currentPath.includes('/admin/transkrip')) {
            setActiveLink(transkripLink);
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
        } else if (currentPath.includes('/admin/kelas')) {
            setActiveLink(kelasLink);
        } else if (currentPath.includes('/admin') || currentPath.includes('/admin/dashboard')) {
            setActiveLink(dashboardLink);
        }
    });
</script>