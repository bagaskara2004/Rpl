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

    /* Profile image styles */
    .profile-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    /* Status badge styles */
    .status-success {
        background-color: #10b981;
        color: white;
    }

    .status-danger {
        background-color: #ef4444;
        color: white;
    }
</style>

<div class="container-mobile p-3 sm:p-4 md:p-6 lg:p-8">
    <!-- Header dengan Search -->
    <div class="header-mobile flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 gap-4">
        <h1 class="header-title text-xl sm:text-2xl font-bold text-gray-800">Keputusan RPL</h1>
        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
            <div class="mobile-search flex items-center bg-white border border-gray-300 rounded-lg px-3 sm:px-4 py-2 w-full sm:w-80">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400 mr-2 sm:mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input
                    type="text"
                    id="search-input"
                    placeholder="Cari mahasiswa, asesor, atau status..."
                    class="w-full outline-none text-gray-700 placeholder-gray-400 text-sm sm:text-base search-input">
            </div>
        </div>
    </div>

    <!-- Tabel Desktop -->
    <div class="hidden md:block bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="table-responsive">
            <table id="keputusan-table" class="w-full table-auto">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider w-16">No</th>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider">Mahasiswa</th>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider">Program Studi</th>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider">Asesor</th>
                        <th class="text-center py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="text-center py-3 sm:py-4 px-3 sm:px-6 text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
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
    <div id="mobile-keputusan-cards" class="md:hidden space-y-4">
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

<!-- Detail Modal -->
<div id="detail-modal" class="fixed inset-0 modal-backdrop hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 shadow-2xl rounded-lg bg-white">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="flex justify-between items-center pb-4 mb-4 border-b border-gray-200">
                <h3 id="modal-title" class="text-lg font-semibold text-gray-900">Detail Keputusan</h3>
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

                <!-- Decision Info -->
                <div id="decision-info" class="mb-6 p-4 border rounded-lg">
                    <!-- Decision info akan dimuat melalui JavaScript -->
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

