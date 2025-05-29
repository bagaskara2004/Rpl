@vite('resources/css/app.css')
<aside class="flex flex-col h-screen w-64 bg-white border-r shadow-md fixed z-30">
    <!-- Logo -->
    <div class="flex flex-col items-center py-8">
        <img src="{{ asset('img/logo-ti.png') }}" alt="Logo TI" class="w-16 h-16 rounded-full mb-2 shadow-lg">
    </div>
    <!-- Menu -->
    <nav class="flex-1 flex flex-col gap-1 px-4">
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-medium text-base
                  {{ request()->routeIs('dashboard') ? 'bg-purple-700 text-white shadow' : 'hover:bg-purple-50 text-gray-800' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" rx="1" />
                <rect x="14" y="3" width="7" height="7" rx="1" />
                <rect x="14" y="14" width="7" height="7" rx="1" />
                <rect x="3" y="14" width="7" height="7" rx="1" />
            </svg>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('assesor.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-medium text-base
                  {{ request()->routeIs('assesor.index') ? 'bg-purple-700 text-white shadow' : 'hover:bg-purple-50 text-gray-800' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                <circle cx="8.5" cy="7" r="4" />
                <path d="M20 8v6M23 11h-6" />
            </svg>
            <span>Applicant</span>
        </a>
    </nav>
    <!-- Logout -->
    <div class="mt-auto px-4 py-6 border-t border-gray-200">
        <form method="POST" action="">
            @csrf
            <button type="submit"
                class="flex items-center gap-3 text-red-600 hover:bg-red-50 px-4 py-3 rounded-lg w-full transition font-medium text-base">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M17 16l4-4m0 0l-4-4m4 4H7" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M3 21V3" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Logout
            </button>
        </form>
    </div>
</aside>