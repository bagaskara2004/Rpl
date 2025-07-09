@extends('components.layout_admin')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.transfer.index') }}"
                class="inline-flex items-center justify-center w-10 h-10 rounded-full text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0 0 50 50">
                    <path d="M 13.082031 12.980469 C 12.492188 12.960938 11.925781 13.203125 11.53125 13.640625 L 1.023438 25 L 11.53125 36.359375 C 12.011719 36.894531 12.746094 37.132813 13.453125 36.976563 C 14.15625 36.820313 14.722656 36.296875 14.933594 35.605469 C 15.144531 34.914063 14.96875 34.164063 14.46875 33.640625 L 8.324219 27 L 47 27 C 47.722656 27.011719 48.390625 26.632813 48.753906 26.007813 C 49.121094 25.386719 49.121094 24.613281 48.753906 23.992188 C 48.390625 23.367188 47.722656 22.988281 47 23 L 8.324219 23 L 14.46875 16.359375 C 15.011719 15.785156 15.167969 14.949219 14.867188 14.21875 C 14.570313 13.492188 13.871094 13.003906 13.082031 12.980469 Z"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Transfer Nilai</h1>
                <p class="text-gray-600 text-sm">Informasi lengkap hasil transfer nilai mahasiswa</p>
            </div>
        </div>
    </div>

    <!-- Student Information Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center space-x-6">
            <!-- Avatar -->
            <div class="flex-shrink-0">
                <div class="h-20 w-20 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center">
                    <span class="text-white text-2xl font-bold">
                        {{ strtoupper(substr($user->dataDiri->nama_lengkap ?? $user->name ?? 'U', 0, 1)) }}
                    </span>
                </div>
            </div>

            <!-- Student Info -->
            <div class="flex-1">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Nama Lengkap</label>
                        <p class="text-lg font-semibold text-gray-900">{{ $user->dataDiri->nama_lengkap ?? $user->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                        <p class="text-lg text-gray-900">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Jurusan Asal</label>
                        <p class="text-lg text-gray-900">{{ $user->pendidikan->jurusan ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Program Studi Asal</label>
                        <p class="text-lg text-gray-900">{{ $user->pendidikan->prodi ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Total SKS Badge -->
            <div class="flex-shrink-0">
                <div class="text-center">
                    <div class="bg-green-100 rounded-full p-4 mb-2">
                        <svg class="w-8 h-8 text-green-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-green-600">{{ $transferNilai->sum('kurikulum.sks') }}</p>
                    <p class="text-sm text-gray-500">Total SKS Transfer</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Transfer Results Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-900">Hasil Transfer Nilai</h2>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                {{ count($transferNilai) }} Mata Kuliah
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah TRPL</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah Asal</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Asal</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Transfer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assessor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($transferNilai as $i => $transfer)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $i + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $transfer->kurikulum->mata_kuliah_trpl ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $transfer->kurikulum->sks ?? 0 }} SKS
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $transfer->transkripNilai->mata_kuliah ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $transfer->transkripNilai->sks ?? 0 }} SKS</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if($transfer->transkripNilai->nilai_huruf == 'A') bg-green-100 text-green-800
                                @elseif($transfer->transkripNilai->nilai_huruf == 'B') bg-blue-100 text-blue-800
                                @elseif($transfer->transkripNilai->nilai_huruf == 'C') bg-yellow-100 text-yellow-800
                                @elseif($transfer->transkripNilai->nilai_huruf == 'D') bg-orange-100 text-orange-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $transfer->transkripNilai->nilai_huruf ?? $transfer->transkripNilai->nilai_angka ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if($transfer->nilai == 'A') bg-green-100 text-green-800
                                @elseif($transfer->nilai == 'B') bg-blue-100 text-blue-800
                                @elseif($transfer->nilai == 'C') bg-yellow-100 text-yellow-800
                                @elseif($transfer->nilai == 'D') bg-orange-100 text-orange-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $transfer->nilai ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $transfer->assessor->name ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $transfer->catatan ?? 'Tidak ada catatan' }}</div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-sm">Belum ada data transfer nilai</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Summary Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Transfer</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="bg-blue-100 rounded-full p-3 w-16 h-16 mx-auto mb-2 flex items-center justify-center">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <p class="text-2xl font-bold text-blue-600">{{ count($transferNilai) }}</p>
                <p class="text-sm text-gray-500">Mata Kuliah Dikonversi</p>
            </div>
            
            <div class="text-center">
                <div class="bg-green-100 rounded-full p-3 w-16 h-16 mx-auto mb-2 flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-2xl font-bold text-green-600">{{ $transferNilai->sum('kurikulum.sks') }}</p>
                <p class="text-sm text-gray-500">Total SKS Transfer</p>
            </div>
            
            <div class="text-center">
                <div class="bg-purple-100 rounded-full p-3 w-16 h-16 mx-auto mb-2 flex items-center justify-center">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <p class="text-2xl font-bold text-purple-600">{{ $transferNilai->where('status', 1)->count() }}</p>
                <p class="text-sm text-gray-500">Disetujui</p>
            </div>
        </div>
    </div>
</div>
@endsection
