<x-layout-user>
    <section id="rpl" class="bg-background pb-20 pt-30 px-5 lg:px-8" x-data="{ konfirmf: false, konfirm: false }">
        <div class="mx-auto max-w-7xl grid grid-cols-1 gap-20 md:gap-5 md:grid-cols-2 items-center">
            <div class="flex justify-center items-center">
                <img src="{{ asset('assets/ilustrasi/ilustrasi7.png') }}" class="h-50 md:h-120 w-auto object-contain">
            </div>
            <div>
                <p class="font-semibold mb-5 bg-primary text-background p-10 rounded">Sebelum mengisi mengajukan RPL
                    calon
                    mahasiswa harus melengkapi formulir dibawah ini !</p>


                @if ($konfirmasi == false)
                    <button @click="konfirmf = !konfirmf"
                        class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-3 hover:opacity-80">Ajukan
                        RPL</button>
                @else
                    <button @click="konfirm = !konfirm"
                        class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-3 hover:opacity-80">Ajukan
                        RPL</button>
                @endif
            </div>
        </div>
        {{-- konfirmasi --}}
        <div x-show="konfirm"
            class="fixed bg-background overflow-auto md:top-10 md:left-20 md:right-20 md:bottom-10 top-5 left-5 right-5 bottom-5 z-10 md:p-5 border-1 rounded">
            <div class="flex justify-center items-center mb-10">
                <div class="text-2xl p-4 inline-block font-semibold text-text border-b-5 border-secondary"><span
                        class="text-primary">Konfirmasi</span> RPL</div>
            </div>
            <form class="flex flex-col justify-between px-5" action="{{ route('user.konfirmasi') }}" method="POST">
                @csrf
                <div>
                    <div>
                        <label class="block text-text font-semibold mb-5">
                            Pertanyaan
                        </label>
                        @foreach ($pertanyaan as $data)
                            <div class="mb-4">
                                <label class="block text-text font-semibold mb-2" for="q1">
                                    {{ $data->pertanyaan }}
                                </label>
                                <div class="flex items-center gap-4">
                                    <label class="flex items-center gap-2">
                                        <input type="radio" name="jawaban[{{ $data->id }}]" value="1"
                                            class="accent-blue-600" />
                                        <span class="text-gray-700">Ya</span>
                                    </label>

                                    <label class="flex items-center gap-2">
                                        <input type="radio" name="jawaban[{{ $data->id }}]" value="0"
                                            class="accent-pink-600" checked />
                                        <span class="text-gray-700">Tidak</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="flex items-start gap-3 mb-5 border-t-2 border-gray-400 pt-10 mt-10">
                    <input type="checkbox" name="konfirmasi" class="size-5">
                    <div>
                        <p class="block text-text font-semibold  text-xs">
                            SAYA TELAH MEMBACA DAN MENGISI FORMULIR PENDAFTARAN UNTUK MENGIKUTI PERKULIAHAN MELALUI
                            PROGRAM
                            RPL DI POLITEKNIK NEGERI BALI DENGAN BAIK, DAN SAYA MENYATAKAN:
                        </p>
                        <ul class="list-decimal text-xs ms-5">
                            <li>Semua informasi yang saya tuliskan adalah sepenuhnya benar dan saya bertanggungjawab
                                atas
                                seluruh data dalam formulir ini.</li>
                            <li>Saya memberikan ijin kepada pihak pengelola program RPL, untuk melakukan pemeriksaan
                                kebenaran informasi yang saya berikan dalam formulir aplikasi ini kepada seluruh pihak
                                yang
                                terkait dengan jenjang akademik sebelumnya dan kepada perusahaan tempat saya bekerja
                                sebelumnya dan atau saat ini saya bekerja.</li>
                            <li>Saya bersedia melengkapi berkas yang dibutuhkan untuk pelaksanaan proses credit transfer
                                dan
                                atau asesmen pengalaman kerja.</li>
                            <li>Saya akan mengikuti proses asesmen sesuai dengan kesepakatan waktu yang ditetapkan dan
                                saya
                                akan melunasi biaya pendaftaran setelah pengisian aplikasi ini selesai.</li>
                            <li>Saya akan mentaati seluruh hal yang tercantum dalam peraturan akademik dan hal-hal
                                terkait
                                administrasi selama saya mengikuti perkuliahan di PNB.</li>
                        </ul>
                    </div>
                </div>
                <div class="grid gap-2">
                    <button
                        class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-3 hover:opacity-80 w-full"
                        type="submit">Kirim</button>
                    <button @click="konfirm = !konfirm" type="button"
                        class="text-sm/6 font-semibold text-text bg-background rounded px-8 py-3 hover:opacity-80 text-center block">Batal</button>
                </div>
            </form>
        </div>

        {{-- gagal --}}
        <div class="fixed top-0 bottom-0 left-0 right-0 flex justify-center items-center" x-show="konfirmf">
            <div
                class="bg-background border-2 py-5 px-10 flex flex-col gap-4 justify-center items-center md:w-1/3 rounded">
                <div class="bg-red-600 py-5 px-6 rounded-full w-fit"><i
                        class="fa-solid fa-xmark text-5xl text-background"></i>
                </div>
                <p class="text-text text-2xl font-semibold">Gagal</p>
                <p class="text-gray-500 font-semibold">Lengkapi Formulir terlebih bahulu</p>
                <button class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-2 hover:opacity-80"
                    @click="konfirmf = !konfirmf">OK
                </button>
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
                    class="text-sm/6 font-semibold text-background rounded px-8 py-3 hover:opacity-80 {{ $datadiri == true ? 'bg-green-700' : 'bg-primary' }}">Form
                    Data Diri</a>
            </div>
            <div>
                <div class="text-2xl font-semibold text-text mb-3"><span class="text-primary">Form</span> Pendidikan
                </div>
                <p class="font-semibold mb-5">mohon siapkan file ijasah dan transkrip nilai sebelum mengisi formulir ini
                </p>
                <a href="{{ route('user.form.pendidikan') }}"
                    class="text-sm/6 font-semibold text-background rounded px-8 py-3 hover:opacity-80 {{ $pendidikan == true ? 'bg-green-700' : 'bg-primary' }}">Form
                    Pendidikan</a>
            </div>
            <div>
                <div class="text-2xl font-semibold text-text mb-3"><span class="text-primary">Form</span> Asesment
                </div>
                <p class="font-semibold mb-5">Sesuaikan formulir dengan Transcript Nilai</p>
                <a href="{{ route('user.form.asesment') }}"
                    class="text-sm/6 font-semibold text-background rounded px-8 py-3 hover:opacity-80 {{ $asesment == true ? 'bg-green-700' : 'bg-primary' }}">Form
                    Asesment</a>
            </div>
            <div>
                <div class="text-2xl font-semibold text-text mb-5"><span class="text-primary">Form</span> Pekerjaan
                </div>
                <a href="{{ route('user.form.pekerjaan') }}"
                    class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-3 hover:opacity-80">Tambah
                    Pekerjaan</a>


                @if (!$pengalamankerja->isEmpty())
                    <div class="relative overflow-x-auto mt-10">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3 w-full">
                                        Perusahaan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengalamankerja as $data)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="px-6 py-4 break-all">
                                            {{ $data->nama_perusahaan }}
                                        </td>
                                        <td class="px-6 py-4 flex gap-3">
                                            <a href="/form/pekerjaan/{{ $data->id }}"
                                                class="text-sm/6 font-semibold text-amber-300 hover:opacity-80">Edit</a>

                                            <form action="{{ route('user.form.pekerjaan') }}" method="post"
                                                x-data="{ open: false }" @submit.prevent="open = true">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                <button type="submit"
                                                    class="text-sm/6 font-semibold text-orange-600 hover:opacity-80">Hapus</button>

                                                <div x-show="open"
                                                    class="fixed inset-0 z-100 flex items-center justify-center">
                                                    <div class="bg-white p-6 rounded shadow-lg text-center">
                                                        <p class="text-lg mb-4">Yakin ingin hapus
                                                            <strong>{{ $data->nama_perusahaan }}</strong>?
                                                        </p>
                                                        <div class="flex justify-center gap-4">
                                                            <button type="button" @click="open = false"
                                                                class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                                                            <button type="submit" @click="$root.submit()"
                                                                class="px-4 py-2 bg-red-600 text-white rounded">Ya,
                                                                Hapus</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
            <div>
                <div class="text-2xl font-semibold text-text mb-5"><span class="text-primary">Form</span> Pelatihan
                </div>
                <a href="{{ route('user.form.pelatihan') }}"
                    class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-3 hover:opacity-80">Tambah
                    Pelatihan</a>

                @if (!$pelatihan->isEmpty())
                    <div class="relative overflow-x-auto mt-10">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                @foreach ($pelatihan as $data)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="px-6 py-4 break-all">
                                            {{ $data->nama_pelatihan }}
                                        </td>
                                        <td class="px-6 py-4 flex gap-3">
                                            <a href="/form/pelatihan/{{ $data->id }}"
                                                class="text-sm/6 font-semibold text-amber-300 hover:opacity-80">Edit</a>

                                            <form action="{{ route('user.form.pelatihan') }}" method="post"
                                                x-data="{ open: false }" @submit.prevent="open = true">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                <button type="submit"
                                                    class="text-sm/6 font-semibold text-orange-600 hover:opacity-80">Hapus</button>

                                                <div x-show="open"
                                                    class="fixed inset-0 z-100 flex items-center justify-center">
                                                    <div class="bg-white p-6 rounded shadow-lg text-center">
                                                        <p class="text-lg mb-4">Yakin ingin hapus
                                                            <strong>{{ $data->nama_pelatihan }}</strong>?
                                                        </p>
                                                        <div class="flex justify-center gap-4">
                                                            <button type="button" @click="open = false"
                                                                class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                                                            <button type="submit" @click="$root.submit()"
                                                                class="px-4 py-2 bg-red-600 text-white rounded">Ya,
                                                                Hapus</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </section>


</x-layout-user>
