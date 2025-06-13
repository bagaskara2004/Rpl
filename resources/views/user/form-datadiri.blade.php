<x-layout-formulir>
    <section class="bg-primary grid grid-cols-1">
        <form class="bg-white m-5 rounded p-5 flex flex-col justify-between md:m-15 md:p-10" action="#" method="POST">
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
                            id="NamaLengkap" type="text" name="name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="Email">
                            Email
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="Email" type="email" name="email">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="Alamat">
                            Alamat
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="Alamat" type="text" name="alamat">
                    </div>

                    <div class="grid md:grid-cols-3 md:gap-5">
                        <div class="mb-4">
                            <label class="block text-text font-semibold mb-2" for="Provinsi">
                                Provinsi
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="Provinsi" type="text" name="provinsi">
                        </div>
                        <div class="mb-4">
                            <label class="block text-text font-semibold mb-2" for="Kabupaten">
                                Kab/Kota
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="Kabupaten" type="text" name="kabupaten">
                        </div>
                        <div class="mb-4">
                            <label class="block text-text font-semibold mb-2" for="Kodepos">
                                Kode Pos
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="Kodepos" type="number" name="kodepos">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 md:gap-5">
                        <div class="mb-4">
                            <label class="block text-text font-semibold mb-2" for="Telepon">
                                Telepon
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="Telepon" type="number" name="telepon">
                        </div>
                        <div class="mb-4">
                            <label class="block text-text font-semibold mb-2" for="hp">
                                HP
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="hp" type="number" name="hp">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2">
                            Jenis Kelamin
                        </label>

                        <label class="inline-flex items-center me-5">
                            <input type="radio" name="gender" value="Laki-laki"
                                class="form-radio text-blue-600 h-5 w-5">
                            <span class="ml-2 text-gray-700">Laki-laki</span>
                        </label>

                        <label class="inline-flex items-center">
                            <input type="radio" name="gender" value="Perempuan"
                                class="form-radio text-pink-500 h-5 w-5">
                            <span class="ml-2 text-gray-700">Perempuan</span>
                        </label>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="tempatlahir">
                            TempatLahir
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="tempatlahir" type="text" name="tempatlahir">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="tanggallahir">
                            TanggalLahir
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="tanggallahir" type="date" name="tanggallahir">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="namaayah">
                            Nama Ayah
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="namaayah" type="text" name="namaayah">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="pekerjaanayah">
                            Pekerjaan Ayah
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="pekerjaanayah" type="text" name="pekerjaanayah">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="namaibu">
                            Nama Ibu
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="namaibu" type="text" name="namaibu">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="pekerjaanibu">
                            Pekerjaan Ibu
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="pekerjaanibu" type="text" name="pekerjaanibu">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="sumberbiaya">
                            Sumber Biaya
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="sumberbiaya" type="text" name="sumberbiaya">
                    </div>



                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="foto">
                            Foto 3x4
                        </label>
                        <input id="foto" type="file" name="foto"
                            class="mt-2 block w-full border-2  text-gray-500 rounded text-sm file:mr-4 file:rounded file:border-e-2 file:bg-gray-200 file:py-3 file:px-4 file:text-sm file:font-semibold file:text-gray-500 hover:file:bg-gray-200 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                    </div>
                    <div class="mb-10">
                        <label class="block text-text font-semibold mb-2" for="cv">
                            File CV
                        </label>
                        <input id="cv" type="file" name="cv"
                            class="mt-2 block w-full border-2  text-gray-500 rounded text-sm file:mr-4 file:rounded file:border-e-2 file:bg-gray-200 file:py-3 file:px-4 file:text-sm file:font-semibold file:text-gray-500 hover:file:bg-gray-200 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                    </div>




                </div>
            </div>
            <div class="grid gap-2">
                <button
                    class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-3 hover:opacity-80 w-full"
                    type="submit">Simpan</button>
                <a href="/rpl"
                    class="text-sm/6 font-semibold text-text bg-background rounded px-8 py-3 hover:opacity-80 text-center block">Kembali</a>
            </div>
        </form>
    </section>
</x-layout-formulir>
