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

    /* Button styles */
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    /* Form styles */
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
        <h1 class="header-title text-xl sm:text-2xl font-bold text-gray-800">Question</h1>
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
            <button id="add-question-btn" class="btn-primary bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-medium text-sm sm:text-base flex items-center gap-2 whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah
            </button>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <!-- Desktop Table -->
        <div class="hidden lg:block overflow-x-auto table-responsive">
            <table id="question-table" class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="py-3 sm:py-4 px-3 sm:px-6 text-left text-xs sm:text-sm font-semibold text-gray-700">No</th>
                        <th class="py-3 sm:py-4 px-3 sm:px-6 text-left text-xs sm:text-sm font-semibold text-gray-700">Question</th>
                        <th class="py-3 sm:py-4 px-3 sm:px-6 text-center text-xs sm:text-sm font-semibold text-gray-700">ACTION</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <!-- Data akan di-load via AJAX -->
                </tbody>
            </table>
        </div>

        <!-- Mobile/Tablet Card View -->
        <div class="lg:hidden" id="mobile-question-cards">
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

<!-- Add/Edit Modal -->
<div id="question-modal" class="fixed inset-0 modal-backdrop hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 xl:w-2/5 shadow-2xl rounded-lg bg-white">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="flex justify-between items-center pb-4 mb-4 border-b border-gray-200">
                <h3 id="modal-title" class="text-lg font-semibold text-gray-900">Tambah Pertanyaan</h3>
                <button id="close-modal" class="text-gray-400 hover:text-gray-600 transition-colors duration-200 p-1 rounded-full hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <form id="question-form">
                <div class="mb-6">
                    <label for="pertanyaan" class="block text-sm font-medium text-gray-700 mb-2">Pertanyaan <span class="text-red-500">*</span></label>
                    <textarea
                        id="pertanyaan"
                        name="pertanyaan"
                        rows="4"
                        class="form-input block w-full rounded-lg border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 resize-none"
                        placeholder="Masukkan pertanyaan..."
                        required></textarea>
                    <div id="error-message" class="text-red-500 text-sm mt-1 hidden"></div>
                    <div class="text-xs text-gray-500 mt-1">
                        <span id="char-count">0</span>/500 karakter
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
    function loadQuestionTable() {
        fetch('/admin/question/data', {
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
                    const tbody = document.querySelector('#question-table tbody');
                    tbody.innerHTML = '<tr><td colspan="3" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
                }
            })
            .catch(() => {
                const tbody = document.querySelector('#question-table tbody');
                tbody.innerHTML = '<tr><td colspan="3" class="text-center py-8 text-red-400">Gagal memuat data</td></tr>';
            });
    }

    function renderTable() {
        const tbody = document.querySelector('#question-table tbody');
        const mobileContainer = document.querySelector('#mobile-question-cards');
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const dataToShow = filteredData.slice(startIndex, endIndex);

        if (dataToShow.length === 0) {
            tbody.innerHTML = '<tr><td colspan="3" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
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
                        <div class="text-gray-900 text-sm sm:text-base">${item.pertanyaan}</div>
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
                            </div>
                            <div class="text-gray-900 text-sm sm:text-base mb-2">
                                ${item.pertanyaan}
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

    // Modal functions
    function showModal(title = 'Tambah Pertanyaan', data = null) {
        const modal = document.getElementById('question-modal');
        const modalContent = modal.querySelector('.modal-content');
        const modalTitle = document.getElementById('modal-title');
        const form = document.getElementById('question-form');
        const pertanyaanInput = document.getElementById('pertanyaan');
        const submitText = document.getElementById('submit-text');

        modalTitle.textContent = title;
        submitText.textContent = data ? 'Perbarui' : 'Simpan';

        if (data) {
            pertanyaanInput.value = data.pertanyaan;
            isEditMode = true;
            editId = data.id;
        } else {
            form.reset();
            isEditMode = false;
            editId = null;
        }

        updateCharCount();
        clearError();

        // Show modal with animation
        modal.classList.remove('hidden');
        modal.classList.add('modal-show');
        modalContent.classList.add('animate-in');

        // Prevent body scroll
        document.body.style.overflow = 'hidden';

        // Focus on input
        setTimeout(() => pertanyaanInput.focus(), 100);
    }

    function hideModal() {
        const modal = document.getElementById('question-modal');
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

    function updateCharCount() {
        const pertanyaanInput = document.getElementById('pertanyaan');
        const charCount = document.getElementById('char-count');
        const currentLength = pertanyaanInput.value.length;
        charCount.textContent = currentLength;

        if (currentLength > 500) {
            charCount.style.color = '#ef4444';
        } else if (currentLength > 450) {
            charCount.style.color = '#f59e0b';
        } else {
            charCount.style.color = '#6b7280';
        }
    }

    function showError(message) {
        const errorElement = document.getElementById('error-message');
        errorElement.textContent = message;
        errorElement.classList.remove('hidden');
    }

    function clearError() {
        const errorElement = document.getElementById('error-message');
        errorElement.classList.add('hidden');
    }

    function setLoading(isLoading) {
        const submitBtn = document.getElementById('submit-btn');
        const submitText = document.getElementById('submit-text');
        const submitSpinner = document.getElementById('submit-spinner');

        if (isLoading) {
            submitBtn.disabled = true;
            submitText.textContent = 'Menyimpan...';
            submitSpinner.classList.remove('hidden');
        } else {
            submitBtn.disabled = false;
            submitText.textContent = isEditMode ? 'Perbarui' : 'Simpan';
            submitSpinner.classList.add('hidden');
        }
    }

    // CRUD Operations
    function saveQuestion(data) {
        const url = isEditMode ? `/admin/question/${editId}` : '/admin/question';
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
                    loadQuestionTable();
                } else {
                    showError(response.message);
                }
            })
            .catch(error => {
                setLoading(false);
                showError('Terjadi kesalahan sistem');
            });
    }

    function editQuestion(id) {
        fetch(`/admin/question/${id}`)
            .then(res => res.json())
            .then(response => {
                if (response.success) {
                    showModal('Edit Pertanyaan', response.data);
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            })
            .catch(() => {
                Swal.fire('Error', 'Gagal memuat data', 'error');
            });
    }

    function deleteQuestion(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Pertanyaan yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/question/${id}`, {
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
                            loadQuestionTable();
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

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the page
        loadQuestionTable();

        // Search functionality with debounce
        let searchTimeout;
        document.getElementById('search-input').addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                const searchTerm = e.target.value.toLowerCase();
                filteredData = allData.filter(item =>
                    item.pertanyaan.toLowerCase().includes(searchTerm)
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

        // Modal events
        document.getElementById('add-question-btn').addEventListener('click', function() {
            showModal();
        });

        document.getElementById('close-modal').addEventListener('click', function() {
            hideModal();
        });

        document.getElementById('cancel-btn').addEventListener('click', function() {
            hideModal();
        });

        // Close modal when clicking outside
        document.getElementById('question-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('question-modal');
                if (!modal.classList.contains('hidden')) {
                    hideModal();
                }
            }
        });

        // Character count
        document.getElementById('pertanyaan').addEventListener('input', updateCharCount);

        // Form submission
        document.getElementById('question-form').addEventListener('submit', function(e) {
            e.preventDefault();
            clearError();

            const pertanyaan = document.getElementById('pertanyaan').value.trim();

            if (!pertanyaan) {
                showError('Pertanyaan wajib diisi');
                return;
            }

            if (pertanyaan.length < 5) {
                showError('Pertanyaan minimal 5 karakter');
                return;
            }

            if (pertanyaan.length > 500) {
                showError('Pertanyaan maksimal 500 karakter');
                return;
            }

            saveQuestion({
                pertanyaan
            });
        });

        // Action buttons
        document.addEventListener('click', function(e) {
            if (e.target.closest('.edit-btn')) {
                const btn = e.target.closest('.edit-btn');
                const id = btn.getAttribute('data-id');
                editQuestion(id);
            }

            if (e.target.closest('.delete-btn')) {
                const btn = e.target.closest('.delete-btn');
                const id = btn.getAttribute('data-id');
                deleteQuestion(id);
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