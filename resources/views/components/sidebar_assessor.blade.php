@vite('resources/css/app.css')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar-asesor');
        const logoBtn = document.getElementById('sidebar-logo-btn');
        logoBtn.addEventListener('click', function() {
            sidebar.classList.toggle('w-16');
            sidebar.classList.toggle('w-64');
            sidebar.classList.toggle('sidebar-collapsed');
        });
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
</style>
<aside id="sidebar-asesor" class="sidebar-assessor flex flex-col h-screen w-64 bg-white shadow-md fixed z-30 transition-all duration-300">
    <!-- Logo -->
    <div class="flex flex-col items-center py-8 cursor-pointer" id="sidebar-logo-btn">
        <img src="{{ asset('assets/Logo.png') }}" alt="Logo TI" class="w-10 h-10 rounded-full mb-2 shadow-lg">
    </div>
    <!-- Menu -->
    <nav class="flex-1 flex flex-col gap-1 px-4">
        <a href="{}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-semibold text-sm font-nunito hover:bg-indigo-50 text-gray-700">
            <!-- Dashboard icon from icons8 -->
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 50 50">
                <path fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2" d="M27 29l0 14c0 1.105.895 2 2 2h14c1.105 0 2-.895 2-2V29c0-1.105-.895-2-2-2H29C27.895 27 27 27.895 27 29zM45 21V7c0-1.105-.895-2-2-2H29c-1.105 0-2 .895-2 2l0 14c0 1.105.895 2 2 2l14 0C44.105 23 45 22.105 45 21zM5 29l0 14c0 1.105.895 2 2 2h14c1.105 0 2-.895 2-2V29c0-1.105-.895-2-2-2H7C5.895 27 5 27.895 5 29zM23 21V7c0-1.105-.895-2-2-2H7C5.895 5 5 5.895 5 7l0 14c0 1.105.895 2 2 2l14 0C22.105 23 23 22.105 23 21z"></path>
            </svg>
            <span class="sidebar-label">Dashboard</span>
        </a>
        <a href="{{ route('assesor.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-semibold text-sm font-nunito hover:bg-indigo-50 text-gray-700">
            <!-- Registration icon from icons8 -->
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 64 64">
                <path stroke="#000" stroke-miterlimit="10" stroke-width="2" d="M 33 7 C 26.074181 7 21.060547 11.765239 21.060547 18.048828 C 21.060547 27.768298 25.091401 33.02136 29.759766 35.857422 C 27.530237 36.656039 25.17395 37.385277 22.556641 38.029297 C 19.308768 38.828621 16.229176 40.285356 13.90625 42.304688 C 11.583324 44.324019 10 46.967322 10 50 L 10 56 A 1.0001 1.0001 0 0 0 11 57 L 48.125 57 A 1.0001 1.0001 0 1 0 48.125 55 L 12 55 L 12 50 C 12 47.657678 13.199473 45.568122 15.216797 43.814453 C 17.23412 42.060784 20.052076 40.704379 23.033203 39.970703 C 26.355504 39.153212 29.442682 38.24694 32.234375 37.109375 C 36.566042 38.994639 40.945772 39.435384 42.716797 39.958984 C 45.386254 40.747818 47.983027 42.123804 49.878906 44.103516 C 51.774786 46.083227 53 48.637519 53 52 L 53 56 A 1.0001 1.0001 0 1 0 55 56 L 55 52 C 55 48.139481 53.527339 45.021242 51.324219 42.720703 C 49.121098 40.420165 46.217746 38.908182 43.283203 38.041016 C 41.305925 37.456436 38.036406 37.142011 34.675781 35.996094 C 36.081433 35.283807 37.413518 34.506214 38.587891 33.578125 C 42.576044 30.426346 45 25.787643 45 19 C 45 19 45.013788 16.041248 43.519531 13.052734 C 42.025274 10.06422 38.833333 7 33 7 z M 33 9 C 38.166667 9 40.474726 11.43578 41.730469 13.947266 C 42.986212 16.458752 43 19 43 19 C 43 25.329357 40.915003 29.190544 37.347656 32.009766 C 35.901639 33.152531 34.134119 34.078421 32.208984 34.916016 C 31.894499 34.762762 31.571556 34.671986 31.261719 34.498047 C 26.861206 32.027654 23.060547 27.593013 23.060547 18.048828 C 23.060547 12.794418 26.953819 9 33 9 z">
                    </pathc>
            </svg>
            <span class="sidebar-label">Applicant</span>
        </a>
    </nav>
    <!-- Logout -->
    <div class="mt-auto px-4 py-6">
        <form method="POST" action="">
            @csrf
            <button type="submit"
                class="flex justify-center items-center gap-3 text-red-600 hover:bg-red-50 px-4 py-3 rounded-lg w-full transition font-medium text-base">
                <!-- Custom Logout icon -->
                <svg class="w-5 h-5 sidebar-icon min-w-[20px]" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0,0,255.99538,255.99538">
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