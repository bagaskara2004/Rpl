<x-lyout_asesor>
    @vite('resources/css/app.css')
    <!-- Tambahkan Bootstrap CSS dan JS jika belum ada -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Import Inter font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif !important;
        }

        .inter-font,
        .bg-white,
        .rounded-2xl,
        .shadow,
        .text-gray-800,
        .font-bold,
        .font-medium,
        .font-semibold,
        .text-xs,
        .text-sm,
        .text-base,
        .text-lg,
        .text-xl,
        .text-3xl,
        .btn,
        .modal-content,
        .form-control,
        select,
        option,
        th,
        td,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        label,
        input,
        button,
        .list-group-item {
            font-family: 'Inter', sans-serif !important;
        }
    </style>

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
        <table class="min-w-full text-sm border-separate border-spacing-0 rounded-2xl overflow-hidden">
            <thead>
                <tr class="bg-gray-50">
                    <th class="py-3 px-4 text-left font-bold text-gray-700 border-b">No</th>
                    <th class="py-3 px-4 text-left font-bold text-gray-700 border-b">NAME</th>
                    <th class="py-3 px-4 text-left font-bold text-gray-700 border-b">MAJOR</th>
                    <th class="py-3 px-4 text-center font-bold text-gray-700 border-b">ACTION</th>
                    <th class="py-3 px-4 text-center font-bold text-gray-700 border-b">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dataDiri as $i => $diri)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="py-3 px-4">{{ $i+1 }}</td>
                    <td class="py-3 px-4">{{ $diri->nama_lengkap }}</td>
                    <td class="py-3 px-4">Jurusan {{ $diri->pendidikan->jurusan ?? '-' }}</td>
                    <td class="py-3 px-4 text-center">
                        <div class="inline-flex gap-2">
                            <button class="w-8 h-8 flex items-center justify-center rounded bg-gray-100 border border-gray-200">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M5 13l4 4L19 7" />
                                </svg>
                            </button>
                            <button class="w-8 h-8 flex items-center justify-center rounded bg-gray-100 border border-gray-200">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </td>
                    <td class="py-3 px-4 text-center">
                        <div class="inline-flex gap-2">
                            <button class="px-4 py-1 rounded border border-primary text-primary bg-white hover:bg-primary hover:text-white text-xs font-semibold" data-bs-toggle="modal" data-bs-target="#modalDataDiri{{ $diri->id }}">Data</button>
                            <button class="px-4 py-1 rounded border border-yellow-400 text-yellow-700 bg-white hover:bg-yellow-50 text-xs font-semibold">Asesmen</button>
                            <button class="px-4 py-1 rounded border border-purple-600 text-purple-700 bg-white hover:bg-purple-50 text-xs font-semibold">Transfer</button>
                        </div>
                    </td>
                </tr>
                <!-- Modal Bootstrap untuk Data Diri -->
                <div class="modal fade" id="modalDataDiri{{ $diri->id }}" tabindex="-1" aria-labelledby="modalDataDiriLabel{{ $diri->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDataDiriLabel{{ $diri->id }}">Detail Data Diri</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-2">
                                    <div class="col-md-6 mb-2"><strong>Nama Lengkap:</strong> {{ $diri->nama_lengkap }}</div>
                                    <div class="col-md-6 mb-2"><strong>Email:</strong> {{ $diri->user->email ?? '-' }}</div>
                                    <div class="col-md-6 mb-2"><strong>NIK:</strong> {{ $diri->nik }}</div>
                                    <div class="col-md-6 mb-2"><strong>Tempat, Tanggal Lahir:</strong> {{ $diri->tempat_lahir }}, {{ $diri->tanggal_lahir }}</div>
                                    <div class="col-md-6 mb-2"><strong>Alamat:</strong> {{ $diri->alamat }}</div>
                                    <div class="col-md-6 mb-2"><strong>No HP:</strong> {{ $diri->no_hp }}</div>
                                </div>
                                <hr>
                                <h6 class="fw-bold mt-3">Pendidikan</h6>
                                <div class="row mb-2">
                                    <div class="col-md-6 mb-2"><strong>Prodi:</strong> {{ $diri->pendidikan->prodi ?? '-' }}</div>
                                    <div class="col-md-6 mb-2"><strong>Jurusan:</strong> {{ $diri->pendidikan->jurusan ?? '-' }}</div>
                                </div>
                                <hr>
                                <h6 class="fw-bold mt-3">Pengalaman Kerja</h6>
                                @php
                                $pengalaman = \App\Models\PengalamanKerja::where('user_id', $diri->user_id)->get();
                                @endphp
                                @if($pengalaman->count())
                                <ul class="list-group mb-2">
                                    @foreach($pengalaman as $kerja)
                                    <li class="list-group-item">
                                        <strong>{{ $kerja->nama_perusahaan }}</strong> - {{ $kerja->posisi_staf }}<br>
                                        <span class="text-muted">{{ $kerja->sejak }} - {{ $kerja->sampai }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                                @else
                                <div class="text-muted">Tidak ada pengalaman kerja</div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-lyout_asesor>