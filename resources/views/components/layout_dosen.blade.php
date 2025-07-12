{{-- resources/views/components/layout_dosen.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Dosen' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f5f7; }
    </style>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{-- Navbar --}}
<nav class="navbar navbar-light bg-white shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center px-4">
        <div class="d-flex align-items-center">
            <img src="/assets/ilustrasi/Logo.png" alt="Logo" width="40" class="me-2">
            <span class="fw-bold fs-5">Sistem Dosen</span>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ url('/dosen/dashboard') }}" class="text-dark text-decoration-none me-3">
                <i class="bi bi-grid fs-4"></i>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link text-decoration-none me-3">
                    <i class="bi bi-box-arrow-right fs-4 text-danger"></i>
                </button>
            </form>
            <div class="me-3">
                <div class="fw-bold">{{ Auth::user()->user_name }}</div>
                <div class="text-muted small">Dosen</div>
            </div>
            <img src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : 'https://i.pravatar.cc/40?img=68' }}"
                 class="rounded-circle" width="40" alt="Avatar"
                 role="button" data-bs-toggle="modal" data-bs-target="#profileModal">
        </div>
    </div>
</nav>
    @hasSection('sidebar')
        <div class="d-flex">
            {{-- Sidebar Khusus Halaman --}}
            @yield('sidebar')

            {{-- Konten utama --}}
            <div class="flex-grow-1">
                @yield('content')
            </div>
        </div>
    @else
        {{-- Hanya konten saja --}}
        @yield('content')
    @endif

@include('dosen.profile_modal')
</body>
</html>
