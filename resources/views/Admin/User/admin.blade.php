@extends('components.layout_admin')

@section('title', 'Kelola Admin')

@section('content')
<div class="p-6">
    <!-- Header dengan Search dan Add Button -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Kelola Admin</h1>
        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
            <div class="flex items-center bg-white border border-gray-300 rounded-lg px-4 py-2 w-full md:w-80">
                <svg class="w-5 h-5 text-gray-400 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input
                    type="text"
                    id="search-input"
                    placeholder="Cari admin..."
                    class="w-full outline-none text-gray-700 placeholder-gray-400">
            </div>
            <button data-modal-target="add-admin-modal" data-modal-toggle="add-admin-modal" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2 whitespace-nowrap" type="button">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Admin
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table id="admin-table" class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Foto</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Username</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Email</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Role</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                        <th class="py-4 px-6 text-center text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <!-- Data akan di-load via AJAX -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-500">
                    <span id="pagination-info">Showing 1-9 of 0</span>
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
</div>

<!-- Modal Add Admin -->
<div id="add-admin-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambah Admin Baru
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="add-admin-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form id="add-admin-form" class="space-y-4" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="user_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                        <input type="text" id="user_name" name="user_name" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Masukkan username">
                        <span class="text-red-500 text-sm hidden" id="error-user_name"></span>
                    </div>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" id="email" name="email" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="name@company.com">
                        <span class="text-red-500 text-sm hidden" id="error-email"></span>
                    </div>

                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" id="password" name="password" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="••••••••">
                        <span class="text-red-500 text-sm hidden" id="error-password"></span>
                    </div>

                    <div>
                        <label for="role_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                        <select id="role_id" name="role_id" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            <option value="">Pilih Role</option>
                            <option value="3">Admin</option>
                            <option value="4">Super Admin</option>
                        </select>
                        <span class="text-red-500 text-sm hidden" id="error-role_id"></span>
                    </div>

                    <div>
                        <label for="foto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Profil (Opsional)</label>
                        <input type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/jpg"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                        <span class="text-red-500 text-sm hidden" id="error-foto"></span>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" data-modal-hide="add-admin-modal"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900">
                            Batal
                        </button>
                        <button type="submit" id="submit-btn"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            <svg id="loading-spinner" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span id="submit-text">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Global variables
    let currentPage = 1;
    let allAdmins = [];
    let filteredAdmins = [];
    const adminsPerPage = 9;

    // Global functions
    function loadAdminTable() {
        fetch('/admin/admin-user/data', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (Array.isArray(data)) {
                    allAdmins = data;
                    filteredAdmins = [...allAdmins];
                    renderTable();
                    updatePagination();
                } else {
                    const tbody = document.querySelector('#admin-table tbody');
                    tbody.innerHTML = '<tr><td colspan="6" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
                }
            })
            .catch(() => {
                const tbody = document.querySelector('#admin-table tbody');
                tbody.innerHTML = '<tr><td colspan="6" class="text-center py-8 text-red-400">Gagal memuat data</td></tr>';
            });
    }

    function renderTable() {
        const tbody = document.querySelector('#admin-table tbody');
        const startIndex = (currentPage - 1) * adminsPerPage;
        const endIndex = startIndex + adminsPerPage;
        const adminsToShow = filteredAdmins.slice(startIndex, endIndex);

        if (adminsToShow.length === 0) {
            tbody.innerHTML = '<tr><td colspan="6" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
            return;
        }

        tbody.innerHTML = '';
        adminsToShow.forEach(admin => {
            const photoSrc = admin.foto ? `/storage/profile_photos/${admin.foto}` : '/assets/User.svg';
            tbody.innerHTML += `
                <tr class="hover:bg-gray-50">
                    <td class="py-4 px-6">
                        <img src="${photoSrc}" alt="Foto" class="w-10 h-10 rounded-full object-cover" onerror="this.src='/assets/User.svg'">
                    </td>
                    <td class="py-4 px-6">
                        <div class="text-sm font-medium text-gray-900">${admin.user_name || '-'}</div>
                    </td>
                    <td class="py-4 px-6">
                        <div class="text-sm text-gray-900">${admin.email || '-'}</div>
                    </td>
                    <td class="py-4 px-6">
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full ${admin.role_id == 4 ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800'}">
                            ${admin.role_name || 'Unknown'}
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <div class="text-sm text-gray-900">${admin.formatted_date}</div>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <button onclick="blockAdmin(${admin.id})" class="text-red-600 hover:text-red-900 text-sm font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                                </svg>
                            </button>
                            <button onclick="deleteAdmin(${admin.id})" class="text-red-600 hover:text-red-900 text-sm font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });
    }

    function updatePagination() {
        const totalItems = filteredAdmins.length;
        const totalPages = Math.ceil(totalItems / adminsPerPage);
        const startItem = totalItems === 0 ? 0 : ((currentPage - 1) * adminsPerPage) + 1;
        const endItem = Math.min(currentPage * adminsPerPage, totalItems);

        document.getElementById('pagination-info').textContent =
            `Showing ${startItem}-${endItem.toString().padStart(2, '0')} of ${totalItems}`;

        document.getElementById('prev-btn').disabled = currentPage === 1;
        document.getElementById('next-btn').disabled = currentPage >= totalPages;
    }

    function blockAdmin(id) {
        Swal.fire({
            title: 'Blokir admin ini?',
            text: 'Admin yang diblokir tidak akan bisa login!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, blokir!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/admin/admin-user/block', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            id: id
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Berhasil!', data.message, 'success');
                            loadAdminTable();
                        } else {
                            Swal.fire('Gagal!', data.message, 'error');
                        }
                    });
            }
        });
    }

    function deleteAdmin(id) {
        Swal.fire({
            title: 'Hapus admin ini?',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/admin-user/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Berhasil!', data.message, 'success');
                            loadAdminTable();
                        } else {
                            Swal.fire('Gagal!', data.message, 'error');
                        }
                    });
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the page
        loadAdminTable();

        // Modal handlers
        const addForm = document.getElementById('add-admin-form');

        // Add form submission
        addForm.addEventListener('submit', function(e) {
            e.preventDefault();
            submitAddForm();
        });

        // Search functionality
        document.getElementById('search-input').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            filteredAdmins = allAdmins.filter(admin =>
                admin.email.toLowerCase().includes(searchTerm) ||
                (admin.user_name && admin.user_name.toLowerCase().includes(searchTerm)) ||
                (admin.display_name && admin.display_name.toLowerCase().includes(searchTerm))
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
            const totalPages = Math.ceil(filteredAdmins.length / adminsPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
                updatePagination();
            }
        });

        // Modal close handlers
        document.querySelectorAll('[data-modal-hide]').forEach(button => {
            button.addEventListener('click', function() {
                const modalId = this.getAttribute('data-modal-hide');
                const modal = document.getElementById(modalId);
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });
        });

        // Modal open handlers
        document.querySelectorAll('[data-modal-toggle]').forEach(button => {
            button.addEventListener('click', function() {
                const modalId = this.getAttribute('data-modal-toggle');
                const modal = document.getElementById(modalId);
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });
        });
    });

    function submitAddForm() {
        const formData = new FormData(document.getElementById('add-admin-form'));

        fetch('/admin/admin-user', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Berhasil!', data.message, 'success');
                    document.getElementById('add-admin-modal').classList.add('hidden');
                    document.getElementById('add-admin-form').reset();
                    loadAdminTable();
                } else {
                    if (data.errors) {
                        Object.keys(data.errors).forEach(key => {
                            showError(key, data.errors[key][0]);
                        });
                    } else {
                        Swal.fire('Gagal!', data.message, 'error');
                    }
                }
            })
            .catch(error => {
                Swal.fire('Error!', 'Terjadi kesalahan pada server', 'error');
            });
    }

    function showError(field, message) {
        const errorElement = document.getElementById(`error-${field}`);
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
        }
    }

    function clearErrors() {
        document.querySelectorAll('[id^="error-"]').forEach(element => {
            element.classList.add('hidden');
            element.textContent = '';
        });
    }
</script>
@endsection