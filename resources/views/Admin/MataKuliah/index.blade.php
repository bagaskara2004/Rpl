@extends('components.layout_admin')

@section('content')
<style>
    /* Enhanced responsive styles */
    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .mobile-card {
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.2s ease-in-out;
        }

        .mobile-card:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .mobile-search {
            width: 100%;
        }
    }

    @media (max-width: 640px) {
        .search-input {
            font-size: 14px;
        }

        .container-mobile {
            padding: 0.75rem;
        }

        .header-mobile {
            flex-direction: column;
            align-items: stretch;
            gap: 1rem;
        }
    }

    @media (max-width: 480px) {

        .table th,
        .table td {
            padding: 0.5rem 0.25rem;
            font-size: 0.875rem;
        }
    }

    /* Modal backdrop */
    .modal-backdrop {
        backdrop-filter: blur(4px);
        background-color: rgba(0, 0, 0, 0.5);
    }

    /* Loading spinner */
    .loading-spinner {
        border: 2px solid #f3f4f6;
        border-top: 2px solid #667eea;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<div class="container-mobile p-3 sm:p-4 md:p-6 lg:p-8">
    <!-- Header dengan Search dan Tombol Tambah -->
    <div class="header-mobile flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 gap-4">
        <h1 class="header-title text-xl sm:text-2xl font-bold text-gray-800">Mata Kuliah</h1>
        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
            <div class="mobile-search flex items-center bg-white border border-gray-300 rounded-lg px-3 sm:px-4 py-2 w-full sm:w-80">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400 mr-2 sm:mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input
                    type="text"
                    id="search-input"
                    placeholder="Cari mata kuliah..."
                    class="w-full outline-none text-gray-700 placeholder-gray-400 text-sm sm:text-base search-input">
            </div>
            <button id="tambah-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 flex items-center gap-2 whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah
            </button>
        </div>
    </div>

    <!-- Tabel Desktop -->
    <div class="hidden md:block bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="table-responsive">
            <table id="matakuliah-table" class="w-full table-auto">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider w-16">No</th>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider">Mata Kuliah</th>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider">Kelas</th>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider">Dosen</th>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider">Semester</th>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider">Tahun</th>
                        <th class="text-center py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider w-32">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Data akan dimuat melalui JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Cards Mobile/Tablet -->
    <div id="mobile-matakuliah-cards" class="md:hidden space-y-4">
        <!-- Cards akan dimuat melalui JavaScript -->
    </div>

    <!-- Pagination -->
    <div class="flex flex-col sm:flex-row items-center justify-between mt-6 gap-4">
        <div class="text-sm text-gray-700">
            Showing <span id="showing-start">0</span> to <span id="showing-end">0</span> of <span id="showing-total">0</span> results
        </div>
        <div id="pagination-container" class="flex items-center space-x-2">
            <!-- Pagination akan dimuat melalui JavaScript -->
        </div>
    </div>
</div>

<!-- Modal Add/Edit Mata Kuliah -->
<div id="matakuliah-modal" class="fixed inset-0 modal-backdrop hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-2xl rounded-lg bg-white">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="flex justify-between items-center pb-4 mb-4 border-b border-gray-200">
                <h3 id="modal-title" class="text-lg font-semibold text-gray-900">Tambah Mata Kuliah</h3>
                <button id="close-modal" class="text-gray-400 hover:text-gray-600 transition-colors duration-200 p-1 rounded-full hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Form -->
            <form id="matakuliah-form">
                <input type="hidden" id="matakuliah-id">

                <div class="mb-4">
                    <label for="mata-kuliah-name" class="block text-sm font-medium text-gray-700 mb-2">Nama Mata Kuliah</label>
                    <input type="text" id="mata-kuliah-name" name="mata_kuliah" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan nama mata kuliah">
                    <div id="mata-kuliah-error" class="text-red-500 text-sm mt-1 hidden"></div>
                </div>

                <div class="mb-4">
                    <label for="kelas-select" class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                    <select id="kelas-select" name="kelas_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Kelas</option>
                    </select>
                    <div id="kelas-error" class="text-red-500 text-sm mt-1 hidden"></div>
                </div>

                <div class="mb-4">
                    <label for="dosen-select" class="block text-sm font-medium text-gray-700 mb-2">Dosen</label>
                    <select id="dosen-select" name="dosen_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Dosen</option>
                    </select>
                    <div id="dosen-error" class="text-red-500 text-sm mt-1 hidden"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="semester-input" class="block text-sm font-medium text-gray-700 mb-2">Semester</label>
                        <input type="text" id="semester-input" name="semester" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Contoh: 1, 2, 3">
                        <div id="semester-error" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>
                    <div>
                        <label for="tahun-input" class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                        <input type="text" id="tahun-input" name="tahun" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Contoh: 2024">
                        <div id="tahun-error" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" id="cancel-btn" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                        Batal
                    </button>
                    <button type="submit" id="submit-btn" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Global variables
    let currentPage = 1;
    let allData = [];
    let filteredData = [];
    let kelasList = [];
    let dosenList = [];
    const itemsPerPage = 10;
    let isEdit = false;

    // Load data
    function loadMataKuliahTable() {
        fetch('/admin/mata-kuliah/data', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (Array.isArray(data)) {
                    allData = data;
                    filteredData = [...allData];
                    renderTable();
                    updatePagination();
                } else {
                    const tbody = document.querySelector('#matakuliah-table tbody');
                    tbody.innerHTML = '<tr><td colspan="7" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                const tbody = document.querySelector('#matakuliah-table tbody');
                tbody.innerHTML = '<tr><td colspan="7" class="text-center py-8 text-red-400">Gagal memuat data</td></tr>';
            });
    }

    function loadKelas() {
        fetch('/admin/mata-kuliah/kelas', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                kelasList = data;
                const select = document.getElementById('kelas-select');
                select.innerHTML = '<option value="">Pilih Kelas</option>';

                data.forEach(item => {
                    select.innerHTML += `<option value="${item.id}">${item.kelas}</option>`;
                });
            })
            .catch((error) => {
                console.error('Error loading kelas:', error);
            });
    }

    function loadDosen() {
        fetch('/admin/mata-kuliah/dosen', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                dosenList = data;
                const select = document.getElementById('dosen-select');
                select.innerHTML = '<option value="">Pilih Dosen</option>';

                data.forEach(item => {
                    select.innerHTML += `<option value="${item.id}">${item.name} (${item.email})</option>`;
                });
            })
            .catch((error) => {
                console.error('Error loading dosen:', error);
            });
    }

    function renderTable() {
        const tbody = document.querySelector('#matakuliah-table tbody');
        const mobileContainer = document.querySelector('#mobile-matakuliah-cards');
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const dataToShow = filteredData.slice(startIndex, endIndex);

        if (dataToShow.length === 0) {
            tbody.innerHTML = '<tr><td colspan="7" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
            mobileContainer.innerHTML = '<div class="text-center py-8 text-gray-400">Tidak ada data</div>';
            return;
        }

        // Desktop Table View
        tbody.innerHTML = '';
        dataToShow.forEach((item, index) => {
            const globalIndex = startIndex + index + 1;

            tbody.innerHTML += `
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <span class="text-sm font-medium text-gray-900">${globalIndex}</span>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <div class="text-gray-900 text-sm sm:text-base font-medium">${item.mata_kuliah}</div>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <div class="text-gray-700 text-sm">${item.kelas}</div>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <div class="text-gray-700 text-sm">${item.dosen}</div>
                        <div class="text-gray-500 text-xs">${item.dosen_email}</div>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <div class="text-gray-700 text-sm">${item.semester}</div>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <div class="text-gray-700 text-sm">${item.tahun}</div>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <button class="inline-flex items-center justify-center w-8 h-8 rounded-full border border-green-300 text-green-500 hover:bg-green-50 transition-colors duration-200 edit-btn" 
                                    data-id="${item.id}" 
                                    title="Edit Mata Kuliah">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button class="inline-flex items-center justify-center w-8 h-8 rounded-full border border-red-300 text-red-500 hover:bg-red-50 transition-colors duration-200 delete-btn" 
                                    data-id="${item.id}" 
                                    data-name="${item.mata_kuliah}"
                                    title="Hapus Mata Kuliah">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });

        // Mobile/Tablet Card View
        mobileContainer.innerHTML = '';
        dataToShow.forEach((item, index) => {
            const globalIndex = startIndex + index + 1;

            mobileContainer.innerHTML += `
                <div class="mobile-card p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <div class="flex items-start justify-between">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="text-xs text-gray-500 font-medium">#${globalIndex}</span>
                            </div>
                            <div class="text-gray-900 text-base font-medium mb-1">${item.mata_kuliah}</div>
                            <div class="text-gray-600 text-sm mb-1"><strong>Kelas:</strong> ${item.kelas}</div>
                            <div class="text-gray-600 text-sm mb-1"><strong>Dosen:</strong> ${item.dosen}</div>
                            <div class="text-gray-600 text-sm mb-1"><strong>Semester:</strong> ${item.semester}</div>
                            <div class="text-gray-600 text-sm"><strong>Tahun:</strong> ${item.tahun}</div>
                        </div>
                        <div class="flex-shrink-0 flex space-x-2">
                            <button class="inline-flex items-center justify-center w-9 h-9 rounded-full border border-green-300 text-green-500 hover:bg-green-50 transition-colors duration-200 edit-btn" 
                                    data-id="${item.id}" 
                                    title="Edit Mata Kuliah">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button class="inline-flex items-center justify-center w-9 h-9 rounded-full border border-red-300 text-red-500 hover:bg-red-50 transition-colors duration-200 delete-btn" 
                                    data-id="${item.id}" 
                                    data-name="${item.mata_kuliah}"
                                    title="Hapus Mata Kuliah">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });

        // Update pagination info
        const totalItems = filteredData.length;
        const showingStart = totalItems > 0 ? startIndex + 1 : 0;
        const showingEnd = Math.min(endIndex, totalItems);

        document.getElementById('showing-start').textContent = showingStart;
        document.getElementById('showing-end').textContent = showingEnd;
        document.getElementById('showing-total').textContent = totalItems;
    }

    function updatePagination() {
        const totalPages = Math.ceil(filteredData.length / itemsPerPage);
        const paginationContainer = document.getElementById('pagination-container');

        if (totalPages <= 1) {
            paginationContainer.innerHTML = '';
            return;
        }

        let paginationHTML = '';

        // Previous button
        paginationHTML += `
            <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50 ${currentPage === 1 ? 'cursor-not-allowed opacity-50' : ''}" 
                    onclick="changePage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}>
                Previous
            </button>
        `;

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            if (i === currentPage) {
                paginationHTML += `
                    <button class="px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-gray-300 hover:bg-blue-100">
                        ${i}
                    </button>
                `;
            } else {
                paginationHTML += `
                    <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-50" onclick="changePage(${i})">
                        ${i}
                    </button>
                `;
            }
        }

        // Next button
        paginationHTML += `
            <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50 ${currentPage === totalPages ? 'cursor-not-allowed opacity-50' : ''}" 
                    onclick="changePage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''}>
                Next
            </button>
        `;

        paginationContainer.innerHTML = paginationHTML;
    }

    function changePage(page) {
        const totalPages = Math.ceil(filteredData.length / itemsPerPage);
        if (page >= 1 && page <= totalPages) {
            currentPage = page;
            renderTable();
            updatePagination();
        }
    }

    function filterData(searchTerm) {
        filteredData = allData.filter(item =>
            item.mata_kuliah.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.kelas.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.dosen.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.semester.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.tahun.toLowerCase().includes(searchTerm.toLowerCase())
        );
        currentPage = 1;
        renderTable();
        updatePagination();
    }

    // Modal functions
    function showModal(isEditMode = false, mataKuliahData = null) {
        isEdit = isEditMode;
        const modal = document.getElementById('matakuliah-modal');
        const title = document.getElementById('modal-title');
        const submitBtn = document.getElementById('submit-btn');

        if (isEdit && mataKuliahData) {
            title.textContent = 'Edit Mata Kuliah';
            submitBtn.textContent = 'Perbarui';

            // Load detail untuk mengisi form
            fetch(`/admin/mata-kuliah/${mataKuliahData.id}`)
                .then(res => res.json())
                .then(response => {
                    if (response.success) {
                        const data = response.data;
                        document.getElementById('matakuliah-id').value = data.id;
                        document.getElementById('mata-kuliah-name').value = data.mata_kuliah;
                        document.getElementById('kelas-select').value = data.kelas_id;
                        document.getElementById('dosen-select').value = data.dosen_id;
                        document.getElementById('semester-input').value = data.semester;
                        document.getElementById('tahun-input').value = data.tahun;
                    }
                });
        } else {
            title.textContent = 'Tambah Mata Kuliah';
            submitBtn.textContent = 'Simpan';
            document.getElementById('matakuliah-form').reset();
            document.getElementById('matakuliah-id').value = '';
        }

        hideErrors();
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('mata-kuliah-name').focus();
    }

    function hideModal() {
        document.getElementById('matakuliah-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        document.getElementById('matakuliah-form').reset();
        hideErrors();
    }

    function showError(fieldId, message) {
        const errorDiv = document.getElementById(fieldId + '-error');
        if (errorDiv) {
            errorDiv.textContent = message;
            errorDiv.classList.remove('hidden');
        }
    }

    function hideErrors() {
        const errorDivs = document.querySelectorAll('[id$="-error"]');
        errorDivs.forEach(div => {
            div.classList.add('hidden');
        });
    }

    function submitForm(event) {
        event.preventDefault();

        const formData = new FormData(document.getElementById('matakuliah-form'));
        const mataKuliahId = document.getElementById('matakuliah-id').value;

        // Get CSRF token
        const token = document.querySelector('meta[name="csrf-token"]');
        if (!token) {
            alert('CSRF token not found');
            return;
        }

        // Disable submit button
        const submitBtn = document.getElementById('submit-btn');
        const originalText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Menyimpan...';

        const url = isEdit ? `/admin/mata-kuliah/${mataKuliahId}` : `/admin/mata-kuliah`;
        const method = isEdit ? 'PUT' : 'POST';

        const data = {
            mata_kuliah: formData.get('mata_kuliah'),
            kelas_id: parseInt(formData.get('kelas_id')),
            dosen_id: parseInt(formData.get('dosen_id')),
            semester: formData.get('semester'),
            tahun: formData.get('tahun')
        };

        fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token.getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(response => {
                if (response.success) {
                    hideModal();
                    loadMataKuliahTable();
                    alert(response.message);
                } else {
                    alert(response.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan data');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            });
    }

    function editMataKuliah(mataKuliahId) {
        // Find mata kuliah data from allData
        const mataKuliahData = allData.find(item => item.id == mataKuliahId);
        if (mataKuliahData) {
            showModal(true, mataKuliahData);
        }
    }

    function deleteMataKuliah(mataKuliahId, mataKuliahName) {
        if (confirm(`Apakah Anda yakin ingin menghapus mata kuliah "${mataKuliahName}"?`)) {
            // Get CSRF token
            const token = document.querySelector('meta[name="csrf-token"]');
            if (!token) {
                alert('CSRF token not found');
                return;
            }

            fetch(`/admin/mata-kuliah/${mataKuliahId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token.getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.json())
                .then(response => {
                    if (response.success) {
                        loadMataKuliahTable();
                        alert(response.message);
                    } else {
                        alert(response.message || 'Gagal menghapus mata kuliah');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus mata kuliah');
                });
        }
    }

    // Event Listeners
    document.addEventListener('DOMContentLoaded', function() {
        loadMataKuliahTable();
        loadKelas();
        loadDosen();

        // Search
        let searchTimeout;
        document.getElementById('search-input').addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                filterData(e.target.value);
            }, 300);
        });

        // Modal events
        document.getElementById('tambah-btn').addEventListener('click', () => showModal());
        document.getElementById('close-modal').addEventListener('click', hideModal);
        document.getElementById('cancel-btn').addEventListener('click', hideModal);
        document.getElementById('matakuliah-form').addEventListener('submit', submitForm);

        // Modal backdrop click
        document.getElementById('matakuliah-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideModal();
            }
        });

        // Event delegation for edit and delete buttons
        document.addEventListener('click', function(e) {
            if (e.target.closest('.edit-btn')) {
                const mataKuliahId = e.target.closest('.edit-btn').getAttribute('data-id');
                editMataKuliah(mataKuliahId);
            }

            if (e.target.closest('.delete-btn')) {
                const mataKuliahId = e.target.closest('.delete-btn').getAttribute('data-id');
                const mataKuliahName = e.target.closest('.delete-btn').getAttribute('data-name');
                deleteMataKuliah(mataKuliahId, mataKuliahName);
            }
        });

        // ESC key to close modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideModal();
            }
        });
    });
</script>
@endsection