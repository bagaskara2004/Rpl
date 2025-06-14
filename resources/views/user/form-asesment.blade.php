<x-layout-formulir>
    <section class="bg-primary grid grid-cols-1">
        <form class="bg-white m-5 rounded p-5 flex flex-col justify-between md:m-15 md:p-10" action="#" method="POST">
            <div>
                <div>
                    <div class="text-2xl inline-block font-semibold text-text mb-3">Form <span
                            class="text-primary">Asesment</span>
                    </div>
                    <p class="font-semibold mb-10 text-gray-500">Lengkapi formulir dibawah ini !!
                    </p>
                </div>
                <div>
                    <div class="flex gap-2">
                        <div class="mb-4 w-full">
                            <label class="block text-text font-semibold mb-2" for="matkul1">
                                Matkul
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="matkul1" type="text" name="matkul1">
                        </div>
                        <div class="mb-4 w-20">
                            <label class="block text-text font-semibold mb-2" for="sks1">
                                Sks
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="sks1" type="number" name="sks1">
                        </div>
                        <div class="mb-4 w-20">
                            <label class="block text-text font-semibold mb-2" for="angka1">
                                Angka
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="angka1" type="number" name="angka1">
                        </div>

                        <div class="mb-4 w-20">
                            <label class="block text-text font-semibold mb-2" for="huruf1">
                                Huruf
                            </label>
                            <input
                                class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                id="huruf1" type="text" name="huruf1">
                        </div>
                    </div>

                    @for ($i = 2; $i <= 10; $i++)
                        <div class="flex gap-2">
                            <div class="mb-4 w-full">
                                <input
                                    class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                    id="matkul{{ $i }}" type="text" name="matkul{{ $i }}">
                            </div>
                            <div class="mb-4 w-20">
                                <input
                                    class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                    id="sks{{ $i }}" type="number" name="sks{{ $i }}">
                            </div>
                            <div class="mb-4 w-20">
                                <input
                                    class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                    id="angka{{ $i }}" type="number" name="angka{{ $i }}">
                            </div>

                            <div class="mb-4 w-20">
                                <input
                                    class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                    id="huruf{{ $i }}" type="text" name="huruf{{ $i }}">
                            </div>
                        </div>
                    @endfor
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
