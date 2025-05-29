<div class="flex min-h-screen bg-gray-100">
    {{-- Sidebar --}}
    <x-sidebar_asesor />

    <div class="flex-1 flex flex-col md:ml-64">
        {{-- Navbar --}}
        <x-navbar_asesor />

        {{-- Main Content --}}
        <main class="flex-1 p-4 md:p-8 overflow-auto">
            {{ $slot }}
        </main>
    </div>
</div>