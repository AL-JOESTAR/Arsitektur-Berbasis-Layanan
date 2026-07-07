<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row gap-6">

                {{-- SIDEBAR --}}
                <aside class="w-full md:w-60 flex-shrink-0">
                    <div class="md:sticky md:top-6 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl shadow-sm overflow-hidden">
                        <div class="px-4 pt-4 pb-2">
                            <p class="text-xs font-medium uppercase tracking-wider text-gray-400 dark:text-gray-500">Menu</p>
                        </div>

                        <nav class="px-3 pb-4 space-y-1">

                            <a href="#"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium bg-indigo-50 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300">
                                <svg class="w-4.5 h-4.5 shrink-0" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <rect x="3" y="3" width="7" height="7" rx="1.5"/>
                                    <rect x="14" y="3" width="7" height="7" rx="1.5"/>
                                    <rect x="3" y="14" width="7" height="7" rx="1.5"/>
                                    <rect x="14" y="14" width="7" height="7" rx="1.5"/>
                                </svg>
                                Dashboard
                            </a>

                            <a href="#"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700/60 transition-colors">
                                <svg class="w-4.5 h-4.5 shrink-0" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M5 21V5a2 2 0 0 1 2-2h6.5L19 8.5V21"/>
                                    <path d="M13.5 3V8.5H19"/>
                                    <circle cx="10" cy="13" r="1"/>
                                </svg>
                                Ruangan
                            </a>

                            <a href="#"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700/60 transition-colors">
                                <svg class="w-4.5 h-4.5 shrink-0" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <rect x="2.5" y="5.5" width="19" height="13" rx="2"/>
                                    <path d="M2.5 9.5h19"/>
                                    <path d="M6 14.5h4"/>
                                </svg>
                                Pembayaran
                            </a>

                            <a href="#"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700/60 transition-colors">
                                <svg class="w-4.5 h-4.5 shrink-0" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M4 19V10M11 19V4M18 19v-7"/>
                                    <path d="M2.5 19h19"/>
                                </svg>
                                Laporan
                            </a>

                            <a href="#"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700/60 transition-colors">
                                <svg class="w-4.5 h-4.5 shrink-0" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M12 3 2 20h20L12 3Z"/>
                                    <path d="M12 10v4"/>
                                    <circle cx="12" cy="16.8" r="0.4" fill="currentColor"/>
                                </svg>
                                Komplain
                            </a>

                        </nav>
                    </div>
                </aside>

                {{-- MAIN CONTENT --}}
                <div class="flex-1 min-w-0 space-y-6">

                    {{-- Welcome --}}
                    <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl shadow-sm p-6">
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ now()->translatedFormat('l, d F Y') }}</p>
                        <p class="text-gray-800 dark:text-gray-100 mt-1">
                            Selamat datang kembali. Berikut ringkasan singkat hari ini.
                        </p>
                    </div>

                    {{-- Stat cards --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                        <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl shadow-sm p-5">
                            <div class="flex items-center gap-3">
                                <span class="flex items-center justify-center w-9 h-9 rounded-lg bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-300 shrink-0">
                                    <svg class="w-4.5 h-4.5" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                        <path d="M5 21V5a2 2 0 0 1 2-2h6.5L19 8.5V21"/>
                                        <path d="M13.5 3V8.5H19"/>
                                    </svg>
                                </span>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Ruangan Tersedia</p>
                            </div>
                            <p class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mt-3">--</p>
                        </div>

                        <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl shadow-sm p-5">
                            <div class="flex items-center gap-3">
                                <span class="flex items-center justify-center w-9 h-9 rounded-lg bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-300 shrink-0">
                                    <svg class="w-4.5 h-4.5" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                        <rect x="2.5" y="5.5" width="19" height="13" rx="2"/>
                                        <path d="M2.5 9.5h19"/>
                                    </svg>
                                </span>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Pembayaran Sukses</p>
                            </div>
                            <p class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mt-3">--</p>
                        </div>

                        <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl shadow-sm p-5">
                            <div class="flex items-center gap-3">
                                <span class="flex items-center justify-center w-9 h-9 rounded-lg bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-300 shrink-0">
                                    <svg class="w-4.5 h-4.5" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                        <path d="M4 19V10M11 19V4M18 19v-7"/>
                                    </svg>
                                </span>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Laporan Bulan Ini</p>
                            </div>
                            <p class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mt-3">--</p>
                        </div>

                        <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl shadow-sm p-5">
                            <div class="flex items-center gap-3">
                                <span class="flex items-center justify-center w-9 h-9 rounded-lg bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-300 shrink-0">
                                    <svg class="w-4.5 h-4.5" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                        <path d="M12 3 2 20h20L12 3Z"/>
                                        <path d="M12 10v4"/>
                                    </svg>
                                </span>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Komplain Aktif</p>
                            </div>
                            <p class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mt-3">--</p>
                        </div>

                    </div>

                    {{-- Weekly activity --}}
                    <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between mb-5">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-200">Aktivitas Mingguan</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500">Menunggu data</p>
                        </div>
                        <div class="flex items-end gap-3 h-28">
                            @php $heights = [30, 55, 40, 70, 50, 85, 35]; @endphp
                            @foreach ($heights as $h)
                                <div class="flex-1 rounded-t-sm bg-indigo-100 dark:bg-indigo-900/40" style="height: {{ $h }}%;"></div>
                            @endforeach
                        </div>
                        <div class="flex justify-between mt-2 text-xs text-gray-400 dark:text-gray-500">
                            <span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span><span>Min</span>
                        </div>
                    </div>

                    {{-- Quick actions --}}
                    <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl shadow-sm p-4 flex flex-wrap gap-3">
                        <a href="#" class="text-sm px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/60 transition-colors">
                            + Tambah Ruangan
                        </a>
                        <a href="#" class="text-sm px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/60 transition-colors">
                            + Catat Pembayaran
                        </a>
                        <a href="#" class="text-sm px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/60 transition-colors">
                            + Buat Laporan
                        </a>
                        <a href="#" class="text-sm px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/60 transition-colors">
                            + Tanggapi Komplain
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>