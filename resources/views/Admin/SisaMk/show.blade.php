@extends('components.layout_admin')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.sisamk.index') }}"
                class="inline-flex items-center justify-center w-10 h-10 rounded-full text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Sisa Mata Kuliah</h1>
                <p class="text-gray-600 text-sm">Daftar mata kuliah yang belum diselesaikan</p>
            </div>
        </div>
    </div>

    <!-- Student Information Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center space-x-6">
            <!-- Avatar -->
            <div class="flex-shrink-0">
                <div class="h-20 w-20 rounded-full bg-gradient-to-r from-orange-500 to-red-600 flex items-center justify-center">
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
                        <label class="block text-sm font-medium text-gray-500 mb-1">Jurusan</label>
                        <p class="text-lg text-gray-900">{{ $user->pendidikan->jurusan ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Program Studi</label>
                        <p class="text-lg text-gray-900">{{ $user->pendidikan->prodi ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Sisa MK Badge -->
            <div class="flex-shrink-0">
                <div class="text-center">
                    <div class="bg-orange-100 rounded-full p-4 mb-2">
                        <svg class="w-8 h-8 text-orange-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-orange-600">{{ count($user->sisaMk) }}</p>
                    <p class="text-sm text-gray-500">Sisa MK</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sisa MK Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-900">Daftar Sisa Mata Kuliah</h2>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                {{ count($user->sisaMk) }} Mata Kuliah
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                       
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($user->sisaMk as $i => $sisaMk)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $i + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $sisaMk->kurikulum->mata_kuliah_trpl ?? 'Mata Kuliah Tidak Ditemukan' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $sisaMk->kurikulum->sks ?? 0 }} SKS
                            </span>
                        </td>
                        
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm">Tidak ada sisa mata kuliah</p>
                                <p class="text-xs text-gray-400 mt-1">Semua mata kuliah sudah diselesaikan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(count($user->sisaMk) > 0)
        <!-- Summary -->
        <div class="mt-6 bg-orange-50 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-orange-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="text-sm">
                    <span class="font-medium text-orange-900">Total SKS yang harus diselesaikan: </span>
                    <span class="font-bold text-orange-700">{{ $user->sisaMk->sum(function($sisaMk) { return $sisaMk->kurikulum->sks ?? 0; }) }} SKS</span>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection