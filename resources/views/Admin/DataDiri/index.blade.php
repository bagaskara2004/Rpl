@extends('components.layout_admin')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-1">Data Pribadi</h1>
            <p class="text-gray-600 text-sm">Kelola data pribadi mahasiswa</p>
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
                <input type="text" id="searchInput"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Cari nama, email, tempat lahir, jurusan...">
            </div>
        </div>
        <div class="text-sm text-gray-600 flex items-center">
            Total: <span id="totalCount" class="font-semibold ml-1">{{ $users ? $users->count() : 0 }}</span> data
        </div>
    </div>

    <!-- Table Section -->
    <div class="overflow-x-auto">
        <table id="data-table" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tempat Lahir</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Lahir</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IPK</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Data akan di-render via JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="bg-white px-6 py-4 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-500">
                <span id="pagination-info">Showing 1-09 of {{ $users ? $users->count() : 0 }}</span>
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

@php
$usersData = $users ?? collect([]);
@endphp

<script>
    // Global variables
    let currentPage = 1;
    let allUsers = @json($usersData);
    let filteredUsers = [...allUsers];
    const usersPerPage = 9;

    // Functions
    function renderTable() {
        const tbody = document.querySelector('#data-table tbody');
        const startIndex = (currentPage - 1) * usersPerPage;
        const endIndex = startIndex + usersPerPage;
        const usersToShow = filteredUsers.slice(startIndex, endIndex);

        if (usersToShow.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="9" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <p class="text-sm">Belum ada data pribadi</p>
                        </div>
                    </td>
                </tr>
            `;
            return;
        }

        tbody.innerHTML = '';
        usersToShow.forEach((user, index) => {
            const globalIndex = startIndex + index + 1;
            const namaLengkap = user.data_diri ? user.data_diri.nama_lengkap : (user.name || user.user_name || 'User');
            const tempatLahir = user.data_diri ? user.data_diri.tempat_lahir : '-';
            const tglLahir = user.data_diri && user.data_diri.tgl_lahir ?
                new Date(user.data_diri.tgl_lahir).toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                }) : '-';
            const jurusan = user.pendidikan ? user.pendidikan.jurusan : '-';
          
            const ipk = user.pendidikan ? user.pendidikan.ipk : '-';
            const initial = namaLengkap.charAt(0).toUpperCase();

            tbody.innerHTML += `
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">${globalIndex}</td>
                    <td class="px-4 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-8 w-8">
                                <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <span class="text-xs font-medium text-indigo-800">${initial}</span>
                                </div>
                            </div>
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-900">${namaLengkap}</div>
                                <div class="text-xs text-gray-500">${user.data_diri && user.data_diri.jenis_kelamin ? user.data_diri.jenis_kelamin.charAt(0).toUpperCase() + user.data_diri.jenis_kelamin.slice(1) : ''}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">${user.email}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">${tempatLahir}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">${tglLahir}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">${jurusan}</td>
                   
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">${ipk}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <a href="/admin/data-diri/${user.id}" 
                           class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white text-xs font-medium rounded-lg hover:bg-indigo-700 transition-colors duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Detail
                        </a>
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

    // Event listeners
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize
        renderTable();
        updatePagination();

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            filteredUsers = allUsers.filter(user => {
                const namaLengkap = user.data_diri ? user.data_diri.nama_lengkap : (user.name || user.user_name || '');
                const email = user.email || '';
                const tempatLahir = user.data_diri ? user.data_diri.tempat_lahir : '';
                const jurusan = user.pendidikan ? user.pendidikan.jurusan : '';
                const prodi = user.pendidikan ? user.pendidikan.prodi : '';

                return namaLengkap.toLowerCase().includes(searchTerm) ||
                    email.toLowerCase().includes(searchTerm) ||
                    tempatLahir.toLowerCase().includes(searchTerm) ||
                    jurusan.toLowerCase().includes(searchTerm) ||
                    prodi.toLowerCase().includes(searchTerm);
            });
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
</script>
@endsection