@vite('resources/css/app.css')
@vite('resources/css/pendaftar-custom.css')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="{{ asset('css/transfer-nilai.css') }}" rel="stylesheet" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@php
$totalSks = 0;
$convertedSks = 0;
if(isset($transferNilai) && $transferNilai->count() > 0) {
foreach($transferNilai as $transfer) {
if($transfer->transkripNilai) {
$totalSks += $transfer->transkripNilai->sks ?? 0;
}
}
foreach($transferNilai->where('status', 1) as $transfer) {
if($transfer->kurikulum) {
$convertedSks += $transfer->kurikulum->sks ?? 0;
}
}
}
$calculatedPercentage = $totalSks > 0 ? round(($convertedSks / $totalSks) * 100) : 0;
@endphp

@if(request()->ajax())
{{-- AJAX Request - Tampilkan hasil statis --}}
<div class="mb-8">
    <div class="text-center mb-6">
        <h1 class="header-title text-4xl font-bold mb-2">Hasil Transfer Nilai</h1>
        <p class="text-gray-600 text-lg">Data transfer nilai yang telah disetujui</p>
        <div class="mt-4">
            <span class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M5 13l4 4L19 7" />
                </svg>
                Transfer Nilai Telah Disetujui
            </span>
        </div>
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
                            <div class="text-2xl font-bold text-blue-700" id="totalSks">{{ $totalSks }}</div>
                            <div class="text-xs text-blue-600 font-medium">Total SKS</div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-4 border border-green-200">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-700" id="convertedSks">{{ $convertedSks }}</div>
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
                <span id="progressPercent">{{ $calculatedPercentage }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2 rounded-full transition-all duration-500"
                    style="width: 0%"
                    id="progressBar1"
                    data-percentage="{{ $calculatedPercentage }}"></div>
            </div>
        </div>
    </div>

    {{-- Hasil Transfer Nilai --}}
    <div class="transfer-card rounded-3xl shadow-xl p-8">
        <div class="mb-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Hasil Transfer Nilai</h2>
                <div class="ml-auto text-sm text-gray-500">
                    Diproses pada: {{ $transferNilai->first()->created_at->format('d F Y') ?? '-' }}
                </div>
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
                                NILAI LAMA
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
                    @forelse($transferNilai as $i => $row)
                    <tr class="table-row transition-all duration-300">
                        <td class="py-5 px-6 text-gray-800">
                            <div class="flex items-center justify-center w-8 h-8 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-full text-sm font-bold text-blue-700">
                                {{ $i+1 }}
                            </div>
                        </td>
                        <td class="py-5 px-6">
                            <div class="font-semibold text-gray-800">{{ $row->transkrip->mata_kuliah }}</div>
                            <div class="text-xs text-gray-500 mt-1">{{ $row->transkrip->sks }} SKS</div>
                        </td>
                        <td class="py-5 px-6">
                            <span class="grade-badge inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold text-blue-800">
                                {{ $row->transkrip->nilai_huruf }}
                            </span>
                        </td>
                        <td class="py-5 px-6">
                            <div class="font-semibold text-gray-800">{{ $row->kurikulum->mata_kuliah_trpl }}</div>
                            <div class="text-xs text-gray-500 mt-1">{{ $row->kurikulum->sks }} SKS</div>
                        </td>
                        <td class="py-5 px-6">
                            <span class="grade-badge inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold
                                @if($row->nilai === 'A') bg-green-100 text-green-800
                                @elseif($row->nilai === 'B') bg-blue-100 text-blue-800
                                @elseif($row->nilai === 'C') bg-yellow-100 text-yellow-800
                                @elseif($row->nilai === 'D') bg-orange-100 text-orange-800
                                @elseif($row->nilai === 'E') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ $row->nilai ?? '-' }}
                            </span>
                        </td>
                        <td class="py-5 px-6">
                            <div class="text-sm text-gray-600">
                                {{ $row->catatan ?? 'Tidak ada catatan' }}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="text-lg font-medium">Belum ada data transfer nilai</p>
                                <p class="text-sm">Data transfer nilai akan ditampilkan di sini setelah diproses</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-between mt-8">
        <button onclick="window.print()" class="btn-secondary px-8 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak Hasil
        </button>

        <a href="{{ route('assesor.pendaftar') }}" class="btn-primary px-8 py-3 text-white rounded-xl font-semibold transition-all duration-300 flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Pendaftar
        </a>
    </div>

    <!-- Status Update Section -->
    <div class="mt-6 border-t border-gray-200 pt-6">
        <form action="{{ route('assesor.transfer.update-status', $transferNilai->first()->transkripNilai->user_id ?? 0) }}" method="POST" class="flex flex-col md:flex-row gap-4 items-end justify-between">
            @csrf
            @method('POST')

            <div class="flex-1 max-w-md">
                <label for="transfer_status" class="block text-sm font-medium text-gray-600 mb-2">Status Transfer Nilai</label>
                <select name="status" id="transfer_status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @php
                    $currentStatus = $transferNilai->first()->status ?? 'prosess';
                    @endphp
                    <option value="prosess" {{ $currentStatus == 'prosess' ? 'selected' : '' }}>
                        🔄 Proses
                    </option>
                    <option value="sukses" {{ $currentStatus == 'sukses' ? 'selected' : '' }}>
                        ✅ Sukses
                    </option>
                    <option value="pending" {{ $currentStatus == 'pending' ? 'selected' : '' }}>
                        ⏳ Pending
                    </option>
                    <option value="gagal" {{ $currentStatus == 'gagal' ? 'selected' : '' }}>
                        ❌ Gagal
                    </option>
                </select>

                <!-- Status Badge Display -->
                <div class="mt-2">
                    <span id="transferStatusBadge" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        @if($currentStatus == 'sukses') bg-green-100 text-green-800
                        @elseif($currentStatus == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($currentStatus == 'gagal') bg-red-100 text-red-800
                        @else bg-blue-100 text-blue-800 @endif">
                        @if($currentStatus == 'sukses') ✅ Sukses
                        @elseif($currentStatus == 'pending') ⏳ Pending
                        @elseif($currentStatus == 'gagal') ❌ Gagal
                        @else 🔄 Proses @endif
                    </span>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Status
                </button>

                <a href="{{ route('assesor.pendaftar') }}"
                    class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Daftar Pendaftar
                </a>
            </div>
        </form>
    </div>
</div>

@else
{{-- Normal Request - Tampilkan dengan layout assessor --}}
<x-layout_assessor>
    <!-- Flash Messages -->
    @if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
        </svg>
        {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
        <div class="flex items-center mb-2">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
            </svg>
            <strong>Terjadi kesalahan:</strong>
        </div>
        <ul class="list-disc pl-7">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

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
            <h1 class="header-title text-4xl font-bold mb-2">Hasil Transfer Nilai</h1>
            <p class="text-gray-600 text-lg">Data transfer nilai yang telah disetujui</p>
            <div class="mt-4">
                <span class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M5 13l4 4L19 7" />
                    </svg>
                    Transfer Nilai Telah Disetujui
                </span>
            </div>
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
                                <div class="text-2xl font-bold text-blue-700" id="totalSks">{{ $totalSks }}</div>
                                <div class="text-xs text-blue-600 font-medium">Total SKS</div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-4 border border-green-200">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-700" id="convertedSks">{{ $convertedSks }}</div>
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
                    <span id="progressPercent">{{ $calculatedPercentage }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2 rounded-full transition-all duration-500"
                        style="width: 0%"
                        id="progressBar2"
                        data-percentage="{{ $calculatedPercentage }}"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Hasil Transfer Nilai (sama seperti bagian AJAX) --}}
    <div class="transfer-card rounded-3xl shadow-xl p-8">
        <div class="mb-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Hasil Transfer Nilai</h2>
                <div class="ml-auto text-sm text-gray-500">
                    Diproses pada: {{ $transferNilai->first()->created_at->format('d F Y') ?? '-' }}
                </div>
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
                                NILAI LAMA
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
                    @forelse($transferNilai as $i => $row)
                    <tr class="table-row transition-all duration-300">
                        <td class="py-5 px-6 text-gray-800">
                            <div class="flex items-center justify-center w-8 h-8 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-full text-sm font-bold text-blue-700">
                                {{ $i+1 }}
                            </div>
                        </td>
                        <td class="py-5 px-6">
                            <div class="font-semibold text-gray-800">{{ $row->transkrip->mata_kuliah }}</div>
                            <div class="text-xs text-gray-500 mt-1">{{ $row->transkrip->sks }} SKS</div>
                        </td>
                        <td class="py-5 px-6">
                            <span class="grade-badge inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold text-blue-800">
                                {{ $row->transkrip->nilai_huruf }}
                            </span>
                        </td>
                        <td class="py-5 px-6">
                            <div class="font-semibold text-gray-800">{{ $row->kurikulum->mata_kuliah_trpl }}</div>
                            <div class="text-xs text-gray-500 mt-1">{{ $row->kurikulum->sks }} SKS</div>
                        </td>
                        <td class="py-5 px-6">
                            <span class="grade-badge inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold
                                @if($row->nilai === 'A') bg-green-100 text-green-800
                                @elseif($row->nilai === 'B') bg-blue-100 text-blue-800
                                @elseif($row->nilai === 'C') bg-yellow-100 text-yellow-800
                                @elseif($row->nilai === 'D') bg-orange-100 text-orange-800
                                @elseif($row->nilai === 'E') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ $row->nilai ?? '-' }}
                            </span>
                        </td>
                        <td class="py-5 px-6">
                            <div class="text-sm text-gray-600">
                                {{ $row->catatan ?? 'Tidak ada catatan' }}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="text-lg font-medium">Belum ada data transfer nilai</p>
                                <p class="text-sm">Data transfer nilai akan ditampilkan di sini setelah diproses</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-between mt-8">
        <button onclick="window.print()" class="btn-secondary px-8 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak Hasil
        </button>

        <a href="{{ route('assesor.pendaftar') }}" class="btn-primary px-8 py-3 text-white rounded-xl font-semibold transition-all duration-300 flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Pendaftar
        </a>
    </div>

