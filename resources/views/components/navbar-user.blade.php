<header class="bg-background fixed z-10 top-0 right-0 left-0" x-data="{ isOpen: false, profile: false }">
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-5 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="https://jti.pnb.ac.id/" class="-m-1.5 p-1.5">
                <span class="sr-only">Teknologi Informasi</span>
                <img class="h-11 w-auto" src="{{ asset('assets/Logo.png') }}" alt="">
            </a>
        </div>

        <div class="flex lg:hidden">
            <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                @click="isOpen = !isOpen">
                <span class="sr-only">Open main menu</span>
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
        <div class="hidden lg:flex lg:gap-x-10 items-center">
            <a href="{{ route('user.beranda') }}"
                class="font-semibold p-1 border-accent hover:border-b-2 hover:text-primary {{ request()->is('/') ? 'text-primary' : 'text-text' }}">Beranda</a>
            <a href="{{ route('user.tentangkami') }}"
                class="font-semibold p-1 border-accent hover:border-b-2 hover:text-primary {{ request()->is('tentangkami') ? 'text-primary' : 'text-text' }}">Tentang
                Kami</a>
            <a href="{{ route('user.berita') }}"
                class="font-semibold p-1 border-accent hover:border-b-2 hover:text-primary {{ request()->is('berita') ? 'text-primary' : 'text-text' }}">Berita</a>
            <a href="{{ route('user.panduan') }}"
                class="font-semibold p-1 border-accent hover:border-b-2 hover:text-primary {{ request()->is('panduan') ? 'text-primary' : 'text-text' }}">Panduan</a>

            @auth
                @if (Auth::user()->role_id === 1)
                    <a href="{{ route('user.rpl') }}"
                        class="font-semibold p-1 border-accent hover:border-b-2 hover:text-primary {{ request()->is('rpl') ? 'text-primary' : 'text-text' }}">RPL</a>
                    <button class=" font-semibold text-white bg-primary rounded px-4 py-2 hover:opacity-80" type="button"
                        @click="profile = !profile"><i class="fa-solid fa-user"></i></button>
                @endif
            @endauth
            @guest
                <a href="{{ route('auth.login') }}"
                    class="text-sm/6 font-semibold text-white bg-primary rounded px-7 py-1 hover:opacity-80">Masuk</a>
            @endguest
        </div>
    </nav>
    @auth
        <div class="fixed top-20 right-5 rounded z-11 p-5 w-75 bg-background border-2" x-show="profile">
            {{-- <img src="https://i.pravatar.cc/300" alt="Profile Picture" class="rounded-full w-28 h-28 mx-auto mb-4 border-4 border-primary dark:border-primary transition-transform duration-300 hover:scale-105"> --}}
            <div class="mb-4 w-full">
                <label class="block text-text font-semibold mb-2" for="username">
                    Username
                </label>
                <input
                    class="shadow appearance-none border-b-2 w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                    id="username" type="text" name="username" value="{{ Auth::user()->user_name }}" disabled>
            </div>
            <div class="mb-4 w-full">
                <label class="block text-text font-semibold mb-2" for="email">
                    Email
                </label>
                <input
                    class="shadow appearance-none border-b-2 w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                    id="email" type="text" name="email" value="{{ Auth::user()->email }}" disabled>
            </div>
            <form method="POST" action="{{ route('auth.logout') }}">
                @csrf
                <button class="text-sm/6 font-semibold text-background bg-red-500 rounded px-8 py-3 hover:opacity-80 w-full"
                    type="submit">Logout</button>
            </form>

        </div>
    @endauth
    <div class="lg:hidden" role="dialog" aria-modal="true" x-show="isOpen">
        <div class="fixed inset-0 z-10"></div>
        <div
            class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-background px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-center justify-between">
                <a href="#" class="-m-1.5 p-1.5">
                    <span class="sr-only">Teknologi Informasi</span>
                    <img class="h-11 w-auto" src="{{ asset('assets/Logo.png') }}" alt="">
                </a>
                <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="isOpen = !isOpen">
                    <span class="sr-only">Close menu</span>
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="space-y-2 py-6">
                        <a href="{{ route('user.beranda') }}"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold hover:bg-gray-50 {{ request()->is('/') ? 'text-primary' : 'text-text' }}">Beranda</a>
                        <a href="{{ route('user.tentangkami') }}"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold hover:bg-gray-50 {{ request()->is('tentangkami') ? 'text-primary' : 'text-text' }}">Tentang
                            Kami</a>
                        <a href="{{ route('user.berita') }}"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold hover:bg-gray-50 {{ request()->is('berita') ? 'text-primary' : 'text-text' }}">Berita</a>
                        <a href="{{ route('user.panduan') }}"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold hover:bg-gray-50 {{ request()->is('panduan') ? 'text-primary' : 'text-text' }}">Panduan</a>
                        @auth
                            @if (Auth::user()->role_id === 1)
                                <a href="{{ route('user.rpl') }}"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold hover:bg-gray-50 {{ request()->is('rpl') ? 'text-primary' : 'text-text' }}">RPL</a>
                            @endif
                        @endauth
                    </div>
                    <div class="py-6">
                        @auth
                            @if (Auth::user()->role_id === 1)
                                <button class=" font-semibold text-white bg-primary rounded px-4 py-2 hover:opacity-80"
                                    type="button" @click="profile = !profile"><i class="fa-solid fa-user"></i></button>
                            @endif
                        @endauth
                        @guest
                            <a href="{{ route('auth.login') }}"
                                class="text-sm/6 font-semibold text-white bg-primary rounded px-7 py-2 hover:opacity-80">Masuk</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
