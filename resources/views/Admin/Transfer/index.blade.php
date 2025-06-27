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

    /* Detail table styles */
    .detail-table {
        max-height: 400px;
        overflow-y: auto;
    }

    .detail-table::-webkit-scrollbar {
        width: 6px;
    }

    .detail-table::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .detail-table::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }

    .detail-table::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>

<div class="container-mobile p-3 sm:p-4 md:p-6 lg:p-8">
    <!-- Header dengan Search -->
    <div class="header-mobile flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 gap-4">
        <h1 class="header-title text-xl sm:text-2xl font-bold text-gray-800">Transcript Results</h1>
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
        </div>
    </div>

    <!-- Tabel Desktop -->
    <div class="hidden md:block bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="table-responsive">
            <table id="transfer-table" class="w-full table-auto">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider w-16">No</th>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider">NAME</th>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider">Major</th>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider">Program Study</th>
                        <th class="text-center py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider w-24">Total SKS</th>
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
    <div id="mobile-transfer-cards" class="md:hidden space-y-4">
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

<!-- Detail Transfer Modal -->
<div id="detail-modal" class="fixed inset-0 modal-backdrop hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-4/5 lg:w-3/4 xl:w-4/5 shadow-2xl rounded-lg bg-white">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="flex justify-between items-center pb-4 mb-4 border-b border-gray-200">
                <h3 id="modal-title" class="text-lg font-semibold text-gray-900">Detail Transfer Nilai</h3>
                <button id="close-modal" class="text-gray-400 hover:text-gray-600 transition-colors duration-200 p-1 rounded-full hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Loading State -->
            <div id="modal-loading" class="hidden text-center py-8">
                <div class="loading-spinner mx-auto mb-4"></div>
                <p class="text-gray-500">Memuat data...</p>
            </div>

            <!-- Modal Content -->
            <div id="modal-content" class="hidden">
                <!-- Student Info -->
                <div id="student-info" class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <!-- Student info akan dimuat melalui JavaScript -->
                </div>

                <!-- Transfer Details Table -->
                <div class="detail-table">
                    <table class="w-full table-auto border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-left py-2 px-3 text-xs font-semibold text-gray-600 uppercase border-b">No</th>
                                <th class="text-left py-2 px-3 text-xs font-semibold text-gray-600 uppercase border-b">Mata Kuliah TRPL</th>
                                <th class="text-center py-2 px-3 text-xs font-semibold text-gray-600 uppercase border-b">SKS TRPL</th>
                                <th class="text-left py-2 px-3 text-xs font-semibold text-gray-600 uppercase border-b">Mata Kuliah Asal</th>
                                <th class="text-center py-2 px-3 text-xs font-semibold text-gray-600 uppercase border-b">Nilai Asal</th>
                                <th class="text-center py-2 px-3 text-xs font-semibold text-gray-600 uppercase border-b">Nilai Transfer</th>
                                <th class="text-left py-2 px-3 text-xs font-semibold text-gray-600 uppercase border-b">Asesor</th>
                            </tr>
                        </thead>
                        <tbody id="detail-table-body">
                            <!-- Detail transfer akan dimuat melalui JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- Summary -->
                <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-700">Total SKS Ditransfer:</span>
                        <span id="total-sks-transfer" class="text-xl font-bold text-blue-600">0 SKS</span>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end mt-6">
                <button id="close-modal-btn" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Global variables
    let currentPage = 1;
    let allData = [];
    let filteredData = [];
    const itemsPerPage = 9;

    // Load data
    function loadTransferTable() {
        fetch('/admin/transfer-hasil/data', {
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
                    const tbody = document.querySelector('#transfer-table tbody');
                    tbody.innerHTML = '<tr><td colspan="6" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
                }
            })
            .catch(() => {
                const tbody = document.querySelector('#transfer-table tbody');
                tbody.innerHTML = '<tr><td colspan="6" class="text-center py-8 text-red-400">Gagal memuat data</td></tr>';
            });
    }

    function renderTable() {
        const tbody = document.querySelector('#transfer-table tbody');
        const mobileContainer = document.querySelector('#mobile-transfer-cards');
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
            tbody.innerHTML += `
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <span class="text-sm font-medium text-gray-900">${globalIndex}</span>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <div class="text-gray-900 text-sm sm:text-base font-medium">${item.name}</div>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <div class="text-gray-700 text-sm">${item.major}</div>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <div class="text-gray-700 text-sm">${item.program_study}</div>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            ${item.total_sks} SKS
                        </span>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6 text-center">
                        <button class="inline-flex items-center justify-center w-8 h-8 rounded-full border border-blue-300 text-blue-500 hover:bg-blue-50 transition-colors duration-200 detail-btn" 
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
            mobileContainer.innerHTML += `
                <div class="mobile-card p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <div class="flex items-start justify-between space-x-4">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="text-xs text-gray-500 font-medium">#${globalIndex}</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    ${item.total_sks} SKS
                                </span>
                            </div>
                            <div class="text-gray-900 text-sm sm:text-base font-medium mb-1">
                                ${item.name}
                            </div>
                            <div class="text-gray-600 text-xs mb-1">
                                <strong>Jurusan:</strong> ${item.major}
                            </div>
                            <div class="text-gray-600 text-xs">
                                <strong>Program Studi:</strong> ${item.program_study}
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <button class="inline-flex items-center justify-center w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-blue-300 text-blue-500 hover:bg-blue-50 transition-colors duration-200 detail-btn" 
                                    data-id="${item.id}" 
                                    title="Lihat Detail">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
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
        // Detail buttons
        document.querySelectorAll('.detail-btn').forEach(btn => {
            btn.addEventListener('click', () => showDetailModal(btn.dataset.id));
        });
    }

    // Search functionality
    function filterData(searchTerm) {
        filteredData = allData.filter(item =>
            item.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.major.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.program_study.toLowerCase().includes(searchTerm.toLowerCase())
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

    // Modal functions
    function showDetailModal(userId) {
        const modal = document.getElementById('detail-modal');
        const loading = document.getElementById('modal-loading');
        const content = document.getElementById('modal-content');

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        loading.classList.remove('hidden');
        content.classList.add('hidden');

        // Find user data for title
        const userData = allData.find(item => item.id == userId);
        if (userData) {
            document.getElementById('modal-title').textContent = `Detail Transfer Nilai - ${userData.name}`;
        }

        // Load transfer details
        fetch(`/admin/transfer-hasil/${userId}/detail`)
            .then(res => res.json())
            .then(response => {
                loading.classList.add('hidden');
                if (response.success) {
                    renderDetailModal(response.data, userData);
                    content.classList.remove('hidden');
                } else {
                    hideDetailModal();
                    alert('Gagal memuat detail transfer');
                }
            })
            .catch(() => {
                loading.classList.add('hidden');
                hideDetailModal();
                alert('Terjadi kesalahan saat memuat data');
            });
    }

    function renderDetailModal(transferData, userData) {
        // Render student info
        const studentInfo = document.getElementById('student-info');
        studentInfo.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Nama Mahasiswa</p>
                    <p class="font-semibold text-gray-900">${userData.name}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Jurusan Asal</p>
                    <p class="font-semibold text-gray-900">${userData.major}</p>
                </div>
               
            </div>
        `;

        // Render transfer details table
        const tableBody = document.getElementById('detail-table-body');
        let totalSks = 0;

        tableBody.innerHTML = '';
        transferData.forEach((item, index) => {
            totalSks += parseInt(item.sks_kurikulum);
            // Menentukan nilai asal yang akan ditampilkan
            const nilaiAsal = item.nilai_huruf_asal || item.nilai_angka_asal || '-';

            tableBody.innerHTML += `
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-3 text-sm border-b">${index + 1}</td>
                    <td class="py-2 px-3 text-sm border-b">${item.mata_kuliah_trpl}</td>
                    <td class="py-2 px-3 text-sm text-center border-b">${item.sks_kurikulum}</td>
                    <td class="py-2 px-3 text-sm border-b">${item.mata_kuliah_asal} (${item.sks_asal} SKS)</td>
                    <td class="py-2 px-3 text-sm text-center border-b">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            ${nilaiAsal}
                        </span>
                    </td>
                    <td class="py-2 px-3 text-sm text-center border-b">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            ${item.nilai}
                        </span>
                    </td>
                    <td class="py-2 px-3 text-sm border-b">${item.asesor_name}</td>
                </tr>
            `;
        });

        // Update total SKS
        document.getElementById('total-sks-transfer').textContent = `${totalSks} SKS`;
    }

    function hideDetailModal() {
        document.getElementById('detail-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Event Listeners
    document.addEventListener('DOMContentLoaded', function() {
        loadTransferTable();

        // Search
        let searchTimeout;
        document.getElementById('search-input').addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                filterData(e.target.value);
            }, 300);
        });

        // Modal close buttons
        document.getElementById('close-modal').addEventListener('click', hideDetailModal);
        document.getElementById('close-modal-btn').addEventListener('click', hideDetailModal);

        // Modal backdrop click
        document.getElementById('detail-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideDetailModal();
            }
        });

        // ESC key to close modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideDetailModal();
            }
        });
    });
</script>
@endsection