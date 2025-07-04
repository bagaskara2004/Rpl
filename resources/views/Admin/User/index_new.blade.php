@extends('components.layout_admin')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-1">Daftar User</h1>
            <p class="text-gray-600 text-sm">Kelola data pengguna sistem</p>
        </div>
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
                <input type="text" id="search-input"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Cari pengguna...">
            </div>
        </div>
        <div class="text-sm text-gray-600 flex items-center">
            Total: <span id="totalCount" class="font-semibold ml-1">0</span> pengguna
        </div>
    </div>

    <!-- Table Section -->
    <div class="overflow-x-auto">
        <table id="user-table" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Data akan di-load via AJAX -->
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="bg-white px-6 py-4 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-500">
                <span id="pagination-info">Showing 1-09 of 0</span>
            </div>
            <div class="flex items-center space-x-2">
                <button id="prev-btn" class="p-2 text-gray-400 hover:text-gray-600 disabled:opacity-50" disabled>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button id="next-btn" class="p-2 text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Global variables
    let currentPage = 1;
    let allUsers = [];
    let filteredUsers = [];
    const usersPerPage = 9;

    // Global functions
    function loadUserTable() {
        fetch('/admin/user/data', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (Array.isArray(data)) {
                    allUsers = data;
                    filteredUsers = [...allUsers];
                    renderTable();
                    updatePagination();
                } else {
                    const tbody = document.querySelector('#user-table tbody');
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                    <p class="text-sm">Tidak ada data pengguna</p>
                                </div>
                            </td>
                        </tr>
                    `;
                }
            })
            .catch(() => {
                const tbody = document.querySelector('#user-table tbody');
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-red-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-red-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm">Gagal memuat data</p>
                            </div>
                        </td>
                    </tr>
                `;
            });
    }

    function renderTable() {
        const tbody = document.querySelector('#user-table tbody');
        const startIndex = (currentPage - 1) * usersPerPage;
        const endIndex = startIndex + usersPerPage;
        const usersToShow = filteredUsers.slice(startIndex, endIndex);

        if (usersToShow.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            <p class="text-sm">Tidak ada data pengguna</p>
                        </div>
                    </td>
                </tr>
            `;
            return;
        }

        tbody.innerHTML = '';
        usersToShow.forEach((user, index) => {
            const globalIndex = startIndex + index + 1;
            const userName = user.name || user.user_name || user.email.split('@')[0];
            const userInitial = userName.charAt(0).toUpperCase();
            const userPhoto = user.foto ? user.foto : null;
            const statusBadge = user.is_blocked ?
                '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Diblokir</span>' :
                '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>';

            tbody.innerHTML += `
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${globalIndex}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                ${userPhoto ? 
                                    `<img src="${userPhoto}" alt="Foto" class="h-10 w-10 rounded-full object-cover border-2 border-gray-200">` :
                                    `<div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                        <span class="text-sm font-medium text-indigo-800">${userInitial}</span>
                                    </div>`
                                }
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">${userName}</div>
                                <div class="text-sm text-gray-500">ID: ${user.id}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${user.email}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formatTanggal(user.created_at)}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">${statusBadge}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <button class="inline-flex items-center px-3 py-1.5 ${user.is_blocked ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700'} text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md block-user-btn" 
                                data-id="${user.id}" 
                                title="${user.is_blocked ? 'Unblokir User' : 'Blokir User'}">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                ${user.is_blocked ? 
                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>' :
                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>'
                                }
                            </svg>
                            ${user.is_blocked ? 'Unblokir' : 'Blokir'}
                        </button>
                    </td>
                </tr>
            `;
        });
    }

    function updatePagination() {
        const totalItems = filteredUsers.length;
        const totalPages = Math.ceil(totalItems / usersPerPage);
        const startItem = totalItems === 0 ? 0 : ((currentPage - 1) * usersPerPage) + 1;
        const endItem = Math.min(currentPage * usersPerPage, totalItems);

        document.getElementById('pagination-info').textContent =
            `Showing ${startItem}-${endItem.toString().padStart(2, '0')} of ${totalItems}`;

        document.getElementById('totalCount').textContent = totalItems;

        document.getElementById('prev-btn').disabled = currentPage === 1;
        document.getElementById('next-btn').disabled = currentPage >= totalPages;
    }

    function formatTanggal(tanggal) {
        if (!tanggal) return '';
        const d = new Date(tanggal);
        return `${d.getDate()}/${d.getMonth()+1}/${d.getFullYear()}`;
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the page
        loadUserTable();

        // Search functionality
        document.getElementById('search-input').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            filteredUsers = allUsers.filter(user =>
                user.email.toLowerCase().includes(searchTerm) ||
                (user.name && user.name.toLowerCase().includes(searchTerm)) ||
                (user.user_name && user.user_name.toLowerCase().includes(searchTerm))
            );
            currentPage = 1;
            renderTable();
            updatePagination();
        });

        // Pagination buttons
        document.getElementById('prev-btn').addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
                updatePagination();
            }
        });

        document.getElementById('next-btn').addEventListener('click', function() {
            const totalPages = Math.ceil(filteredUsers.length / usersPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
                updatePagination();
            }
        });
    });

    document.addEventListener('click', function(e) {
        if (e.target.closest('.block-user-btn')) {
            const btn = e.target.closest('.block-user-btn');
            const userId = btn.getAttribute('data-id');
            const isBlocked = btn.textContent.trim().includes('Unblokir');

            Swal.fire({
                title: isBlocked ? 'Unblokir user ini?' : 'Blokir user ini?',
                text: isBlocked ? 'User akan dapat login kembali!' : 'User yang diblokir tidak akan bisa login!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: isBlocked ? '#059669' : '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: isBlocked ? 'Ya, unblokir!' : 'Ya, blokir!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]');
                    if (!csrfToken) {
                        Swal.fire('Error', 'CSRF token tidak ditemukan', 'error');
                        return;
                    }

                    fetch('/admin/user/block', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                id: userId
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                loadUserTable();
                                Swal.fire('Berhasil!', data.message || (isBlocked ? 'User berhasil di-unblokir.' : 'User berhasil diblokir.'), 'success');
                            } else {
                                Swal.fire('Gagal', data.message || 'Terjadi kesalahan pada server.', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Gagal', 'Terjadi kesalahan: ' + error.message, 'error');
                        });
                }
            });
        }
    });
</script>
@endsection