</x-layout_assessor>
@endif

<script>
    $(document).ready(function() {
        // Set progress bar values
        const percentage1 = $('#progressBar1').data('percentage');
        const percentage2 = $('#progressBar2').data('percentage');

        $('#progressBar1').css('width', percentage1 + '%');
        $('#progressBar2').css('width', percentage2 + '%');

        // Update status badge when dropdown changes
        const statusSelect = document.getElementById('transfer_status');
        if (statusSelect) {
            statusSelect.addEventListener('change', function() {
                const selectedValue = this.value;
                const badge = document.getElementById('transferStatusBadge');

                if (!badge) return;

                // Remove all existing classes
                badge.className = badge.className.replace(/bg-\w+-100|text-\w+-800/g, '');

                // Add new classes based on selected value
                switch (selectedValue) {
                    case 'sukses':
                        badge.className += ' bg-green-100 text-green-800';
                        badge.textContent = '✅ Sukses';
                        break;
                    case 'pending':
                        badge.className += ' bg-yellow-100 text-yellow-800';
                        badge.textContent = '⏳ Pending';
                        break;
                    case 'gagal':
                        badge.className += ' bg-red-100 text-red-800';
                        badge.textContent = '❌ Gagal';
                        break;
                    default:
                        badge.className += ' bg-blue-100 text-blue-800';
                        badge.textContent = '🔄 Proses';
                }
            });
        }

        // Form submission confirmation
        document.querySelector('form[action*="update-status"]')?.addEventListener('submit', function(e) {
            const selectedStatus = document.getElementById('transfer_status').value;
            const statusLabels = {
                'prosess': 'Proses',
                'sukses': 'Sukses',
                'pending': 'Pending',
                'gagal': 'Gagal'
            };

            if (!confirm(`Apakah Anda yakin ingin mengubah status transfer nilai menjadi "${statusLabels[selectedStatus]}"?`)) {
                e.preventDefault();
            }
        });

        // Search functionality
        $('#searchInput').on('keyup', function() {
            const searchValue = $(this).val().toLowerCase();
            let visibleRows = 0;

            $('.table-row').each(function() {
                const mataKuliahLama = $(this).find('td:nth-child(2) .font-semibold').text().toLowerCase();
                const mataKuliahTrpl = $(this).find('td:nth-child(4) .font-semibold').text().toLowerCase();

                if (mataKuliahLama.includes(searchValue) || mataKuliahTrpl.includes(searchValue)) {
                    $(this).show();
                    visibleRows++;
                } else {
                    $(this).hide();
                }
            });

            // Update row numbers for visible rows
            updateRowNumbers();
        });

        // Function to update row numbers
        function updateRowNumbers() {
            let counter = 1;
            $('.table-row:visible').each(function() {
                $(this).find('td:first-child .bg-gradient-to-r').text(counter);
                counter++;
            });
        }
    });
</script>