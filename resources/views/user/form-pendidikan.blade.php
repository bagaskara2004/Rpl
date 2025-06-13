<x-layout-formulir>
    <section class="bg-primary grid grid-cols-1">
        <form class="bg-white m-5 rounded p-5 flex flex-col justify-between md:m-15 md:p-10" action="#" method="POST">
            <div>
                <div>
                    <div class="text-2xl inline-block font-semibold text-text mb-3">Form <span class="text-primary">Pendidikan</span>
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
                            id="namaperguruantinggi" type="text" name="namaperguruantinggi">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="nim">
                            Nim
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="nim" type="number" name="nim">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="jenjang">
                            Jenjang Pendidikan
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="jenjang" type="text" name="jenjang">
                    </div>      
                    
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="jurusan">
                            Jurusan
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="jurusan" type="text" name="jurusan">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="programstudi">
                            Program Studi
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="programstudi" type="text" name="programstudi">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="tahunmasuk">
                            Tahun Masuk
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="tahunmasuk" type="date" name="tahunmasuk">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="tahunlulus">
                            Tahun Lulus
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="tahunlulus" type="date" name="tahunlulus">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="konsentrasi">
                            Konsentrasi *optional
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="konsentrasi" type="text" name="konsentrasi">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="ipk">
                            IPK
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="ipk" type="number" name="ipk">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="judulta">
                            Judul TA
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="judulta" type="text" name="judulta">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="namapembimbingta">
                            Nama Pembimbing TA
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="namapembimbingta" type="text" name="namapembimbingta">
                    </div>



                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="ijasah">
                            File Ijasah
                        </label>
                        <input id="ijasah" type="file" name="ijasah"
                            class="mt-2 block w-full border-2  text-gray-500 rounded text-sm file:mr-4 file:rounded file:border-e-2 file:bg-gray-200 file:py-3 file:px-4 file:text-sm file:font-semibold file:text-gray-500 hover:file:bg-gray-200 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                    </div>
                    <div class="mb-10">
                        <label class="block text-text font-semibold mb-2" for="transkrip">
                            File Transkrip
                        </label>
                        <input id="transkrip" type="file" name="transkrip"
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
