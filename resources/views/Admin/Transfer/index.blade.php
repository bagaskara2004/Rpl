@extends('components.layout_admin')

@section('content')
<style>
    /* Enhanced responsive styles */
    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
            -we                        <div class="flex-shrink-0">
                            <a href="/admin/transfer-hasil/${item.id}" class="inline-flex items-center justify-center w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-blue-300 text-blue-500 hover:bg-blue-50 transition-colors duration-200" 
                               title="Lihat Detail">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                        </div>flow-scrolling: touch;
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
</style>

<div class="container-mobile p-3 sm:p-4 md:p-6 lg:p-8">
    <!-- Header dengan Search -->
    <div class="header-mobile flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 gap-4">
        <h1 class="header-title text-xl sm:text-2xl font-bold text-gray-800">Transfer Results</h1>
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
                        <a href="/admin/transfer-hasil/${item.id}" class="inline-flex items-center justify-center w-8 h-8 rounded-full border border-blue-300 text-blue-500 hover:bg-blue-50 transition-colors duration-200" 
                           title="Lihat Detail">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </a>
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
                            <a href="/admin/transfer/${item.id}" class="inline-flex items-center justify-center w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-blue-300 text-blue-500 hover:bg-blue-50 transition-colors duration-200" 
                               title="Lihat Detail">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
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
        // No action buttons needed anymore since we're using direct links
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
    });
</script>
@endsection