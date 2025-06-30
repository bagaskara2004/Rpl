<x-layout_assessor>
    @vite('resources/css/app.css')
    @vite('resources/css/pendaftar-custom.css')

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 -->

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">


    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Pendaftar</h1>
        <div class="bg-white rounded-2xl shadow flex items-center px-2 py-1 mb-6 overflow-x-auto w-full max-w-3xl">
            <div class="flex items-center justify-center w-10 h-10">
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M3 4a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v2a1 1 0 0 1-.293.707l-6.414 6.414A1 1 0 0 0 13 14.414V19a1 1 0 0 1-1.447.894l-2-1A1 1 0 0 1 9 18v-3.586a1 1 0 0 0-.293-.707L2.293 6.707A1 1 0 0 1 2 6V4z" />
                </svg>
            </div>
            <div class="flex-1 grid grid-cols-4 gap-0">
                <div class="flex items-center border-l border-gray-200 px-2 h-10">
                    <span class="text-gray-800 font-medium text-sm">Filter By</span>
                </div>
                <div class="flex items-center border-l border-gray-200 px-2 h-10">
                    <select class="w-full bg-transparent focus:outline-none text-gray-800 font-medium text-sm py-1">
                        <option>Date</option>
                    </select>
                </div>
                <div class="flex items-center border-l border-gray-200 px-2 h-10">
                    <select class="w-full bg-transparent focus:outline-none text-gray-800 font-medium text-sm py-1">
                        <option>Major Type</option>
                    </select>
                </div>
                <div class="flex items-center border-l border-gray-200 px-2 h-10">
                    <select class="w-full bg-transparent focus:outline-none text-gray-800 font-medium text-sm py-1">
                        <option>Status</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center border-l border-gray-200 px-2 h-10">
                <button class="flex items-center text-pink-600 hover:text-pink-700 font-medium text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41" />
                        <path d="M12 8v4l3 3" />
                    </svg>
                    Reset Filter
                </button>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-2 overflow-x-auto">
        <table class="min-w-full text-sm border-separate border-spacing-0 rounded-2xl overflow-hidden" id="pendaftar-table">
            <thead>
                <tr class="bg-gray-50">
                    <th class="py-3 px-4 text-left font-bold text-gray-700 border-b">No</th>
                    <th class="py-3 px-4 text-left font-bold text-gray-700 border-b">NAMA</th>
                    <th class="py-3 px-4 text-left font-bold text-gray-700 border-b">PENDIDIKAN</th>
                    <th class="py-3 px-4 text-center font-bold text-gray-700 border-b">EVALUASI</th>
                    <th class="py-3 px-4 text-center font-bold text-gray-700 border-b">AKSI</th>
                </tr>
            </thead>
            <tbody id="pendaftar-tbody">
                <tr>
                    <td colspan="7" class="text-center py-4">Loading...</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="modal-container"></div>

    <!-- Add missing search input for the filter functionality -->
    <style>
        /* Hide the search input that doesn't have a corresponding element */
        .hidden-search {
            display: none;
        }
    </style>
    <input type="text" id="search-input" class="hidden-search">
    <select id="filter-status" class="hidden-search">
        <option value="">Semua</option>
        <option value="pending">Menunggu</option>
    </select>
    <button id="reset-filter" class="hidden-search">Reset</button>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tbody = document.getElementById('pendaftar-tbody');
            let allPendaftar = [];
            let filteredPendaftar = [];

            // Setup event listeners
            setupEventListeners();

            // Load initial data
            loadPendaftarData();

            function setupEventListeners() {
                // Search functionality
                document.getElementById('search-input').addEventListener('input', filterData);

                // Filter functionality
                document.getElementById('filter-status').addEventListener('change', filterData);

                // Reset filter
                document.getElementById('reset-filter').addEventListener('click', function() {
                    document.getElementById('search-input').value = '';
                    document.getElementById('filter-status').value = '';
                    filterData();
                });
            }

            function loadPendaftarData() {
                tbody.innerHTML = `<tr><td colspan="7" class="px-6 py-12 text-center">
                    <div class="flex items-center justify-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-purple-600"></div>
                        <span class="ml-2 text-gray-500">Memuat data...</span>
                    </div>
                </td></tr>`;

                fetch("{{ route('assesor.pendaftar.data') }}")
                    .then(response => response.json()).then(data => {
                        allPendaftar = data;
                        filteredPendaftar = data;
                        // updateStatistics(); // Remove this since we don't have statistics cards in this view
                        renderTable();
                    })
                    .catch(error => {
                        console.error('Error loading data:', error);
                        tbody.innerHTML = '<tr><td colspan="7" class="px-6 py-12 text-center text-red-500">Error memuat data</td></tr>';
                    });
            }

            function filterData() {
                const searchTerm = document.getElementById('search-input').value.toLowerCase();
                const statusFilter = document.getElementById('filter-status').value;

                filteredPendaftar = allPendaftar.filter(pendaftar => {
                    const matchesSearch = pendaftar.nama_lengkap.toLowerCase().includes(searchTerm) ||
                        (pendaftar.pendidikan?.jurusan || '').toLowerCase().includes(searchTerm);

                    // For now, all are pending since no keputusan exists yet
                    const matchesStatus = statusFilter === '' || statusFilter === 'pending';

                    return matchesSearch && matchesStatus;
                });

                renderTable();
            }

            function renderTable() {
                if (!filteredPendaftar.length) {
                    tbody.innerHTML = '<tr><td colspan="7" class="px-6 py-12 text-center text-gray-500">Tidak ada data pendaftar</td></tr>';
                    return;
                }

                tbody.innerHTML = filteredPendaftar.map((diri, i) => `
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${i + 1}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-r from-purple-400 to-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm">${diri.nama_lengkap.charAt(0).toUpperCase()}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">${diri.nama_lengkap}</div>
                                    <div class="text-sm text-gray-500">${diri.user?.email || diri.email || 'Email tidak tersedia'}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">${diri.pendidikan?.prodi || 'Belum diisi'}</div>
                            <div class="text-sm text-gray-500">${diri.pendidikan?.jurusan || 'Jurusan belum diisi'}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="w-8 h-8 flex items-center justify-center rounded-full bg-green-100 hover:bg-green-200 transition btn-approve" data-userid="${diri.user_id}" title="Setujui">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                                <button class="w-8 h-8 flex items-center justify-center rounded-full bg-red-100 hover:bg-red-200 transition btn-reject" data-userid="${diri.user_id}" title="Tolak">
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-1">
                                <a href="/assesor/datadiri/${diri.id}" class="px-3 py-1 bg-purple-600 text-white rounded-md text-xs font-medium hover:bg-purple-700 transition">Data</a>
                                <a href="/assesor/asesmen/${diri.user_id}" class="px-3 py-1 bg-blue-600 text-white rounded-md text-xs font-medium hover:bg-blue-700 transition">Asesmen</a>
                                <button onclick="loadTransferNilai(${diri.user_id})" class="px-3 py-1 bg-green-600 text-white rounded-md text-xs font-medium hover:bg-green-700 transition">Transfer</button>
                            </div>
                        </td>
                    </tr>
                `).join('');
            }

            function formatDate(dateString) {
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                });
            }

            // Function untuk Transfer Nilai tetap menggunakan AJAX
            window.loadTransferNilai = function(id) {
                const mainContent = document.querySelector('#main-content main');
                if (!mainContent) return;

                mainContent.innerHTML = `<div class="flex items-center justify-center min-h-64">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-purple-600"></div>
                    <span class="ml-3 text-gray-500">Memuat halaman transfer nilai...</span>
                </div>`;

                fetch(`/assesor/transfer-nilai/${id}?ajax=1`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        mainContent.innerHTML = html;
                        history.pushState({
                            transferId: id
                        }, '', `/assesor/transfer-nilai/${id}`);
                    })
                    .catch(error => {
                        console.error('Error loading transfer nilai:', error);
                        mainContent.innerHTML = '<div class="text-center text-red-500 py-8">Error memuat halaman transfer nilai</div>';
                    });
            }

            window.addEventListener('popstate', function(event) {
                const path = window.location.pathname;
                const match = path.match(/\/assesor\/transfer-nilai\/(\d+)/);
                const mainContent = document.querySelector('#main-content main');
                if (match && mainContent) {
                    mainContent.innerHTML = `<div class="flex items-center justify-center min-h-64">
                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-purple-600"></div>
                        <span class="ml-3 text-gray-500">Memuat halaman transfer nilai...</span>
                    </div>`;
                    fetch(`/assesor/transfer-nilai/${match[1]}?ajax=1`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.text())
                        .then(html => {
                            mainContent.innerHTML = html;
                        });
                } else if (mainContent) {
                    window.location.reload();
                }
            });

            // Event delegation untuk tombol evaluasi
            document.addEventListener('click', function(e) {
                // Approve (centang)
                if (e.target.closest('.btn-approve')) {
                    const btn = e.target.closest('.btn-approve');
                    const userId = btn.dataset.userid;
                    Swal.fire({
                        title: 'Setujui Pendaftar?',
                        text: 'Apakah Anda yakin ingin menyetujui pendaftar ini?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Setujui',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#10B981',
                        cancelButtonColor: '#6B7280'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch('/assesor/keputusan', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                        'X-Requested-With': 'XMLHttpRequest'
                                    },
                                    body: JSON.stringify({
                                        user_id: userId,
                                        status: 1,
                                        catatan: null
                                    })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: 'Pendaftar berhasil disetujui.',
                                        icon: 'success',
                                        confirmButtonColor: '#10B981'
                                    }).then(() => window.location.reload());
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Terjadi kesalahan saat menyetujui pendaftar.',
                                        icon: 'error',
                                        confirmButtonColor: '#EF4444'
                                    });
                                });
                        }
                    });
                }

                // Reject (silang)
                if (e.target.closest('.btn-reject')) {
                    const btn = e.target.closest('.btn-reject');
                    const userId = btn.dataset.userid;
                    Swal.fire({
                        title: 'Tolak Pendaftar',
                        input: 'textarea',
                        inputLabel: 'Catatan Penolakan',
                        inputPlaceholder: 'Masukkan alasan penolakan...',
                        inputAttributes: {
                            'aria-label': 'Masukkan alasan penolakan'
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Tolak',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#EF4444',
                        cancelButtonColor: '#6B7280',
                        inputValidator: (value) => {
                            if (!value) {
                                return 'Catatan wajib diisi!';
                            }
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch('/assesor/keputusan', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                        'X-Requested-With': 'XMLHttpRequest'
                                    },
                                    body: JSON.stringify({
                                        user_id: userId,
                                        status: 0,
                                        catatan: result.value
                                    })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: 'Pendaftar berhasil ditolak.',
                                        icon: 'success',
                                        confirmButtonColor: '#10B981'
                                    }).then(() => window.location.reload());
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Terjadi kesalahan saat menolak pendaftar.',
                                        icon: 'error',
                                        confirmButtonColor: '#EF4444'
                                    });
                                });
                        }
                    });
                }
            });
        });
    </script>
</x-layout_assessor>