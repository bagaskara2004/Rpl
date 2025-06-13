<article class="p-6 bg-background-secondary rounded-lg ">
    <img src="{{ asset($image) }}" alt="" srcset="" class="rounded-2xl mb-5">
    <div class="flex justify-between items-center mb-5 text-gray-500">
        <span class="text-xs text-secondary font-semibold">{{ $tanggal }}</span>
    </div>
    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><a
            href="{{ $slug }}">{{ $judul }}</a></h2>
    <p class="mb-5 font-light text-text">{{ $deskripsi }}</p>
</article>
