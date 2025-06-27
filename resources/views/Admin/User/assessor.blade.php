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

    /* Improved card layout */
    .mobile-card-content {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
    }

    .user-info {
        flex: 1;
        min-width: 0;
    }

    .action-button {
        flex-shrink: 0;
    }
</style>

<div class="container-mobile p-3 sm:p-4 md:p-6 lg:p-8">
    <!-- Header dengan Search -->
    <div class="header-mobile flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 gap-4">
        <h1 class="header-title text-xl sm:text-2xl font-bold text-gray-800">Daftar Assessor</h1>
        <div class="mobile-search flex items-center bg-white border border-gray-300 rounded-lg px-3 sm:px-4 py-2 w-full sm:w-80 lg:w-96">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400 mr-2 sm:mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input
                type="text"
                id="search-input"
                placeholder="Cari assessor..."
                class="w-full outline-none text-gray-700 placeholder-gray-400 text-sm sm:text-base search-input">
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <!-- Desktop Table -->
        <div class="hidden lg:block overflow-x-auto table-responsive">
            <table id="user-table" class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="py-3 sm:py-4 px-3 sm:px-6 text-left text-xs sm:text-sm font-semibold text-gray-700">Image</th>
                        <th class="py-3 sm:py-4 px-3 sm:px-6 text-left text-xs sm:text-sm font-semibold text-gray-700">Nama</th>
                        <th class="py-3 sm:py-4 px-3 sm:px-6 text-left text-xs sm:text-sm font-semibold text-gray-700">Email</th>
                        <th class="py-3 sm:py-4 px-3 sm:px-6 text-left text-xs sm:text-sm font-semibold text-gray-700">Tanggal</th>
                        <th class="py-3 sm:py-4 px-3 sm:px-6 text-center text-xs sm:text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <!-- Data akan di-load via AJAX -->
                </tbody>
            </table>
        </div>

        <!-- Mobile/Tablet Card View -->
        <div class="lg:hidden" id="mobile-user-cards">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Global variables
    let currentPage = 1;
    let allUsers = [];
    let filteredUsers = [];
    const usersPerPage = 9;

    // Global functions
    function loadUserTable() {
        fetch('/admin/user/data/assessor', {
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
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
                }
            })
            .catch(() => {
                const tbody = document.querySelector('#user-table tbody');
                tbody.innerHTML = '<tr><td colspan="5" class="text-center py-8 text-red-400">Gagal memuat data</td></tr>';
            });
    }

    function renderTable() {
        const tbody = document.querySelector('#user-table tbody');
        const mobileContainer = document.querySelector('#mobile-user-cards');
        const startIndex = (currentPage - 1) * usersPerPage;
        const endIndex = startIndex + usersPerPage;
        const usersToShow = filteredUsers.slice(startIndex, endIndex);

        if (usersToShow.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
            mobileContainer.innerHTML = '<div class="text-center py-8 text-gray-400">Tidak ada data</div>';
            return;
        }

        // Desktop Table View
        tbody.innerHTML = '';
        usersToShow.forEach(user => {
            tbody.innerHTML += `
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <img src="${user.foto ?? '/assets/default-avatar.png'}" 
                             alt="Foto" 
                             class="w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover border-2 border-gray-200">
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <div class="font-medium text-gray-900 text-sm sm:text-base">${user.name || user.email.split('@')[0]}</div>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <div class="text-gray-700 text-sm sm:text-base">${user.email}</div>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <span class="text-gray-600 text-xs sm:text-sm">${formatTanggal(user.created_at)}</span>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6 text-center">
                        <button class="inline-flex items-center justify-center w-7 h-7 sm:w-8 sm:h-8 rounded-full border border-red-300 text-red-500 hover:bg-red-50 transition-colors duration-200 block-user-btn" 
                                data-id="${user.id}" 
                                title="Blokir User">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0,0,255.99538,255.99538" class="sm:w-5 sm:h-5">
                                <g fill="#ff0000" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                    <g transform="scale(5.12,5.12)">
                                        <path d="M25,3c-5.815,0 -9.66252,3.586 -9.97852,9.25c-0.014,0.246 -0.02148,0.496 -0.02148,0.75c-0.002,1.647 0.40547,3.2988 0.85547,4.7168c-0.432,0.514 -0.85047,1.29534 -0.85547,2.27734c0,0.105 0.00358,0.34591 0.01758,0.50391c0.274,2.107 1.22841,3.11253 2.06641,3.51953c0.277,1.898 0.96502,3.48955 1.91602,4.43555v3.77539c-0.578,1.386 -2.5892,2.18728 -4.9082,3.11328c-3.901,1.558 -8.75684,3.49552 -9.08984,9.60352l-0.00195,1.05469h24.62305c-0.368,-0.633 -0.67583,-1.301 -0.92383,-2h-21.57813c0.731,-4.013 4.27394,-5.42878 7.71094,-6.80078c2.736,-1.093 5.32223,-2.1237 6.11523,-4.4707l0.05273,-0.15625v-5.07227l-0.40039,-0.30078c-0.661,-0.495 -1.41252,-1.93802 -1.60352,-4.04102l-0.05273,-0.90625h-0.91211c-0.204,-0.036 -0.83139,-0.48284 -1.02539,-1.96484c-0.005,-0.069 -0.00586,-0.21725 -0.00586,-0.28125c0.004,-0.756 0.56727,-1.18155 0.57227,-1.18555l0.61328,-0.42969l-0.23828,-0.70898c-0.675,-2.012 -0.94927,-3.35848 -0.94727,-4.64648c0.005,-4.956 3.071,-8.03516 8,-8.03516c1.977,0 3.11428,0.83959 3.48828,1.55859l0.24414,0.46875l0.52539,0.0625c3.065,0.362 3.72719,3.08183 3.74219,5.29883c0.015,2.155 -0.64008,4.29136 -0.95508,5.31836l-0.17187,0.77148l0.65625,0.4043c0.092,0.058 0.46666,0.438 0.47266,1.125c0,0.064 -0.00281,0.21139 -0.00781,0.27539c-0.14,1.61 -0.81819,1.96275 -0.99219,1.96875h-0.87305l-0.11914,0.86328c-0.322,2.363 -1.04237,3.66094 -1.60937,4.08594l-0.40039,0.29883v5.05859l0.06445,0.17188c0.159,0.417 0.38844,0.78205 0.64844,1.12305c0.376,-0.627 0.80611,-1.21767 1.28711,-1.76367v-3.64062c1.107,-1.121 1.63577,-3.00177 1.88477,-4.38477c0.908,-0.378 1.90956,-1.39428 2.10156,-3.61328c0.009,-0.111 0.01367,-0.35098 0.01367,-0.45898c-0.007,-0.981 -0.38347,-1.79117 -0.85547,-2.32617c0.366,-1.245 0.86947,-3.22497 0.85547,-5.29297c-0.027,-4.009 -1.84758,-6.60131 -5.01758,-7.19531c-0.962,-1.355 -2.81542,-2.17773 -4.98242,-2.17773zM40,30c-5.511,0 -10,4.489 -10,10c0,5.511 4.489,10 10,10c5.511,0 10,-4.489 10,-10c0,-5.511 -4.489,-10 -10,-10zM40,32c4.43012,0 8,3.56988 8,8c0,4.43012 -3.56988,8 -8,8c-4.43012,0 -8,-3.56988 -8,-8c0,-4.43012 3.56988,-8 8,-8zM36.49023,35.49023c-0.40692,0.00011 -0.77321,0.24676 -0.92633,0.62377c-0.15312,0.37701 -0.06255,0.80921 0.22907,1.09303l2.79297,2.79297l-2.79297,2.79297c-0.26124,0.25082 -0.36648,0.62327 -0.27512,0.97371c0.09136,0.35044 0.36503,0.62411 0.71547,0.71547c0.35044,0.09136 0.72289,-0.01388 0.97371,-0.27512l2.79297,-2.79297l2.79297,2.79297c0.25082,0.26124 0.62327,0.36648 0.97371,0.27512c0.35044,-0.09136 0.62411,-0.36503 0.71547,-0.71547c0.09136,-0.35044 -0.01388,-0.72289 -0.27512,-0.97371l-2.79297,-2.79297l2.79297,-2.79297c0.29576,-0.28749 0.38469,-0.72707 0.22393,-1.10691c-0.16075,-0.37985 -0.53821,-0.62204 -0.9505,-0.60988c-0.2598,0.00774 -0.50638,0.11632 -0.6875,0.30273l-2.79297,2.79297l-2.79297,-2.79297c-0.18827,-0.19353 -0.4468,-0.30272 -0.7168,-0.30273z"></path>
                                    </g>
                                </g>
                            </svg>
                        </button>
                    </td>
                </tr>
            `;
        });

        // Mobile/Tablet Card View
        mobileContainer.innerHTML = '';
        usersToShow.forEach(user => {
            mobileContainer.innerHTML += `
                <div class="mobile-card p-4 border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200">
                    <div class="mobile-card-content">
                        <div class="flex items-center space-x-3 user-info">
                            <img src="${user.foto ?? '/assets/default-avatar.png'}" 
                                 alt="Foto" 
                                 class="w-12 h-12 sm:w-14 sm:h-14 rounded-full object-cover border-2 border-gray-200 flex-shrink-0">
                            <div class="flex-1 min-w-0">
                                <div class="font-medium text-gray-900 text-sm sm:text-base truncate">
                                    ${user.name || user.email.split('@')[0]}
                                </div>
                                <div class="text-gray-600 text-xs sm:text-sm truncate mt-1">
                                    ${user.email}
                                </div>
                                <div class="text-gray-500 text-xs mt-1">
                                    <span class="inline-block bg-gray-100 px-2 py-1 rounded text-xs">
                                        ${formatTanggal(user.created_at)}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <button class="action-button inline-flex items-center justify-center w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-red-300 text-red-500 hover:bg-red-50 transition-colors duration-200 block-user-btn" 
                                data-id="${user.id}" 
                                title="Blokir User">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0,0,255.99538,255.99538" class="sm:w-5 sm:h-5">
                                <g fill="#ff0000" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                    <g transform="scale(5.12,5.12)">
                                        <path d="M25,3c-5.815,0 -9.66252,3.586 -9.97852,9.25c-0.014,0.246 -0.02148,0.496 -0.02148,0.75c-0.002,1.647 0.40547,3.2988 0.85547,4.7168c-0.432,0.514 -0.85047,1.29534 -0.85547,2.27734c0,0.105 0.00358,0.34591 0.01758,0.50391c0.274,2.107 1.22841,3.11253 2.06641,3.51953c0.277,1.898 0.96502,3.48955 1.91602,4.43555v3.77539c-0.578,1.386 -2.5892,2.18728 -4.9082,3.11328c-3.901,1.558 -8.75684,3.49552 -9.08984,9.60352l-0.00195,1.05469h24.62305c-0.368,-0.633 -0.67583,-1.301 -0.92383,-2h-21.57813c0.731,-4.013 4.27394,-5.42878 7.71094,-6.80078c2.736,-1.093 5.32223,-2.1237 6.11523,-4.4707l0.05273,-0.15625v-5.07227l-0.40039,-0.30078c-0.661,-0.495 -1.41252,-1.93802 -1.60352,-4.04102l-0.05273,-0.90625h-0.91211c-0.204,-0.036 -0.83139,-0.48284 -1.02539,-1.96484c-0.005,-0.069 -0.00586,-0.21725 -0.00586,-0.28125c0.004,-0.756 0.56727,-1.18155 0.57227,-1.18555l0.61328,-0.42969l-0.23828,-0.70898c-0.675,-2.012 -0.94927,-3.35848 -0.94727,-4.64648c0.005,-4.956 3.071,-8.03516 8,-8.03516c1.977,0 3.11428,0.83959 3.48828,1.55859l0.24414,0.46875l0.52539,0.0625c3.065,0.362 3.72719,3.08183 3.74219,5.29883c0.015,2.155 -0.64008,4.29136 -0.95508,5.31836l-0.17187,0.77148l0.65625,0.4043c0.092,0.058 0.46666,0.438 0.47266,1.125c0,0.064 -0.00281,0.21139 -0.00781,0.27539c-0.14,1.61 -0.81819,1.96275 -0.99219,1.96875h-0.87305l-0.11914,0.86328c-0.322,2.363 -1.04237,3.66094 -1.60937,4.08594l-0.40039,0.29883v5.05859l0.06445,0.17188c0.159,0.417 0.38844,0.78205 0.64844,1.12305c0.376,-0.627 0.80611,-1.21767 1.28711,-1.76367v-3.64062c1.107,-1.121 1.63577,-3.00177 1.88477,-4.38477c0.908,-0.378 1.90956,-1.39428 2.10156,-3.61328c0.009,-0.111 0.01367,-0.35098 0.01367,-0.45898c-0.007,-0.981 -0.38347,-1.79117 -0.85547,-2.32617c0.366,-1.245 0.86947,-3.22497 0.85547,-5.29297c-0.027,-4.009 -1.84758,-6.60131 -5.01758,-7.19531c-0.962,-1.355 -2.81542,-2.17773 -4.98242,-2.17773zM40,30c-5.511,0 -10,4.489 -10,10c0,5.511 4.489,10 10,10c5.511,0 10,-4.489 10,-10c0,-5.511 -4.489,-10 -10,-10zM40,32c4.43012,0 8,3.56988 8,8c0,4.43012 -3.56988,8 -8,8c-4.43012,0 -8,-3.56988 -8,-8c0,-4.43012 3.56988,-8 8,-8zM36.49023,35.49023c-0.40692,0.00011 -0.77321,0.24676 -0.92633,0.62377c-0.15312,0.37701 -0.06255,0.80921 0.22907,1.09303l2.79297,2.79297l-2.79297,2.79297c-0.26124,0.25082 -0.36648,0.62327 -0.27512,0.97371c0.09136,0.35044 0.36503,0.62411 0.71547,0.71547c0.35044,0.09136 0.72289,-0.01388 0.97371,-0.27512l2.79297,-2.79297l2.79297,2.79297c0.25082,0.26124 0.62327,0.36648 0.97371,0.27512c0.35044,-0.09136 0.62411,-0.36503 0.71547,-0.71547c0.09136,-0.35044 -0.01388,-0.72289 -0.27512,-0.97371l-2.79297,-2.79297l2.79297,-2.79297c0.29576,-0.28749 0.38469,-0.72707 0.22393,-1.10691c-0.16075,-0.37985 -0.53821,-0.62204 -0.9505,-0.60988c-0.2598,0.00774 -0.50638,0.11632 -0.6875,0.30273l-2.79297,2.79297l-2.79297,-2.79297c-0.18827,-0.19353 -0.4468,-0.30272 -0.7168,-0.30273z"></path>
                                    </g>
                                </g>
                            </svg>
                        </button>
                    </div>
                </div>
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

        // Update page indicator
        const pageIndicator = document.getElementById('page-indicator');
        if (pageIndicator) {
            pageIndicator.textContent = `${currentPage}/${totalPages || 1}`;
        }

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

        // Search functionality with debounce
        let searchTimeout;
        document.getElementById('search-input').addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                const searchTerm = e.target.value.toLowerCase();
                filteredUsers = allUsers.filter(user =>
                    user.email.toLowerCase().includes(searchTerm) ||
                    (user.name && user.name.toLowerCase().includes(searchTerm))
                );
                currentPage = 1;
                renderTable();
                updatePagination();
            }, 300); // 300ms debounce
        });

        // Pagination buttons
        document.getElementById('prev-btn').addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
                updatePagination();

                // Smooth scroll to top on mobile
                if (window.innerWidth < 768) {
                    document.querySelector('.bg-white.rounded-lg').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });

        document.getElementById('next-btn').addEventListener('click', function() {
            const totalPages = Math.ceil(filteredUsers.length / usersPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
                updatePagination();

                // Smooth scroll to top on mobile
                if (window.innerWidth < 768) {
                    document.querySelector('.bg-white.rounded-lg').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
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

        // Handle window resize for better responsive behavior
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                renderTable();
                updatePagination();
            }, 150);
        });
    });
    document.addEventListener('click', function(e) {
        if (e.target.closest('.block-user-btn')) {
            const btn = e.target.closest('.block-user-btn');
            const userId = btn.getAttribute('data-id');
            Swal.fire({
                title: 'Blokir user ini?',
                text: 'User yang diblokir tidak akan bisa login!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, blokir!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Check if CSRF token exists
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
                        }).then(res => {
                            console.log('Response status:', res.status);
                            console.log('Response headers:', res.headers);

                            // Cek apakah response berhasil
                            if (!res.ok) {
                                throw new Error(`HTTP error! status: ${res.status}`);
                            }

                            // Clone response untuk debugging
                            const responseClone = res.clone();

                            return res.text().then(text => {
                                console.log('Raw response text:', text);
                                try {
                                    return JSON.parse(text);
                                } catch (e) {
                                    console.error('JSON parse error:', e);
                                    throw new Error('Invalid JSON response');
                                }
                            });
                        })
                        .then(data => {
                            console.log('Parsed response data:', data);
                            console.log('data.success type:', typeof data.success);
                            console.log('data.success value:', data.success);

                            // Check berbagai kemungkinan format response
                            if (data.success === true || data.success === 'true' || data.success === 1 || data.success === '1') {
                                loadUserTable(); // Reload the table
                                Swal.fire('Berhasil!', data.message || 'User berhasil diblokir.', 'success');
                            } else {
                                console.log('Success check failed:', data.success);
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