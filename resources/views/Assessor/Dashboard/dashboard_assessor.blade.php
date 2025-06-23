<x-layout_assessor>
    @vite('resources/css/app.css')

    <div class="space-y-6">
        <!-- Welcome Header -->
        <div class="bg-gradient-to-r from-purple-600 to-purple-800 rounded-2xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->user_name ?? 'Assessor' }}!</h1>
                    <p class="text-purple-100">Dashboard Assessor - Kelola dan evaluasi pendaftar RPL</p>
                </div>
                <div class="hidden md:block">
                    <svg class="w-16 h-16 text-purple-200" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Pendaftar -->
            <div class="bg-white rounded-2xl shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Pendaftar</p>
                        <p class="text-3xl font-bold text-gray-900" id="total-pendaftar">-</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-sm text-gray-500">Menunggu evaluasi</span>
                </div>
            </div>

            <!-- Disetujui -->
            <div class="bg-white rounded-2xl shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Disetujui</p>
                        <p class="text-3xl font-bold text-green-600" id="disetujui">-</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-sm text-green-500">✓ Telah dievaluasi</span>
                </div>
            </div>

            <!-- Ditolak -->
            <div class="bg-white rounded-2xl shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Ditolak</p>
                        <p class="text-3xl font-bold text-red-600" id="ditolak">-</p>
                    </div>
                    <div class="bg-red-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-sm text-red-500">✗ Tidak memenuhi syarat</span>
                </div>
            </div>

            <!-- Transfer Nilai -->
            <div class="bg-white rounded-2xl shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Transfer Nilai</p>
                        <p class="text-3xl font-bold text-purple-600" id="transfer-nilai">-</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-sm text-purple-500">Nilai telah ditransfer</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Aksi Cepat</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('assesor.pendaftar') }}" class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl hover:from-blue-100 hover:to-blue-200 transition group">
                    <div class="bg-blue-600 p-3 rounded-lg mr-4 group-hover:bg-blue-700 transition">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-blue-900">Evaluasi Pendaftar</h3>
                        <p class="text-sm text-blue-700">Lihat dan evaluasi data pendaftar</p>
                    </div>
                </a>

                <a href="{{ route('assesor.pendaftar') }}" class="flex items-center p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-xl hover:from-green-100 hover:to-green-200 transition group">
                    <div class="bg-green-600 p-3 rounded-lg mr-4 group-hover:bg-green-700 transition">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-green-900">Review Asesmen</h3>
                        <p class="text-sm text-green-700">Tinjau hasil asesmen mandiri</p>
                    </div>
                </a>

                <a href="{{ route('assesor.pendaftar') }}" class="flex items-center p-4 bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl hover:from-purple-100 hover:to-purple-200 transition group">
                    <div class="bg-purple-600 p-3 rounded-lg mr-4 group-hover:bg-purple-700 transition">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-purple-900">Transfer Nilai</h3>
                        <p class="text-sm text-purple-700">Kelola transfer nilai mata kuliah</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Pendaftar Terbaru -->
            <div class="bg-white rounded-2xl shadow p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Pendaftar Terbaru</h2>
                    <a href="{{ route('assesor.pendaftar') }}" class="text-purple-600 hover:text-purple-700 text-sm font-medium">Lihat Semua</a>
                </div>
                <div id="recent-applicants" class="space-y-3">
                    <!-- Loading state -->
                    <div class="animate-pulse space-y-3">
                        @for($i = 0; $i < 3; $i++)
                            <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gray-200 rounded-full"></div>
                            <div class="flex-1">
                                <div class="h-4 bg-gray-200 rounded w-3/4 mb-2"></div>
                                <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                            </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="bg-white rounded-2xl shadow p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Aktivitas Terbaru</h2>
                <div class="text-sm text-gray-500">Keputusan terakhir</div>
            </div>
            <div id="recent-activities" class="space-y-3">
                <!-- Loading state -->
                <div class="animate-pulse space-y-3">
                    @for($i = 0; $i < 3; $i++)
                        <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gray-200 rounded-full"></div>
                        <div class="flex-1">
                            <div class="h-4 bg-gray-200 rounded w-3/4 mb-2"></div>
                            <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                        </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
    </div>

    <!-- Progress Chart Section -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Progress Evaluasi Bulanan</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Monthly Stats -->
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg">
                    <div>
                        <p class="text-sm font-medium text-blue-600">Target Bulanan</p>
                        <p class="text-2xl font-bold text-blue-700" id="monthly-target">20</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                    <div>
                        <p class="text-sm font-medium text-green-600">Selesai</p>
                        <p class="text-2xl font-bold text-green-700" id="monthly-completed">0</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="md:col-span-2 flex items-center justify-center">
                <div class="w-full max-w-md">
                    <div class="flex justify-between text-sm font-medium text-gray-700 mb-2">
                        <span>Progress</span>
                        <span id="progress-percentage">0%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div id="progress-bar" class="bg-gradient-to-r from-purple-500 to-purple-600 h-4 rounded-full transition-all duration-500" style="width: 0%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2 text-center">Evaluasi yang telah diselesaikan bulan ini</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Overview -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Ringkasan Status</h2>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-yellow-400 rounded-full mr-3"></div>
                    <span class="text-gray-700">Menunggu Evaluasi</span>
                </div>
                <span class="font-semibold text-gray-900" id="status-pending">-</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-green-500 rounded-full mr-3"></div>
                    <span class="text-gray-700">Disetujui</span>
                </div>
                <span class="font-semibold text-gray-900" id="status-approved">-</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-red-500 rounded-full mr-3"></div>
                    <span class="text-gray-700">Ditolak</span>
                </div>
                <span class="font-semibold text-gray-900" id="status-rejected">-</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-purple-500 rounded-full mr-3"></div>
                    <span class="text-gray-700">Transfer Nilai</span>
                </div>
                <span class="font-semibold text-gray-900" id="status-transfer">-</span>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            loadDashboardData();
            // Refresh dashboard data every 30 seconds
            setInterval(loadDashboardData, 30000);
        });

        function loadDashboardData() {
            fetch('{{ route("assesor.dashboard.data") }}')
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error('Error loading dashboard data:', data.error);
                        return;
                    }
                    updateStatistics(data.stats);
                    updateRecentApplicants(data.recent_applicants);
                    updateRecentActivities(data.recent_activities);
                })
                .catch(error => {
                    console.error('Error loading dashboard data:', error);
                });
        }

        function updateStatistics(stats) {
            // Update main statistics cards
            document.getElementById('total-pendaftar').textContent = stats.total_pendaftar || '0';
            document.getElementById('disetujui').textContent = stats.disetujui || '0';
            document.getElementById('ditolak').textContent = stats.ditolak || '0';
            document.getElementById('transfer-nilai').textContent = stats.transfer_nilai || '0';

            // Update status overview
            document.getElementById('status-pending').textContent = stats.pending_evaluasi || '0';
            document.getElementById('status-approved').textContent = stats.disetujui || '0';
            document.getElementById('status-rejected').textContent = stats.ditolak || '0';
            document.getElementById('status-transfer').textContent = stats.transfer_nilai || '0';

            // Update progress chart
            updateProgressChart(stats);
        }

        function updateProgressChart(stats) {
            const target = 20; // Monthly target
            const completed = (stats.disetujui || 0) + (stats.ditolak || 0);
            const percentage = Math.min((completed / target) * 100, 100);

            document.getElementById('monthly-target').textContent = target;
            document.getElementById('monthly-completed').textContent = completed;
            document.getElementById('progress-percentage').textContent = Math.round(percentage) + '%';
            document.getElementById('progress-bar').style.width = percentage + '%';
        }

        function updateRecentApplicants(applicants) {
            const container = document.getElementById('recent-applicants');

            if (!applicants || applicants.length === 0) {
                container.innerHTML = '<p class="text-gray-500 text-center py-8">Belum ada pendaftar baru</p>';
                return;
            }

            container.innerHTML = applicants.map(applicant => `
                <div class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-lg transition cursor-pointer" 
                     onclick="window.location.href='{{ url('assesor/pendaftar') }}'">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-400 to-purple-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold text-sm">${applicant.nama_lengkap.charAt(0).toUpperCase()}</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">${applicant.nama_lengkap}</p>
                        <p class="text-sm text-gray-500">${applicant.pendidikan?.jurusan || 'Jurusan belum diisi'}</p>
                        <p class="text-xs text-gray-400">${formatDate(applicant.created_at)}</p>
                    </div>
                    <div class="text-right">
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">
                            Menunggu Evaluasi
                        </span>
                    </div>
                </div>
            `).join('');
        }

        function updateRecentActivities(activities) {
            const container = document.getElementById('recent-activities');

            if (!activities || activities.length === 0) {
                container.innerHTML = '<p class="text-gray-500 text-center py-8">Belum ada aktivitas terbaru</p>';
                return;
            }

            container.innerHTML = activities.map(activity => {
                const statusInfo = getStatusInfo(activity.status);
                return `
                    <div class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-lg transition">
                        <div class="w-10 h-10 ${statusInfo.bgColor} rounded-full flex items-center justify-center">
                            ${statusInfo.icon}
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">
                                ${activity.user?.user_name || 'User tidak diketahui'} 
                                <span class="${statusInfo.textColor}">${statusInfo.text}</span>
                            </p>
                            <p class="text-sm text-gray-500">${formatDate(activity.created_at)}</p>
                            ${activity.catatan ? `<p class="text-xs text-gray-400 mt-1">${activity.catatan}</p>` : ''}
                        </div>
                    </div>
                `;
            }).join('');
        }

        function getStatusInfo(status) {
            if (status === 1) {
                return {
                    text: 'disetujui',
                    textColor: 'text-green-600',
                    bgColor: 'bg-green-100',
                    icon: '<svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                };
            } else {
                return {
                    text: 'ditolak',
                    textColor: 'text-red-600',
                    bgColor: 'bg-red-100',
                    icon: '<svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                };
            }
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const diffTime = Math.abs(now - date);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            if (diffDays === 1) {
                return 'Hari ini';
            } else if (diffDays === 2) {
                return 'Kemarin';
            } else if (diffDays <= 7) {
                return `${diffDays - 1} hari yang lalu`;
            } else {
                return date.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                });
            }
        }
    </script>
</x-layout_assessor>