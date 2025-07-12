<x-layout_assessor>
    @vite('resources/css/app.css')
    @vite('resources/css/pendaftar-custom.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 -->

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">


    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Pendaftar Siap Evaluasi</h1>
        <p class="text-gray-600">Daftar pendaftar yang telah menyelesaikan data diri, assessment, dan transkrip nilai</p>
    </div>

    <div class="bg-white rounded-2xl shadow-xl p-6 overflow-hidden">
        <div class="table-container">
            <table class="min-w-full text-sm border-separate border-spacing-0 rounded-2xl overflow-hidden" id="pendaftar-table">
                <thead>
                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <th class="py-4 px-6 text-left font-bold text-gray-700 border-b-2 border-gray-200 rounded-tl-lg">No</th>
                        <th class="py-4 px-6 text-left font-bold text-gray-700 border-b-2 border-gray-200">NAMA</th>
                        <th class="py-4 px-6 text-left font-bold text-gray-700 border-b-2 border-gray-200">PENDIDIKAN</th>
                        <th class="py-4 px-6 text-center font-bold text-gray-700 border-b-2 border-gray-200">EVALUASI</th>
                        <th class="py-4 px-6 text-center font-bold text-gray-700 border-b-2 border-gray-200 rounded-tr-lg">AKSI</th>
                    </tr>
                </thead>
                <tbody id="pendaftar-tbody">
                    <tr>
                        <td colspan="5" class="text-center py-8">
                            <div class="flex items-center justify-center">
                                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-purple-600"></div>
                                <span class="ml-2 text-gray-500">Loading...</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="modal-container"></div>

    <!-- Add missing search input for the filter functionality -->
    <style>
        /* Hide the search input that doesn't have a corresponding element */
        .hidden-search {
            display: none;
        }

        /* Custom button animations */
        .btn-hover-effect {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-hover-effect:hover {
            transform: translateY(-2px);
        }

        /* Custom gradient backgrounds */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        }

        .bg-gradient-danger {
            background: linear-gradient(135deg, #f87171 0%, #ef4444 100%);
        }

        .bg-gradient-info {
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
        }

        /* Table hover effects */
        .table-row-hover:hover {
            transform: translateY(-1px);
            transition: all 0.2s ease-in-out;
        }

        /* Status badge pulse animation */
        .status-badge {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.8;
            }
        }

        /* Modern button styles */
        .modern-btn {
            position: relative;
            overflow: hidden;
        }

        .modern-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .modern-btn:hover::before {
            left: 100%;
        }

        /* Pastikan elemen tetap berada dalam viewport */
        body {
            overflow-x: hidden;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .table-container {
            overflow-x: auto;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: left;
            padding: 0.5rem;
        }

        @media (max-width: 768px) {
            .grid {
                display: block;
            }

            .grid>div {
                margin-bottom: 1rem;
            }

            .table-container {
                overflow-x: auto;
            }
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
                tbody.innerHTML = `<tr><td colspan="5" class="px-6 py-16 text-center">
                    <div class="flex flex-col items-center justify-center space-y-4">
                        <div class="relative">
                            <div class="animate-spin rounded-full h-12 w-12 border-4 border-purple-200"></div>
                            <div class="animate-spin rounded-full h-12 w-12 border-4 border-purple-600 border-t-transparent absolute top-0 left-0"></div>
                        </div>
                        <div class="text-center">
                            <p class="text-lg font-medium text-gray-700">Memuat data pendaftar siap evaluasi...</p>
                            <p class="text-sm text-gray-500">Mohon tunggu sebentar</p>
                        </div>
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
                        tbody.innerHTML = `<tr><td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center space-y-4">
                                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="text-center">
                                    <p class="text-lg font-medium text-red-600">Gagal memuat data</p>
                                    <p class="text-sm text-gray-500">Terjadi kesalahan saat mengambil data pendaftar</p>
                                    <button onclick="loadPendaftarData()" class="mt-3 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                                        Coba Lagi
                                    </button>
                                </div>
                            </div>
                        </td></tr>`;
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

            // Function untuk menentukan warna badge berdasarkan status
            // Status yang didukung: proses (biru), sukses (hijau), pending (kuning), gagal (merah)
            function getStatusBadgeColor(status) {
                switch (status) {
                    case 'proses':
                        return 'bg-blue-100 text-blue-800';
                    case 'sukses':
                        return 'bg-green-100 text-green-800';
                    case 'pending':
                        return 'bg-yellow-100 text-yellow-800';
                    case 'gagal':
                        return 'bg-red-100 text-red-800';
                    default:
                        return 'bg-gray-100 text-gray-800';
                }
            }

            // Function untuk menentukan warna tombol berdasarkan status
            // Status yang didukung: proses (biru), sukses (hijau), pending (kuning), gagal (merah)
            function getStatusColor(status) {
                switch (status) {
                    case 'proses':
                        return {
                            bg: 'bg-blue-600',
                                hover: 'hover:bg-blue-700',
                                text: 'text-white',
                                shadow: 'shadow-lg shadow-blue-500/25',
                                ring: 'focus:ring-2 focus:ring-blue-500 focus:ring-offset-2'
                        };
                    case 'sukses':
                        return {
                            bg: 'bg-green-600',
                                hover: 'hover:bg-green-700',
                                text: 'text-white',
                                shadow: 'shadow-lg shadow-green-500/25',
                                ring: 'focus:ring-2 focus:ring-green-500 focus:ring-offset-2'
                        };
                    case 'pending':
                        return {
                            bg: 'bg-yellow-500',
                                hover: 'hover:bg-yellow-600',
                                text: 'text-white',
                                shadow: 'shadow-lg shadow-yellow-500/25',
                                ring: 'focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2'
                        };
                    case 'gagal':
                        return {
                            bg: 'bg-red-600',
                                hover: 'hover:bg-red-700',
                                text: 'text-white',
                                shadow: 'shadow-lg shadow-red-500/25',
                                ring: 'focus:ring-2 focus:ring-red-500 focus:ring-offset-2'
                        };
                    default:
                        return {
                            bg: 'bg-gray-600',
                                hover: 'hover:bg-gray-700',
                                text: 'text-white',
                                shadow: 'shadow-lg shadow-gray-500/25',
                                ring: 'focus:ring-2 focus:ring-gray-500 focus:ring-offset-2'
                        };
                }
            }

            function renderTable() {
                if (!filteredPendaftar.length) {
                    tbody.innerHTML = `<tr><td colspan="5" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center justify-center space-y-4">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                            </div>
                            <div class="text-center">
                                <p class="text-lg font-medium text-gray-700">Tidak ada pendaftar yang siap dievaluasi</p>
                                <p class="text-sm text-gray-500">Hanya menampilkan pendaftar yang sudah mengisi data diri, assessment, dan transkrip nilai</p>
                            </div>
                        </div>
                    </td></tr>`;
                    return;
                }

                tbody.innerHTML = filteredPendaftar.map((diri, i) => {
                    const dataStatusColor = getStatusColor(diri.data_diri_status || 'pending');
                    const assessmentStatusColor = getStatusColor(diri.assessment_status || 'pending');
                    const transferStatusColor = getStatusColor(diri.transfer_nilai_status || 'pending');

                    const dataStatusBadge = getStatusBadgeColor(diri.data_diri_status || 'pending');
                    const assessmentStatusBadge = getStatusBadgeColor(diri.assessment_status || 'pending');
                    const transferStatusBadge = getStatusBadgeColor(diri.transfer_nilai_status || 'pending');

                    return `
                    <tr class="hover:bg-gray-50 transition-all duration-200 table-row-hover">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">${i + 1}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center shadow-lg">
                                    <span class="text-white font-bold text-lg">${diri.nama_lengkap.charAt(0).toUpperCase()}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-gray-900">${diri.nama_lengkap}</div>
                                    <div class="text-sm text-gray-500">${diri.user?.email || diri.email || 'Email tidak tersedia'}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">${diri.pendidikan?.prodi || 'Belum diisi'}</div>
                            <div class="text-sm text-gray-500">${diri.pendidikan?.jurusan || 'Jurusan belum diisi'}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-3">
                                ${diri.can_evaluate ? `
                                <button class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white shadow-lg shadow-green-500/25 transition-all duration-200 transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 btn-approve" 
                                        data-userid="${diri.user_id}" 
                                        title="Setujui Pendaftar">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                                <button class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white shadow-lg shadow-red-500/25 transition-all duration-200 transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 btn-reject" 
                                        data-userid="${diri.user_id}" 
                                        title="Tolak Pendaftar">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                                ` : `
                                <button class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-200 cursor-not-allowed opacity-50" 
                                        disabled 
                                        title="Belum memenuhi syarat evaluasi">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                                <button class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-200 cursor-not-allowed opacity-50" 
                                        disabled 
                                        title="Belum memenuhi syarat evaluasi">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                                `}
                            </div>
                            <div class="mt-3 text-xs text-gray-500">
                                ${!diri.can_evaluate ? `
                                <div class="flex flex-col space-y-2">
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium ${dataStatusBadge} shadow-sm">
                                        <div class="w-2 h-2 rounded-full mr-2 ${diri.data_diri_status === 'sukses' ? 'bg-green-500' : diri.data_diri_status === 'proses' ? 'bg-blue-500' : diri.data_diri_status === 'gagal' ? 'bg-red-500' : 'bg-yellow-500'}"></div>
                                        Data: ${diri.data_diri_status || 'Pending'}
                                    </div>
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium ${assessmentStatusBadge} shadow-sm">
                                        <div class="w-2 h-2 rounded-full mr-2 ${diri.assessment_status === 'sukses' ? 'bg-green-500' : diri.assessment_status === 'proses' ? 'bg-blue-500' : diri.assessment_status === 'gagal' ? 'bg-red-500' : 'bg-yellow-500'}"></div>
                                        Asesmen: ${diri.assessment_status || 'Pending'}
                                    </div>
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium ${transferStatusBadge} shadow-sm">
                                        <div class="w-2 h-2 rounded-full mr-2 ${diri.transfer_nilai_status === 'sukses' ? 'bg-green-500' : diri.transfer_nilai_status === 'proses' ? 'bg-blue-500' : diri.transfer_nilai_status === 'gagal' ? 'bg-red-500' : 'bg-yellow-500'}"></div>
                                        Transfer: ${diri.transfer_nilai_status || 'Pending'}
                                    </div>
                                </div>
                                ` : '<div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 shadow-sm"><div class="w-2 h-2 rounded-full bg-green-500 mr-2"></div>Siap evaluasi</div>'}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-3">
                                <a href="/assesor/datadiri/${diri.id}" 
                                   class="inline-flex items-center px-4 py-2 ${dataStatusColor.bg} ${dataStatusColor.text} rounded-lg text-sm font-medium ${dataStatusColor.hover} ${dataStatusColor.shadow} ${dataStatusColor.ring} transition-all duration-200 transform hover:scale-105 focus:outline-none modern-btn btn-hover-effect">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Data
                                </a>
                                <a href="/assesor/asesmen/${diri.id}" 
                                   class="inline-flex items-center px-4 py-2 ${assessmentStatusColor.bg} ${assessmentStatusColor.text} rounded-lg text-sm font-medium ${assessmentStatusColor.hover} ${assessmentStatusColor.shadow} ${assessmentStatusColor.ring} transition-all duration-200 transform hover:scale-105 focus:outline-none modern-btn btn-hover-effect">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                    </svg>
                                    Asesmen
                                </a>
                                <button onclick="loadTransferNilai(${diri.user_id})" 
                                        class="inline-flex items-center px-4 py-2 ${transferStatusColor.bg} ${transferStatusColor.text} rounded-lg text-sm font-medium ${transferStatusColor.hover} ${transferStatusColor.shadow} ${transferStatusColor.ring} transition-all duration-200 transform hover:scale-105 focus:outline-none modern-btn btn-hover-effect">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                    </svg>
                                    Transfer
                                </button>
                            </div>
                        </td>
                    </tr>
                    `;
                }).join('');
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
                if (e.target.closest('.btn-approve') && !e.target.closest('.btn-approve').disabled) {
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
                if (e.target.closest('.btn-reject') && !e.target.closest('.btn-reject').disabled) {
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