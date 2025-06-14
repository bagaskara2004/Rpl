<x-layout-user>
    <section id="detail" class="bg-background pb-20 pt-30 px-5 lg:px-8">
        <div class="flex justify-center items-center mb-10">
            <div class="text-2xl p-5 inline-block font-semibold text-text border-b-2 border-gray-400">{{ $berita->judul }}</div>
        </div>
        <img src="{{ asset('storage/berita/'.$berita->foto) }}" alt="" srcset="" class="w-full rounded-2xl">
        <p class="font-semibold my-10">{{ $berita->created_at->format('d-m-Y') }}</p>
        <p class="font-semibold my-10 py-5 border-b-2 border-t-2 border-gray-400"> {{ $berita->deskripsi }}</p>
        <a href="{{ route('user.berita') }}"
                    class="font-semibold border-accent hover:border-b-2 hover:text-primary text-primary">Kembali Ke Berita &rightarrow;</a>
    </section>
</x-layout-user>
