<x-layout-formulir>
    <section class="bg-primary grid grid-cols-1">
        <form class="bg-white m-5 rounded p-5 flex flex-col justify-between md:m-15 md:p-10"
            action="{{ route('user.form.datadiri') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($data)
                @method('PUT')
            @endif
            <div>
                <div>
                    <div class="text-2xl inline-block font-semibold text-text mb-3">Form <span class="text-primary">Data
                            Diri</span>
                    </div>
                    <p class="font-semibold mb-10 text-gray-500">Lengkapi formulir dibawah ini !!
                    </p>
                </div>
                <div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="NamaLengkap">
                            NamaLengkap
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="NamaLengkap" type="text" name="nama_lengkap"
                            value="{{ old('nama_lengkap', $data->nama_lengkap ?? '') }}">
                        @error('nama_lengkap')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="Email">
                            Email
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="Email" type="email" name="email" value="{{ old('email', $data->email ?? '') }}">
                        @error('email')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="Alamat">
                            Alamat
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="Alamat" type="text" name="alamat"
                            value="{{ old('alamat', $data->alamat ?? '') }}">
                        @error('alamat')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid md:grid-cols-3 md:gap-5">
                        <div class="mb-4">
                            <label class="block text-text font-semibold mb-2" for="Provinsi">
                                Provinsi
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="Provinsi" type="text" name="provinsi"
                                value="{{ old('provinsi', $data->provinsi ?? '') }}">
                            @error('provinsi')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-text font-semibold mb-2" for="Kabupaten">
                                Kab/Kota
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="Kabupaten" type="text" name="kab_kota"
                                value="{{ old('kab_kota', $data->kab_kota ?? '') }}">
                            @error('kab_kota')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-text font-semibold mb-2" for="Kodepos">
                                Kode Pos
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="Kodepos" type="number" name="kode_pos"
                                value="{{ old('kode_pos', $data->kode_pos ?? '') }}">
                            @error('kode_pos')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 md:gap-5">
                        <div class="mb-4">
                            <label class="block text-text font-semibold mb-2" for="Telepon">
                                Telepon
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="Telepon" type="number" name="tlp"
                                value="{{ old('tlp', $data->tlp ?? '') }}">
                            @error('tlp')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-text font-semibold mb-2" for="hp">
                                HP
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="hp" type="number" name="hp" value="{{ old('hp', $data->hp ?? '') }}">
                            @error('hp')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2">
                            Jenis Kelamin
                        </label>

                        @php
                            $jk = old('jenis_kelamin', $data->jenis_kelamin ?? '');
                        @endphp

                        <label class="inline-flex items-center me-5">
                            <input type="radio" name="jenis_kelamin" value="laki-laki"
                                class="form-radio text-blue-600 h-5 w-5"
                                {{ $jk == 'laki-laki' ? 'checked' : 'checked' }}>
                            <span class="ml-2 text-gray-700">Laki-laki</span>
                        </label>

                        <label class="inline-flex items-center">
                            <input type="radio" name="jenis_kelamin" value="perempuan"
                                class="form-radio text-pink-500 h-5 w-5" {{ $jk == 'perempuan' ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700">Perempuan</span>
                        </label>
                    </div>

                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="tempatlahir">
                            TempatLahir
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="tempatlahir" type="text" name="tempat_lahir"
                            value="{{ old('tempat_lahir', $data->tempat_lahir ?? '') }}">
                        @error('tempat_lahir')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="tanggallahir">
                            TanggalLahir
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="tanggallahir" type="date" name="tgl_lahir"
                            value="{{ old('tgl_lahir', $data->tgl_lahir ?? '') }}">
                        @error('tgl_lahir')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="namaayah">
                            Nama Ayah
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="namaayah" type="text" name="nama_ayah"
                            value="{{ old('nama_ayah', $data->nama_ayah ?? '') }}">
                        @error('nama_ayah')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="pekerjaanayah">
                            Pekerjaan Ayah
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="pekerjaanayah" type="text" name="pekerjaan_ayah"
                            value="{{ old('pekerjaan_ayah', $data->pekerjaan_ayah ?? '') }}">
                        @error('pekerjaan_ayah')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="namaibu">
                            Nama Ibu
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="namaibu" type="text" name="nama_ibu"
                            value="{{ old('nama_ibu', $data->nama_ibu ?? '') }}">
                        @error('nama_ibu')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="pekerjaanibu">
                            Pekerjaan Ibu
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="pekerjaanibu" type="text" name="pekerjaan_ibu"
                            value="{{ old('pekerjaan_ibu', $data->pekerjaan_ibu ?? '') }}">
                        @error('pekerjaan_ibu')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="sumberbiaya">
                            Sumber Biaya
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="sumberbiaya" type="text" name="sumber_biaya_pendidikan"
                            value="{{ old('sumber_biaya_pendidikan', $data->sumber_biaya_pendidikan ?? '') }}">
                        @error('sumber_biaya_pendidikan')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>



                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="foto">
                            Foto 3x4
                        </label>
                        @if ($data)
                            <a href="{{ asset('storage/'.$data->foto) }}" target="_blank" class="text-accent">klik untuk melihat foto sebelumnya</a>
                        @endif
                        <input id="foto" type="file" name="foto"
                            class="mt-2 block w-full border-2  text-gray-500 rounded text-sm file:mr-4 file:rounded file:border-e-2 file:bg-gray-200 file:py-3 file:px-4 file:text-sm file:font-semibold file:text-gray-500 hover:file:bg-gray-200 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                        @error('foto')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-10">
                        <label class="block text-text font-semibold mb-2" for="cv">
                            File CV
                        </label>
                        @if ($data)
                            <a href="{{ asset('storage/'.$data->cv) }}" target="_blank" class="text-accent">klik untuk melihat cv sebelumnya</a>
                        @endif
                        <input id="cv" type="file" name="cv"
                            class="mt-2 block w-full border-2  text-gray-500 rounded text-sm file:mr-4 file:rounded file:border-e-2 file:bg-gray-200 file:py-3 file:px-4 file:text-sm file:font-semibold file:text-gray-500 hover:file:bg-gray-200 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                        @error('cv')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>




                </div>
            </div>
            <div class="grid gap-2">
                <button
                    class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-3 hover:opacity-80 w-full"
                    type="submit">Simpan</button>
                <a href="{{ route('user.rpl') }}"
                    class="text-sm/6 font-semibold text-text bg-background rounded px-8 py-3 hover:opacity-80 text-center block">Kembali</a>
            </div>
        </form>
    </section>
</x-layout-formulir>
