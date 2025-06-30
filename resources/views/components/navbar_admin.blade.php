<nav class="w-full bg-white shadow flex items-center justify-between px-3 sm:px-4 md:px-6 lg:px-8 h-14 sm:h-16 border-b border-gray-200">
    <!-- Left side - Mobile Menu Button and Title -->
    <div class="flex items-center space-x-2 sm:space-x-4">
        <!-- Mobile Menu Button -->
        <button id="mobile-menu-btn" class="lg:hidden p-1.5 sm:p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Logo/Title (optional) -->
        <div class="hidden sm:block">
            <span class="text-sm font-medium text-gray-700">Admin Panel</span>
        </div>
    </div>

    <!-- Right side - Profile Section -->
    <div class="flex items-center space-x-2 md:space-x-3">
        <!-- Online Status -->
        <div class="hidden sm:block">
            <div class="flex items-center space-x-2 px-2 sm:px-3 py-1.5 sm:py-2 bg-blue-50 rounded-lg">
                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                <span class="text-xs sm:text-sm text-blue-700 font-medium">Online</span>
            </div>
        </div>

        <!-- Profile Photo -->
        @if(Auth::user()->foto)
        <img src="{{ asset('storage/profile_photos/' . Auth::user()->foto) }}" alt="Profile" class="w-8 h-8 md:w-10 md:h-10 rounded-full object-cover border-2 border-blue-200 shadow-sm">
        @else
        <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center border-2 border-blue-200 shadow-sm">
            <span class="text-white font-semibold text-xs sm:text-sm">{{ strtoupper(substr(Auth::user()->user_name ?? Auth::user()->name ?? 'A', 0, 1)) }}</span>
        </div>
        @endif

        <!-- Profile Info -->
        <div class="flex flex-col min-w-0">
            <a href="{{ route('admin.profile') }}" class="font-semibold text-gray-800 hover:text-blue-600 transition text-xs sm:text-[14px] font-nunito truncate max-w-20 sm:max-w-32 md:max-w-none">{{ Auth::user()->user_name ?? Auth::user()->name ?? 'Admin' }}</a>
            <span class="transition font-normal text-[10px] sm:text-[10px] font-nunito text-gray-500">Administrator</span>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar-asesor');
        const overlay = document.getElementById('sidebar-overlay');

        if (mobileMenuBtn && sidebar && overlay) {
            mobileMenuBtn.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            });
        }
    });
</script>