<x-layout-user>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-5">
        <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md text-center">

            <div
                class="bg-yellow-100 text-yellow-600 w-20 h-20 flex items-center justify-center rounded-full mx-auto mb-5 animate-pulse">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <h2 class="text-2xl font-semibold mb-3 text-gray-800">Formulir Masih Diproses</h2>

            <p class="text-gray-600 mb-6">
                Terima kasih telah mengisi formulir Rekognisi Pembelajaran Lampau.<br>
                Saat ini status Anda: <span class="font-semibold text-yellow-600">Menunggu Verifikasi</span>.
            </p>

            <a href="{{ route('user.rpl.detail') }}" class="bg-yellow-500 text-white px-5 py-2 rounded-lg hover:bg-yellow-600 transition">
                Periksa Formulir
            </a>

        </div>
    </div>
</x-layout-user>
