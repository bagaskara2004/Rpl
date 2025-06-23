<x-layout_assessor>
    @vite('resources/css/app.css')

    <div class="mb-6">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('assesor.index') }}" class="flex items-center text-gray-600 hover:text-gray-800">
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
                </div>
            </div>
            @else
            <div class="text-center py-8">
                <p class="text-gray-500 italic">Tidak ada pertanyaan asesmen tersedia</p>
            </div>
            @endif
        </div>

        <!-- Tombol Aksi -->
        <div class="flex flex-col sm:flex-row gap-4 justify-between">
            <a href="{{ route('assesor.index') }}"
                class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition text-center">
                Kembali ke Daftar Pendaftar
            </a>

            <div class="flex gap-2">
                <a href="{{ route('assesor.datadiri.show', $dataDiri->id) }}"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-center">
                    Lihat Data Diri
                </a>
                <a href="{{ route('assesor.transfer-nilai', $dataDiri->id) }}"
                    class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition text-center">
                    Transfer Nilai
                </a>
            </div>
        </div>
    </div>
</x-layout_assessor>