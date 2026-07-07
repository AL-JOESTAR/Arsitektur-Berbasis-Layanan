<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 px-4">

        <div class="w-full max-w-sm">

            {{-- TITLE --}}
            <div class="text-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                    Login
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Masuk ke akun kamu
                </p>
            </div>

            {{-- CARD --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-6">

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
                            class="block mt-1 w-full rounded-lg border-gray-300 focus:border-gray-900 focus:ring-gray-900"
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
                            class="block mt-1 w-full rounded-lg border-gray-300 focus:border-gray-900 focus:ring-gray-900"
                            required
                            placeholder="••••••••"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- REMEMBER --}}
                    <div class="flex items-center justify-between text-sm">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="remember"
                                class="rounded border-gray-300 text-gray-900 focus:ring-gray-900">
                            <span class="ml-2 text-gray-600 dark:text-gray-400">
                                Remember me
                            </span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                Forgot?
                            </a>
                        @endif
                    </div>

                    {{-- BUTTON --}}
                    <button type="submit"
                        class="w-full bg-gray-900 text-white py-2.5 rounded-lg hover:bg-gray-800 transition">
                        Login
                    </button>

                </form>

            </div>

            {{-- FOOTER --}}
            <p class="text-center text-sm text-gray-500 mt-4">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-gray-900 font-medium hover:underline">
                    Register
                </a>
            </p>

        </div>

    </div>

</x-guest-layout>