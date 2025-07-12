@extends('components.layout_admin')

@section('content')
@vite('resources/css/app.css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="mb-6">
    <div class="flex items-center gap-4 mb-4">
        <a href="{{ route('admin.pendaftar.index') }}" class="flex items-center text-gray-600 hover:text-gray-800">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M19 12H5M12 19l-7-7 7-7" />
            </svg>
            Kembali ke Pendaftar
        </a>
    </div>
    <h1 class="text-3xl font-bold text-gray-800">Asesmen Pendaftar</h1>
</div>

<div class="bg-white rounded-2xl shadow p-6">
    <!-- Header dengan info pendaftar -->
    <div class="flex flex-col md:flex-row gap-6 mb-6 pb-6 border-b border-gray-200">
        <div class="flex-1">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $dataDiri->nama_lengkap }}</h2>
            <p class="text-gray-600 mb-2">{{ $dataDiri->email }}</p>
            @if($dataDiri->pendidikan)
            <p class="text-gray-600">Jurusan {{ $dataDiri->pendidikan->jurusan ?? '-' }}</p>
            @endif
        </div>
        @if($dataDiri->foto)
        <div class="flex justify-center md:justify-end">
            <img src="{{ asset('assets/' . $dataDiri->foto) }}" alt="Foto"
                class="w-24 h-24 object-cover rounded-full border-4 border-gray-200">
        </div>
        @endif
    </div>

    <!-- Tabel Asesmen -->
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Hasil Asesmen</h3>

        @if($pertanyaan->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600" style="width: 60px">No.</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Pertanyaan</th>
                        <th class="px-4 py-3 text-center text-sm font-medium text-gray-600" style="width: 100px">Jawaban</th>
                    </tr>
                    <tr class="border-t border-gray-200">
                        <th class="px-4 py-2 text-center text-xs text-gray-500"></th>
                        <th class="px-4 py-2 text-center text-xs text-gray-500"></th>
                        <th class="px-4 py-2 text-center text-xs text-gray-500">
                            <div class="flex justify-center gap-8">
                                <span>Ya</span>
                                <span>Tidak</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($pertanyaan as $index => $q)
                    @php
                    $jawabanObj = $assessment->where('pertanyaan_id', $q->id)->first();
                    $yesChecked = $jawabanObj && $jawabanObj->jawaban == 0;
                    $noChecked = $jawabanObj && $jawabanObj->jawaban == 1;
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $index + 1 }}.</td>
                        <td class="px-4 py-3 text-sm text-gray-800">{{ $q->pertanyaan }}</td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-8">
                                <div class="flex items-center">
                                    <input type="checkbox" {{ $yesChecked ? 'checked' : '' }} disabled
                                        class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" {{ $noChecked ? 'checked' : '' }} disabled
                                        class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Summary -->
        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
            <h4 class="font-semibold text-gray-800 mb-2">Ringkasan Asesmen</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div>
                    <span class="text-gray-600">Total Pertanyaan:</span>
                    <span class="font-medium text-gray-800">{{ $pertanyaan->count() }}</span>
                </div>
                <div>
                    <span class="text-gray-600">Jawaban "Ya":</span>
                    <span class="font-medium text-green-600">{{ $assessment->where('jawaban', 0)->count() }}</span>
                </div>
                <div>
                    <span class="text-gray-600">Jawaban "Tidak":</span>
                    <span class="font-medium text-red-600">{{ $assessment->where('jawaban', 1)->count() }}</span>
                </div>
                <div>
                    <span class="text-gray-600">Status Terkini:</span>
                    @php
                    $currentStatuses = $assessment->groupBy('status')->map->count();
                    @endphp
                    <div class="flex flex-wrap gap-1 mt-1">
                        @foreach($currentStatuses as $status => $count)
                        @php
                        $statusColors = [
                        'prosess' => 'bg-yellow-100 text-yellow-800',
                        'pending' => 'bg-gray-100 text-gray-800',
                        'sukses' => 'bg-green-100 text-green-800',
                        'gagal' => 'bg-red-100 text-red-800'
                        ];
                        $statusLabels = [
                        'prosess' => 'Proses',
                        'pending' => 'Pending',
                        'sukses' => 'Sukses',
                        'gagal' => 'Gagal'
                        ];
                        @endphp
                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ $statusLabels[$status] ?? $status }}: {{ $count }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Update Section -->
        <div class="mt-6 border-t border-gray-200 pt-6">
            <form action="{{ route('assesor.assessment.update-status', $dataDiri->user_id) }}" method="POST" class="flex flex-col md:flex-row gap-4 items-end justify-between">
                @csrf
                @method('POST')

                <div class="flex-1 max-w-md">
                    <label for="assessment_status" class="block text-sm font-medium text-gray-600 mb-2">Status Asesmen</label>
                    <select name="status" id="assessment_status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @php
                        $currentStatus = $assessment->first()->status ?? 'prosess';
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
                        <span id="statusBadge" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
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
        @else
        <div class="text-center py-8">
            <p class="text-gray-500 italic">Tidak ada pertanyaan asesmen tersedia</p>
        </div>
        @endif
    </div>

    <!-- Tombol Aksi -->

</div>

<script>
    // Update status badge when dropdown changes
    document.getElementById('assessment_status').addEventListener('change', function() {
        const selectedValue = this.value;
        const badge = document.getElementById('statusBadge');

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

    // Form submission confirmation
    document.querySelector('form').addEventListener('submit', function(e) {
        const selectedStatus = document.getElementById('assessment_status').value;
        const statusLabels = {
            'prosess': 'Proses',
            'sukses': 'Sukses',
            'pending': 'Pending',
            'gagal': 'Gagal'
        };

        if (!confirm(`Apakah Anda yakin ingin mengubah status asesmen menjadi "${statusLabels[selectedStatus]}"?`)) {
            e.preventDefault();
        }
    });
</script>
@endsection