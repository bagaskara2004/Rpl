<x-layout-formulir>
    <section class="bg-primary grid grid-cols-1">
        <form class="bg-white m-5 rounded p-5 flex flex-col justify-between md:m-15 md:p-10"
            action="{{ route('user.form.pendidikan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($data)
                @method('PUT')
            @endif
            <div>
                <div>
                    <div class="text-2xl inline-block font-semibold text-text mb-3">Form <span
                            class="text-primary">Pendidikan</span>
                    </div>
                    <p class="font-semibold mb-10 text-gray-500">Lengkapi formulir dibawah ini !!
                    </p>
                </div>
                <div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="namaperguruantinggi">
                            Nama Perguruan Tinggi
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="namaperguruantinggi" type="text" name="nama_perguruan"
                            value="{{ old('nama_perguruan', $data->nama_perguruan ?? '') }}">
                        @error('nama_perguruan')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="nim">
                            Nim
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="nim" type="number" name="nim"
                            value="{{ old('nim', $data->nim ?? '') }}">
                        @error('nim')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="jenjang">
                            Jenjang Pendidikan
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="jenjang" type="text" name="jenjang_pendidikan"
                            value="{{ old('jenjang_pendidikan', $data->jenjang_pendidikan ?? '') }}">
                        @error('jenjang_pendidikan')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="jurusan">
                            Jurusan
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="jurusan" type="text" name="jurusan"
                            value="{{ old('jurusan', $data->jurusan ?? '') }}">
                        @error('jurusan')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="programstudi">
                            Program Studi
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="programstudi" type="text" name="prodi"
                            value="{{ old('prodi', $data->prodi ?? '') }}">
                        @error('prodi')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="tahunmasuk">
                            Tahun Masuk
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="tahunmasuk" type="date" name="tahun_masuk"
                            value="{{ old('tahun_masuk', $data->tahun_masuk ?? '') }}">
                        @error('tahun_masuk')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="tahunlulus">
                            Tahun Lulus
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="tahunlulus" type="date" name="tahun_lulus"
                            value="{{ old('tahun_lulus', $data->tahun_lulus ?? '') }}">
                        @error('tahun_lulus')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="ipk">
                            IPK
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="ipk" type="number" name="ipk" step="0.01"
                            value="{{ old('ipk', $data->ipk ?? '') }}">
                        @error('ipk')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="judulta">
                            Judul TA
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="judulta" type="text" name="judul_ta"
                            value="{{ old('judul_ta', $data->judul_ta ?? '') }}">
                        @error('judul_ta')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="namapembimbingta">
                            Nama Pembimbing TA
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="namapembimbingta" type="text" name="pembimbing1"
                            value="{{ old('pembimbing1', $data->pembimbing1 ?? '') }}">
                        @error('pembimbing1')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>



                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="ijasah">
                            File Ijasah
                        </label>
                        @if ($data)
                            <a href="{{ asset('storage/' . $data->ijasah) }}" target="_blank"
                                class="text-accent">klik
                                untuk melihat ijasah sebelumnya</a>
                        @endif
                        <input id="ijasah" type="file" name="ijasah"
                            class="mt-2 block w-full border-2  text-gray-500 rounded text-sm file:mr-4 file:rounded file:border-e-2 file:bg-gray-200 file:py-3 file:px-4 file:text-sm file:font-semibold file:text-gray-500 hover:file:bg-gray-200 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                        @error('ijasah')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-10">
                        <label class="block text-text font-semibold mb-2" for="transkrip">
                            File Transkrip
                        </label>
                        @if ($data)
                            <a href="{{ asset('storage/' . $data->transkrip) }}" target="_blank"
                                class="text-accent">klik
                                untuk melihat transkrip sebelumnya</a>
                        @endif
                        <input id="transkrip" type="file" name="transkrip"
                            class="mt-2 block w-full border-2  text-gray-500 rounded text-sm file:mr-4 file:rounded file:border-e-2 file:bg-gray-200 file:py-3 file:px-4 file:text-sm file:font-semibold file:text-gray-500 hover:file:bg-gray-200 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                        @error('transkrip')
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
