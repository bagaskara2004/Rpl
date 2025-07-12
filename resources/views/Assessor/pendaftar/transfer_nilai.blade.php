@vite('resources/css/app.css')
@vite('resources/css/pendaftar-custom.css')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('css/transfer-nilai.css') }}" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('js/transfer-nilai.js') }}"></script>

{{-- Cek apakah user sudah memiliki data transfer nilai --}}
@if(isset($hasTransferNilai) && $hasTransferNilai)
{{-- Jika sudah ada transfer nilai, tampilkan hasil statis --}}
@include('Assessor.pendaftar.transfer_nilai_statis')
@else
{{-- Jika belum ada transfer nilai, tampilkan form input --}}

@if(request()->ajax())
{{-- AJAX Request - Hanya tampilkan form --}}
<div class="mb-8">
    <div class="flex items-center gap-6 mb-6">
        <a href="{{ route('assesor.pendaftar') }}" class="flex items-center text-gray-600 hover:text-blue-600 transition-all duration-300 bg-white rounded-xl px-4 py-2 shadow-md hover:shadow-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M19 12H5M12 19l-7-7 7-7" />
            </svg>
            Kembali ke Pendaftar
        </a>
    </div>
    <div class="text-center mb-6">
        <h1 class="header-title text-4xl font-bold mb-2">Transfer Nilai</h1>
        <p class="text-gray-600 text-lg">Kelola transfer nilai mata kuliah dengan mudah</p>
    </div>

    <!-- Search and Summary Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Search Bar -->
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" id="searchInput"
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Cari mata kuliah...">
                </div>
            </div>

            <!-- SKS Summary -->
            <div class="lg:w-80">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-4 border border-blue-200">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-700" id="totalSks">{{ $transkrip->sum('sks') ?? 0 }}</div>
                            <div class="text-xs text-blue-600 font-medium">Total SKS</div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-4 border border-green-200">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-700" id="convertedSks">0</div>
                            <div class="text-xs text-green-600 font-medium">SKS Dikonversi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="mt-4">
            <div class="flex justify-between text-sm text-gray-600 mb-2">
                <span>Progress Konversi</span>
                <span id="progressPercent">0%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2 rounded-full transition-all duration-500" style="width: 0%" id="progressBar"></div>
            </div>
        </div>
    </div>

    <form method="POST" action="">
        @csrf
        <div class="transfer-card rounded-3xl shadow-xl p-8">
            <div class="mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Data Transfer Nilai</h2>
                </div>
            </div>
            <div class="overflow-x-auto rounded-2xl border border-gray-200">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="table-header">
                            <th class="py-4 px-6 text-left font-bold text-gray-700 rounded-tl-2xl">
                                <div class="flex items-center gap-2">
                                    <span class="w-6 h-6 bg-white rounded-full flex items-center justify-center text-xs font-bold text-gray-600">#</span>
                                    No
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    MATA KULIAH LAMPAU
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                    NILAI
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    MATA KULIAH TRPL
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    NILAI BARU
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700 rounded-tr-2xl">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                    KETERANGAN
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($transkrip as $i => $row)
                        <tr class="table-row transition-all duration-300">
                            <td class="py-5 px-6 text-gray-800">
                                <div class="flex items-center justify-center w-8 h-8 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-full text-sm font-bold text-blue-700">
                                    {{ $i+1 }}
                                </div>
                            </td>
                            <td class="py-5 px-6">
                                <div class="font-semibold text-gray-800">{{ $row->mata_kuliah }}</div>
                            </td>
                            <td class="py-5 px-6">
                                <span class="grade-badge inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold text-blue-800">
                                    {{ $row->nilai_huruf }}
                                </span>
                            </td>
                            <input type="hidden" name="transkrip_id[]" value="{{ $row->id }}" />
                            <td class="py-5 px-6">
                                <select class="kurikulum-select w-full" name="kurikulum[]" data-row="{{ $i }}">
                                    <option value="">Pilih Mata Kuliah TRPL</option>
                                    @foreach($kurikulum as $kuri)
                                    <option value="{{ $kuri->id }}" data-sks="{{ $kuri->sks }}">{{ $kuri->mata_kuliah_trpl }} ({{ $kuri->sks }} SKS)</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="py-5 px-6">
                                <select class="form-input-enhanced w-full" name="nilai_trpl[]">
                                    <option value="">Pilih Nilai</option>
                                    <option value="A">A - Sangat Baik</option>
                                    <option value="B">B - Baik</option>
                                    <option value="C">C - Cukup</option>
                                    <option value="D">D - Kurang</option>
                                    <option value="E">E - Sangat Kurang</option>
                                </select>
                            </td>
                            <td class="py-5 px-6">
                                <input type="text" class="form-input-enhanced w-full" name="keterangan[]" value="" placeholder="Tambahkan catatan..." />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-end mt-8 gap-4">
            <button type="button" id="btnBatalAjax" class="btn-secondary px-8 py-3 rounded-xl font-semibold transition-all duration-300 bg-red-500 text-white hover:bg-red-600">
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
                Batal
            </button>
            <button type="submit" class="btn-primary px-8 py-3 text-white rounded-xl font-semibold transition-all duration-300 flex items-center gap-3 bg-blue-600 hover:bg-blue-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M5 13l4 4L19 7" />
                </svg>
                Simpan Transfer Nilai
            </button>
        </div>
    </form>
