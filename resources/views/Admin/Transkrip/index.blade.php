@extends('components.layout_admin')

@section('content')
<div class="p-6">
    <!-- Header dengan Search dan Add Button -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Transkrip Nilai</h1>
        <div class="flex items-center space-x-4">
            <div class="flex items-center bg-white border border-gray-300 rounded-lg px-4 py-2 w-full md:w-80">
                <svg class="w-5 h-5 text-gray-400 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input
                    type="text"
                    id="search-input"
                    placeholder="Search Data"
                    class="w-full outline-none text-gray-700 placeholder-gray-400">
            </div>
            <button id="add-transkrip-btn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span>Tambah</span>
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table id="transkrip-table" class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Nama Mahasiswa</th>
                        <!-- <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Email</th> -->
                        <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Mata Kuliah</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">SKS</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Nilai</th>
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
                    <span id="pagination-info">Showing 1-09 of 78</span>
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

<!-- Modal Tambah/Edit Transkrip -->
<div id="transkrip-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 id="modal-title" class="text-lg font-semibold text-gray-900">Tambah Transkrip Nilai</h3>
                    <button id="close-modal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="transkrip-form">
                    <input type="hidden" id="transkrip-id">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mahasiswa</label>
                        <select id="user-select" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Mahasiswa</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mata Kuliah</label>
                        <input type="text" id="mata-kuliah" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">SKS</label>
                        <select id="sks" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="">Pilih SKS</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nilai</label>
                        <select id="nilai" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="">Pilih Nilai</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                        </select>
                    </div>

                    <div class="flex space-x-3">
                        <button type="button" id="cancel-btn" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">Batal</button>
                        <button type="submit" id="save-btn" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">Simpan</button>
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
    let allTranskrips = [];
    let filteredTranskrips = [];
    let allUsers = [];
    const transkripsPerPage = 10;
    let isEditing = false;
    let editingId = null;

    // Global functions
    function loadTranskripTable() {
        fetch('/admin/transkrip/data', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (Array.isArray(data)) {
                    allTranskrips = data;
                    filteredTranskrips = [...allTranskrips];
                    renderTable();
                    updatePagination();
                } else {
                    const tbody = document.querySelector('#transkrip-table tbody');
                    tbody.innerHTML = '<tr><td colspan="7" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
                }
            })
            .catch(() => {
                const tbody = document.querySelector('#transkrip-table tbody');
                tbody.innerHTML = '<tr><td colspan="7" class="text-center py-8 text-red-400">Gagal memuat data</td></tr>';
            });
    }

    function loadUsers() {
        fetch('/admin/user/data', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (Array.isArray(data)) {
                    allUsers = data;
                    populateUserSelect();
                }
            })
            .catch(error => {
                console.error('Error loading users:', error);
            });
    }

    function populateUserSelect() {
        const userSelect = document.getElementById('user-select');
        userSelect.innerHTML = '<option value="">Pilih Mahasiswa</option>';

        allUsers.forEach(user => {
            const option = document.createElement('option');
            option.value = user.id;
            option.textContent = `${user.name || user.email.split('@')[0]} - ${user.email}`;
            userSelect.appendChild(option);
        });
    }

    function renderTable() {
        const tbody = document.querySelector('#transkrip-table tbody');
        const startIndex = (currentPage - 1) * transkripsPerPage;
        const endIndex = startIndex + transkripsPerPage;
        const transkripsToShow = filteredTranskrips.slice(startIndex, endIndex);

        if (transkripsToShow.length === 0) {
            tbody.innerHTML = '<tr><td colspan="7" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
            return;
        }

        tbody.innerHTML = '';
        transkripsToShow.forEach(transkrip => {
            tbody.innerHTML += `
                <tr class="hover:bg-gray-50">
                    <td class="py-4 px-6">
                        <div class="font-medium text-gray-900">${transkrip.user_name || 'Unknown'}</div>
                    </td>
                    <td class="py-4 px-6">
                        <div class="text-gray-900">${transkrip.mata_kuliah}</div>
                    </td>
                    <td class="py-4 px-6">
                        <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">${transkrip.sks}</span>
                    </td>
                    <td class="py-4 px-6">
                        <span class="inline-block px-2 py-1 rounded text-sm font-medium ${getNilaiColor(transkrip.nilai)}">${transkrip.nilai}</span>
                    </td>
                    <td class="py-4 px-6">
                        <span class="text-gray-600 text-sm">${formatTanggal(transkrip.created_at)}</span>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <button class="inline-flex items-center justify-center w-8 h-8 rounded-full border border-blue-300 text-blue-500 hover:bg-blue-50 transition-colors duration-200 edit-transkrip-btn" 
                                    data-id="${transkrip.id}" 
                                    title="Edit Transkrip">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button class="inline-flex items-center justify-center w-8 h-8 rounded-full border border-red-300 text-red-500 hover:bg-red-50 transition-colors duration-200 delete-transkrip-btn" 
                                    data-id="${transkrip.id}" 
                                    title="Hapus Transkrip">
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

    function getNilaiColor(nilai) {
        switch (nilai) {
            case 'A':
                return 'bg-green-100 text-green-800';
            case 'B':
                return 'bg-blue-100 text-blue-800';
            case 'C':
                return 'bg-yellow-100 text-yellow-800';
            case 'D':
                return 'bg-orange-100 text-orange-800';
            case 'E':
                return 'bg-red-100 text-red-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    }

    function updatePagination() {
        const totalItems = filteredTranskrips.length;
        const totalPages = Math.ceil(totalItems / transkripsPerPage);
        const startItem = totalItems === 0 ? 0 : ((currentPage - 1) * transkripsPerPage) + 1;
        const endItem = Math.min(currentPage * transkripsPerPage, totalItems);

        document.getElementById('pagination-info').textContent =
            `Showing ${startItem}-${endItem.toString().padStart(2, '0')} of ${totalItems}`;

        document.getElementById('prev-btn').disabled = currentPage === 1;
        document.getElementById('next-btn').disabled = currentPage >= totalPages;
    }

    function formatTanggal(tanggal) {
        if (!tanggal) return '';
        const d = new Date(tanggal);
        return `${d.getDate()}/${d.getMonth()+1}/${d.getFullYear()}`;
    }

    function openModal(title = 'Tambah Transkrip Nilai') {
        document.getElementById('modal-title').textContent = title;
        document.getElementById('transkrip-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('transkrip-modal').classList.add('hidden');
        document.getElementById('transkrip-form').reset();
        isEditing = false;
        editingId = null;
    }

    function saveTranskrip() {
        const formData = {
            user_id: document.getElementById('user-select').value,
            mata_kuliah: document.getElementById('mata-kuliah').value,
            sks: document.getElementById('sks').value,
            nilai: document.getElementById('nilai').value
        };

        const url = isEditing ? `/admin/transkrip/${editingId}` : '/admin/transkrip';
        const method = isEditing ? 'PUT' : 'POST';

        fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: JSON.stringify(formData)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    closeModal();
                    loadTranskripTable();
                    Swal.fire('Berhasil!', data.message, 'success');
                } else {
                    Swal.fire('Gagal', data.message || 'Terjadi kesalahan.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Gagal', 'Terjadi kesalahan pada server.', 'error');
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the page
        loadTranskripTable();
        loadUsers();

        // Search functionality
        document.getElementById('search-input').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            filteredTranskrips = allTranskrips.filter(transkrip =>
                transkrip.mata_kuliah.toLowerCase().includes(searchTerm) ||
                transkrip.user_name.toLowerCase().includes(searchTerm) ||
                transkrip.user_email.toLowerCase().includes(searchTerm) ||
                transkrip.nilai.toLowerCase().includes(searchTerm)
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
            const totalPages = Math.ceil(filteredTranskrips.length / transkripsPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
                updatePagination();
            }
        });

        // Modal controls
        document.getElementById('add-transkrip-btn').addEventListener('click', function() {
            openModal('Tambah Transkrip Nilai');
        });

        document.getElementById('close-modal').addEventListener('click', closeModal);
        document.getElementById('cancel-btn').addEventListener('click', closeModal);

        // Form submission
        document.getElementById('transkrip-form').addEventListener('submit', function(e) {
            e.preventDefault();
            saveTranskrip();
        });

        // Click outside modal to close
        document.getElementById('transkrip-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    });

    // Event listeners for edit and delete buttons
    document.addEventListener('click', function(e) {
        if (e.target.closest('.edit-transkrip-btn')) {
            const btn = e.target.closest('.edit-transkrip-btn');
            const transkripId = btn.getAttribute('data-id');

            // Find the transkrip data
            const transkrip = allTranskrips.find(t => t.id == transkripId);
            if (transkrip) {
                isEditing = true;
                editingId = transkripId;

                // Populate form with existing data
                document.getElementById('user-select').value = transkrip.user_id;
                document.getElementById('mata-kuliah').value = transkrip.mata_kuliah;
                document.getElementById('sks').value = transkrip.sks;
                document.getElementById('nilai').value = transkrip.nilai;

                openModal('Edit Transkrip Nilai');
            }
        }

        if (e.target.closest('.delete-transkrip-btn')) {
            const btn = e.target.closest('.delete-transkrip-btn');
            const transkripId = btn.getAttribute('data-id');

            Swal.fire({
                title: 'Hapus transkrip ini?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/transkrip/${transkripId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                loadTranskripTable();
                                Swal.fire('Berhasil!', data.message, 'success');
                            } else {
                                Swal.fire('Gagal', data.message || 'Terjadi kesalahan.', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Gagal', 'Terjadi kesalahan pada server.', 'error');
                        });
                }
            });
        }
    });
</script>
@endsection