<!-- Tailwind CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<nav class="w-full bg-white border-b shadow flex items-center justify-between px-4 md:px-8 h-16">
    <div></div>
    <div class="flex items-center space-x-2 md:space-x-3">
        <img src="{{ asset('img/profile.png') }}" alt="Profile" class="w-8 h-8 md:w-10 md:h-10 rounded-full object-cover">
        <div class="flex flex-col">
            <span class="font-semibold text-gray-800 text-xs md:text-sm">Momi Roy</span>
            <span class="text-[10px] md:text-xs text-gray-500">Assessor</span>
        </div>
    </div>
</nav>