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

        .btn-mobile {
            padding: 0.5rem;
            min-width: 2rem;
            min-height: 2rem;
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

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
    }

    /* Modal Background Blur Effect */
    .modal-backdrop {
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
    }

    .modal-content {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Enhanced Button Styles */
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px 0 rgba(116, 79, 168, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px 0 rgba(116, 79, 168, 0.4);
    }

    /* Form Input Enhanced Styles */
    .form-input {
        transition: all 0.2s ease;
        border: 2px solid #e5e7eb;
    }

    .form-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    /* Loading animation */
    .loading-spinner {
        border: 2px solid #f3f3f3;
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
        <h1 class="header-title text-xl sm:text-2xl font-bold text-gray-800">Curriculum</h1>
        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
            <div class="mobile-search flex items-center bg-white border border-gray-300 rounded-lg px-3 sm:px-4 py-2 w-full sm:w-80">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400 mr-2 sm:mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input
                    type="text"
                    id="search-input"
                    placeholder="Search Data"
                    class="w-full outline-none text-gray-700 placeholder-gray-400 text-sm sm:text-base search-input">
            </div>
            <button id="add-kurikulum-btn" class="btn-primary bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-medium text-sm sm:text-base flex items-center gap-2 whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah
            </button>
        </div>
    </div>

    <!-- Tabel Desktop -->
    <div class="hidden md:block bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="table-responsive">
            <table id="kurikulum-table" class="w-full table-auto">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider w-16 sm:w-20">No</th>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider">MATKUL</th>
                        <th class="text-center py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider w-20">SKS</th>
                        <th class="text-center py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider w-32">ACTION</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Data akan dimuat melalui JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Cards Mobile/Tablet -->
    <div id="mobile-kurikulum-cards" class="md:hidden space-y-4">
        <!-- Cards akan dimuat melalui JavaScript -->
    </div>

    <!-- Pagination -->
    <div id="pagination-container" class="flex flex-col sm:flex-row items-center justify-between mt-6 gap-4">
        <div class="text-sm text-gray-500 order-2 sm:order-1">
            Showing <span id="showing-start">0</span>-<span id="showing-end">0</span> of <span id="showing-total">0</span>
        </div>
        <div id="pagination-buttons" class="flex items-center space-x-2 order-1 sm:order-2">
            <!-- Pagination buttons akan dimuat melalui JavaScript -->
        </div>
    </div>
</div>

<!-- Add/Edit Modal -->
<div id="kurikulum-modal" class="fixed inset-0 modal-backdrop hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 xl:w-2/5 shadow-2xl rounded-lg bg-white">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="flex justify-between items-center pb-4 mb-4 border-b border-gray-200">
                <h3 id="modal-title" class="text-lg font-semibold text-gray-900">Tambah Kurikulum</h3>
                <button id="close-modal" class="text-gray-400 hover:text-gray-600 transition-colors duration-200 p-1 rounded-full hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <form id="kurikulum-form">
                <div class="mb-6">
                    <label for="mata_kuliah_trpl" class="block text-sm font-medium text-gray-700 mb-2">Mata Kuliah <span class="text-red-500">*</span></label>
                    <input
                        type="text"
                        id="mata_kuliah_trpl"
                        name="mata_kuliah_trpl"
                        class="form-input block w-full rounded-lg border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500"
                        placeholder="Masukkan nama mata kuliah..."
                        required>
                    <div id="error-mata-kuliah" class="text-red-500 text-sm mt-1 hidden"></div>
                </div>

                <div class="mb-6">
                    <label for="sks" class="block text-sm font-medium text-gray-700 mb-2">SKS <span class="text-red-500">*</span></label>
                    <input
                        type="number"
                        id="sks"
                        name="sks"
                        min="1"
                        max="6"
                        class="form-input block w-full rounded-lg border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500"
                        placeholder="Masukkan jumlah SKS..."
                        required>
                    <div id="error-sks" class="text-red-500 text-sm mt-1 hidden"></div>
                    <div class="text-xs text-gray-500 mt-1">
                        SKS minimal 1 dan maksimal 6
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex flex-col sm:flex-row justify-end gap-3">
                    <button type="button" id="cancel-btn" class="w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                        Batal
                    </button>
                    <button type="submit" id="submit-btn" class="w-full sm:w-auto btn-primary bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 flex items-center justify-center gap-2">
                        <span id="submit-text">Simpan</span>
                        <div id="submit-spinner" class="loading-spinner hidden"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Global variables
    let currentPage = 1;
    let allData = [];
    let filteredData = [];
    let isEditMode = false;
    let editId = null;
    const itemsPerPage = 9;

    // Load data
    function loadKurikulumTable() {
        fetch('/admin/kurikulum/data', {
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
                    const tbody = document.querySelector('#kurikulum-table tbody');
                    tbody.innerHTML = '<tr><td colspan="4" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
                }
            })
            .catch(() => {
                const tbody = document.querySelector('#kurikulum-table tbody');
                tbody.innerHTML = '<tr><td colspan="4" class="text-center py-8 text-red-400">Gagal memuat data</td></tr>';
            });
    }

    function renderTable() {
        const tbody = document.querySelector('#kurikulum-table tbody');
        const mobileContainer = document.querySelector('#mobile-kurikulum-cards');
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const dataToShow = filteredData.slice(startIndex, endIndex);

        if (dataToShow.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
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
                        <div class="text-gray-900 text-sm sm:text-base">${item.mata_kuliah_trpl}</div>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            ${item.sks} SKS
                        </span>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <button class="inline-flex items-center justify-center w-8 h-8 rounded-full border border-blue-300 text-blue-500 hover:bg-blue-50 transition-colors duration-200 edit-btn" 
                                    data-id="${item.id}" 
                                    title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button class="inline-flex items-center justify-center w-8 h-8 rounded-full border border-red-300 text-red-500 hover:bg-red-50 transition-colors duration-200 delete-btn" 
                                    data-id="${item.id}" 
                                    title="Hapus">
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
                <div class="mobile-card p-4 border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200">
                    <div class="flex items-start justify-between space-x-4">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="text-xs text-gray-500 font-medium">#${globalIndex}</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    ${item.sks} SKS
                                </span>
                            </div>
                            <div class="text-gray-900 text-sm sm:text-base mb-2">
                                ${item.mata_kuliah_trpl}
                            </div>
                        </div>
                        <div class="flex space-x-2 flex-shrink-0">
                            <button class="inline-flex items-center justify-center w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-blue-300 text-blue-500 hover:bg-blue-50 transition-colors duration-200 edit-btn" 
                                    data-id="${item.id}" 
                                    title="Edit">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button class="inline-flex items-center justify-center w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-red-300 text-red-500 hover:bg-red-50 transition-colors duration-200 delete-btn" 
                                    data-id="${item.id}" 
                                    title="Hapus">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });

        // Add event listeners for action buttons
        addActionListeners();
        updateShowingInfo();
    }

    function addActionListeners() {
        // Edit buttons
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', () => editKurikulum(btn.dataset.id));
        });

        // Delete buttons
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', () => deleteKurikulum(btn.dataset.id));
        });
    }

    // Search functionality
    function filterData(searchTerm) {
        filteredData = allData.filter(item =>
            item.mata_kuliah_trpl.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.sks.toString().includes(searchTerm)
        );
        currentPage = 1;
        renderTable();
        updatePagination();
    }

    // Pagination
    function updatePagination() {
        const totalItems = filteredData.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        const container = document.getElementById('pagination-buttons');

        if (totalPages <= 1) {
            container.innerHTML = '';
            return;
        }

        let paginationHTML = '';

        // Previous button
        paginationHTML += `
            <button ${currentPage === 1 ? 'disabled' : ''} 
                    onclick="changePage(${currentPage - 1})" 
                    class="px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">
                <span class="sr-only">Previous</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
            </button>
        `;

        // Page numbers
        const startPage = Math.max(1, currentPage - 2);
        const endPage = Math.min(totalPages, startPage + 4);

        for (let i = startPage; i <= endPage; i++) {
            paginationHTML += `
                <button onclick="changePage(${i})" 
                        class="px-3 py-2 text-sm leading-tight ${currentPage === i ? 'text-blue-600 bg-blue-50 border-blue-300' : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700'} border">
                    ${i}
                </button>
            `;
        }

        // Next button
        paginationHTML += `
            <button ${currentPage === totalPages ? 'disabled' : ''} 
                    onclick="changePage(${currentPage + 1})" 
                    class="px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">
                <span class="sr-only">Next</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </button>
        `;

        container.innerHTML = paginationHTML;
    }

    function changePage(page) {
        const totalPages = Math.ceil(filteredData.length / itemsPerPage);
        if (page >= 1 && page <= totalPages) {
            currentPage = page;
            renderTable();
            updatePagination();
        }
    }

    function updateShowingInfo() {
        const totalItems = filteredData.length;
        const startIndex = (currentPage - 1) * itemsPerPage + 1;
        const endIndex = Math.min(currentPage * itemsPerPage, totalItems);

        document.getElementById('showing-start').textContent = totalItems > 0 ? startIndex : 0;
        document.getElementById('showing-end').textContent = endIndex;
        document.getElementById('showing-total').textContent = totalItems;
    }

    // CRUD Operations
    function saveKurikulum(data) {
        const url = isEditMode ? `/admin/kurikulum/${editId}` : '/admin/kurikulum';
        const method = isEditMode ? 'PUT' : 'POST';

        setLoading(true);

        fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(response => {
                setLoading(false);
                if (response.success) {
                    hideModal();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    loadKurikulumTable();
                } else {
                    showError(response.message);
                }
            })
            .catch(() => {
                setLoading(false);
                showError('Terjadi kesalahan sistem');
            });
    }

    function editKurikulum(id) {
        fetch(`/admin/kurikulum/${id}`)
            .then(res => res.json())
            .then(response => {
                if (response.success) {
                    showModal('Edit Kurikulum', response.data);
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            })
            .catch(() => {
                Swal.fire('Error', 'Gagal memuat data', 'error');
            });
    }

    function deleteKurikulum(id) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus kurikulum ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/kurikulum/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.json())
                    .then(response => {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            loadKurikulumTable();
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    })
                    .catch(() => {
                        Swal.fire('Error', 'Gagal menghapus data', 'error');
                    });
            }
        });
    }

    // Modal functions
    function showModal(title, data = null) {
        document.getElementById('modal-title').textContent = title;
        document.getElementById('kurikulum-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        clearErrors();

        if (data) {
            isEditMode = true;
            editId = data.id;
            document.getElementById('mata_kuliah_trpl').value = data.mata_kuliah_trpl;
            document.getElementById('sks').value = data.sks;
            document.getElementById('submit-text').textContent = 'Update';
        } else {
            isEditMode = false;
            editId = null;
            document.getElementById('kurikulum-form').reset();
            document.getElementById('submit-text').textContent = 'Simpan';
        }
    }

    function hideModal() {
        document.getElementById('kurikulum-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        document.getElementById('kurikulum-form').reset();
        clearErrors();
        isEditMode = false;
        editId = null;
    }

    function setLoading(loading) {
        const submitBtn = document.getElementById('submit-btn');
        const submitText = document.getElementById('submit-text');
        const submitSpinner = document.getElementById('submit-spinner');

        if (loading) {
            submitBtn.disabled = true;
            submitText.textContent = 'Menyimpan...';
            submitSpinner.classList.remove('hidden');
        } else {
            submitBtn.disabled = false;
            submitText.textContent = isEditMode ? 'Update' : 'Simpan';
            submitSpinner.classList.add('hidden');
        }
    }

    function clearErrors() {
        document.getElementById('error-mata-kuliah').classList.add('hidden');
        document.getElementById('error-sks').classList.add('hidden');
    }

    function showError(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: message
        });
    }

    // Event Listeners
    document.addEventListener('DOMContentLoaded', function() {
        loadKurikulumTable();

        // Search
        let searchTimeout;
        document.getElementById('search-input').addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                filterData(e.target.value);
            }, 300);
        });

        // Add button
        document.getElementById('add-kurikulum-btn').addEventListener('click', () => {
            showModal('Tambah Kurikulum');
        });

        // Modal close buttons
        document.getElementById('close-modal').addEventListener('click', hideModal);
        document.getElementById('cancel-btn').addEventListener('click', hideModal);

        // Form submit
        document.getElementById('kurikulum-form').addEventListener('submit', function(e) {
            e.preventDefault();
            clearErrors();

            const formData = {
                mata_kuliah_trpl: document.getElementById('mata_kuliah_trpl').value,
                sks: parseInt(document.getElementById('sks').value)
            };

            saveKurikulum(formData);
        });

        // Modal backdrop click
        document.getElementById('kurikulum-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideModal();
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