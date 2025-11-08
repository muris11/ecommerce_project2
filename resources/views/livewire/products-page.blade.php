@push('meta')
    <meta name="description"
        content="Lihat katalog produk pertanian lengkap: beras, pupuk, pestisida. Filter berdasarkan kategori, merek, harga, dan promo.">
    <meta property="og:title" content="Produk - Munir Jaya Abadi">
    <meta property="og:description" content="Jelajahi produk pertanian berkualitas dengan harga terbaik.">
    <meta property="og:type" content="website">
@endpush

<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section
        class="py-10 bg-gradient-to-br from-gray-50 to-blue-50 font-poppins   rounded-lg animate-fade-in">
        <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
            <div class="flex flex-wrap mb-24 -mx-3">
                <div class="w-full pr-2 lg:w-1/4 lg:block">
                    <div
                        class="p-4 mb-5 bg-white border border-gray-200   rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 animate-fade-in-up">
                        <h2 class="text-2xl font-bold  flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            Kategori
                        </h2>
                        <div class="w-16 pb-2 mb-6 border-b-2 border-blue-600 "></div>
                        <ul>

                            @foreach ($categories as $category)
                                <li class="mb-4 transform hover:translate-x-2 transition-all duration-300" wire:key
                                    {{ $category->id }}>
                                    <label for="{{ $category->slug }}"
                                        class="flex items-center  cursor-pointer group">
                                        <input type="checkbox" wire:model.live="selected_categories"
                                            id="{{ $category->slug }}" value="{{ $category->id }}"
                                            class="w-4 h-4 mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500 transition-all">
                                        <span
                                            class="text-lg group-hover:text-blue-600 transition-colors duration-300">{{ $category->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <div
                        class="p-4 mb-5 bg-white border border-gray-200   rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 animate-fade-in-up animation-delay-200">
                        <h2 class="text-2xl font-bold  flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                            Merek
                        </h2>
                        <div class="w-16 pb-2 mb-6 border-b-2 border-blue-600 "></div>
                        <ul>
                            @foreach ($brands as $brand)
                                <li class="mb-4 transform hover:translate-x-2 transition-all duration-300" wire:key
                                    {{ $brand->id }}>
                                    <label for="{{ $brand->slug }}"
                                        class="flex items-center  cursor-pointer group">
                                        <input type="checkbox" wire:model.live="selected_brands"
                                            id="{{ $brand->slug }}" value="{{ $brand->id }}"
                                            class="w-4 h-4 mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500 transition-all">
                                        <span
                                            class="text-lg  group-hover:text-blue-600 transition-colors duration-300">{{ $brand->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div
                        class="p-4 mb-5 bg-white border border-gray-200   rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 animate-fade-in-up animation-delay-400">
                        <h2 class="text-2xl font-bold  flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Status Produk
                        </h2>
                        <div class="w-16 pb-2 mb-6 border-b-2 border-blue-600 "></div>
                        <ul>
                            <li class="mb-4 transform hover:translate-x-2 transition-all duration-300">
                                <label for="featured" class="flex items-center  cursor-pointer group">
                                    <input type="checkbox" id="featured" wire:model.live="featured" value="1"
                                        class="w-4 h-4 mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500 transition-all">
                                    <span
                                        class="text-lg  group-hover:text-blue-600 transition-colors duration-300">Produk
                                        Unggulan</span>
                                </label>
                            </li>
                            <li class="mb-4 transform hover:translate-x-2 transition-all duration-300">
                                <label for="on_sale" class="flex items-center  cursor-pointer group">
                                    <input type="checkbox" id="on_sale" wire:model.live="on_sale" value="1"
                                        class="w-4 h-4 mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500 transition-all">
                                    <span
                                        class="text-lg  group-hover:text-blue-600 transition-colors duration-300">Di
                                        Jual</span>
                                </label>
                            </li>
                        </ul>
                    </div>

                    <div
                        class="p-4 mb-5 bg-white border border-gray-200   rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 animate-fade-in-up animation-delay-600">
                        <h2 class="text-2xl font-bold  flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            Harga
                        </h2>
                        <div class="w-16 pb-2 mb-6 border-b-2 border-blue-600 "></div>
                        <div>
                            <div class="font-semibold">{{ Number::currency($price_range, 'IDR') }}</div>
                            <input type="range" wire:model.live="price_range"
                                class="w-full h-1 mb-4 bg-blue-100 rounded appearance-none cursor-pointer"
                                max="10000000" value="10000000" step="1000">
                            <div class="flex justify-between ">
                                <span
                                    class="inline-block text-lg font-bold text-blue-400 ">{{ Number::currency(1000, 'IDR') }}</span>
                                <span
                                    class="inline-block text-lg font-bold text-blue-400 ">{{ Number::currency(10000000, 'IDR') }}</span>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full px-3 lg:w-3/4">
                    <div class="px-3 mb-4">
                        <div
                            class="items-center justify-between hidden px-3 py-2 bg-gray-100 md:flex  ">
                            <div class="flex items-center justify-between">
                                <select wire:model.live="sort"
                                    class="block w-75 text-base bg-gray-100 cursor-pointer  ">
                                    <option value="latest">Urutan Terbaru</option>
                                    <option value="price">Urutan Harga Terendah</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center ">

                        @foreach ($products as $product)
                            <div class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3 animate-fade-in-up"
                                wire:key={{ $product->id }} style="animation-delay: {{ $loop->index * 50 }}ms">
                                <div
                                    class="bg-white  rounded-xl shadow-md hover:shadow-2xl transition-all duration-500 border border-gray-200  overflow-hidden group transform hover:-translate-y-2 hover:scale-105">
                                    <div class="relative bg-gray-100  overflow-hidden">
                                        <a href="{{ route('products.show', $product->slug) }}" class="block">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                            </div>
                                            <img src="{{ is_array($product->image) && !empty($product->image) ? url('storage', $product->image[0]) : url('images/no-image.png') }}"
                                                alt="{{ $product->name }}"
                                                class="object-cover w-full h-56 lg:h-72 transform group-hover:scale-110 group-hover:rotate-2 transition-all duration-500"
                                                class="object-cover w-full h-56 mx-auto transform group-hover:scale-110 transition-transform duration-300"
                                                loading="lazy" width="300" height="224">
                                        </a>
                                    </div>
                                    <div class="p-4">
                                        <div class="mb-3">
                                            <h3
                                                class="text-lg font-semibold text-gray-800  line-clamp-2 min-h-[3.5rem] hover:text-blue-600  transition-colors">
                                                <a
                                                    href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                            </h3>
                                        </div>
                                        <div class="flex items-center justify-between mb-4">
                                            <p class="text-xl font-bold text-green-600 ">
                                                {{ Number::currency($product->price, 'IDR') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="px-4 pb-4">
                                        <button wire:click.prevent="addToCart({{ $product->id }})"
                                            class="w-full py-3 px-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold rounded-lg flex items-center justify-center gap-2 transition-all duration-300 shadow-sm hover:shadow-md active:scale-95">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                                <path
                                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                                </path>
                                            </svg>
                                            <span wire:loading.remove
                                                wire:target="addToCart({{ $product->id }})">Tambah Ke
                                                Keranjang</span>
                                            <span wire:loading wire:target="addToCart({{ $product->id }})"
                                                class="flex items-center gap-2">
                                                <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                        stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                    </path>
                                                </svg>
                                                Menambahkan..
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <!-- pagination start -->
                    <div class="flex justify-end mt-6">
                        {{ $products->links() }}
                    </div>
                    <!-- pagination end -->
                </div>
            </div>
        </div>
    </section>

</div>
