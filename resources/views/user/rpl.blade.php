<x-layout-user>
    <section id="rpl" class="bg-background pb-20 pt-30 px-5 lg:px-8">
        <div class="mx-auto max-w-7xl grid grid-cols-1 gap-20 md:gap-5 md:grid-cols-2 items-center">
            <div class="flex justify-center items-center">
                <img src="{{ asset('assets/ilustrasi/ilustrasi7.png') }}" class="h-50 md:h-120 w-auto object-contain">
            </div>
            <div>
                <p class="font-semibold mb-5 bg-primary text-background p-10 rounded">Sebelum mengisi mengajukan RPL
                    calon
                    mahasiswa harus melengkapi formulir dibawah ini !</p>
                <button
                    class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-3 hover:opacity-80">Ajukan
                    RPL</button>
            </div>
        </div>
    </section>
    <section id="formulir" class="bg-background-secondary pb-20 pt-30 px-5 lg:px-8">
        <div class="mx-auto max-w-7xl grid gap-15">
            <div>
                <div class="text-2xl font-semibold text-text mb-3"><span class="text-primary">Form</span> Data Diri
                </div>
                <p class="font-semibold mb-5">mohon siapkan foto ukuran 3x4 dan CV sebelum mengisi formulir ini</p>
                <a href="{{ route('user.form.datadiri') }}"
                    class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-3 hover:opacity-80">Form
                    Data Diri</a>
            </div>
            <div>
                <div class="text-2xl font-semibold text-text mb-3"><span class="text-primary">Form</span> Pendidikan
                </div>
                <p class="font-semibold mb-5">mohon siapkan file ijasah dan transkrip nilai sebelum mengisi formulir ini
                </p>
                <a href="{{ route('user.form.pendidikan') }}"
                    class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-3 hover:opacity-80">Form
                    Pendidikan</a>
            </div>
            <div>
                <div class="text-2xl font-semibold text-text mb-3"><span class="text-primary">Form</span> Asesment
                </div>
                <p class="font-semibold mb-5">Sesuaikan formulir dengan Transcript Nilai</p>
                <a href="{{ route('user.form.asesment') }}"
                    class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-3 hover:opacity-80">Form
                    Asesment</a>
            </div>
            <div>
                <div class="text-2xl font-semibold text-text mb-5"><span class="text-primary">Form</span> Pekerjaan
                </div>
                <a href="{{ route('user.form.pekerjaan') }}"
                    class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-3 hover:opacity-80">Tambah
                    Pekerjaan</a>


                <div class="relative overflow-x-auto mt-10">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3 w-full">
                                    Pekerjaan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    1
                                </th>
                                <td class="px-6 py-4 break-all">
                                    Web dev
                                </td>
                                <td class="px-6 py-4 flex gap-3">
                                    <a href="#"
                                        class="text-sm/6 font-semibold text-amber-300 hover:opacity-80">Edit</a>
                                    <button
                                        class="text-sm/6 font-semibold text-orange-600 hover:opacity-80">Hapus</button>
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    2
                                </th>
                                <td class="px-6 py-4 break-all">
                                    Apps dev
                                </td>
                                <td class="px-6 py-4 flex gap-3">
                                    <a href="#"
                                        class="text-sm/6 font-semibold text-amber-300 hover:opacity-80">Edit</a>
                                    <button
                                        class="text-sm/6 font-semibold text-orange-600 hover:opacity-80">Hapus</button>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    3
                                </th>
                                <td class="px-6 py-4 break-all">
                                    UI UX
                                </td>
                                <td class="px-6 py-4 flex gap-3">
                                    <a href="#"
                                        class="text-sm/6 font-semibold text-amber-300 hover:opacity-80">Edit</a>
                                    <button
                                        class="text-sm/6 font-semibold text-orange-600 hover:opacity-80">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div>
                <div class="text-2xl font-semibold text-text mb-5"><span class="text-primary">Form</span> Pelatihan
                </div>
                <a href="{{ route('user.form.pelatihan') }}"
                    class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-3 hover:opacity-80">Tambah
                    Pelatihan</a>


                <div class="relative overflow-x-auto mt-10">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3 w-full">
                                    Pelatihan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    1
                                </th>
                                <td class="px-6 py-4 break-all">
                                    Web dev
                                </td>
                                <td class="px-6 py-4 flex gap-3">
                                    <a href="#"
                                        class="text-sm/6 font-semibold text-amber-300 hover:opacity-80">Edit</a>
                                    <button
                                        class="text-sm/6 font-semibold text-orange-600 hover:opacity-80">Hapus</button>
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    2
                                </th>
                                <td class="px-6 py-4 break-all">
                                    Apps dev
                                </td>
                                <td class="px-6 py-4 flex gap-3">
                                    <a href="#"
                                        class="text-sm/6 font-semibold text-amber-300 hover:opacity-80">Edit</a>
                                    <button
                                        class="text-sm/6 font-semibold text-orange-600 hover:opacity-80">Hapus</button>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    3
                                </th>
                                <td class="px-6 py-4 break-all">
                                    UI UX
                                </td>
                                <td class="px-6 py-4 flex gap-3">
                                    <a href="#"
                                        class="text-sm/6 font-semibold text-amber-300 hover:opacity-80">Edit</a>
                                    <button
                                        class="text-sm/6 font-semibold text-orange-600 hover:opacity-80">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>

    {{-- konfirmasi --}}
    {{-- <div class="fixed bg-background overflow-auto md:top-20 md:left-20 md:right-20 md:bottom-20 top-5 left-5 right-5 bottom-5 z-10 md:p-5 border-1 rounded">
        <div class="flex justify-center items-center mb-10">
            <div class="text-2xl p-4 inline-block font-semibold text-text border-b-5 border-secondary"><span
                    class="text-primary">Konfirmasi</span> RPL</div>
        </div>
        <form class="flex flex-col justify-between px-5" action="#" method="POST">
            <div>
                <div>
                    <label class="block text-text font-semibold mb-5">
                        Pertanyaan
                    </label>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="q1">
                            Apakah kamu sudah pernah membuat aplikasi dengan laravel ?
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="q1" type="text" name="q1">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="q2">
                            Apakah kamu menguasai laravel ?
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="q2" type="text" name="q2">
                    </div>

                </div>
            </div>
            <div class="flex items-start gap-3 mb-5">
                <input type="checkbox" name="konformasi" class="size-5">
                <div>
                    <p class="block text-text font-semibold  text-xs">
                        SAYA TELAH MEMBACA DAN MENGISI FORMULIR PENDAFTARAN UNTUK MENGIKUTI PERKULIAHAN MELALUI PROGRAM
                        RPL DI POLITEKNIK NEGERI BALI DENGAN BAIK, DAN SAYA MENYATAKAN:
                    </p>
                    <ul class="list-decimal text-xs ms-5">
                        <li>Semua informasi yang saya tuliskan adalah sepenuhnya benar dan saya bertanggungjawab atas
                            seluruh data dalam formulir ini.</li>
                        <li>Saya memberikan ijin kepada pihak pengelola program RPL, untuk melakukan pemeriksaan
                            kebenaran informasi yang saya berikan dalam formulir aplikasi ini kepada seluruh pihak yang
                            terkait dengan jenjang akademik sebelumnya dan kepada perusahaan tempat saya bekerja
                            sebelumnya dan atau saat ini saya bekerja.</li>
                        <li>Saya bersedia melengkapi berkas yang dibutuhkan untuk pelaksanaan proses credit transfer dan
                            atau asesmen pengalaman kerja.</li>
                        <li>Saya akan mengikuti proses asesmen sesuai dengan kesepakatan waktu yang ditetapkan dan saya
                            akan melunasi biaya pendaftaran setelah pengisian aplikasi ini selesai.</li>
                        <li>Saya akan mentaati seluruh hal yang tercantum dalam peraturan akademik dan hal-hal terkait
                            administrasi selama saya mengikuti perkuliahan di PNB.</li>
                    </ul>
                </div>
            </div>
            <div class="grid gap-2">
                <button
                    class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-3 hover:opacity-80 w-full"
                    type="submit">Kirim</button>
                <a href="#"
                    class="text-sm/6 font-semibold text-text bg-background rounded px-8 py-3 hover:opacity-80 text-center block">Batal</a>
            </div>
        </form>
    </div> --}}
</x-layout-user>
