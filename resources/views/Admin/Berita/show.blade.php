@extends('components.layout_admin')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <!-- Header Section -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-1">Detail Berita</h1>
            <p class="text-gray-600 text-sm">Lihat detail informasi berita</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.berita.edit', $berita->id) }}"
                class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white text-sm font-medium rounded-lg hover:bg-yellow-700 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
            <a href="{{ route('admin.berita.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Content Section -->
    <div class="space-y-6">
        <!-- Meta Information -->
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                    <p class="text-sm text-gray-900">{{ $berita->admin->name ?? 'Admin' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Dibuat</label>
                    <p class="text-sm text-gray-900">{{ $berita->created_at->format('d F Y, H:i') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Terakhir Diupdate</label>
                    <p class="text-sm text-gray-900">{{ $berita->updated_at->format('d F Y, H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Title -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Berita</label>
            <h2 class="text-2xl font-bold text-gray-900">{{ $berita->judul }}</h2>
        </div>

        <!-- Slug -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
            <p class="text-sm text-gray-600 bg-gray-50 px-3 py-2 rounded-lg font-mono">{{ $berita->slug }}</p>
        </div>

        <!-- Image -->
        @if($berita->foto)
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Berita</label>
            <div class="max-w-2xl">
                <img src="{{ asset('storage/' . $berita->foto) }}"
                    alt="{{ $berita->judul }}"
                    class="w-full h-auto object-cover rounded-lg shadow-md">
            </div>
        </div>
        @endif

        <!-- Content -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Konten Berita</label>
            <div class="prose max-w-none bg-gray-50 p-6 rounded-lg">
                <div class="text-gray-900 whitespace-pre-wrap">{{ $berita->deskripsi }}</div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.berita.edit', $berita->id) }}"
                class="inline-flex justify-center items-center px-6 py-3 bg-yellow-600 text-white text-sm font-medium rounded-lg hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Berita
            </a>
            <button onclick="deleteBerita({{ $berita->id }})"
                class="inline-flex justify-center items-center px-6 py-3 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Hapus Berita
            </button>
        </div>
    </div>
</div>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function deleteBerita(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Berita yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/berita/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Terhapus!', data.message, 'success').then(() => {
                                window.location.href = '{{ route('
                                admin.berita.index ') }}';
                            });
                        } else {
                            Swal.fire('Error!', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error!', 'Terjadi kesalahan saat menghapus berita', 'error');
                    });
            }
        });
    }
</script>
@endsection