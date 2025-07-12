<x-layout-user>
    {{-- <section id="diproses" class="bg-background pb-20 pt-30 px-5 lg:px-8">
        <div class="flex justify-center items-center mb-20">
            <div class="text-2xl p-4 inline-block font-semibold text-red-500 ">DITOLAK</div>
        </div>
        <div class="mx-auto max-w-7xl grid grid-cols-1 gap-20 md:gap-5 md:grid-cols-2 items-center">
            <div class="flex justify-center items-center">
                <img src="{{ asset('assets/ilustrasi/ilustrasi9.png') }}" class="h-80 md:h-100 w-auto object-contain">
            </div>
            <div class=" ">
                <p class="font-semibold p-5 rounded border-2 border-primary mb-10">Permohonan pengajuan RPL kamu ditolak dikarenakan Pengalaman kerja dan
                    pembelajaran sebelumnya tidak relevan dengan kompetensi mata kuliah atau program studi yang dituju.
                    untuk lebih lengkapnya bisa menghubungi narahubung.</p>
                    <a href="#"
                        class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-3 hover:opacity-80">Resubmit</a>
            </div>
        </div>

    </section> --}}
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-5">
        <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md text-center" x-data="{ open: false }">

            <div
                class="bg-red-100 text-red-600 w-20 h-20 flex items-center justify-center rounded-full mx-auto mb-5 animate-shake">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>

            <h2 class="text-2xl font-semibold mb-3 text-gray-800">Formulir Ditolak</h2>

            <p class="text-gray-600 mb-6">
                Mohon maaf, Formulir Rekognisi Pembelajaran Lampau Anda <span
                    class="font-semibold text-red-600">Ditolak</span>.
                Silakan cek alasan penolakan dan ajukan kembali jika memungkinkan.
            </p>
            <button @click="open = !open"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl shadow transition">
                <span x-text="open ? 'Tutup Alasan Penolakan' : 'Lihat Alasan Penolakan'"></span>
            </button>
            <div x-show="open" x-transition class="mt-4 p-4 bg-red-50 border border-red-300 rounded-lg text-red-700">
                <p class="font-medium mb-2">Alasan Penolakan:</p>
                <p class="mb-5">
                    {{ $message }}
                </p>

                <a href="{{ route('user.rpl.ulang') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-3 rounded-xl shadow transition">
                    Ajukan Ulang
                </a>
            </div>

        </div>
    </div>

</x-layout-user>
