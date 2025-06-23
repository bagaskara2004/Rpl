<nav class="w-full bg-white shadow flex items-center justify-between px-4 md:px-8 h-16">
    <!-- Left side - Title and Date -->
    <div class="flex items-center space-x-4">
       
    </div>

    <!-- Right side - Profile Section -->
    <div class="flex items-center space-x-2 md:space-x-3">
        <div class="hidden md:block">
            <div class="flex items-center space-x-2 px-3 py-2 bg-purple-50 rounded-lg">
                <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                <span class="text-sm text-purple-700 font-medium">Online</span>
            </div>
        </div>

        <!-- Profile Photo -->
        @if(Auth::user()->foto)
        <img src="{{ asset('storage/profile_photos/' . Auth::user()->foto) }}" alt="Profile" class="w-8 h-8 md:w-10 md:h-10 rounded-full object-cover border-2 border-purple-200">
        @else
        <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-gradient-to-r from-purple-400 to-purple-600 flex items-center justify-center border-2 border-purple-200">
            <span class="text-white font-semibold text-sm">{{ strtoupper(substr(Auth::user()->user_name, 0, 1)) }}</span>
        </div>
        @endif

        <div class="flex flex-col">
            <a href="{{ route('assesor.profile') }}" class="font-semibold text-gray-800 hover:text-purple-600 transition text-[14px] font-nunito">{{ Auth::user()->user_name ?? 'Assessor' }}</a>
            <span class="transition font-normal text-[10px] font-nunito text-gray-500">Assessor</span>
        </div>
    </div>
</nav>