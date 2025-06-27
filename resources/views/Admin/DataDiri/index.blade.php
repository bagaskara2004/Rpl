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
        .text-responsive {
            font-size: 0.875rem;
        }

        .header-title {
            font-size: 1.25rem;
        }
    }

    /* Modal styles */
    .modal-backdrop {
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        background-color: rgba(0, 0, 0, 0.5);
        transition: all 0.3s ease-in-out;
    }

    .modal-content {
        max-height: 90vh;
        overflow-y: auto;
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-in-out;
    }

    .modal-show .modal-content {
        transform: scale(1);
        opacity: 1;
    }

    .modal-hide .modal-content {
        transform: scale(0.95);
        opacity: 0;
    }

    /* Smooth modal animation */
    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes modalFadeOut {
        from {
            opacity: 1;
            transform: scale(1);
        }

        to {
            opacity: 0;
            transform: scale(0.95);
        }
    }

    .modal-content.animate-in {
        animation: modalFadeIn 0.3s ease-out forwards;
    }

    .modal-content.animate-out {
        animation: modalFadeOut 0.3s ease-out forwards;
    }

    /* Tab styles */
    .tab-btn {
        transition: all 0.2s ease-in-out;
        border: 1px solid transparent;
    }

    .tab-btn:hover {
        background-color: #f3f4f6;
    }

    .tab-btn.active {
        border-color: #3b82f6;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }

    /* Field styles */
    .field-container {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        transition: all 0.2s ease-in-out;
    }

    .field-container:hover {
        background: #f3f4f6;
        border-color: #d1d5db;
    }

    /* Loading animation */
    .loading-spinner {
        border: 2px solid #f3f3f3;
        border-top: 2px solid #3b82f6;
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

    /* Status badge styles */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .status-pending {
        background-color: #fef3c7;
        color: #92400e;
    }

    .status-approved {
        background-color: #d1fae5;
        color: #065f46;
    }

    .status-rejected {
        background-color: #fee2e2;
        color: #991b1b;
    }
</style>

<div class="container-mobile p-3 sm:p-4 md:p-6 lg:p-8">
    <!-- Header dengan Search -->
    <div class="header-mobile flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 gap-4">
        <h1 class="header-title text-xl sm:text-2xl font-bold text-gray-800">Data Pribadi</h1>
        <div class="mobile-search flex items-center bg-white border border-gray-300 rounded-lg px-3 sm:px-4 py-2 w-full sm:w-80 lg:w-96">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400 mr-2 sm:mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input
                type="text"
                id="search-input"
                placeholder="Cari data pribadi..."
                class="w-full outline-none text-gray-700 placeholder-gray-400 text-sm sm:text-base search-input">
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <!-- Desktop Table -->
        <div class="hidden lg:block overflow-x-auto table-responsive">
            <table id="data-table" class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="py-3 sm:py-4 px-3 sm:px-6 text-left text-xs sm:text-sm font-semibold text-gray-700">No</th>
                        <th class="py-3 sm:py-4 px-3 sm:px-6 text-left text-xs sm:text-sm font-semibold text-gray-700">Nama</th>
                        <th class="py-3 sm:py-4 px-3 sm:px-6 text-left text-xs sm:text-sm font-semibold text-gray-700">Email</th>
                        <th class="py-3 sm:py-4 px-3 sm:px-6 text-left text-xs sm:text-sm font-semibold text-gray-700">Jurusan</th>
                        <th class="py-3 sm:py-4 px-3 sm:px-6 text-center text-xs sm:text-sm font-semibold text-gray-700">Status</th>
                        <th class="py-3 sm:py-4 px-3 sm:px-6 text-center text-xs sm:text-sm font-semibold text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <!-- Data akan di-load via AJAX -->
                </tbody>
            </table>
        </div>

        <!-- Mobile/Tablet Card View -->
        <div class="lg:hidden" id="mobile-data-cards">
            <!-- Cards akan di-load via AJAX -->
        </div>

        <!-- Pagination -->
        <div class="bg-white px-3 sm:px-6 py-3 sm:py-4 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="text-xs sm:text-sm text-gray-500 order-2 sm:order-1">
                    <span id="pagination-info">Showing 1-09 of 78</span>
                </div>
                <div class="flex items-center space-x-2 order-1 sm:order-2">
                    <button id="prev-btn" class="p-1.5 sm:p-2 text-gray-400 hover:text-gray-600 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 btn-mobile rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300" disabled>
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <span class="text-xs sm:text-sm text-gray-500 px-2 min-w-[3rem] text-center" id="page-indicator">1</span>
                    <button id="next-btn" class="p-1.5 sm:p-2 text-gray-400 hover:text-gray-600 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 btn-mobile rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detail-modal" class="fixed inset-0 modal-backdrop hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-2/3 xl:w-1/2 shadow-2xl rounded-lg bg-white">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="flex justify-between items-center pb-3 mb-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Detail Data Pribadi</h3>
                <button id="close-modal" class="text-gray-400 hover:text-gray-600 transition-colors duration-200 p-1 rounded-full hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div id="modal-content">
                <!-- Content akan di-load via AJAX -->
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Global variables
    let currentPage = 1;
    let allData = [];
    let filteredData = [];
    const itemsPerPage = 9;

    // Load data
    function loadDataTable() {
        fetch('/admin/data-diri/data', {
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
                    const tbody = document.querySelector('#data-table tbody');
                    tbody.innerHTML = '<tr><td colspan="6" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
                }
            })
            .catch(() => {
                const tbody = document.querySelector('#data-table tbody');
                tbody.innerHTML = '<tr><td colspan="6" class="text-center py-8 text-red-400">Gagal memuat data</td></tr>';
            });
    }

    function renderTable() {
        const tbody = document.querySelector('#data-table tbody');
        const mobileContainer = document.querySelector('#mobile-data-cards');
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const dataToShow = filteredData.slice(startIndex, endIndex);

        if (dataToShow.length === 0) {
            tbody.innerHTML = '<tr><td colspan="6" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
            mobileContainer.innerHTML = '<div class="text-center py-8 text-gray-400">Tidak ada data</div>';
            return;
        }

        // Desktop Table View
        tbody.innerHTML = '';
        dataToShow.forEach((item, index) => {
            const globalIndex = startIndex + index + 1;
            const statusClass = getStatusClass(item.status);
            tbody.innerHTML += `
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <span class="text-sm font-medium text-gray-900">${globalIndex}</span>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <div class="font-medium text-gray-900 text-sm sm:text-base">${item.nama_lengkap}</div>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <div class="text-gray-700 text-sm sm:text-base">${item.email}</div>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <div class="text-gray-700 text-sm sm:text-base">${item.jurusan}</div>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6 text-center">
                        <span class="status-badge ${statusClass}">${formatStatus(item.status)}</span>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6 text-center">
                        <button class="inline-flex items-center justify-center w-8 h-8 rounded-full border border-blue-300 text-blue-500 hover:bg-blue-50 transition-colors duration-200 view-detail-btn" 
                                data-id="${item.id}" 
                                title="Lihat Detail">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
            `;
        });

        // Mobile/Tablet Card View
        mobileContainer.innerHTML = '';
        dataToShow.forEach((item, index) => {
            const globalIndex = startIndex + index + 1;
            const statusClass = getStatusClass(item.status);
            mobileContainer.innerHTML += `
                <div class="mobile-card p-4 border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200">
                    <div class="flex items-start justify-between space-x-4">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="text-xs text-gray-500 font-medium">#${globalIndex}</span>
                                <span class="status-badge ${statusClass}">${formatStatus(item.status)}</span>
                            </div>
                            <div class="font-medium text-gray-900 text-sm sm:text-base truncate mb-1">
                                ${item.nama_lengkap}
                            </div>
                            <div class="text-gray-600 text-xs sm:text-sm truncate mb-1">
                                ${item.email}
                            </div>
                            <div class="text-gray-500 text-xs">
                                <span class="inline-block bg-gray-100 px-2 py-1 rounded text-xs">
                                    ${item.jurusan}
                                </span>
                            </div>
                        </div>
                        <button class="inline-flex items-center justify-center w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-blue-300 text-blue-500 hover:bg-blue-50 transition-colors duration-200 view-detail-btn flex-shrink-0" 
                                data-id="${item.id}" 
                                title="Lihat Detail">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
        });
    }

    function updatePagination() {
        const totalItems = filteredData.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        const startItem = totalItems === 0 ? 0 : ((currentPage - 1) * itemsPerPage) + 1;
        const endItem = Math.min(currentPage * itemsPerPage, totalItems);

        document.getElementById('pagination-info').textContent =
            `Showing ${startItem}-${endItem.toString().padStart(2, '0')} of ${totalItems}`;

        const pageIndicator = document.getElementById('page-indicator');
        if (pageIndicator) {
            pageIndicator.textContent = `${currentPage}/${totalPages || 1}`;
        }

        document.getElementById('prev-btn').disabled = currentPage === 1;
        document.getElementById('next-btn').disabled = currentPage >= totalPages;
    }

    function getStatusClass(status) {
        switch (status) {
            case 'approved':
                return 'status-approved';
            case 'rejected':
                return 'status-rejected';
            default:
                return 'status-pending';
        }
    }

    function formatStatus(status) {
        switch (status) {
            case 'approved':
                return 'Disetujui';
            case 'rejected':
                return 'Ditolak';
            default:
                return 'Pending';
        }
    }

    // Show detail modal
    function showDetailModal(id) {
        const modal = document.getElementById('detail-modal');
        const modalContent = modal.querySelector('.modal-content');
        const modalContentDiv = document.getElementById('modal-content');

        // Show loading state
        modalContentDiv.innerHTML = `
            <div class="flex items-center justify-center py-12">
                <div class="loading-spinner mr-3"></div>
                <span class="text-gray-600">Memuat data...</span>
            </div>
        `;

        // Show modal with animation
        modal.classList.remove('hidden');
        modal.classList.add('modal-show');
        modalContent.classList.add('animate-in');

        // Prevent body scroll
        document.body.style.overflow = 'hidden';

        fetch(`/admin/data-diri/${id}`)
            .then(res => res.json())
            .then(response => {
                if (response.success) {
                    const data = response.data;
                    renderModalContent(data);
                } else {
                    hideDetailModal();
                    Swal.fire('Error', response.message, 'error');
                }
            })
            .catch(error => {
                hideDetailModal();
                Swal.fire('Error', 'Gagal memuat detail data', 'error');
            });
    }

    // Hide detail modal
    function hideDetailModal() {
        const modal = document.getElementById('detail-modal');
        const modalContent = modal.querySelector('.modal-content');

        modal.classList.add('modal-hide');
        modalContent.classList.remove('animate-in');
        modalContent.classList.add('animate-out');

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('modal-show', 'modal-hide');
            modalContent.classList.remove('animate-out');

            // Restore body scroll
            document.body.style.overflow = '';
        }, 300);
    }

    function renderModalContent(data) {
        const dataDiri = data.data_diri;
        const pendidikan = data.pendidikan;
        const pengalamanKerja = data.pengalaman_kerja;

        const modalContent = document.getElementById('modal-content');
        modalContent.innerHTML = `
            <!-- Tabs -->
            <div class="mb-6">
                <nav class="flex space-x-1 bg-gray-100 p-1 rounded-lg" aria-label="Tabs">
                    <button class="tab-btn active bg-white text-blue-700 px-4 py-2 font-medium text-sm rounded-md shadow-sm" data-tab="data-diri">
                        Data Diri
                    </button>
                    <button class="tab-btn text-gray-500 hover:text-gray-700 px-4 py-2 font-medium text-sm rounded-md" data-tab="pendidikan">
                        Pendidikan
                    </button>
                    <button class="tab-btn text-gray-500 hover:text-gray-700 px-4 py-2 font-medium text-sm rounded-md" data-tab="pengalaman">
                        Pengalaman Kerja
                    </button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div id="tab-content">
                <!-- Data Diri Tab -->
                <div id="data-diri-content" class="tab-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${dataDiri.nama_lengkap || '-'}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${dataDiri.email || '-'}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                            <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${dataDiri.tempat_lahir || '-'}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                            <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${dataDiri.tgl_lahir || '-'}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                            <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${dataDiri.jenis_kelamin || '-'}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
                            <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${dataDiri.hp || '-'}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                            <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${dataDiri.alamat || '-'}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kabupaten/Kota</label>
                            <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${dataDiri.kab_kota || '-'}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                            <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${dataDiri.provinsi || '-'}</p>
                        </div>
                    </div>
                </div>

                <!-- Pendidikan Tab -->
                <div id="pendidikan-content" class="tab-content hidden">
                    ${pendidikan ? `
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Perguruan Tinggi</label>
                                <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${pendidikan.nama_perguruan || '-'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Program Studi</label>
                                <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${pendidikan.prodi || '-'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                                <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${pendidikan.jurusan || '-'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">NIM</label>
                                <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${pendidikan.nim || '-'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Masuk</label>
                                <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${pendidikan.tahun_masuk || '-'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Lulus</label>
                                <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${pendidikan.tahun_lulus || '-'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">IPK</label>
                                <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${pendidikan.ipk || '-'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jenjang Pendidikan</label>
                                <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${pendidikan.jenjang_pendidikan || '-'}</p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Tugas Akhir</label>
                                <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${pendidikan.judul_ta || '-'}</p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pembimbing 1</label>
                                <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${pendidikan.pembimbing1 || '-'}</p>
                            </div>
                        </div>
                    ` : '<p class="text-gray-500 text-center py-8">Data pendidikan belum diisi</p>'}
                </div>

                <!-- Pengalaman Kerja Tab -->
                <div id="pengalaman-content" class="tab-content hidden">
                    ${pengalamanKerja && pengalamanKerja.length > 0 ? `
                        <div class="space-y-4">
                            ${pengalamanKerja.map((exp, index) => `
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-medium text-gray-900 mb-3">Pengalaman ${index + 1}</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Perusahaan</label>
                                            <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${exp.nama_perusahaan || '-'}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Posisi</label>
                                            <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${exp.posisi || '-'}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Mulai</label>
                                            <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${exp.tahun_mulai || '-'}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Selesai</label>
                                            <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${exp.tahun_selesai || '-'}</p>
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Kerja</label>
                                            <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${exp.deskripsi_kerja || '-'}</p>
                                        </div>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    ` : '<p class="text-gray-500 text-center py-8">Data pengalaman kerja belum diisi</p>'}
                </div>
            </div>
        `;

        // Add tab functionality
        const tabBtns = modalContent.querySelectorAll('.tab-btn');
        const tabContents = modalContent.querySelectorAll('.tab-content');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');

                // Update active tab
                tabBtns.forEach(b => {
                    b.classList.remove('active', 'bg-white', 'text-blue-700', 'shadow-sm');
                    b.classList.add('text-gray-500', 'hover:text-gray-700');
                });
                this.classList.add('active', 'bg-white', 'text-blue-700', 'shadow-sm');
                this.classList.remove('text-gray-500', 'hover:text-gray-700');

                // Show active content
                tabContents.forEach(content => content.classList.add('hidden'));
                document.getElementById(`${tabId}-content`).classList.remove('hidden');
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the page
        loadDataTable();

        // Search functionality with debounce
        let searchTimeout;
        document.getElementById('search-input').addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                const searchTerm = e.target.value.toLowerCase();
                filteredData = allData.filter(item =>
                    item.nama_lengkap.toLowerCase().includes(searchTerm) ||
                    item.email.toLowerCase().includes(searchTerm) ||
                    item.jurusan.toLowerCase().includes(searchTerm)
                );
                currentPage = 1;
                renderTable();
                updatePagination();
            }, 300);
        });

        // Pagination buttons
        document.getElementById('prev-btn').addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
                updatePagination();

                if (window.innerWidth < 768) {
                    document.querySelector('.bg-white.rounded-lg').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });

        document.getElementById('next-btn').addEventListener('click', function() {
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
                updatePagination();

                if (window.innerWidth < 768) {
                    document.querySelector('.bg-white.rounded-lg').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });

        // View detail button
        document.addEventListener('click', function(e) {
            if (e.target.closest('.view-detail-btn')) {
                const btn = e.target.closest('.view-detail-btn');
                const id = btn.getAttribute('data-id');
                showDetailModal(id);
            }
        });

        // Close modal
        document.getElementById('close-modal').addEventListener('click', function() {
            hideDetailModal();
        });

        // Close modal when clicking outside
        document.getElementById('detail-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideDetailModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('detail-modal');
                if (!modal.classList.contains('hidden')) {
                    hideDetailModal();
                }
            }
        });

        // Handle orientation change on mobile
        window.addEventListener('orientationchange', function() {
            setTimeout(() => {
                renderTable();
                updatePagination();
            }, 100);
        });
    });
</script>
@endsection