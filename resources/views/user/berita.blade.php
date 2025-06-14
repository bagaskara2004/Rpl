<x-layout-user>
    <section id="berita" class="bg-background py-20 pt-30 px-5 lg:px-8">
        <div class="flex justify-center items-center mb-20">
            <div class="text-2xl p-4 inline-block font-semibold text-text border-b-5 border-secondary"><span
                    class="text-primary">Berita</span> Terkini</div>
        </div>
        <div class="mx-auto max-w-7xl grid grid-cols-1 sm:grid-cols-3 gap-5 ">

           @foreach ($berita as $data)
                <x-article>
                    <x-slot:judul>{{ Str::limit($data->judul, 50, '...'); }}</x-slot:judul>
                    <x-slot:slug>{{ $data->slug }}</x-slot:slug>
                    <x-slot:tanggal>{{ $data->created_at->diffForHumans() }}</x-slot:tanggal>
                    <x-slot:image>{{ $data->foto }}</x-slot:image>
                    <x-slot:deskripsi>{{ Str::limit($data->deskripsi, 200, '...');  }}</x-slot:deskripsi>
                </x-article>
            @endforeach

        </div>
        <div class="mx-auto max-w-7xl mt-10">
            {{ $berita->links() }}
        </div>
    </section>
</x-layout-user>
