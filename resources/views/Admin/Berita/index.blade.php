@extends('components.layout_admin')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-1">Manajemen Berita</h1>
            <p class="text-gray-600 text-sm">Kelola berita dan artikel untuk website</p>
        </div>
        <a href="{{ route('admin.berita.create') }}"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors duration-200 shadow-sm hover:shadow-md">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Berita
        </a>
    </div>

    <!-- Search and Filter Section -->
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <div class="flex-1">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" id="searchInput"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Cari berita...">
            </div>
        </div>
        <div class="text-sm text-gray-600 flex items-center">
            Total: <span id="totalCount" class="font-semibold ml-1">0</span> berita
        </div>
    </div>

    <!-- Table Section -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penulis</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody id="beritaTableBody" class="bg-white divide-y divide-gray-200">
                <!-- Data akan diisi via AJAX -->
            </tbody>
        </table>
    </div>

    <!-- Loading State -->
    <div id="loadingState" class="text-center py-8">
        <div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-indigo-500 bg-white transition ease-in-out duration-150">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Loading...
        </div>
    </div>

    <!-- Empty State -->
    <div id="emptyState" class="text-center py-12 hidden">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada berita</h3>
        <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat berita pertama Anda.</p>
        <div class="mt-6">
            <a href="{{ route('admin.berita.create') }}"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Berita
            </a>
        </div>
    </div>

    <!-- Pagination -->
    <div id="paginationContainer" class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6 mt-4">
        <div class="flex flex-1 justify-between sm:hidden">
            <button id="prevPageMobile" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</button>
            <button id="nextPageMobile" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</button>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing <span id="showingStart" class="font-medium">0</span> to <span id="showingEnd" class="font-medium">0</span> of <span id="showingTotal" class="font-medium">0</span> results
                </p>
            </div>
            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" id="paginationNav">
                    <!-- Pagination buttons will be inserted here -->
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let currentPage = 1;
    let totalPages = 1;

    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        let searchTimeout;

        // Load initial data
        loadBerita();

        // Search functionality
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                currentPage = 1;
                loadBerita();
            }, 500);
        });
    });

    function loadBerita() {
        const searchValue = document.getElementById('searchInput').value;
        const loadingState = document.getElementById('loadingState');
        const tableBody = document.getElementById('beritaTableBody');
        const emptyState = document.getElementById('emptyState');
        const paginationContainer = document.getElementById('paginationContainer');

        // Show loading
        loadingState.classList.remove('hidden');
        tableBody.innerHTML = '';
        emptyState.classList.add('hidden');

        fetch(`{{ route('admin.berita.data') }}?page=${currentPage}&search=${encodeURIComponent(searchValue)}`)
            .then(response => response.json())
            .then(data => {
                loadingState.classList.add('hidden');

                // Debug: Log the data structure to console
                console.log('Data received:', data);
                if (data.data && data.data.length > 0) {
                    console.log('First item structure:', data.data[0]);
                }

                if (data.data.length === 0) {
                    emptyState.classList.remove('hidden');
                    paginationContainer.classList.add('hidden');
                } else {
                    renderTable(data.data);
                    updatePagination(data);
                    paginationContainer.classList.remove('hidden');
                }

                document.getElementById('totalCount').textContent = data.total;
            })
            .catch(error => {
                console.error('Error:', error);
                loadingState.classList.add('hidden');
                Swal.fire('Error', 'Gagal memuat data berita', 'error');
            });
    }

    function renderTable(berita) {
        const tableBody = document.getElementById('beritaTableBody');
        tableBody.innerHTML = '';

        // Log the first item to understand the data structure
        if (berita.length > 0) {
            console.log('Rendering table with data structure:', berita[0]);
            console.log('Available keys:', Object.keys(berita[0]));
        }

        berita.forEach((item, index) => {
            try {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50 transition-colors duration-200';

                const startIndex = (currentPage - 1) * 9 + index + 1;

                // Handle foto safely
                const fotoHtml = item.foto ?
                    `<img src="{{ asset('storage') }}/${item.foto}" alt="Foto berita" class="w-12 h-12 object-cover rounded-lg shadow-sm">` :
                    `<div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                     <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                     </svg>
                   </div>`;

                // Handle date safely
                let formattedDate = 'Tanggal tidak tersedia';
                if (item.created_at) {
                    try {
                        formattedDate = new Date(item.created_at).toLocaleDateString('id-ID', {
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric'
                        });
                    } catch (e) {
                        console.error('Error formatting date:', e);
                        formattedDate = 'Format tanggal tidak valid';
                    }
                }

                // Handle author/admin data - specifically use admin.user_name based on admin_id
                let penulisName = 'Admin';
                let penulisInitial = 'A';

                try {
                    // Get user_name from admin relation based on admin_id
                    if (item.admin && item.admin.user_name) {
                        penulisName = item.admin.user_name;
                        penulisInitial = item.admin.user_name.charAt(0).toUpperCase();
                    } else {
                        // Default fallback jika admin tidak ditemukan
                        penulisName = 'Admin';
                        penulisInitial = 'A';
                    }

                    // Log for debugging
                    console.log('Author data for item:', {
                        id: item.id,
                        admin_id: item.admin_id,
                        admin: item.admin,
                        user_name: item.admin?.user_name,
                        resolved: penulisName
                    });

                } catch (error) {
                    console.error('Error processing author data:', error);
                    penulisName = 'Admin';
                    penulisInitial = 'A';
                }

                // Handle title and description safely
                const judulBerita = item.judul || item.title || 'Judul tidak tersedia';
                const deskripsiBerita = item.deskripsi || item.description || item.content || 'Deskripsi tidak tersedia';
                const shortDescription = deskripsiBerita.length > 100 ?
                    deskripsiBerita.substring(0, 100) + '...' :
                    deskripsiBerita;

                row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">${startIndex}</td>
                <td class="px-6 py-4 whitespace-nowrap">${fotoHtml}</td>
                <td class="px-6 py-4">
                    <div class="text-sm font-medium text-gray-900">${judulBerita}</div>
                    <div class="text-sm text-gray-500">${shortDescription}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-8 w-8">
                            <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                <span class="text-sm font-medium text-indigo-600">${penulisInitial}</span>
                            </div>
                        </div>
                        <div class="ml-2">
                            <div class="text-sm font-medium text-gray-900">${penulisName}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formattedDate}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex space-x-2">
                        <a href="/admin/berita/${item.id}/edit" 
                           class="inline-flex items-center px-3 py-1 text-yellow-600 hover:text-yellow-900 bg-yellow-50 hover:bg-yellow-100 rounded-md transition-colors duration-200 text-sm font-medium shadow-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>
                        <button onclick="deleteBerita(${item.id})" 
                                class="inline-flex items-center px-3 py-1 text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 rounded-md transition-colors duration-200 text-sm font-medium shadow-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus
                        </button>
                    </div>
                </td>
            `;
                tableBody.appendChild(row);

            } catch (error) {
                console.error('Error rendering table row:', error, 'Item:', item);
                // Create a fallback row in case of error
                const errorRow = document.createElement('tr');
                errorRow.className = 'hover:bg-gray-50 transition-colors duration-200';
                errorRow.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${(currentPage - 1) * 9 + index + 1}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="w-12 h-12 bg-red-200 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-red-600">Error memuat data</div>
                        <div class="text-sm text-red-500">Terjadi kesalahan saat memproses item ini</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Admin</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">-</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <span class="text-gray-400">Aksi tidak tersedia</span>
                    </td>
                `;
                tableBody.appendChild(errorRow);
            }
        });
    }

    function updatePagination(data) {
        currentPage = data.current_page;
        totalPages = data.total_pages;

        // Update showing info
        const startItem = ((currentPage - 1) * 9) + 1;
        const endItem = Math.min(currentPage * 9, data.total);

        document.getElementById('showingStart').textContent = data.total > 0 ? startItem : 0;
        document.getElementById('showingEnd').textContent = endItem;
        document.getElementById('showingTotal').textContent = data.total;

        // Update pagination buttons
        const paginationNav = document.getElementById('paginationNav');
        paginationNav.innerHTML = '';

        // Previous button
        const prevButton = document.createElement('button');
        prevButton.innerHTML = 'Previous';
        prevButton.className = 'relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0' + (currentPage === 1 ? ' cursor-not-allowed' : ' hover:text-gray-600');
        prevButton.disabled = currentPage === 1;
        prevButton.onclick = () => {
            if (currentPage > 1) {
                currentPage--;
                loadBerita();
            }
        };
        paginationNav.appendChild(prevButton);

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                const pageButton = document.createElement('button');
                pageButton.textContent = i;
                pageButton.className = 'relative inline-flex items-center px-4 py-2 text-sm font-semibold ' + (i === currentPage ? 'z-10 bg-indigo-600 text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0');
                pageButton.onclick = () => {
                    currentPage = i;
                    loadBerita();
                };
                paginationNav.appendChild(pageButton);
            } else if (i === currentPage - 2 || i === currentPage + 2) {
                const ellipsis = document.createElement('span');
                ellipsis.textContent = '...';
                ellipsis.className = 'relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0';
                paginationNav.appendChild(ellipsis);
            }
        }

        // Next button
        const nextButton = document.createElement('button');
        nextButton.innerHTML = 'Next';
        nextButton.className = 'relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0' + (currentPage === totalPages ? ' cursor-not-allowed' : ' hover:text-gray-600');
        nextButton.disabled = currentPage === totalPages;
        nextButton.onclick = () => {
            if (currentPage < totalPages) {
                currentPage++;
                loadBerita();
            }
        };
        paginationNav.appendChild(nextButton);

        // Mobile pagination
        document.getElementById('prevPageMobile').onclick = () => {
            if (currentPage > 1) {
                currentPage--;
                loadBerita();
            }
        };
        document.getElementById('nextPageMobile').onclick = () => {
            if (currentPage < totalPages) {
                currentPage++;
                loadBerita();
            }
        };
    }

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
                            Swal.fire('Terhapus!', data.message, 'success');
                            loadBerita();
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