</div>

@else
{{-- Normal Request - Tampilkan dengan layout assessor --}}
<x-layout_assessor>
    <div class="mb-8">
        <div class="flex items-center gap-6 mb-6">
            <a href="{{ route('assesor.pendaftar') }}" class="flex items-center text-gray-600 hover:text-blue-600 transition-all duration-300 bg-white rounded-xl px-4 py-2 shadow-md hover:shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                Kembali ke Pendaftar
            </a>
        </div>
        <div class="text-center mb-6">
            <h1 class="header-title text-4xl font-bold mb-2">Transfer Nilai</h1>
            <p class="text-gray-600 text-lg">Kelola transfer nilai mata kuliah dengan mudah</p>
        </div>

        <!-- Search and Summary Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Search Bar -->
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" id="searchInput"
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Cari mata kuliah...">
                    </div>
                </div>

                <!-- SKS Summary -->
                <div class="lg:w-80">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-4 border border-blue-200">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-700" id="totalSks">{{ $transkrip->sum('sks') ?? 0 }}</div>
                                <div class="text-xs text-blue-600 font-medium">Total SKS</div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-4 border border-green-200">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-700" id="convertedSks">0</div>
                                <div class="text-xs text-green-600 font-medium">SKS Dikonversi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="mt-4">
                <div class="flex justify-between text-sm text-gray-600 mb-2">
                    <span>Progress Konversi</span>
                    <span id="progressPercent">0%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2 rounded-full transition-all duration-500" style="width: 0%" id="progressBar"></div>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="">
        @csrf
        <div class="transfer-card rounded-3xl shadow-xl p-8">
            <div class="mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Data Transfer Nilai</h2>
                </div>
            </div>
            <div class="overflow-x-auto rounded-2xl border border-gray-200">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="table-header">
                            <th class="py-4 px-6 text-left font-bold text-gray-700 rounded-tl-2xl">
                                <div class="flex items-center gap-2">
                                    <span class="w-6 h-6 bg-white rounded-full flex items-center justify-center text-xs font-bold text-gray-600">#</span>
                                    No
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    MATA KULIAH LAMPAU
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                    NILAI
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    MATA KULIAH TRPL
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    NILAI BARU
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700 rounded-tr-2xl">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                    KETERANGAN
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($transkrip as $i => $row)
                        <tr class="table-row transition-all duration-300">
                            <td class="py-5 px-6 text-gray-800">
                                <div class="flex items-center justify-center w-8 h-8 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-full text-sm font-bold text-blue-700">
                                    {{ $i+1 }}
                                </div>
                            </td>
                            <td class="py-5 px-6">
                                <div class="font-semibold text-gray-800">{{ $row->mata_kuliah }}</div>
                            </td>
                            <td class="py-5 px-6">
                                <span class="grade-badge inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold text-blue-800">
                                    {{ $row->nilai_huruf }}
                                </span>
                            </td>
                            <input type="hidden" name="transkrip_id[]" value="{{ $row->id }}" />
                            <td class="py-5 px-6">
                                <select class="kurikulum-select w-full" name="kurikulum[]" data-row="{{ $i }}">
                                    <option value="">Pilih Mata Kuliah TRPL</option>
                                    @foreach($kurikulum as $kuri)
                                    <option value="{{ $kuri->id }}" data-sks="{{ $kuri->sks }}">{{ $kuri->mata_kuliah_trpl }} ({{ $kuri->sks }} SKS)</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="py-5 px-6">
                                <select class="form-input-enhanced w-full" name="nilai_trpl[]">
                                    <option value="">Pilih Nilai</option>
                                    <option value="A">A - Sangat Baik</option>
                                    <option value="B">B - Baik</option>
                                    <option value="C">C - Cukup</option>
                                    <option value="D">D - Kurang</option>
                                    <option value="E">E - Sangat Kurang</option>
                                </select>
                            </td>
                            <td class="py-5 px-6">
                                <input type="text" class="form-input-enhanced w-full" name="keterangan[]" value="" placeholder="Tambahkan catatan..." />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-end mt-8 gap-4">
            <button type="button" id="btnBatal" class="btn-secondary px-8 py-3 rounded-xl font-semibold transition-all duration-300 bg-red-500 text-white hover:bg-red-600">
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
                Batal
            </button>
            <button type="submit" class="btn-primary px-8 py-3 text-white rounded-xl font-semibold transition-all duration-300 flex items-center gap-3 bg-blue-600 hover:bg-blue-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M5 13l4 4L19 7" />
                </svg>
                Simpan Transfer Nilai
            </button>
        </div>
    </form>

</x-layout_assessor>
@endif

<script>
    $(document).ready(function() {
        // Create kurikulum SKS mapping for JavaScript
        const kurikulumSksMap = {
            @foreach($kurikulum as $kuri) {
                {
                    $kuri - > id
                }
            }: {
                {
                    $kuri - > sks
                }
            },
            @endforeach
        };

        // Initialize Transfer Nilai module
        if (typeof TransferNilai !== 'undefined') {
            TransferNilai.init(kurikulumSksMap);
        } else {
            console.error('TransferNilai module not loaded!');
        }
    });
</script>

@endif {{-- End of hasTransferNilai check --}}