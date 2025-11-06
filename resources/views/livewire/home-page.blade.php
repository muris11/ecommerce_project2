<div>
    @push('meta')
        <meta name="description"
            content="Belanja beras, pupuk, pestisida, dan kebutuhan pertanian berkualitas di Munir Jaya Abadi. Harga terjangkau, pengiriman cepat.">
        <meta property="og:title" content="Beranda - Munir Jaya Abadi">
        <meta property="og:description" content="Toko online produk pertanian berkualitas. Cek katalog dan promo terbaru.">
        <meta property="og:type" content="website">
    @endpush
    <!-- Hero Section Start -->
    <div
        class="w-full min-h-screen bg-gradient-to-br from-blue-100 via-cyan-50 to-blue-200 py-10 md:py-20 px-4 sm:px-6 lg:px-8 animate-gradient-x relative overflow-hidden">
        <!-- Animated Background Blobs -->
        <div
            class="absolute top-0 -left-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
        </div>
        <div
            class="absolute top-0 -right-4 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000">
        </div>

        <div class="max-w-[85rem] mx-auto h-full relative z-10">
            <!-- Grid -->
            <div class="grid md:grid-cols-2 gap-8 md:gap-12 xl:gap-20 md:items-center h-full">
                <div class="order-2 md:order-1 animate-fade-in-up">
                    <h1
                        class="block text-3xl font-bold text-gray-800 sm:text-4xl lg:text-5xl xl:text-6xl lg:leading-tight dark:text-white animate-fade-in">
                        Mulai belanja di <span
                            class="text-blue-600 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-cyan-600 animate-gradient-x">Munir
                            Jaya Abadi</span></h1>
                    <p
                        class="mt-4 text-base sm:text-lg text-gray-700 dark:text-gray-400 leading-relaxed animate-fade-in animation-delay-200">
                        Dapatkan beras
                        berkualitas dan obat
                        pertanian terbaik hanya di Munir Jaya Abadi. Kami menyediakan solusi untuk kebutuhan pertanian
                        Anda dengan harga terjangkau dan pelayanan terbaik.</p>

                    <!-- Buttons -->
                    <div
                        class="mt-6 lg:mt-8 flex flex-col sm:flex-row gap-3 sm:gap-4 animate-fade-in animation-delay-400">
                        <a class="group py-3 px-6 inline-flex justify-center items-center gap-x-2 text-sm sm:text-base font-semibold rounded-xl border border-transparent bg-gradient-to-r from-blue-600 to-blue-700 text-white hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-2xl hover:scale-105 disabled:opacity-50 disabled:pointer-events-none transform"
                            href="{{ route('register') }}">
                            Mulailah
                            <svg class="flex-shrink-0 w-4 h-4 group-hover:translate-x-1 transition-transform duration-300"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </a>
                        <a class="group py-3 px-6 inline-flex justify-center items-center gap-x-2 text-sm sm:text-base font-semibold rounded-xl border-2 border-gray-800 bg-white text-gray-800 shadow-lg hover:bg-gray-50 hover:shadow-2xl hover:scale-105 transition-all duration-300 dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 transform"
                            href="{{ route('contact') }}">
                            Hubungi tim penjualan
                        </a>
                    </div>
                    <!-- End Buttons -->

                    <!-- Review Statistics -->
                    <div
                        class="mt-8 lg:mt-12 p-4 sm:p-6 bg-white/50 dark:bg-gray-800/50 rounded-xl backdrop-blur-sm hover:bg-white/70 transition-all duration-300 animate-fade-in animation-delay-600 border border-white/20 hover:shadow-xl hover:scale-105 transform">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="flex space-x-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="h-5 w-5 sm:h-6 sm:w-6 text-yellow-400 animate-pulse-slow" width="51"
                                        height="51" viewBox="0 0 51 51" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M27.0352 1.6307L33.9181 16.3633C34.2173 16.6768 34.5166 16.9903 34.8158 16.9903L50.0779 19.1845C50.9757 19.1845 51.275 20.4383 50.6764 21.0652L39.604 32.3498C39.3047 32.6632 39.3047 32.9767 39.3047 33.2901L41.998 49.2766C42.2973 50.217 41.1002 50.8439 40.5017 50.5304L26.4367 43.3208C26.1375 43.3208 25.8382 43.3208 25.539 43.3208L11.7732 50.8439C10.8754 51.1573 9.97763 50.5304 10.2769 49.59L12.9702 33.6036C12.9702 33.2901 12.9702 32.9767 12.671 32.6632L1.29923 21.0652C0.700724 20.4383 0.999979 19.4979 1.89775 19.4979L17.1598 17.3037C17.459 17.3037 17.7583 16.9903 18.0575 16.6768L24.9404 1.6307C25.539 0.69032 26.736 0.69032 27.0352 1.6307Z"
                                            fill="currentColor" />
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-gray-200">5.0</span>
                        </div>
                        <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
                            Dipercaya oleh <span
                                class="font-semibold text-blue-600">{{ $storeReviews->count() }}+</span> pelanggan
                            yang puas
                        </p>
                    </div>
                    <!-- End Review Statistics -->
                </div>
                <!-- End Col -->

                <div class="relative order-1 md:order-2 animate-fade-in-right">
                    <img class="w-full rounded-xl shadow-2xl hover:shadow-3xl transition-all duration-500 hover:scale-105 transform"
                        src="/images/bg3.png" alt="Munir Jaya Abadi" loading="eager" width="800" height="600">
                    <div
                        class="absolute inset-0 -z-[1] bg-gradient-to-tr from-gray-200 via-white/0 to-white/0 w-full h-full rounded-xl mt-4 -mb-4 me-4 -ms-4 lg:mt-6 lg:-mb-6 lg:me-6 lg:-ms-6 dark:from-slate-800 dark:via-slate-900/0 dark:to-slate-900/0 animate-pulse-slow">
                    </div>

                    <!-- SVG-->
                    <div class="absolute bottom-0 start-0">
                        <svg class="w-2/3 ms-auto h-auto text-white dark:text-slate-900" width="630" height="451"
                            viewBox="0 0 630 451" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="531" y="352" width="99" height="99" fill="currentColor" />
                            <rect x="140" y="352" width="106" height="99" fill="currentColor" />
                            <rect x="482" y="402" width="64" height="49" fill="currentColor" />
                            <rect x="433" y="402" width="63" height="49" fill="currentColor" />
                            <rect x="384" y="352" width="49" height="50" fill="currentColor" />
                            <rect x="531" y="328" width="50" height="50" fill="currentColor" />
                            <rect x="99" y="303" width="49" height="58" fill="currentColor" />
                            <rect x="99" y="352" width="49" height="50" fill="currentColor" />
                            <rect x="99" y="392" width="49" height="59" fill="currentColor" />
                            <rect x="44" y="402" width="66" height="49" fill="currentColor" />
                            <rect x="234" y="402" width="62" height="49" fill="currentColor" />
                            <rect x="334" y="303" width="50" height="49" fill="currentColor" />
                            <rect x="581" width="49" height="49" fill="currentColor" />
                            <rect x="581" width="49" height="64" fill="currentColor" />
                            <rect x="482" y="123" width="49" height="49" fill="currentColor" />
                            <rect x="507" y="124" width="49" height="24" fill="currentColor" />
                            <rect x="531" y="49" width="99" height="99" fill="currentColor" />
                        </svg>
                    </div>
                    <!-- End SVG-->
                </div>
                <!-- End Col -->
            </div>
            <!-- End Grid -->
        </div>
    </div>
    <!-- Hero Section End -->
    <!--Brand Section Start -->
    <section class="py-12 sm:py-16 md:py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <div class="relative flex flex-col items-center">
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-gray-200">
                        Cari <span class="text-blue-500">Merek Populer</span>
                    </h1>
                    <div class="flex w-32 sm:w-40 mt-3 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200"></div>
                        <div class="flex-1 h-2 bg-blue-400"></div>
                        <div class="flex-1 h-2 bg-blue-600"></div>
                    </div>
                </div>
                <p class="text-sm sm:text-base lg:text-lg text-gray-600 dark:text-gray-400 max-w-3xl mx-auto px-4">
                    Temukan beragam pilihan beras terbaik dan produk pertanian berkualitas dari merek terpercaya petani
                    lokal dan nasional.
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">

                @foreach ($brands->take(8) as $brand)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 dark:bg-gray-800 overflow-hidden group transform hover:-translate-y-2 hover:scale-105 animate-fade-in-up"
                        wire:key="{{ $brand->id }}" style="animation-delay: {{ $loop->index * 100 }}ms">
                        <a href="/products?selected_brands[0]={{ $brand->id }}" class="block">
                            <div class="overflow-hidden relative">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                </div>
                                <img src="{{ $brand->image ? url('storage', $brand->image) : url('images/no-image.png') }}"
                                    alt="{{ $brand->name }}"
                                    class="object-cover w-full h-48 sm:h-56 md:h-64 transform group-hover:scale-110 group-hover:rotate-2 transition-all duration-500"
                                    loading="lazy" width="300" height="256">
                            </div>
                        </a>
                        <div
                            class="p-4 sm:p-5 text-center bg-gradient-to-b from-transparent to-gray-50 dark:to-gray-900">
                            <a href="/products?selected_brands[0]={{ $brand->id }}"
                                class="text-lg sm:text-xl lg:text-2xl font-bold tracking-tight text-gray-900 hover:text-blue-600 transition-all duration-300 dark:text-gray-300 dark:hover:text-blue-400 relative inline-block group-hover:scale-110">
                                {{ $brand->name }}
                                <span
                                    class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!--Brand Section End -->

    <!-- Categori Section Start-->
    <section
        class="bg-gradient-to-br from-orange-100 to-orange-200 dark:from-gray-800 dark:to-gray-900 py-12 sm:py-16 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <div class="relative flex flex-col items-center">
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-gray-200">
                        Cari <span class="text-blue-500">Kategori</span>
                    </h1>
                    <div class="flex w-32 sm:w-40 mt-3 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200"></div>
                        <div class="flex-1 h-2 bg-blue-400"></div>
                        <div class="flex-1 h-2 bg-blue-600"></div>
                    </div>
                </div>
                <p class="text-sm sm:text-base lg:text-lg text-gray-700 dark:text-gray-400 max-w-3xl mx-auto px-4">
                    Temukan berbagai kategori produk beras dan pertanian sesuai kebutuhan Anda. Belanja lebih mudah
                    dengan pilihan yang terorganisir dan lengkap.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">

                @foreach ($categories as $category)
                    <a class="group flex bg-white border-2 border-gray-100 shadow-lg hover:shadow-2xl rounded-2xl hover:border-blue-300 transition-all duration-500 dark:bg-slate-900 dark:border-gray-800 dark:hover:border-blue-600 transform hover:-translate-y-1 hover:scale-102 animate-fade-in-up overflow-hidden relative"
                        href="/products?selected_category[0]={{ $category->id }}" wire:key="{{ $category->id }}"
                        style="animation-delay: {{ $loop->index * 100 }}ms">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-blue-500/0 to-blue-500/0 group-hover:from-blue-500/5 group-hover:to-transparent transition-all duration-500">
                        </div>
                        <div class="p-4 sm:p-5 md:p-6 w-full relative z-10">
                            <div class="flex justify-between items-center gap-3">
                                <div class="flex items-center gap-3 sm:gap-4 flex-1 min-w-0">
                                    <div
                                        class="flex-shrink-0 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                                        <img class="h-16 w-16 sm:h-20 sm:w-20 rounded-xl object-cover shadow-md group-hover:shadow-xl"
                                            src="{{ $category->image ? url('storage', $category->image) : url('images/no-image.png') }}"
                                            alt="{{ $category->name }}" loading="lazy">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3
                                            class="group-hover:text-blue-600 text-lg sm:text-xl lg:text-2xl font-bold text-gray-800 transition-all duration-300 truncate dark:group-hover:text-blue-400 dark:text-gray-200 transform group-hover:translate-x-1">
                                            {{ $category->name }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-gray-400 group-hover:text-blue-600 group-hover:translate-x-2 transition-all duration-300 dark:group-hover:text-blue-400 animate-bounce-x"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m9 18 6-6-6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Categori Section End -->

    <!-- Customer Review Section Start -->
    <section class="bg-white dark:bg-gray-900 py-12 sm:py-16 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <div class="relative flex flex-col items-center">
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-gray-200">
                        Penilaian <span class="text-blue-500">Pelanggan</span>
                    </h1>
                    <div class="flex w-32 sm:w-40 mt-3 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200"></div>
                        <div class="flex-1 h-2 bg-blue-400"></div>
                        <div class="flex-1 h-2 bg-blue-600"></div>
                    </div>
                </div>
                <p class="text-sm sm:text-base lg:text-lg text-gray-600 dark:text-gray-400 max-w-3xl mx-auto px-4">
                    Lihat apa kata pelanggan kami tentang produk dan layanan yang kami berikan. Kepuasan Anda adalah
                    prioritas kami.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:gap-6">

                @forelse($storeReviews as $review)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 dark:border-gray-700 p-4 sm:p-6">
                        <!-- User Info & Rating -->
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-4">
                            <div class="flex items-center gap-3 sm:gap-4 flex-1 min-w-0">
                                <div class="flex-shrink-0">
                                    @if ($review->user->avatar)
                                        <img src="{{ Storage::url($review->user->avatar) }}"
                                            alt="{{ $review->user->name }}"
                                            class="w-14 h-14 sm:w-16 sm:h-16 rounded-full object-cover border-4 border-blue-100 dark:border-blue-900 shadow-lg"
                                            loading="lazy" width="64" height="64">
                                    @else
                                        <div
                                            class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-xl sm:text-2xl shadow-lg">
                                            {{ strtoupper(substr($review->user->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white truncate">
                                        {{ $review->user->name }}
                                    </h3>
                                    <p
                                        class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ $review->created_at->format('F d, Y') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Rating Stars -->
                            <div
                                class="flex items-center gap-1 bg-yellow-50 dark:bg-yellow-900/20 px-3 py-2 rounded-lg w-fit">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                @endfor
                            </div>
                        </div>

                        <!-- Review Text -->
                        <div class="mb-4">
                            <p class="text-sm sm:text-base text-gray-700 dark:text-gray-300 leading-relaxed">
                                {{ Str::limit($review->review, 250) }}
                            </p>
                        </div>

                        <!-- Read More Link -->
                        @if (strlen($review->review) > 250)
                            <a href="{{ route('store.reviews') }}"
                                class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-700 transition-colors">
                                Baca Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif
                    </div>

                @empty
                    <div
                        class="bg-white border-2 shadow-lg rounded-2xl p-8 sm:p-12 text-center dark:bg-slate-900 dark:border-gray-800">
                        <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-4 text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                        <p class="text-gray-600 dark:text-gray-400 text-base sm:text-lg mb-6">Belum ada ulasan
                            pelanggan.</p>
                        <a href="{{ route('store.reviews') }}"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-semibold shadow-lg hover:shadow-xl text-sm sm:text-base">
                            Jadilah yang Pertama Memberikan Ulasan
                        </a>
                    </div>
                @endforelse

                @if ($storeReviews->count() > 0)
                    <div class="text-center mt-6 sm:mt-8">
                        <a href="{{ route('store.reviews') }}"
                            class="inline-flex items-center gap-2 px-6 sm:px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-semibold shadow-lg hover:shadow-xl text-sm sm:text-base">
                            Lihat Semua Ulasan
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 20 20" fill="none">
                                <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </section>
    <!-- Customer Review Section End -->

</div>
