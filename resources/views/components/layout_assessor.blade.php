<div class="flex min-h-screen bg-gray-100">
    {{-- Sidebar --}}
    <x-sidebar_assessor />

    <div id="main-content" class="flex-1 flex flex-col transition-all duration-300 ml-64">
        {{-- Navbar --}}
        <x-navbar_assessor />

        {{-- Main Content --}}
        <main class="flex-1 p-4 md:p-8 overflow-auto">
            {{ $slot }}
        </main>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar-asesor');
        const mainContent = document.getElementById('main-content');
        const logoBtn = document.getElementById('sidebar-logo-btn');
        logoBtn.addEventListener('click', function() {

            setTimeout(function() {
                if (sidebar.classList.contains('w-16')) {
                    mainContent.classList.remove('ml-64');
                    mainContent.classList.add('ml-16');
                } else {
                    mainContent.classList.remove('ml-16');
                    mainContent.classList.add('ml-64');
                }
            }, 10);
        });
    });
</script>