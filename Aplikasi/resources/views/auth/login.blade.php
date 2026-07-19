<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center bg-amber-50 dark:bg-emerald-950 px-4">

        <div class="w-full max-w-sm">

            {{-- BRAND --}}
            <div class="flex flex-col items-center mb-6">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-600 to-amber-800 flex items-center justify-center shadow-md shadow-amber-800/20 mb-3">
                    <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.5 8.5a3.5 3.5 0 1 0-3.916 3.478L4 18.56V21h3l3.5-3.5.94.94 2.06-2.06-.94-.94L14.5 12.5A3.5 3.5 0 0 0 14.5 8.5Z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="15.5" cy="7.5" r="1.1" fill="currentColor"/>
                    </svg>
                </div>
                <span class="font-serif text-lg font-semibold text-emerald-900 dark:text-amber-50">E-Kos</span>
            </div>

            {{-- TITLE --}}
            <div class="text-center mb-6">
                <h1 class="font-serif text-2xl font-semibold text-emerald-950 dark:text-white">
                    Selamat Datang Kembali
                </h1>
                <p class="text-sm text-emerald-800/70 dark:text-amber-100/70 mt-1">
                    Masuk ke akun kamu untuk melanjutkan
                </p>
            </div>

            {{-- CARD --}}
            <div class="bg-white dark:bg-emerald-900/40 shadow-sm border border-amber-900/10 dark:border-white/10 rounded-2xl p-6">

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    {{-- EMAIL --}}
                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input
                            id="email"
                            type="email"
                            name="email"
                            class="block mt-1 w-full rounded-lg border-amber-900/20 focus:border-emerald-700 focus:ring-emerald-700"
                            :value="old('email')"
                            required
                            autofocus
                            placeholder="email@domain.com"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- PASSWORD --}}
                    <div>
                        <x-input-label for="password" value="Password" />
                        <x-text-input
                            id="password"
                            type="password"
                            name="password"
                            class="block mt-1 w-full rounded-lg border-amber-900/20 focus:border-emerald-700 focus:ring-emerald-700"
                            required
                            placeholder="••••••••"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- REMEMBER --}}
                    <div class="flex items-center justify-between text-sm">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="remember"
                                class="rounded border-amber-900/30 text-emerald-800 focus:ring-emerald-700">
                            <span class="ml-2 text-emerald-900/70 dark:text-amber-100/70">
                                Remember me
                            </span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-emerald-800/70 hover:text-emerald-900 dark:hover:text-white">
                                Forgot?
                            </a>
                        @endif
                    </div>

                    {{-- BUTTON --}}
                    <button type="submit"
                        class="w-full bg-emerald-800 text-dark py-2.5 rounded-lg hover:bg-dark-900 transition">
                        Login
                    </button>

                </form>

            </div>

            {{-- FOOTER --}}
            <p class="text-center text-sm text-emerald-900/60 dark:text-amber-100/60 mt-4">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-emerald-900 dark:text-amber-200 font-medium hover:underline">
                    Register
                </a>
            </p>

        </div>

    </div>

</x-guest-layout>