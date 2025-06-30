<x-layout-formulir>
    <section class="bg-primary grid grid-cols-1 min-h-dvh" x-data="{ form: false, loading: false }" @submit="loading = true">
        <div class="bg-white m-5 rounded p-5 flex flex-col justify-between md:m-15 md:p-10">
            <div>
                <div>
                    <div class="text-2xl inline-block font-semibold text-text mb-3">Form <span
                            class="text-primary">Asesment</span>
                    </div>
                    <p class="font-semibold mb-10 text-gray-500">Lengkapi formulir dibawah ini !!
                    </p>
                </div>


                @if ($asesments->isEmpty())
                    <div class="flex bg-gray-100 h-70 justify-center items-center text-gray-400">Tidak Ada Data</div>
                @else
                    <div class="flex gap-2">
                        <div class="mb-4 w-full">
                            <label class="block text-text font-semibold mb-2" for="matkul1">Matkul</label>
                        </div>
                        <div class="mb-4 w-30">
                            <label class="block text-text font-semibold mb-2" for="sks1">Sks</label>
                        </div>
                        <div class="mb-4 w-30">
                            <label class="block text-text font-semibold mb-2" for="angka1">Angka</label>
                        </div>
                        <div class="mb-4 w-30">
                            <label class="block text-text font-semibold mb-2" for="huruf1">Huruf</label>
                        </div>
                        <div class="mb-4 w-10"></div>
                    </div>

                    @foreach ($asesments as $asesment)
                        <div class="flex gap-2 items-center">
                            <div class="mb-4 w-full">
                                <input
                                    class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                    type="text" disabled value="{{ $asesment->mata_kuliah }}">
                            </div>
                            <div class="mb-4 w-30">
                                <input
                                    class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                    type="text" disabled value="{{ $asesment->sks }}">
                            </div>
                            <div class="mb-4 w-30">
                                <input
                                    class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                    type="text" disabled value="{{ $asesment->nilai_angka }}">
                            </div>
                            <div class="mb-4  w-30">
                                <input
                                    class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                                    type="text" disabled value="{{ $asesment->nilai_huruf }}">
                            </div>
                            <div class="mb-4 w-10">
                                <form action="{{ route('user.form.asesment') }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{ $asesment->id }}">
                                    <button type="submit"><i class="fa-solid fa-minus text-red-500"></i></button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                @endif
            </div>

            <div class="grid gap-2">
                <button @click="form = !form"
                    class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-3 hover:opacity-80 w-full"
                    type="buttom">+ Tambah Data</button>
                <a href="{{ route('user.rpl') }}"
                    class="text-sm/6 font-semibold text-text bg-background rounded px-8 py-3 hover:opacity-80 text-center block">Kembali</a>
            </div>
        </div>

        <div class="fixed inset-0 flex items-center justify-center bg-[rgba(0,0,0,0.3)] bg-opacity-30" x-show="form">
            <form action="{{ route('user.form.asesment') }}" method="POST"
                class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
                @csrf
                <h2 class="text-2xl font-semibold mb-6 text-center">Tambah Data</h2>

                <div class="mb-4">
                    <label for="mata_kuliah" class="block text-gray-700 font-medium mb-1">Matkul</label>
                    <input type="text" id="mata_kuliah" name="mata_kuliah" value="{{ old('mata_kuliah') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('mata_kuliah')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="sks" class="block text-gray-700 font-medium mb-1">Sks</label>
                    <input type="number" id="sks" name="sks" value="{{ old('sks') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('sks')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-5">
                    <div class="mb-6">
                        <label for="nilai_angka" class="block text-gray-700 font-medium mb-1">Angka</label>
                        <input type="number" id="nilai_angka" name="nilai_angka" value="{{ old('nilai_angka') }}"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('nilai_angka')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="nilai_huruf" class="block text-gray-700 font-medium mb-1">Huruf</label>
                        <input type="text" id="nilai_huruf" name="nilai_huruf" value="{{ old('nilai_huruf') }}"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('nilai_huruf')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <button type="submit" x-bind:disabled="loading" x-text="loading ? 'Loading...' : 'Tambah'"
                    class="w-full bg-primary text-white py-2 rounded hover:opacity-80 transition"></button>
                <button type="button" @click="form = !form"
                    class="w-full bg-background text-text py-2 rounded hover:opacity-80 transition">Batal</button>

            </form>
        </div>
    </section>
</x-layout-formulir>
