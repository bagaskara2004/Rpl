<x-lyout_asesor>
    @vite('resources/css/app.css')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Pendaftar</h1>
        <div class="bg-white rounded-xl shadow px-4 py-3 flex flex-wrap items-center gap-4">
            <button class="flex items-center text-gray-600 hover:text-purple-700">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M8 12h8M12 8v8" />
                </svg>
                Filter By
            </button>
            <select class="border rounded px-3 py-1 text-sm">
                <option>Date</option>
            </select>
            <select class="border rounded px-3 py-1 text-sm">
                <option>Major Type</option>
            </select>
            <select class="border rounded px-3 py-1 text-sm">
                <option>Status</option>
            </select>
            <button class="flex items-center text-red-500 hover:text-red-700 ml-auto">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M18 6L6 18M6 6l12 12" />
                </svg>
                Reset Filter
            </button>
            <div class="ml-auto">
                <input type="text" placeholder="Search Data" class="border rounded px-3 py-1 text-sm w-56">
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-4">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="border-b">
                    <th class="py-2 px-4 text-left font-semibold text-gray-600">No</th>
                    <th class="py-2 px-4 text-left font-semibold text-gray-600">Nama Lengkap</th>
                    <th class="py-2 px-4 text-left font-semibold text-gray-600">Prodi</th>
                    <th class="py-2 px-4 text-left font-semibold text-gray-600">Jurusan</th>
                    <th class="py-2 px-4 text-center font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dataDiri as $i => $diri)
                <tr class="border-b">
                    <td class="py-2 px-4">{{ $i+1 }}</td>
                    <td class="py-2 px-4">{{ $diri->nama_lengkap }}</td>
                    <td class="py-2 px-4">{{ $diri->pendidikan->prodi ?? '-' }}</td>
                    <td class="py-2 px-4">{{ $diri->pendidikan->jurusan ?? '-' }}</td>

                    <td class="py-2 px-4 text-center space-x-2">
                        <button class="px-3 py-1 rounded bg-purple-100 text-purple-700 border border-purple-300 text-xs">Detail</button>
                        <button class="px-3 py-1 rounded bg-yellow-100 text-yellow-700 border border-yellow-300 text-xs">Asesmen</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="flex justify-between items-center mt-4 text-xs text-gray-500">
            <span>Showing 1-09 of 78</span>
            <div class="space-x-2">
                <button class="px-2 py-1 rounded border border-gray-300 hover:bg-gray-100">&lt;</button>
                <button class="px-2 py-1 rounded border border-gray-300 hover:bg-gray-100">&gt;</button>
            </div>
        </div>
    </div>
</x-lyout_asesor>