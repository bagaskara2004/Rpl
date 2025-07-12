<x-layout-user>

    <div class="min-h-screen bg-gray-100 p-6 md:p-10">
        <div class="max-w-7xl px-5 pt-20 pb-10 lg:px-8 mx-auto">

            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Informasi Formulir</h1>
                <a href="{{ route('user.rpl') }}"
                    class="inline-block bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400 transition">
                    Kembali &rightarrow;</a>
            </div>

            <!-- Formulir Data Diri -->
            <div class="bg-white rounded-2xl p-6 shadow-lg mb-10">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-primary">Data Diri</h2>
                    {{-- <span class="font-semibold {{ $datadiri->status == 'sukses' ? 'text-green-600' : ($datadiri->status == 'gagal' ? 'text-red-600' : 'text-yellow-500') }}">{{ $datadiri->status }}</span> --}}
                </div>
                <div class="space-y-3 text-gray-700">
                    @foreach ($datadiri->toArray() as $field => $value)
                        @if ($field != 'foto' && $field != 'cv' && $field != 'status')
                            <p><span class="font-medium">{{ $field }} :</span> {{ $value }}</p>
                        @endif

                        @if ($field === 'foto' || $field === 'cv')
                            <p><span class="font-medium">{{ $field }} :</span> <a
                                    href="{{ asset('storage/' . $value) }}" target="_blank" class="text-accent">klik
                                    untuk melihat file</a></p>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Formulir Pendidikan -->
            <div class="bg-white rounded-2xl p-6 shadow-lg mb-10">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-primary">Pendidikan</h2>
                    {{-- <span class="font-semibold {{ $datadiri->status == 'sukses' ? 'text-green-600' : ($datadiri->status == 'gagal' ? 'text-red-600' : 'text-yellow-500') }}">{{ $datadiri->status }}</span> --}}
                </div>
                <div class="space-y-3 text-gray-700">
                    @foreach ($pendidikan->toArray() as $field => $value)
                        @if ($field != 'ijasah' && $field != 'transkrip')
                            <p><span class="font-medium">{{ $field }} :</span> {{ $value }}</p>
                        @endif

                        @if ($field === 'ijasah' || $field === 'transkrip')
                            <p><span class="font-medium">{{ $field }} :</span> <a
                                    href="{{ asset('storage/' . $value) }}" target="_blank" class="text-accent">klik
                                    untuk melihat file</a></p>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Formulir Transkrip -->
            <div class="bg-white rounded-2xl p-6 shadow-lg mb-10">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-primary">Transkrip</h2>
                </div>

                <div class="space-y-3 text-gray-700">

                    @foreach ($transkrip as $data)
                        <div class="border border-gray-200 p-5 rounded-xl hover:shadow-md transition bg-gray-50">
                            <p class=" mb-2"><span class="font-medium">mata_kuliah :</span>
                                {{ $data->mata_kuliah }}</p>
                            <p class=" mb-2"><span class="font-medium">sks :</span> {{ $data->sks }}
                            </p>
                            <p class=" mb-2"><span class="font-medium">nilai_huruf :</span>
                                {{ $data->nilai_huruf }}</p>
                            <p class=""><span class="font-medium">nilai angka :</span>
                                {{ $data->nilai_angka }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Formulir Pekerjaan -->
            <div class="bg-white rounded-2xl p-6 shadow-lg mb-10">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-primary">Pengalaman Kerja</h2>
                </div>

                <div class="space-y-3 text-gray-700">

                    @foreach ($pekerjaan as $data)
                        <div class="border border-gray-200 p-5 rounded-xl hover:shadow-md transition bg-gray-50">
                            <p class="mb-2"><span class="font-medium">perusahaan :</span>
                                {{ $data->nama_perusahaan }}</p>
                            <p class="mb-2"><span class="font-medium">alamat :</span>
                                {{ $data->alamat_perusahaan }}
                            </p>
                            <p class="mb-2"><span class="font-medium">kab/kota :</span>
                                {{ $data->kota_kab_perusahaan }}</p>
                            <p class="mb-2"><span class="font-medium">provinsi :</span>
                                {{ $data->provinsi_perusahaan }}</p>
                            <p class="mb-2"><span class="font-medium">negara :</span>
                                {{ $data->negara_perusahaan }}</p>
                            <p class="mb-2"><span class="font-medium">sejak :</span>
                                {{ $data->sejak }}</p>
                            <p class="mb-2"><span class="font-medium">sampai :</span>
                                {{ $data->sampai }}</p>
                            <p class="mb-2"><span class="font-medium">nama_staf :</span>
                                {{ $data->nama_staf }}</p>
                            <p class="mb-2"><span class="font-medium">posisi_staf :</span>
                                {{ $data->posisi_staf }}</p>
                            <p class="mb-2"><span class="font-medium">tlp_staf :</span>
                                {{ $data->tlp_staf }}</p>
                            <p class="mb-2"><span class="font-medium">email_staf :</span>
                                {{ $data->email_staf }}</p>
                            <p class="mb-2"><span class="font-medium">posisi :</span>
                                {{ $data->posisi }}</p>
                            <p class="mb-2"><span class="font-medium">prestasi :</span>
                                {{ $data->prestasi }}</p>
                            <p class="mb-2"><span class="font-medium">durasi :</span>
                                {{ $data->durasi }} bulan</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Formulir Pelatihan -->
            <div class="bg-white rounded-2xl p-6 shadow-lg mb-10">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-primary">Pelatihan</h2>
                </div>

                <div class="space-y-3 text-gray-700">
                    @foreach ($pelatihan as $data)
                        <div class="border border-gray-200 p-5 rounded-xl hover:shadow-md transition bg-gray-50">
                            <p class="mb-2"><span class="font-medium">pelatihan :</span>
                                {{ $data->nama_pelatihan }}</p>
                            <p class="mb-2"><span class="font-medium">penyelenggara :</span>
                                {{ $data->penyelenggara }}</p>
                            <p class="mb-2"><span class="font-medium">peran :</span>
                                {{ $data->peran }}</p>
                            <p class="mb-2"><span class="font-medium">sertifikat :</span>
                                <a href="{{ asset('storage/' . $data->sertifikat) }}" target="_blank"
                                    class="text-accent">klik
                                    untuk melihat file</a>
                            </p>
                            <p class="text-gray-800 mb-2"><span class="font-medium">durasi :</span>
                                {{ $data->durasi }} hari</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


</x-layout-user>
