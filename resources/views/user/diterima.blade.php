<x-layout-user>
    {{-- <section id="diproses" class="bg-background pb-20 pt-30 px-5 lg:px-8">
        <div class="flex justify-center items-center mb-20">
            <div class="text-2xl p-4 inline-block font-semibold text-green-500 ">DITERIMA</div>
        </div>
        <div class="mx-auto max-w-7xl grid grid-cols-1 gap-20 md:gap-5 md:grid-cols-2 items-center">
            <div class="flex justify-center items-center">
                <img src="{{ asset('assets/ilustrasi/ilustrasi10.png') }}" class="h-80 md:h-100 w-auto object-contain">
            </div>
            <div class=" ">
                <p class="font-semibold p-5 rounded border-2 border-primary mb-10">Selamat pengajuan RPL kamu diterima silahkan hubungi harahubung untuk proses selanjutnya.</p>
                    <a href="#"
                        class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-3 hover:opacity-80">Ketuk untuk melihat matkul</a>
            </div>
        </div>

    </section> --}}
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-5">
        <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md text-center">

            <div
                class="bg-green-100 text-green-600 w-20 h-20 flex items-center justify-center rounded-full mx-auto mb-5 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h2 class="text-2xl font-semibold mb-3 text-gray-800">Formulir Diterima</h2>

            <p class="text-gray-600 mb-6">
                Selamat! Formulir Rekognisi Pembelajaran Lampau Anda telah <span
                    class="font-semibold text-green-600">Diterima</span> dan dinyatakan valid.
            </p>

            <button class="bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600 transition">
                Lihat Detail
            </button>

        </div>
    </div>

</x-layout-user>
