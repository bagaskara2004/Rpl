@extends('components.layout_admin')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-1">Detail Data Pribadi</h1>
            <p class="text-gray-600 text-sm">Informasi lengkap data pribadi mahasiswa</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.datadiri.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- User Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl p-6 text-white">
                <div class="text-center">
                    <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold">
                            {{ $user->dataDiri ? substr($user->dataDiri->nama_lengkap, 0, 1) : substr($user->user_name ?? 'U', 0, 1) }}
                        </span>
                    </div>
                    <h3 class="text-xl font-semibold mb-1">
                        {{ $user->dataDiri->nama_lengkap ?? $user->user_name ?? 'User' }}
                    </h3>
                    <p class="text-indigo-100 mb-4">{{ $user->email }}</p>

                    @php
                    $status = $user->dataDiri->status ?? 'pending';
                    $statusClass = '';
                    $statusText = '';
                    switch($status) {
                    case 'approved':
                    $statusClass = 'bg-green-500';
                    $statusText = 'Disetujui';
                    break;
                    case 'rejected':
                    $statusClass = 'bg-red-500';
                    $statusText = 'Ditolak';
                    break;
                    default:
                    $statusClass = 'bg-yellow-500';
                    $statusText = 'Pending';
                    break;
                    }
                    @endphp

                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusClass }} text-white">
                        {{ $statusText }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Detail Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Data Pribadi -->
            <div class="bg-white border border-gray-200 rounded-xl p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Data Pribadi
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Nama Lengkap</label>
                        <p class="text-gray-900">{{ $user->dataDiri->nama_lengkap ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                        <p class="text-gray-900">{{ $user->email ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Tempat Lahir</label>
                        <p class="text-gray-900">{{ $user->dataDiri->tempat_lahir ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Lahir</label>
                        <p class="text-gray-900">
                            {{ $user->dataDiri->tgl_lahir ? \Carbon\Carbon::parse($user->dataDiri->tgl_lahir)->format('d F Y') : '-' }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Jenis Kelamin</label>
                        <p class="text-gray-900">{{ ucfirst($user->dataDiri->jenis_kelamin ?? '-') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">No. Telepon</label>
                        <p class="text-gray-900">{{ $user->dataDiri->no_telp ?? '-' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-500 mb-1">Alamat</label>
                        <p class="text-gray-900">{{ $user->dataDiri->alamat ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Data Pendidikan -->
            @if($user->pendidikan)
            <div class="bg-white border border-gray-200 rounded-xl p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Data Pendidikan
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Jurusan</label>
                        <p class="text-gray-900">{{ $user->pendidikan->jurusan ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Program Studi</label>
                        <p class="text-gray-900">{{ $user->pendidikan->prodi ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Universitas</label>
                        <p class="text-gray-900">{{ $user->pendidikan->universitas ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">IPK</label>
                        <p class="text-gray-900">{{ $user->pendidikan->ipk ?? '-' }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Data Pengalaman Kerja -->
            @if($user->pengalamanKerja && $user->pengalamanKerja->count() > 0)
            <div class="bg-white border border-gray-200 rounded-xl p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                    </svg>
                    Pengalaman Kerja
                </h4>
                <div class="space-y-4">
                    @foreach($user->pengalamanKerja as $pengalaman)
                    <div class="border border-gray-100 rounded-lg p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Nama Perusahaan</label>
                                <p class="text-gray-900 font-medium">{{ $pengalaman->nama_perusahaan ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Posisi</label>
                                <p class="text-gray-900">{{ $pengalaman->posisi ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Mulai Kerja</label>
                                <p class="text-gray-900">
                                    {{ $pengalaman->tgl_mulai ? \Carbon\Carbon::parse($pengalaman->tgl_mulai)->format('F Y') : '-' }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Selesai Kerja</label>
                                <p class="text-gray-900">
                                    {{ $pengalaman->tgl_selesai ? \Carbon\Carbon::parse($pengalaman->tgl_selesai)->format('F Y') : 'Masih Bekerja' }}
                                </p>
                            </div>
                            @if($pengalaman->deskripsi)
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-500 mb-1">Deskripsi Pekerjaan</label>
                                <p class="text-gray-900">{{ $pengalaman->deskripsi }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection