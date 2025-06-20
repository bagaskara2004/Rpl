<x-layout-auth>
    <section class="bg-primary h-dvh grid grid-cols-1 lg:grid-cols-2 gap-20">
        <div class="justify-center items-center hidden lg:flex">
            <img src="{{ asset('assets/ilustrasi/ilustrasi6.png') }}" class="w-150">
        </div>
        <form class="bg-white overflow-auto m-5 rounded p-5 flex flex-col justify-between lg:m-15 lg:p-10"
            action="{{ route('auth.login') }}" method="POST" x-data="{ loading: false }" @submit="loading = true">
            @csrf
            <div>
                <div>
                    <div class="text-3xl inline-block font-semibold text-text mb-3">Masuk ke <span
                            class="text-primary">Akunmu</span>
                    </div>
                    <p class="font-semibold mb-10 text-gray-500">Selamat datang di Politeknik Negeri Bali
                    </p>
                </div>
                <div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="email">
                            Email
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="email" type="email" name="email" required value="{{ old('email') }}">
                    </div>
                    <div class="mb-4">
                        <label class="block text-text font-semibold mb-2" for="password">
                            Kata Sandi
                        </label>
                        <input
                            class="shadow appearance-none border-2 rounded w-full py-3 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline"
                            id="password" type="password" name="password" required>
                    </div>
                </div>
            </div>
            <div class="grid gap-2">
                <div class="g-recaptcha" data-sitekey="6LfKVWIrAAAAAHtdc7-P9drlPdVbFPfgGLuHvmef"></div>
                <button
                    class="text-sm/6 font-semibold text-background bg-primary rounded px-8 py-3 hover:opacity-80 w-full"
                    type="submit" x-bind:disabled="loading" x-text="loading ? 'Loading...' : 'MASUK'"></button >
                <a href="{{ route('user.beranda') }}"
                    class="text-sm/6 font-semibold text-text bg-background rounded px-8 py-3 hover:opacity-80 text-center block">Beranda</a>
            </div>
        </form>
    </section>
</x-layout-auth>
