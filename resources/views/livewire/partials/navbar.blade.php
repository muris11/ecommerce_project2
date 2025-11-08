<header
    class="flex z-[60] sticky top-0 flex-wrap md:justify-start md:flex-nowrap w-full bg-white/90 backdrop-blur-md text-sm py-3 md:py-0 shadow-md transition-all duration-300 border-b border-gray-100">
    <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8" aria-label="Global">
        <div class="relative md:flex md:items-center md:justify-between">
            <div class="flex items-center justify-between">
                <a class="flex-none text-xl font-semibold hover:scale-105 transition-transform duration-300"
                    href="{{ route('home') }}" aria-label="Brand">
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-cyan-600">Munir Jaya
                        Abadi</span>
                </a>
                <div class="md:hidden">
                    <button type="button"
                        class="hs-collapse-toggle flex justify-center items-center w-9 h-9 text-sm font-semibold rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none"
                        data-hs-collapse="#navbar-collapse-with-animation"
                        aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
                        <svg class="hs-collapse-open:hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="6" y2="6" />
                            <line x1="3" x2="21" y1="12" y2="12" />
                            <line x1="3" x2="21" y1="18" y2="18" />
                        </svg>
                        <svg class="hs-collapse-open:block hidden flex-shrink-0 w-4 h-4"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <div id="navbar-collapse-with-animation"
                class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block">
                <div
                    class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300">
                    <div
                        class="flex flex-col gap-x-0 mt-5 divide-y divide-dashed divide-gray-200 md:flex-row md:items-center md:justify-end md:gap-x-7 md:mt-0 md:ps-7 md:divide-y-0 md:divide-solid">

                        <a wire:navigate
                            class="font-medium {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-500' }} py-3 md:py-6 hover:text-blue-600 transition-all duration-300 relative group"
                            href="{{ route('home') }}" aria-current="page">
                            Beranda
                            <span
                                class="absolute bottom-2 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
                        </a>

                        <a wire:navigate
                            class="font-medium {{ request()->routeIs('brands') ? 'text-blue-600' : 'text-gray-500' }} hover:text-blue-600 py-3 md:py-6 transition-all duration-300 relative group"
                            href="{{ route('brands') }}">
                            Merek
                            <span
                                class="absolute bottom-2 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
                        </a>

                        <a wire:navigate
                            class="font-medium {{ request()->routeIs('categories') ? 'text-blue-600' : 'text-gray-500' }} hover:text-blue-600 py-3 md:py-6 transition-all duration-300 relative group"
                            href="{{ route('categories') }}">
                            Kategori
                            <span
                                class="absolute bottom-2 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
                        </a>

                        <a wire:navigate
                            class="font-medium {{ request()->routeIs('products') ? 'text-blue-600' : 'text-gray-500' }} hover:text-blue-600 py-3 md:py-6 transition-all duration-300 relative group"
                            href="{{ route('products') }}">
                            Produk
                            <span
                                class="absolute bottom-2 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
                        </a>

                        <a wire:navigate
                            class="font-medium {{ request()->routeIs('about') ? 'text-blue-600' : 'text-gray-500' }} hover:text-blue-600 py-3 md:py-6 transition-all duration-300 relative group"
                            href="{{ route('about') }}">
                            Tentang Kami
                            <span
                                class="absolute bottom-2 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
                        </a>

                        <a wire:navigate
                            class="font-medium {{ request()->routeIs('contact') ? 'text-blue-600' : 'text-gray-500' }} hover:text-blue-600 py-3 md:py-6 transition-all duration-300 relative group"
                            href="{{ route('contact') }}">
                            Hubungi Kami
                            <span
                                class="absolute bottom-2 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
                        </a>

                        <a wire:navigate
                            class="font-medium flex items-center {{ request()->routeIs('cart') ? 'text-blue-600' : 'text-gray-500' }} hover:text-blue-600 py-3 md:py-6 transition-all duration-300 relative group"
                            href="{{ route('cart') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="flex-shrink-0 w-5 h-5 mr-1 group-hover:scale-110 transition-transform duration-300">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            <span class="mr-1">Keranjang</span>
                            <span
                                class="py-0.5 px-1.5 rounded-full text-xs font-medium bg-blue-50 border border-blue-200 text-blue-600 animate-pulse">{{ $total_count }}</span>
                            <span
                                class="absolute bottom-2 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
                        </a>

                        @guest
                            <div class="pt-3 md:pt-0">
                                <a wire:navigate
                                    class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                    href="{{ route('login') }}">
                                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                    Login
                                </a>
                            </div>
                        @endguest

                        @auth
                            <div
                                class="hs-dropdown [--strategy:static] md:[--strategy:fixed] [--adaptive:none] md:[--trigger:click] md:py-4">
                                <button type="button"
                                    class="flex items-center w-full text-gray-500 hover:text-gray-400 font-medium">
                                    {{ Auth::user()->name }}
                                    <svg class="ms-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </button>

                                <div
                                    class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-48 hidden z-10 bg-white md:shadow-md rounded-lg p-2 before:absolute top-full md:border before:-top-5 before:start-0 before:w-full before:h-5">
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500"
                                        wire:navigate href="{{ route('profile') }}">
                                        <svg class="flex-shrink-0 w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Profil Saya
                                    </a>

                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500"
                                        wire:navigate href="{{ route('my-orders') }}">
                                        <svg class="flex-shrink-0 w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        Pesanan Saya
                                    </a>
                                    <button wire:click="logout" type="button"
                                        class="w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-red-600 hover:bg-red-50 focus:ring-2 focus:ring-red-500">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar
                                    </button>
                                </div>
                            </div>
                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
