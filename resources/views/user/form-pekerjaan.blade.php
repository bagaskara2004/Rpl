{{-- {{ dd($data) }} --}}
<x-layout-formulir>
    <section class="bg-primary grid grid-cols-1">
        <form class="bg-white m-5 rounded p-5 flex flex-col justify-between md:m-15 md:p-10"
            action="{{ route('user.form.pekerjaan') }}" method="POST">
            @csrf

            @if ($data)
                @method('put')
            @endif

            <div>
                <div>
                    <div class="text-2xl inline-block font-semibold text-text mb-3">Form <span
                            class="text-primary">Pengalaman Kerja
                        </span>
                    </div>
                    <p class="font-semibold mb-10 text-gray-500">Lengkapi formulir dibawah ini !!
                    </p>
                </div>
                <div>
                    <input
                        class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                        id="id" type="hidden" name="id"
                        value="{{ old('id', $data->id ?? '') }}">
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="namaperusahaan">
                            Nama Perusahaan
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="namaperusahaan" type="text" name="nama_perusahaan"
                            value="{{ old('nama_perusahaan', $data->nama_perusahaan ?? '') }}">
                        @error('nama_perusahaan')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="alamat">
                            Alamat
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="alamat" type="text" name="alamat_perusahaan"
                            value="{{ old('alamat_perusahaan', $data->alamat_perusahaan ?? '') }}">
                        @error('alamat_perusahaan')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid md:grid-cols-3 md:gap-5">
                        <div class="mb-4">
                            <label class="block text-text font-semibold mb-2" for="negara">
                                Negara
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="negara" type="text" name="negara_perusahaan"
                                value="{{ old('negara_perusahaan', $data->negara_perusahaan ?? '') }}">
                            @error('negara_perusahaan')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-text font-semibold mb-2" for="Provinsi">
                                Provinsi
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="Provinsi" type="text" name="provinsi_perusahaan"
                                value="{{ old('provinsi_perusahaan', $data->provinsi_perusahaan ?? '') }}">
                            @error('provinsi_perusahaan')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-text font-semibold mb-2" for="Kabupaten">
                                Kab/Kota
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="Kabupaten" type="text" name="kota_kab_perusahaan"
                                value="{{ old('kota_kab_perusahaan', $data->kota_kab_perusahaan ?? '') }}">
                            @error('kota_kab_perusahaan')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>


                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="sejak">
                            Sejak
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="sejak" type="date" name="sejak"
                            value="{{ old('sejak', $data->sejak ?? '') }}">
                        @error('sejak')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="sampai">
                            Sampai
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="sampai" type="date" name="sampai"
                            value="{{ old('sampai', $data->sampai ?? '') }}">
                        @error('sampai')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <label class="block text-primary font-semibold py-4 border-b-2 mb-4 border-accent" for="sampai">
                        Staf yang dapat dihubungi
                    </label>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="namastaf">
                            Nama Staf
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="namastaf" type="text" name="nama_staf"
                            value="{{ old('nama_staf', $data->nama_staf ?? '') }}">
                        @error('nama_staf')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="telp">
                            No Telepon
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="telp" type="number" name="tlp_staf"
                            value="{{ old('tlp_staf', $data->tlp_staf ?? '') }}">
                        @error('tlp_staf')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="posisi">
                            Posisi
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="posisi" type="text" name="posisi_staf"
                            value="{{ old('posisi_staf', $data->posisi_staf ?? '') }}">
                        @error('posisi_staf')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="email">
                            Email
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="email" type="email" name="email_staf"
                            value="{{ old('email_staf', $data->email_staf ?? '') }}">
                        @error('email_staf')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <label class="block text-primary font-semibold py-4 border-b-2 mb-4 border-accent" for="sampai">
                        Posisi di perusahaan
                    </label>

                    <div class="grid md:grid-cols-3 md:gap-5">
                        <div class="mb-4">
                            <label class="block text-text font-semibold mb-2" for="posisi">
                                Posisi
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="posisi" type="text" name="posisi"
                                value="{{ old('posisi', $data->posisi ?? '') }}">
                            @error('posisi')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-text font-semibold mb-2" for="durasi">
                                Durasi( bulan )
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="durasi" type="number" name="durasi"
                                value="{{ old('durasi', $data->durasi ?? '') }}">
                            @error('durasi')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-text font-semibold mb-2" for="prestasi">
                                Prestasi
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="prestasi" type="text" name="prestasi"
                                value="{{ old('prestasi', $data->prestasi ?? '') }}">
                            @error('prestasi')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
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
