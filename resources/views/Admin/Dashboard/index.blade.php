@extends('components.layout_admin')

@section('title', 'Dashboard Admin RPL')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-xl p-8 text-white mb-8 shadow-lg">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Dashboard Admin RPL</h1>
                <p class="text-blue-100 text-lg">Kelola sistem Recognition of Prior Learning dengan mudah dan efisien</p>
                <div class="mt-4 flex items-center space-x-4 text-sm">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                        {{ now()->format('d M Y') }}
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        {{ now()->format('H:i') }} WIB
                    </div>
                </div>
            </div>
            <div class="mt-6 md:mt-0">
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold">{{ $totalPendaftar ?? 0 }}</div>
                    <div class="text-sm text-blue-100">Total Pendaftar</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total User</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalUsers ?? 0 }}</p>
                    <p class="text-sm text-green-600 font-medium mt-1">
                        <span class="inline-flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            +{{ $newUsersThisMonth ?? 0 }} bulan ini
                        </span>
                    </p>
                </div>
                <div class="p-4 rounded-full bg-blue-100">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Data Diri -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Data Diri Lengkap</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalDataDiri ?? 0 }}</p>
                    <p class="text-sm text-blue-600 font-medium mt-1">
                        <span class="inline-flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $percentageDataDiri ?? 0 }}% dari total user
                        </span>
                    </p>
                </div>
                <div class="p-4 rounded-full bg-green-100">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Transkrip -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Transkrip</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalTranskrip ?? 0 }}</p>
                    <p class="text-sm text-purple-600 font-medium mt-1">
                        <span class="inline-flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $avgSksTersedia ?? 0 }} SKS rata-rata
                        </span>
                    </p>
                </div>
                <div class="p-4 rounded-full bg-purple-100">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Assessment -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Assessment</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalAssessment ?? 0 }}</p>
                    <p class="text-sm text-orange-600 font-medium mt-1">
                        <span class="inline-flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2L3 7v11a1 1 0 001 1h4v-8a1 1 0 011-1h2a1 1 0 011 1v8h4a1 1 0 001-1V7l-7-5z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $pendingAssessment ?? 0 }} pending review
                        </span>
                    </p>
                </div>
                <div class="p-4 rounded-full bg-orange-100">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Analytics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Registration Trend Chart -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Trend Pendaftaran</h3>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                    <span class="text-sm text-gray-600">7 hari terakhir</span>
                </div>
            </div>
            <div class="space-y-4">
                @php
                $chartData = $registrationTrend ?? [
                ['day' => 'Sen', 'count' => 12],
                ['day' => 'Sel', 'count' => 8],
                ['day' => 'Rab', 'count' => 15],
                ['day' => 'Kam', 'count' => 7],
                ['day' => 'Jum', 'count' => 20],
                ['day' => 'Sab', 'count' => 5],
                ['day' => 'Min', 'count' => 3],
                ];
                $maxCount = max(array_column($chartData, 'count'));
                @endphp
                @foreach($chartData as $data)
                <div class="flex items-center space-x-3">
                    <div class="w-8 text-sm text-gray-600 font-medium">{{ $data['day'] }}</div>
                    <div class="flex-1 bg-gray-100 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full transition-all duration-500"
                            style="width: {{ $maxCount > 0 ? ($data['count'] / $maxCount) * 100 : 0 }}%"></div>
                    </div>
                    <div class="w-8 text-sm text-gray-900 font-semibold">{{ $data['count'] }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Top Perguruan Tinggi -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Top Perguruan Tinggi</h3>
            <div class="space-y-4">
                @forelse($topPerguruanTinggi ?? [] as $index => $pt)
                <div class="flex items-center justify-between p-3 rounded-lg {{ $index < 3 ? 'bg-gradient-to-r from-blue-50 to-indigo-50' : 'bg-gray-50' }}">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 {{ $index < 3 ? 'bg-blue-500' : 'bg-gray-400' }} text-white rounded-full flex items-center justify-center text-sm font-bold">
                            {{ $index + 1 }}
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $pt['nama_perguruan'] ?? 'Unknown' }}</p>
                            <p class="text-xs text-gray-500">{{ $pt['jumlah'] ?? 0 }} pendaftar</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-sm font-semibold text-gray-900">{{ $pt['percentage'] ?? 0 }}%</span>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <p class="text-gray-500 text-sm mt-2">Belum ada data perguruan tinggi</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Statistik Posisi dan Data Export -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Top Posisi Pekerjaan -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Top Posisi Pekerjaan</h3>
            <div class="space-y-4">
                @forelse($topPosisi ?? [] as $index => $posisi)
                <div class="flex items-center justify-between p-3 rounded-lg {{ $index < 3 ? 'bg-gradient-to-r from-green-50 to-emerald-50' : 'bg-gray-50' }}">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 {{ $index < 3 ? 'bg-green-500' : 'bg-gray-400' }} text-white rounded-full flex items-center justify-center text-sm font-bold">
                            {{ $index + 1 }}
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $posisi['posisi'] ?? 'Unknown' }}</p>
                            <p class="text-xs text-gray-500">{{ $posisi['jumlah'] ?? 0 }} orang</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-sm font-semibold text-gray-900">{{ $posisi['percentage'] ?? 0 }}%</span>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                    </svg>
                    <p class="text-gray-500 text-sm mt-2">Belum ada data posisi pekerjaan</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Data Export Section -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Download Data & Laporan</h3>
            <div class="space-y-4">
                <!-- Export All Data -->
                <div class="border rounded-lg p-4 hover:bg-gray-50 transition-colors duration-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Semua Data Pendaftar</p>
                                <p class="text-xs text-gray-500">Excel format (.xlsx)</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.export.all-data') }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200 export-btn" data-type="all-data">
                            <span class="btn-text">Download</span>
                            <span class="btn-loading hidden">
                                <svg class="animate-spin h-4 w-4 text-white inline-block mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Loading...
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Export Statistik -->
                <div class="border rounded-lg p-4 hover:bg-gray-50 transition-colors duration-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-green-100 rounded-lg">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Laporan Statistik</p>
                                <p class="text-xs text-gray-500">PDF format (.pdf)</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.export.statistics') }}" class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors duration-200 export-btn" data-type="statistics">
                            <span class="btn-text">Download</span>
                            <span class="btn-loading hidden">
                                <svg class="animate-spin h-4 w-4 text-white inline-block mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Loading...
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Export Transkrip -->
                <div class="border rounded-lg p-4 hover:bg-gray-50 transition-colors duration-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-purple-100 rounded-lg">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Data Transkrip Nilai</p>
                                <p class="text-xs text-gray-500">Excel format (.xlsx)</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.export.transkrip') }}" class="px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 transition-colors duration-200 export-btn" data-type="transkrip">
                            <span class="btn-text">Download</span>
                            <span class="btn-loading hidden">
                                <svg class="animate-spin h-4 w-4 text-white inline-block mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Loading...
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Export Assessment -->
                <div class="border rounded-lg p-4 hover:bg-gray-50 transition-colors duration-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-orange-100 rounded-lg">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Data Assessment</p>
                                <p class="text-xs text-gray-500">Excel format (.xlsx)</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.export.assessment') }}" class="px-4 py-2 bg-orange-600 text-white text-sm font-medium rounded-lg hover:bg-orange-700 transition-colors duration-200 export-btn" data-type="assessment">
                            <span class="btn-text">Download</span>
                            <span class="btn-loading hidden">
                                <svg class="animate-spin h-4 w-4 text-white inline-block mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 714 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Loading...
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities and Data -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mb-8">
        <!-- Recent Users -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">User Terbaru</h3>
                <a href="/admin/users" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</a>
            </div>
            <div class="space-y-4">
                @forelse($recentUsers ?? [] as $user)
                <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $user->name ?? 'Unknown User' }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ $user->email ?? 'No email' }}</p>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-500">{{ $user->created_at ? $user->created_at->diffForHumans() : 'Unknown' }}</div>
                        @if(isset($user->data_diri))
                        <div class="text-xs text-green-600 font-medium">✓ Data Lengkap</div>
                        @else
                        <div class="text-xs text-orange-600 font-medium">⚠ Data Kurang</div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <p class="text-gray-500 text-sm mt-2">Belum ada user terbaru</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Transkrip -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Transkrip Terbaru</h3>
                <a href="/admin/transkrip" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</a>
            </div>
            <div class="space-y-4">
                @forelse($recentTranskrip ?? [] as $transkrip)
                <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $transkrip->mata_kuliah ?? 'Unknown Course' }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ ($transkrip->user->name ?? 'Unknown') }} • Grade: {{ $transkrip->nilai_huruf ?? 'N/A' }}</p>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-500">{{ $transkrip->created_at ? $transkrip->created_at->diffForHumans() : 'Unknown' }}</div>
                        <div class="text-xs font-medium {{ ($transkrip->nilai_huruf ?? '') >= 'B' ? 'text-green-600' : 'text-orange-600' }}">
                            {{ $transkrip->sks ?? 0 }} SKS
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-gray-500 text-sm mt-2">Belum ada transkrip terbaru</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Counter animation for statistics
        const counters = document.querySelectorAll('.counter');

        const animateCounters = () => {
            counters.forEach(counter => {
                const target = parseInt(counter.textContent);
                const increment = target / 100;
                let current = 0;

                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        counter.textContent = Math.ceil(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };

                updateCounter();
            });
        };

        // Add counter class to statistic numbers
        const statNumbers = document.querySelectorAll('.text-3xl.font-bold');
        statNumbers.forEach(stat => {
            stat.classList.add('counter');
        });

        // Animate counters on load
        setTimeout(animateCounters, 500);

        // Add hover effects to cards
        const cards = document.querySelectorAll('.bg-white.rounded-xl');
        cards.forEach(card => {
            card.classList.add('dashboard-card');
        });

        // Add loading state simulation for charts
        const chartBars = document.querySelectorAll('.bg-blue-500.h-2');
        chartBars.forEach((bar, index) => {
            setTimeout(() => {
                bar.style.width = bar.style.width;
                bar.style.transition = 'width 1s ease-in-out';
            }, index * 200);
        });

        // Auto-refresh dashboard every 5 minutes
        setInterval(() => {
            // You can add AJAX call here to refresh data
            console.log('Dashboard auto-refresh triggered');
        }, 300000);

        // Quick action hover effects
        const quickActions = document.querySelectorAll('a[href*="/admin/"]');
        quickActions.forEach(action => {
            action.classList.add('quick-action-card');
        });

        // System status indicator
        const statusIndicators = document.querySelectorAll('.w-2.h-2.bg-green-500');
        statusIndicators.forEach(indicator => {
            indicator.parentElement.classList.add('status-online');
        });

        // Add welcome header animation class
        const welcomeHeader = document.querySelector('.bg-gradient-to-r');
        if (welcomeHeader) {
            welcomeHeader.classList.add('welcome-header');
        }

        // Interactive notifications
        const notifications = document.querySelectorAll('.space-y-4 > div');
        notifications.forEach(notification => {
            notification.classList.add('notification-item');
            notification.style.cursor = 'pointer';

            notification.addEventListener('click', function() {
                // Add click animation
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            });
        });

        // Export button handling
        const exportButtons = document.querySelectorAll('.export-btn');
        exportButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const btnText = this.querySelector('.btn-text');
                const btnLoading = this.querySelector('.btn-loading');
                const exportType = this.getAttribute('data-type');

                // Show loading state
                btnText.classList.add('hidden');
                btnLoading.classList.remove('hidden');
                this.disabled = true;

                // Simulate export process (replace with actual export call)
                fetch(this.href, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Show success message
                            showNotification('success', data.message);

                            // If there's a real download URL, trigger download
                            if (data.download_url && data.download_url !== '#') {
                                const link = document.createElement('a');
                                link.href = data.download_url;
                                link.download = data.filename || 'export.xlsx';
                                document.body.appendChild(link);
                                link.click();
                                document.body.removeChild(link);
                            }
                        } else {
                            showNotification('error', data.message || 'Gagal mengekspor data');
                        }
                    })
                    .catch(error => {
                        console.error('Export error:', error);
                        showNotification('error', 'Terjadi kesalahan saat mengekspor data');
                    })
                    .finally(() => {
                        // Reset button state
                        btnText.classList.remove('hidden');
                        btnLoading.classList.add('hidden');
                        this.disabled = false;
                    });
            });
        });

        // Notification system
        function showNotification(type, message) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        ${type === 'success' 
                            ? '<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>'
                            : '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>'
                        }
                    </svg>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(notification);

            // Auto remove after 3 seconds
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    });
</script>

@push('scripts')
<script>
    // Additional dashboard functionality
    function refreshDashboard() {
        // Implement dashboard refresh logic
        console.log('Refreshing dashboard data...');

        // Show loading state
        const cards = document.querySelectorAll('.dashboard-card');
        cards.forEach(card => {
            card.style.opacity = '0.7';
        });

        // Simulate data refresh
        setTimeout(() => {
            cards.forEach(card => {
                card.style.opacity = '1';
            });
            console.log('Dashboard refreshed');
        }, 1000);
    }

    // Export functions for global use
    window.dashboardUtils = {
        refreshDashboard: refreshDashboard
    };
</script>
@endpush
@endsection