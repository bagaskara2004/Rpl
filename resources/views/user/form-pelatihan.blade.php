<x-layout-formulir>
    <section class="bg-primary grid grid-cols-1">
        <form class="bg-white m-5 rounded p-5 flex flex-col justify-between md:m-15 md:p-10" action="{{ route('user.form.pelatihan') }}" method="POST">
            <div>
                <div>
                    <div class="text-2xl inline-block font-semibold text-text mb-3">Form <span
                            class="text-primary">Pelatihan
                        </span>
                    </div>
                    <p class="font-semibold mb-10 text-gray-500">Lengkapi formulir dibawah ini !!
                    </p>
                </div>
                <div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="namapelatihan">
                            Nama Pelatihan
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="namapelatihan" type="text" name="namapelatihan">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="penyelenggara">
                            Penyelenggara
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="penyelenggara" type="text" name="penyelenggara">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="peranserta">
                            Peran Serta
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="peranserta" type="text" name="peranserta">
                    </div>

                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="durasi">
                            Durasi ( hari )
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="durasi" type="number" name="durasi">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="sertifikat">
                            Sertifikat
                        </label>
                        <input id="sertifikat" type="file" name="sertifikat"
                            class="mt-2 block w-full border-2  text-gray-500 rounded text-sm file:mr-4 file:rounded file:border-e-2 file:bg-gray-200 file:py-3 file:px-4 file:text-sm file:font-semibold file:text-gray-500 hover:file:bg-gray-200 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
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
