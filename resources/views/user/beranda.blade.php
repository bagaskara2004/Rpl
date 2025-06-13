<x-layout-user>
    <section id="utama" class="bg-background">
        <div class="mx-auto max-w-7xl px-5 pt-20 pb-10 lg:px-8 min-h-dvh grid grid-cols-1 md:grid-cols-2 items-center">
            <div>
                <div class="text-3xl font-semibold text-text">Rekognisi Pembelajaran Lampau Kenali Potensimu, Akui
                    Pengalamanmu</div>
                <div class=" font-semibold text-text mt-5 mb-15">Rekognisi Pembelajaran Lampau (RPL) adalah
                    proses
                    pengakuan dan penilaian terhadap pengalaman belajar yang telah dilakukan oleh individu di luar
                    sistem pendidikan formal. RPL bertujuan untuk memberikan pengakuan terhadap kompetensi yang telah
                    diperoleh melalui pengalaman kerja, pelatihan, atau kegiatan non-formal lainnya.</div>
                <a href="#"
                    class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-3 hover:opacity-80">Ajukan
                    Sekarang</a>
            </div>
            <div class="hidden md:flex justify-center items-center">
                <img src="{{ asset('assets/ilustrasi/ilustrasi1.png') }}" class="h-130 w-auto object-contain">
            </div>
        </div>
    </section>

    <section id="tentangkami" class="bg-background-secondary py-20 px-5 lg:px-8">
        <div class="flex justify-center items-center mb-20">
            <div class="text-2xl p-4 inline-block font-semibold text-text border-b-5 border-secondary"><span
                    class="text-primary">Tentang</span> Kami</div>
        </div>
        <div class="mx-auto max-w-7xl grid grid-cols-1 gap-20 md:gap-5 md:grid-cols-2 items-center">
            <div class="flex justify-center items-center">
                <img src="{{ asset('assets/ilustrasi/ilustrasi2.png') }}" class="h-50 md:h-80 w-auto object-contain">
            </div>
            <div>
                <p class="font-semibold mb-5">Program Rpl sebagaimana tertuang di dalam Peratiran Mentri Reset,
                    Teknologi dan Pendidikan Tinggi Nomor 26 Tahun 2016, adalah pengakuan atas hasil pembelajaran yang
                    diperolehnya baik dari pendidikan formal atau nonformal atau informal, dan/atau pengalaman kerja ke
                    dalam pendidikan formal.</p>
                <p class="font-semibold mb-3">Pengetahuan dan keterampilan yang telah diperoleh sebelumnya dapat diakui
                    ke
                    dalam Satuan Kredit Semester (SKS) sehingga untuk melanjutkan pendidikan seseorang tidak harus
                    mengambil semua SKS atau mata kuliah.</p>
                <a href="/tentangkami"
                    class="font-semibold py-1 border-accent hover:border-b-2 hover:text-primary text-primary">Pelajari
                    lebih lanjut &rightarrow;</a>
            </div>
        </div>
    </section>

    <section id="gelombang" class="bg-background py-20 px-5 lg:px-8">
        <div class="flex justify-center items-center mb-20">
            <div class="text-2xl p-4 inline-block font-semibold text-text border-b-5 border-secondary"><span
                    class="text-primary">Gelombang</span> Pendaftaran</div>
        </div>
        <div class="mx-auto max-w-7xl grid grid-cols-1 grid-rows-3 gap-5 md:text-lg">
            <div class="bg-primary p-6 md:px-30 flex justify-between items-center rounded">
                <div class="font-semibold text-background">Gelombang 1</div>
                <div class="font-semibold text-background">1 Maret - 1 Mei</div>
            </div>
            <div class="bg-primary p-6 md:px-30 flex justify-between items-center rounded">
                <div class="font-semibold text-background">Gelombang 2</div>
                <div class="font-semibold text-background">1 Mei - 1 Juli</div>
            </div>
            <div class="bg-primary p-6 md:px-30 flex justify-between items-center rounded">
                <div class="font-semibold text-background">Gelombang 3</div>
                <div class="font-semibold text-background">1 Juli - 31 Agustus</div>
            </div>
        </div>
    </section>

    <section id="biaya" class="bg-background-secondary py-20 px-5 lg:px-8">
        <div class="flex justify-center items-center mb-20">
            <div class="text-2xl p-4 inline-block font-semibold text-text border-b-5 border-secondary"><span
                    class="text-primary">Biaya</span> Pendidikan</div>
        </div>
        <div class="mx-auto max-w-7xl grid grid-cols-1 gap-20 md:gap-5 md:grid-cols-2 items-center">
            <div class="flex justify-center items-center">
                <img src="{{ asset('assets/ilustrasi/ilustrasi3.png') }}" class="h-80 md:h-100 w-auto object-contain">
            </div>
            <div>
                <div class="bg-primary p-10 rounded-3xl text-center md:mx-20">
                    <div class="text-2xl font-bold text-background mb-5">UKT :</div>
                    <div class="text-2xl font-bold text-background">Rp.5,000,000 / Semester</div>
                </div>
            </div>
        </div>
    </section>

    <section id="berita" class="bg-background py-20 px-5 lg:px-8">
        <div class="flex justify-center items-center mb-20">
            <div class="text-2xl p-4 inline-block font-semibold text-text border-b-5 border-secondary"><span
                    class="text-primary">Berita</span> Terkini</div>
        </div>
        <div class="mx-auto max-w-7xl grid grid-cols-1 sm:grid-cols-3 items-center gap-5 mb-20">

            <x-article>
                <x-slot:judul>S3 Bisnis Pariwisata PNB Buka Pendafaran Gelombang 2</x-slot:judul>
                <x-slot:slug>s3-bisnis-pariwisata-pnb-buka-pendafaran-gelombang-2</x-slot:slug>
                <x-slot:tanggal>2 day ago</x-slot:tanggal>
                <x-slot:kategori>kerjasama</x-slot:kategori>
                <x-slot:image>assets/berita.jpg</x-slot:image>
                <x-slot:deskripsi>Program Studi Bisnis Pariwisata Program Doktor Terapan (Prodi
                    D,Bispar) Jurusan Pariwisata Politeknik Negeri Bali membuka pendaftaran calon mahasiswa baru tahun
                    akademik 2025/2026 Gelombang 2.</x-slot:deskripsi>
            </x-article>
            <x-article>
                <x-slot:judul>S3 Bisnis Pariwisata PNB Buka Pendafaran Gelombang 2</x-slot:judul>
                <x-slot:slug>s3-bisnis-pariwisata-pnb-buka-pendafaran-gelombang-2</x-slot:slug>
                <x-slot:tanggal>2 day ago</x-slot:tanggal>
                <x-slot:kategori>kerjasama</x-slot:kategori>
                <x-slot:image>assets/berita.jpg</x-slot:image>
                <x-slot:deskripsi>Program Studi Bisnis Pariwisata Program Doktor Terapan (Prodi
                    D,Bispar) Jurusan Pariwisata Politeknik Negeri Bali membuka pendaftaran calon mahasiswa baru tahun
                    akademik 2025/2026 Gelombang 2.</x-slot:deskripsi>
            </x-article>
            <x-article>
                <x-slot:judul>S3 Bisnis Pariwisata PNB Buka Pendafaran Gelombang 2</x-slot:judul>
                <x-slot:slug>s3-bisnis-pariwisata-pnb-buka-pendafaran-gelombang-2</x-slot:slug>
                <x-slot:tanggal>2 day ago</x-slot:tanggal>
                <x-slot:kategori>kerjasama</x-slot:kategori>
                <x-slot:image>assets/berita.jpg</x-slot:image>
                <x-slot:deskripsi>Program Studi Bisnis Pariwisata Program Doktor Terapan (Prodi
                    D,Bispar) Jurusan Pariwisata Politeknik Negeri Bali membuka pendaftaran calon mahasiswa baru tahun
                    akademik 2025/2026 Gelombang 2.</x-slot:deskripsi>
            </x-article>

        </div>
        <div class="flex justify-center">
            <a href="/berita"
                class="text-sm/6 font-semibold text-white bg-primary rounded py-3 px-10 hover:opacity-80">Berita
                Lainnya</a>
        </div>
    </section>
</x-layout-user>
