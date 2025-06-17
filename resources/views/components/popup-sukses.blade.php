<div class="fixed top-0 bottom-0 left-0 right-0 flex justify-center items-center" x-data="{ isclick: true }" x-show="isclick">
    <div class="bg-background border-2 py-5 px-10 flex flex-col gap-4 justify-center items-center md:w-1/3 rounded">
        <div class="bg-green-600 py-5 px-6 rounded-full w-fit"><i class="fa-solid fa-check text-5xl text-background"></i>
        </div>
        <p class="text-text text-2xl font-semibold">Sukses</p>
        <p class="text-gray-500 font-semibold">{{ $slot }}</p>
        <button class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-2 hover:opacity-80"
            @click="isclick = !isclick">OK
        </button>
    </div>
</div>
