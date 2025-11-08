    <section class="py-20">
        <div class="relative flex flex-col items-center animate-fade-in-up">
            <h1 class="text-5xl font-bold mb-5">
                <span
                    class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent animate-gradient-x">
                    Merek Populer
                </span>
            </h1>
            <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded-full shadow-md">
                <div class="flex-1 h-2 bg-gradient-to-r from-blue-200 to-blue-300 animate-pulse"></div>
                <div class="flex-1 h-2 bg-gradient-to-r from-blue-400 to-blue-500 animate-pulse animation-delay-200">
                </div>
                <div class="flex-1 h-2 bg-gradient-to-r from-blue-600 to-purple-600 animate-pulse animation-delay-400">
                </div>
            </div>
        </div>
        <div class="justify-center max-w-6xl px-4 py-4 mx-auto lg:py-0">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-4 md:grid-cols-2">

                @foreach ($brands as $brand)
                    <div class="group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 hover:scale-105 hover:rotate-1 animate-fade-in-up"
                        style="animation-delay: {{ $loop->index * 100 }}ms" wire:key="{{ $brand->id }}">
                        <a href="/products?selected_brands[0]={{ $brand->id }}"
                            class="block relative overflow-hidden rounded-t-xl">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10 flex items-end p-4">
                                <span
                                    class="text-white font-semibold text-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    Lihat Produk →
                                </span>
                            </div>
                            <img src="{{ $brand->image ? url('storage', $brand->image) : url('images/no-image.png') }}"
                                alt="{{ $brand->name }}"
                                class="object-cover w-full h-64 rounded-t-xl transform group-hover:scale-110 group-hover:rotate-2 transition-all duration-500"
                                loading="lazy" width="300" height="256">
                        </a>
                        <div class="p-5 text-center bg-gradient-to-br from-white to-gray-50 rounded-b-xl">
                            <a href="/products?selected_brands[0]={{ $brand->id }}"
                                class="text-2xl font-bold tracking-tight text-gray-900 hover:text-blue-600 transition-colors duration-300 inline-block transform group-hover:scale-110">
                                {{ $brand->name }}
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
