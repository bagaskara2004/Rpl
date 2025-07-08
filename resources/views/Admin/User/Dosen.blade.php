@extends('components.layout_admin')

@section('content')
<div class="p-6">
    <!-- Header dengan Search dan Add Button -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Daftar Dosen</h1>
        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
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
            <button data-modal-target="add-dosen-modal" data-modal-toggle="add-dosen-modal" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2 whitespace-nowrap" type="button">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Dosen
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table id="dosen-table" class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Image</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">nama</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Email</th>
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

<!-- Modal Add Dosen -->
<div id="add-dosen-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    Tambah Dosen Baru
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="add-dosen-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form id="add-dosen-form" class="space-y-4" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="user_name" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                        <input type="text" id="user_name" name="user_name" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan username">
                        <span class="text-red-500 text-sm hidden" id="error-user_name"></span>
                    </div>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input type="email" id="email" name="email" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@company.com">
                        <span class="text-red-500 text-sm hidden" id="error-email"></span>
                    </div>

                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input type="password" id="password" name="password" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="••••••••">
                        <span class="text-red-500 text-sm hidden" id="error-password"></span>
                    </div>

                    <!-- Hidden field untuk role default sebagai Dosen -->
                    <input type="hidden" name="role_id" value="4">

                    <div class="flex justify-end space-x-3">
                        <button data-modal-hide="add-dosen-modal" type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                            Batal
                        </button>
                        <button type="submit" id="submit-btn" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <svg id="loading-spinner" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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
    let allDosens = [];
    let filteredDosens = [];
    const dosensPerPage = 9;

    // Global functions
    function loadDosenTable() {
        fetch('/admin/dosen/data', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (Array.isArray(data)) {
                    allDosens = data;
                    filteredDosens = [...allDosens];
                    renderTable();
                    updatePagination();
                } else {
                    const tbody = document.querySelector('#dosen-table tbody');
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
                }
            })
            .catch(() => {
                const tbody = document.querySelector('#dosen-table tbody');
                tbody.innerHTML = '<tr><td colspan="5" class="text-center py-8 text-red-400">Gagal memuat data</td></tr>';
            });
    }

    function renderTable() {
        const tbody = document.querySelector('#dosen-table tbody');
        const startIndex = (currentPage - 1) * dosensPerPage;
        const endIndex = startIndex + dosensPerPage;
        const dosensToShow = filteredDosens.slice(startIndex, endIndex);

        if (dosensToShow.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
            return;
        }

        tbody.innerHTML = '';
        dosensToShow.forEach(dosen => {
            tbody.innerHTML += `
                <tr class="hover:bg-gray-50">
                    <td class="py-4 px-6">
                        <img src="${dosen.foto ?? '/assets/User.svg'}" 
                             alt="Foto" 
                             class="w-12 h-12 rounded-full object-cover border-2 border-gray-200">
                    </td>
                    <td class="py-4 px-6">
                        <div class="font-medium text-gray-900">${dosen.name || dosen.email.split('@')[0]}</div>
                    </td>
                    <td class="py-4 px-6">
                        <div class="text-gray-700">${dosen.email}</div>
                    </td>
                    <td class="py-4 px-6">
                        <span class="text-gray-600 text-sm">${formatTanggal(dosen.created_at)}</span>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <button class="inline-flex items-center justify-center w-8 h-8 rounded-full border border-red-300 text-red-500 hover:bg-red-50 transition-colors duration-200 block-dosen-btn" 
                                data-id="${dosen.id}" 
                                title="Blokir Dosen">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0,0,255.99538,255.99538">
<g fill="#ff0000" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M25,3c-5.815,0 -9.66252,3.586 -9.97852,9.25c-0.014,0.246 -0.02148,0.496 -0.02148,0.75c-0.002,1.647 0.40547,3.2988 0.85547,4.7168c-0.432,0.514 -0.85047,1.29534 -0.85547,2.27734c0,0.105 0.00358,0.34591 0.01758,0.50391c0.274,2.107 1.22841,3.11253 2.06641,3.51953c0.277,1.898 0.96502,3.48955 1.91602,4.43555v3.77539c-0.578,1.386 -2.5892,2.18728 -4.9082,3.11328c-3.901,1.558 -8.75684,3.49552 -9.08984,9.60352l-0.00195,1.05469h24.62305c-0.368,-0.633 -0.67583,-1.301 -0.92383,-2h-21.57813c0.731,-4.013 4.27394,-5.42878 7.71094,-6.80078c2.736,-1.093 5.32223,-2.1237 6.11523,-4.4707l0.05273,-0.15625v-5.07227l-0.40039,-0.30078c-0.661,-0.495 -1.41252,-1.93802 -1.60352,-4.04102l-0.05273,-0.90625h-0.91211c-0.204,-0.036 -0.83139,-0.48284 -1.02539,-1.96484c-0.005,-0.069 -0.00586,-0.21725 -0.00586,-0.28125c0.004,-0.756 0.56727,-1.18155 0.57227,-1.18555l0.61328,-0.42969l-0.23828,-0.70898c-0.675,-2.012 -0.94927,-3.35848 -0.94727,-4.64648c0.005,-4.956 3.071,-8.03516 8,-8.03516c1.977,0 3.11428,0.83959 3.48828,1.55859l0.24414,0.46875l0.52539,0.0625c3.065,0.362 3.72719,3.08183 3.74219,5.29883c0.015,2.155 -0.64008,4.29136 -0.95508,5.31836l-0.17187,0.77148l0.65625,0.4043c0.092,0.058 0.46666,0.438 0.47266,1.125c0,0.064 -0.00281,0.21139 -0.00781,0.27539c-0.14,1.61 -0.81819,1.96275 -0.99219,1.96875h-0.87305l-0.11914,0.86328c-0.322,2.363 -1.04237,3.66094 -1.60937,4.08594l-0.40039,0.29883v5.05859l0.06445,0.17188c0.159,0.417 0.38844,0.78205 0.64844,1.12305c0.376,-0.627 0.80611,-1.21767 1.28711,-1.76367v-3.64062c1.107,-1.121 1.63577,-3.00177 1.88477,-4.38477c0.908,-0.378 1.90956,-1.39428 2.10156,-3.61328c0.009,-0.111 0.01367,-0.35098 0.01367,-0.45898c-0.007,-0.981 -0.38347,-1.79117 -0.85547,-2.32617c0.366,-1.245 0.86947,-3.22497 0.85547,-5.29297c-0.027,-4.009 -1.84758,-6.60131 -5.01758,-7.19531c-0.962,-1.355 -2.81542,-2.17773 -4.98242,-2.17773zM40,30c-5.511,0 -10,4.489 -10,10c0,5.511 4.489,10 10,10c5.511,0 10,-4.489 10,-10c0,-5.511 -4.489,-10 -10,-10zM40,32c4.43012,0 8,3.56988 8,8c0,4.43012 -3.56988,8 -8,8c-4.43012,0 -8,-3.56988 -8,-8c0,-4.43012 3.56988,-8 8,-8zM36.49023,35.49023c-0.40692,0.00011 -0.77321,0.24676 -0.92633,0.62377c-0.15312,0.37701 -0.06255,0.80921 0.22907,1.09303l2.79297,2.79297l-2.79297,2.79297c-0.26124,0.25082 -0.36648,0.62327 -0.27512,0.97371c0.09136,0.35044 0.36503,0.62411 0.71547,0.71547c0.35044,0.09136 0.72289,-0.01388 0.97371,-0.27512l2.79297,-2.79297l2.79297,2.79297c0.25082,0.26124 0.62327,0.36648 0.97371,0.27512c0.35044,-0.09136 0.62411,-0.36503 0.71547,-0.71547c0.09136,-0.35044 -0.01388,-0.72289 -0.27512,-0.97371l-2.79297,-2.79297l2.79297,-2.79297c0.29576,-0.28749 0.38469,-0.72707 0.22393,-1.10691c-0.16075,-0.37985 -0.53821,-0.62204 -0.9505,-0.60988c-0.2598,0.00774 -0.50638,0.11632 -0.6875,0.30273l-2.79297,2.79297l-2.79297,-2.79297c-0.18827,-0.19353 -0.4468,-0.30272 -0.7168,-0.30273z"></path></g></g>
</svg>
                        </button>
                    </td>
                </tr>
            `;
        });
    }

    function updatePagination() {
        const totalItems = filteredDosens.length;
        const totalPages = Math.ceil(totalItems / dosensPerPage);
        const startItem = totalItems === 0 ? 0 : ((currentPage - 1) * dosensPerPage) + 1;
        const endItem = Math.min(currentPage * dosensPerPage, totalItems);

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

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the page
        loadDosenTable();

        // Modal and form elements
        const form = document.getElementById('add-dosen-form');

        // Listen for button clicks that open the modal to reset form
        document.querySelector('[data-modal-toggle="add-dosen-modal"]').addEventListener('click', function() {
            // Small delay to ensure modal is ready
            setTimeout(() => {
                form.reset();
                clearErrors();
            }, 100);
        });

        // Listen for modal hide buttons to reset form
        document.querySelectorAll('[data-modal-hide="add-dosen-modal"]').forEach(button => {
            button.addEventListener('click', function() {
                setTimeout(() => {
                    form.reset();
                    clearErrors();
                }, 100);
            });
        });

        // Form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            submitForm();
        });

        // Search functionality
        document.getElementById('search-input').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            filteredDosens = allDosens.filter(dosen =>
                dosen.email.toLowerCase().includes(searchTerm) ||
                (dosen.name && dosen.name.toLowerCase().includes(searchTerm))
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
            const totalPages = Math.ceil(filteredDosens.length / dosensPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
                updatePagination();
            }
        });
    });

    function submitForm() {
        const submitBtn = document.getElementById('submit-btn');
        const submitText = document.getElementById('submit-text');
        const loadingSpinner = document.getElementById('loading-spinner');

        // Show loading state
        submitBtn.disabled = true;
        submitText.textContent = 'Menyimpan...';
        loadingSpinner.classList.remove('hidden');

        // Clear previous errors
        clearErrors();

        const formData = new FormData(document.getElementById('add-dosen-form'));

        fetch('/admin/dosen', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Berhasil!', data.message, 'success');

                    // Hide modal by triggering the hide button
                    const hideButton = document.querySelector('[data-modal-hide="add-dosen-modal"]');
                    if (hideButton) {
                        hideButton.click();
                    }

                    document.getElementById('add-dosen-form').reset();
                    clearErrors();
                    loadDosenTable(); // Reload table
                } else {
                    if (data.message.includes('Data tidak valid:')) {
                        // Handle validation errors
                        const errors = data.message.replace('Data tidak valid: ', '').split(', ');
                        errors.forEach(error => {
                            if (error.includes('user_name')) {
                                showError('user_name', 'Username sudah digunakan');
                            } else if (error.includes('email')) {
                                showError('email', 'Email sudah digunakan');
                            } else if (error.includes('password')) {
                                showError('password', 'Password minimal 8 karakter');
                            }
                        });
                    } else {
                        Swal.fire('Gagal!', data.message, 'error');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Gagal!', 'Terjadi kesalahan pada server', 'error');
            })
            .finally(() => {
                // Reset loading state
                submitBtn.disabled = false;
                submitText.textContent = 'Simpan';
                loadingSpinner.classList.add('hidden');
            });
    }

    function showError(field, message) {
        const errorElement = document.getElementById(`error-${field}`);
        const inputElement = document.getElementById(field);

        if (errorElement && inputElement) {
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
            inputElement.classList.remove('border-gray-300', 'focus:border-blue-500');
            inputElement.classList.add('border-red-500', 'focus:border-red-500');
        }
    }

    function clearErrors() {
        const errorElements = document.querySelectorAll('[id^="error-"]');
        const inputElements = document.querySelectorAll('input, select');

        errorElements.forEach(element => {
            element.classList.add('hidden');
            element.textContent = '';
        });

        inputElements.forEach(element => {
            element.classList.remove('border-red-500', 'focus:border-red-500');
            element.classList.add('border-gray-300', 'focus:border-blue-500');
        });
    }
    document.addEventListener('click', function(e) {
        if (e.target.closest('.block-dosen-btn')) {
            const btn = e.target.closest('.block-dosen-btn');
            const dosenId = btn.getAttribute('data-id');
            Swal.fire({
                title: 'Blokir dosen ini?',
                text: 'Dosen yang diblokir tidak akan bisa login!',
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

                    fetch('/admin/dosen/block', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                id: dosenId
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
                                loadDosenTable(); // Reload the table
                                Swal.fire('Berhasil!', data.message || 'Dosen berhasil diblokir.', 'success');
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