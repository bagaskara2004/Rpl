<x-layout_assessor>
    @vite('resources/css/app.css')

    <div class="mb-6">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('assesor.pendaftar') }}" class="flex items-center text-gray-600 hover:text-gray-800">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                Kembali ke Pendaftar
            </a>
        </div>
        <h1 class="text-3xl font-bold text-gray-800">Detail Data Diri</h1>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <!-- Header dengan foto -->
        <div class="flex flex-col md:flex-row gap-6 mb-6">
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $dataDiri->nama_lengkap }}</h2>
                <p class="text-gray-600">{{ $dataDiri->email }}</p>
            </div>
            @if($dataDiri->foto)
            <div class="flex justify-center md:justify-end">
                <img src="{{ asset('assets/' . $dataDiri->foto) }}" alt="Foto"
                    class="w-24 h-24 object-cover rounded-full border-4 border-gray-200">
            </div>
            @endif
        </div>

        <!-- Data Pribadi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Data Pribadi</h3>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Tanggal Lahir</label>
                        <p class="text-gray-800">{{ $dataDiri->tgl_lahir ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Jenis Kelamin</label>
                        <p class="text-gray-800">{{ $dataDiri->jenis_kelamin ?? '-' }}</p>
                    </div>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Kontak</h3>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">No HP</label>
                        <p class="text-gray-800">{{ $dataDiri->hp ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">No Telepon</label>
                        <p class="text-gray-800">{{ $dataDiri->tlp ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Alamat</label>
                        <p class="text-gray-800">{{ $dataDiri->alamat ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Kab/Kota</label>
                        <p class="text-gray-800">{{ $dataDiri->kab_kota ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Provinsi</label>
                        <p class="text-gray-800">{{ $dataDiri->provinsi ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Kode Pos</label>
                        <p class="text-gray-800">{{ $dataDiri->kode_pos ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Keluarga -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Data Orang Tua</h3>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Nama Ayah</label>
                        <p class="text-gray-800">{{ $dataDiri->nama_ayah ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Pekerjaan Ayah</label>
                        <p class="text-gray-800">{{ $dataDiri->pekerjaan_ayah ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Nama Ibu</label>
                        <p class="text-gray-800">{{ $dataDiri->nama_ibu ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Pekerjaan Ibu</label>
                        <p class="text-gray-800">{{ $dataDiri->pekerjaan_ibu ?? '-' }}</p>
                    </div>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Pendanaan</h3>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Sumber Biaya Pendidikan</label>
                        <p class="text-gray-800">{{ $dataDiri->sumber_biaya_pen ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Pendidikan -->
        @if($dataDiri->pendidikan)
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Data Pendidikan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Program Studi</label>
                        <p class="text-gray-800">{{ $dataDiri->pendidikan->prodi ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Jurusan</label>
                        <p class="text-gray-800">{{ $dataDiri->pendidikan->jurusan ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">NIM</label>
                        <p class="text-gray-800">{{ $dataDiri->pendidikan->nim ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Jenjang Pendidikan</label>
                        <p class="text-gray-800">{{ $dataDiri->pendidikan->jenjang_pendidikan ?? '-' }}</p>
                    </div>
                </div>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Tahun Lulus</label>
                        <p class="text-gray-800">{{ $dataDiri->pendidikan->tahun_lulus ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">IPK</label>
                        <p class="text-gray-800">{{ $dataDiri->pendidikan->ipk ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Pembimbing 1</label>
                        <p class="text-gray-800">{{ $dataDiri->pendidikan->pembimbing1 ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Judul Tugas Akhir</label>
                        <p class="text-gray-800">{{ $dataDiri->pendidikan->judul_ta ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Pengalaman Kerja -->
        @if($dataDiri->pengalamanKerja && $dataDiri->pengalamanKerja->count() > 0)
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Pengalaman Kerja</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">No</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Perusahaan</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Alamat</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Periode</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Kontak Staf</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Dokumen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($dataDiri->pengalamanKerja as $index => $kerja)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $kerja->nama_perusahaan ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                {{ $kerja->alamat_perusahaan ?? '-' }}<br>
                                <small class="text-gray-600">
                                    {{ $kerja->kota_kab_perusahaan ?? '' }} {{ $kerja->provinsi_perusahaan ?? '' }}
                                    {{ $kerja->negara_perusahaan ?? '' }}
                                </small>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                {{ $kerja->sejak ?? '-' }} s/d {{ $kerja->sampai ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                <strong>{{ $kerja->nama_staf ?? '-' }}</strong><br>
                                <small class="text-gray-600">{{ $kerja->posisi_staf ?? '' }}</small><br>
                                <small class="text-gray-600">{{ $kerja->tlp_staf ?? '' }}</small><br>
                                <small class="text-gray-600">{{ $kerja->email_staf ?? '' }}</small>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @if($kerja->dokumen_pendukung)
                                <a href="{{ asset('assets/' . $kerja->dokumen_pendukung) }}" target="_blank"
                                    class="text-blue-600 hover:text-blue-800">Lihat Dokumen</a>
                                @else
                                <span class="text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Pengalaman Kerja</h3>
            <p class="text-gray-500 italic">Tidak ada pengalaman kerja</p>
        </div>
        @endif

        <!-- Tombol Kembali -->
        <div class="flex justify-end">
            <a href="{{ route('assesor.index') }}"
                class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                Kembali ke Daftar Pendaftar
            </a>
        </div>
    </div>
</x-layout_assessor>