<!-- Edit Modal -->
<div id="edit-modal" class="fixed inset-0 modal-backdrop hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-2xl rounded-lg bg-white">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="flex justify-between items-center pb-4 mb-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Edit Keputusan</h3>
                <button id="close-edit-modal" class="text-gray-400 hover:text-gray-600 transition-colors duration-200 p-1 rounded-full hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Edit Form -->
            <form id="edit-form">
                <input type="hidden" id="edit-keputusan-id">

                <!-- Student Info (Read Only) -->
                <div id="edit-student-info" class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <!-- Student info akan dimuat melalui JavaScript -->
                </div>

                <!-- Decision Form -->
                <div class="space-y-4">
                    <div>
                        <label for="edit-status" class="block text-sm font-medium text-gray-700 mb-2">Status Keputusan</label>
                        <select id="edit-status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="1">Diterima</option>
                            <option value="0">Ditolak</option>
                        </select>
                    </div>

                    <div>
                        <label for="edit-catatan" class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                        <textarea id="edit-catatan" name="catatan" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan catatan keputusan..."></textarea>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" id="cancel-edit-btn" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Simpan Perubahan
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
    const itemsPerPage = 10;

    // Load data
    function loadKeputusanTable() {
        fetch('/admin/keputusan/data', {
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
                    const tbody = document.querySelector('#keputusan-table tbody');
                    tbody.innerHTML = '<tr><td colspan="7" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                const tbody = document.querySelector('#keputusan-table tbody');
                tbody.innerHTML = '<tr><td colspan="7" class="text-center py-8 text-red-400">Gagal memuat data</td></tr>';
            });
    }

    function renderTable() {
        const tbody = document.querySelector('#keputusan-table tbody');
        const mobileContainer = document.querySelector('#mobile-keputusan-cards');
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
            const photoUrl = item.foto ? `/storage/${item.foto}` : 'https://via.placeholder.com/40x40?text=U';

            tbody.innerHTML += `
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <span class="text-sm font-medium text-gray-900">${globalIndex}</span>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <div class="flex items-center space-x-3">
                            <img class="profile-img" src="${photoUrl}" alt="Profile" onerror="this.src='https://via.placeholder.com/40x40?text=U'">
                            <div>
                                <div class="text-gray-900 text-sm sm:text-base font-medium">${item.mahasiswa_name}</div>
                                <div class="text-gray-500 text-xs">${item.email}</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <div class="text-gray-700 text-sm">${item.jurusan}</div>
                        <div class="text-gray-500 text-xs">${item.prodi}</div>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6">
                        <div class="text-gray-700 text-sm">${item.asesor_name}</div>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium status-${item.status_class}">
                            ${item.status_text}
                        </span>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6 text-center">
                        <div class="text-gray-700 text-sm">${item.created_at}</div>
                    </td>
                    <td class="py-3 sm:py-4 px-3 sm:px-6 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <button class="inline-flex items-center justify-center w-8 h-8 rounded-full border border-blue-300 text-blue-500 hover:bg-blue-50 transition-colors duration-200 detail-btn" 
                                    data-id="${item.id}" 
                                    title="Lihat Detail">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button class="inline-flex items-center justify-center w-8 h-8 rounded-full border border-green-300 text-green-500 hover:bg-green-50 transition-colors duration-200 edit-btn" 
                                    data-id="${item.id}" 
                                    title="Edit Keputusan">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
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
            const photoUrl = item.foto ? `/storage/${item.foto}` : 'https://via.placeholder.com/40x40?text=U';

            mobileContainer.innerHTML += `
                <div class="mobile-card p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <div class="flex items-start justify-between space-x-4">
                        <div class="flex items-start space-x-3 flex-1 min-w-0">
                            <img class="profile-img" src="${photoUrl}" alt="Profile" onerror="this.src='https://via.placeholder.com/40x40?text=U'">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="text-xs text-gray-500 font-medium">#${globalIndex}</span>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium status-${item.status_class}">
                                        ${item.status_text}
                                    </span>
                                </div>
                                <div class="text-gray-900 text-sm sm:text-base font-medium mb-1">
                                    ${item.mahasiswa_name}
                                </div>
                                <div class="text-gray-600 text-xs mb-1">
                                    <strong>Email:</strong> ${item.email}
                                </div>
                                <div class="text-gray-600 text-xs mb-1">
                                    <strong>Program Studi:</strong> ${item.prodi}
                                </div>
                                <div class="text-gray-600 text-xs mb-1">
                                    <strong>Asesor:</strong> ${item.asesor_name}
                                </div>
                                <div class="text-gray-500 text-xs">
                                    ${item.created_at}
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0 flex space-x-2">
                            <button class="inline-flex items-center justify-center w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-blue-300 text-blue-500 hover:bg-blue-50 transition-colors duration-200 detail-btn" 
                                    data-id="${item.id}" 
                                    title="Lihat Detail">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button class="inline-flex items-center justify-center w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-green-300 text-green-500 hover:bg-green-50 transition-colors duration-200 edit-btn" 
                                    data-id="${item.id}" 
                                    title="Edit Keputusan">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
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
            item.mahasiswa_name.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.email.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.asesor_name.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.status_text.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.jurusan.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.prodi.toLowerCase().includes(searchTerm.toLowerCase())
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
    function showDetailModal(keputusanId) {
        const modal = document.getElementById('detail-modal');
        const loading = document.getElementById('modal-loading');
        const content = document.getElementById('modal-content');

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        loading.classList.remove('hidden');
        content.classList.add('hidden');

        // Load detail
        fetch(`/admin/keputusan/${keputusanId}`)
            .then(res => res.json())
            .then(response => {
                loading.classList.add('hidden');
                if (response.success) {
                    renderDetailModal(response.data);
                    content.classList.remove('hidden');
                } else {
                    hideDetailModal();
                    alert('Gagal memuat detail keputusan');
                }
            })
            .catch(() => {
                loading.classList.add('hidden');
                hideDetailModal();
                alert('Terjadi kesalahan saat memuat data');
            });
    }

    function renderDetailModal(data) {
        // Render student info
        const photoUrl = data.foto ? `/storage/${data.foto}` : 'https://via.placeholder.com/100x100?text=U';
        const studentInfo = document.getElementById('student-info');
        studentInfo.innerHTML = `
            <div class="flex items-start space-x-4">
                <img class="w-20 h-20 rounded-full object-cover" src="${photoUrl}" alt="Profile" onerror="this.src='https://via.placeholder.com/100x100?text=U'">
                <div class="flex-1">
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Informasi Mahasiswa</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Nama Lengkap</p>
                            <p class="font-semibold text-gray-900">${data.nama_lengkap || data.mahasiswa_name}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            <p class="font-semibold text-gray-900">${data.email || '-'}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Jurusan Asal</p>
                            <p class="font-semibold text-gray-900">${data.jurusan || 'Belum Diisi'}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Program Studi Tujuan</p>
                            <p class="font-semibold text-gray-900">${data.prodi || 'Belum Diisi'}</p>
                        </div>
                        ${data.nama_perguruan ? `
                        <div>
                            <p class="text-sm text-gray-600">Perguruan Tinggi</p>
                            <p class="font-semibold text-gray-900">${data.nama_perguruan}</p>
                        </div>
                        ` : ''}
                        ${data.ipk ? `
                        <div>
                            <p class="text-sm text-gray-600">IPK</p>
                            <p class="font-semibold text-gray-900">${data.ipk}</p>
                        </div>
                        ` : ''}
                    </div>
                </div>
            </div>
        `;

        // Render decision info
        const statusClass = data.status ? 'success' : 'danger';
        const statusText = data.status ? 'Diterima' : 'Ditolak';
        const decisionInfo = document.getElementById('decision-info');
        decisionInfo.innerHTML = `
            <h4 class="text-lg font-semibold text-gray-900 mb-4">Informasi Keputusan</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Asesor</p>
                    <p class="font-semibold text-gray-900">${data.asesor_name}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Status Keputusan</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium status-${statusClass}">
                        ${statusText}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Tanggal Keputusan</p>
                    <p class="font-semibold text-gray-900">${new Date(data.created_at).toLocaleDateString('id-ID')}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-600">Catatan</p>
                    <p class="font-semibold text-gray-900">${data.catatan || 'Tidak ada catatan'}</p>
                </div>
            </div>
        `;
    }

    function hideDetailModal() {
        document.getElementById('detail-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Edit Modal Functions
    function showEditModal(keputusanId) {
        const modal = document.getElementById('edit-modal');

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        // Load detail untuk mengisi form
        fetch(`/admin/keputusan/${keputusanId}`)
            .then(res => res.json())
            .then(response => {
                if (response.success) {
                    fillEditForm(response.data);
                } else {
                    hideEditModal();
                    alert('Gagal memuat detail keputusan');
                }
            })
            .catch(() => {
                hideEditModal();
                alert('Terjadi kesalahan saat memuat data');
            });
    }

    function fillEditForm(data) {
        // Isi hidden ID
        document.getElementById('edit-keputusan-id').value = data.id;

        // Isi info mahasiswa (read-only)
        const photoUrl = data.foto ? `/storage/${data.foto}` : 'https://via.placeholder.com/80x80?text=U';
        const studentInfo = document.getElementById('edit-student-info');
        studentInfo.innerHTML = `
            <div class="flex items-center space-x-4">
                <img class="w-16 h-16 rounded-full object-cover" src="${photoUrl}" alt="Profile" onerror="this.src='https://via.placeholder.com/80x80?text=U'">
                <div>
                    <h5 class="text-lg font-semibold text-gray-900">${data.nama_lengkap || data.mahasiswa_name}</h5>
                    <p class="text-sm text-gray-600">${data.email || '-'}</p>
                    <p class="text-sm text-gray-600">${data.prodi || 'Belum Diisi'}</p>
                </div>
            </div>
        `;

        // Isi form
        document.getElementById('edit-status').value = data.status ? '1' : '0';
        document.getElementById('edit-catatan').value = data.catatan || '';
    }

    function hideEditModal() {
        document.getElementById('edit-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';

        // Reset form
        document.getElementById('edit-form').reset();
        document.getElementById('edit-keputusan-id').value = '';
        document.getElementById('edit-student-info').innerHTML = '';
    }

    function submitEditForm(event) {
        event.preventDefault();

        const keputusanId = document.getElementById('edit-keputusan-id').value;
        const status = document.getElementById('edit-status').value;
        const catatan = document.getElementById('edit-catatan').value;

        // Get CSRF token
        const token = document.querySelector('meta[name="csrf-token"]');
        if (!token) {
            alert('CSRF token not found');
            return;
        }

        // Disable submit button to prevent double submission
        const submitBtn = event.target.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Menyimpan...';

        fetch(`/admin/keputusan/${keputusanId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token.getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    status: parseInt(status),
                    catatan: catatan
                })
            })
            .then(res => res.json())
            .then(response => {
                if (response.success) {
                    hideEditModal();
                    loadKeputusanTable(); // Reload data
                    alert('Keputusan berhasil diperbarui');
                } else {
                    alert(response.message || 'Gagal memperbarui keputusan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memperbarui keputusan');
            })
            .finally(() => {
                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            });
    }

    // Event Listeners
    document.addEventListener('DOMContentLoaded', function() {
        loadKeputusanTable();

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

        // Edit modal close buttons
        document.getElementById('close-edit-modal').addEventListener('click', hideEditModal);
        document.getElementById('cancel-edit-btn').addEventListener('click', hideEditModal);

        // Edit form submit
        document.getElementById('edit-form').addEventListener('submit', submitEditForm);

        // Modal backdrop click for detail modal
        document.getElementById('detail-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideDetailModal();
            }
        });

        // Modal backdrop click for edit modal
        document.getElementById('edit-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideEditModal();
            }
        });

        // Event delegation for detail and edit buttons
        document.addEventListener('click', function(e) {
            if (e.target.closest('.detail-btn')) {
                const keputusanId = e.target.closest('.detail-btn').getAttribute('data-id');
                showDetailModal(keputusanId);
            }

            if (e.target.closest('.edit-btn')) {
                const keputusanId = e.target.closest('.edit-btn').getAttribute('data-id');
                showEditModal(keputusanId);
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