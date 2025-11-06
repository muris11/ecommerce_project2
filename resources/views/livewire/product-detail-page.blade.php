@push('meta')
    <meta name="description" content="{{ Str::limit(strip_tags($product->description ?? $product->name), 160) }}">
    <meta property="og:title" content="{{ $product->name }} - Munir Jaya Abadi">
    <meta property="og:description" content="{{ Str::limit(strip_tags($product->description ?? ''), 180) }}">
    <meta property="og:type" content="product">
@endpush

<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="overflow-hidden bg-white py-11 font-poppins dark:bg-gray-800 rounded-xl shadow-lg">
        <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full mb-8 md:w-1/2 md:mb-0 animate-fade-in-up" x-data="{ mainImage: '{{ is_array($product->image) && !empty($product->image) ? url('storage', $product->image[0]) : url('images/no-image.png') }}' }">
                    <div class="sticky top-0 z-50 overflow-hidden">
                        <div class="relative mb-6 lg:mb-10 lg:h-2/4 group">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl">
                            </div>
                            <img x-bind:src="mainImage" alt="{{ $product->name }}"
                                class="object-cover w-full lg:h-full rounded-xl shadow-lg transform group-hover:scale-105 transition-transform duration-500"
                                loading="eager" width="600" height="600">
                        </div>
                        <div class="flex-wrap hidden md:flex gap-2">
                            @if (!empty($product->image))
                                @foreach ($product->image as $image)
                                    <div class="w-1/2 p-2 sm:w-1/4 animate-fade-in-up"
                                        style="animation-delay: {{ $loop->index * 100 }}ms"
                                        x-on:click="mainImage='{{ url('storage', $image) }}'">
                                        <img src="{{ url('storage', $image) }}" alt="{{ $product->name }}"
                                            class="object-cover w-full lg:h-20 cursor-pointer rounded-lg border-2 border-transparent hover:border-blue-500 transform hover:scale-110 hover:-translate-y-1 transition-all duration-300 shadow-md hover:shadow-xl"
                                            loading="lazy" width="100" height="80">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="px-6 pb-6 mt-6 border-t border-gray-300 dark:border-gray-400">
                            <div
                                class="mt-6 p-4 sm:p-6 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5 animate-fade-in-up">
                                <div class="flex flex-col sm:flex-row items-start gap-3 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor"
                                        class="w-6 h-6 sm:w-7 sm:h-7 text-blue-600 dark:text-blue-400 flex-shrink-0 mt-0.5 sm:mt-1 animate-pulse"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z">
                                        </path>
                                    </svg>
                                    <div class="flex-1">
                                        <h3
                                            class="text-base sm:text-lg font-bold text-blue-700 dark:text-blue-400 mb-2 animate-fade-in">
                                            Layanan Pengiriman Tersedia</h3>
                                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mb-4 animate-fade-in"
                                            style="animation-delay: 100ms">
                                            Pilih kurir saat checkout untuk melihat estimasi biaya dan waktu pengiriman
                                        </p>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-3">
                                            <div class="flex items-center gap-2 text-xs sm:text-sm text-gray-700 dark:text-gray-300 p-2 rounded-md hover:bg-white/50 dark:hover:bg-gray-800/50 transition-all duration-200 transform hover:translate-x-1 animate-fade-in-up"
                                                style="animation-delay: 150ms">
                                                <svg class="w-4 h-4 text-green-600 dark:text-green-400 flex-shrink-0"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="font-medium">JNE</span>
                                            </div>
                                            <div class="flex items-center gap-2 text-xs sm:text-sm text-gray-700 dark:text-gray-300 p-2 rounded-md hover:bg-white/50 dark:hover:bg-gray-800/50 transition-all duration-200 transform hover:translate-x-1 animate-fade-in-up"
                                                style="animation-delay: 200ms">
                                                <svg class="w-4 h-4 text-green-600 dark:text-green-400 flex-shrink-0"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="font-medium">POS Indonesia</span>
                                            </div>
                                            <div class="flex items-center gap-2 text-xs sm:text-sm text-gray-700 dark:text-gray-300 p-2 rounded-md hover:bg-white/50 dark:hover:bg-gray-800/50 transition-all duration-200 transform hover:translate-x-1 animate-fade-in-up"
                                                style="animation-delay: 250ms">
                                                <svg class="w-4 h-4 text-green-600 dark:text-green-400 flex-shrink-0"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="font-medium">TIKI</span>
                                            </div>
                                            <div class="flex items-center gap-2 text-xs sm:text-sm text-gray-700 dark:text-gray-300 p-2 rounded-md hover:bg-white/50 dark:hover:bg-gray-800/50 transition-all duration-200 transform hover:translate-x-1 animate-fade-in-up"
                                                style="animation-delay: 300ms">
                                                <svg class="w-4 h-4 text-green-600 dark:text-green-400 flex-shrink-0"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="font-medium">J&T Express</span>
                                            </div>
                                            <div class="flex items-center gap-2 text-xs sm:text-sm text-gray-700 dark:text-gray-300 p-2 rounded-md hover:bg-white/50 dark:hover:bg-gray-800/50 transition-all duration-200 transform hover:translate-x-1 animate-fade-in-up"
                                                style="animation-delay: 350ms">
                                                <svg class="w-4 h-4 text-green-600 dark:text-green-400 flex-shrink-0"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="font-medium">SiCepat</span>
                                            </div>
                                            <div class="flex items-center gap-2 text-xs sm:text-sm text-gray-700 dark:text-gray-300 p-2 rounded-md hover:bg-white/50 dark:hover:bg-gray-800/50 transition-all duration-200 transform hover:translate-x-1 animate-fade-in-up"
                                                style="animation-delay: 400ms">
                                                <svg class="w-4 h-4 text-green-600 dark:text-green-400 flex-shrink-0"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="font-medium">AnterAja</span>
                                            </div>
                                            <div class="flex items-center gap-2 text-xs sm:text-sm text-gray-700 dark:text-gray-300 p-2 rounded-md hover:bg-white/50 dark:hover:bg-gray-800/50 transition-all duration-200 transform hover:translate-x-1 animate-fade-in-up"
                                                style="animation-delay: 450ms">
                                                <svg class="w-4 h-4 text-green-600 dark:text-green-400 flex-shrink-0"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="font-medium">Ninja Express</span>
                                            </div>
                                            <div class="flex items-center gap-2 text-xs sm:text-sm text-gray-700 dark:text-gray-300 p-2 rounded-md hover:bg-white/50 dark:hover:bg-gray-800/50 transition-all duration-200 transform hover:translate-x-1 animate-fade-in-up"
                                                style="animation-delay: 500ms">
                                                <svg class="w-4 h-4 text-green-600 dark:text-green-400 flex-shrink-0"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="font-medium">Lion Parcel</span>
                                            </div>
                                            <div class="flex items-center gap-2 text-xs sm:text-sm text-gray-700 dark:text-gray-300 p-2 rounded-md hover:bg-white/50 dark:hover:bg-gray-800/50 transition-all duration-200 transform hover:translate-x-1 animate-fade-in-up"
                                                style="animation-delay: 550ms">
                                                <svg class="w-4 h-4 text-green-600 dark:text-green-400 flex-shrink-0"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="font-medium">PCP Express</span>
                                            </div>
                                            <div class="flex items-center gap-2 text-xs sm:text-sm text-gray-700 dark:text-gray-300 p-2 rounded-md hover:bg-white/50 dark:hover:bg-gray-800/50 transition-all duration-200 transform hover:translate-x-1 animate-fade-in-up"
                                                style="animation-delay: 600ms">
                                                <svg class="w-4 h-4 text-green-600 dark:text-green-400 flex-shrink-0"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="font-medium">JET Express</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full px-4 md:w-1/2 animate-fade-in-up animation-delay-200">
                    <div class="lg:pl-20">
                        <div class="mb-8 [&>ul]:list-disc [&>ul:ml-4]">
                            <h2
                                class="max-w-xl mb-6 text-2xl font-bold dark:text-gray-400 md:text-4xl transform hover:scale-105 transition-transform duration-300 bg-gradient-to-r from-gray-900 to-gray-700 dark:from-gray-100 dark:to-gray-300 bg-clip-text text-transparent">
                                {{ $product->name }}</h2>
                            <p
                                class="inline-block mb-6 text-4xl font-bold text-transparent bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text animate-pulse-slow">
                                <span>
                                    {{ Number::currency($product->price * $quantity, 'IDR') }}
                                </span>
                            </p>
                            <p
                                class="whitespace-pre-line leading-relaxed text-gray-700 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 transition-colors duration-300">
                                {!! Str::markdown($product->description ?? '') !!}
                            </p>
                        </div>
                        <div class="w-32 mb-8">
                            <label for=""
                                class="w-full pb-1 text-xl font-semibold text-gray-700 border-b-2 border-blue-300 dark:border-gray-600 dark:text-gray-400">Jumlah</label>
                            <div
                                class="relative flex flex-row w-full h-10 mt-6 bg-transparent rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                                <button wire:click="decreaseQty"
                                    class="w-20 h-full text-gray-600 bg-gray-300 rounded-l-lg outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 hover:text-gray-700 dark:bg-gray-900 hover:bg-gray-400 transform hover:scale-105 active:scale-95 transition-all duration-300">
                                    <span class="m-auto text-2xl font-thin">-</span>
                                </button>
                                <input type="number" wire:model="quantity" readonly
                                    class="flex items-center w-full font-semibold text-center text-gray-700 placeholder-gray-700 bg-gray-300 outline-none dark:text-gray-400 dark:placeholder-gray-400 dark:bg-gray-900 focus:outline-none text-md hover:text-black"
                                    placeholder="1">
                                <button wire:click="increaseQty"
                                    class="w-20 h-full text-gray-600 bg-gray-300 rounded-r-lg outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 dark:bg-gray-900 hover:text-gray-700 hover:bg-gray-400 transform hover:scale-105 active:scale-95 transition-all duration-300">
                                    <span class="m-auto text-2xl font-thin">+</span>
                                </button>
                            </div>
                        </div>
                        <div class="flex flex-wrap items-center gap-4">
                            <button wire:click="addToCart({{ $product->id }})"
                                class="w-full p-4 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg lg:w-auto dark:text-gray-200 text-gray-50 hover:from-blue-700 hover:to-purple-700 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-semibold flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                <span wire:loading.remove wire:target="addToCart({{ $product->id }})">Tambah Ke
                                    Keranjang</span><span wire:loading
                                    wire:target="addToCart({{ $product->id }})">Menambahkan..</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="max-w-6xl px-4 py-8 mx-auto md:px-6 animate-fade-in-up animation-delay-400">
            <div class="mb-8 border-b border-gray-200 dark:border-gray-700 pb-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Review Pelanggan</h2>
                        <div class="flex items-center">
                            <div class="flex items-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= floor($averageRating) ? 'text-yellow-400' : 'text-gray-300' }} transform hover:scale-125 transition-transform duration-300"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                @endfor
                            </div>
                            <span class="ml-2 text-gray-600 dark:text-gray-400">{{ $averageRating }} dari 5</span>
                            <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">({{ $reviewCount }}
                                review)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Review Form (Only for logged-in users) -->
            @auth
                <div
                    class="mb-8 bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-100 dark:border-gray-700 p-6 md:p-8">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                        <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Tulis Review Anda
                    </h3>
                    <form wire:submit.prevent="submitReview">
                        <!-- Rating Stars -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                                Berikan Rating
                            </label>
                            <div class="flex items-center space-x-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <button type="button" wire:click="$set('rating', {{ $i }})"
                                        class="focus:outline-none transition-all hover:scale-110">
                                        <svg class="w-10 h-10 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }} hover:text-yellow-400 transition-colors"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    </button>
                                @endfor
                                <span
                                    class="ml-3 text-lg font-medium text-gray-700 dark:text-gray-300">{{ $rating }}
                                    / 5</span>
                            </div>
                            @error('rating')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Comment -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Ulasan Anda
                            </label>
                            <textarea wire:model="comment" rows="5"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white transition-all"
                                placeholder="Ceritakan pengalaman Anda dengan produk ini... (minimal 20 karakter)"></textarea>
                            @error('comment')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full md:w-auto px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                            <span wire:loading.remove wire:target="submitReview" class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Kirim Review
                            </span>
                            <span wire:loading wire:target="submitReview" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Mengirim...
                            </span>
                        </button>
                    </form>
                </div>
            @else
                <div
                    class="mb-8 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 p-10 text-center">
                    <div
                        class="w-20 h-20 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                        Login untuk Memberikan Review
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                        Bagikan pengalaman Anda dengan pelanggan lainnya
                    </p>
                    <a href="/login"
                        class="inline-flex items-center gap-2 px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all shadow-sm hover:shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Login Sekarang
                    </a>
                </div>
            @endauth

            <!-- Recent Reviews -->
            <div class="space-y-6">
                @forelse($recentReviews as $review)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100 dark:border-gray-700 p-6">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-4">
                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0">
                                    @if ($review->user->avatar)
                                        <img src="{{ Storage::url($review->user->avatar) }}"
                                            alt="{{ $review->user->name }}"
                                            class="w-12 h-12 rounded-full object-cover border-2 border-blue-100 dark:border-blue-900 shadow-sm"
                                            loading="lazy" width="48" height="48">
                                    @else
                                        <div
                                            class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-lg shadow-sm">
                                            {{ strtoupper(substr($review->user->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="text-base font-semibold text-gray-900 dark:text-white">
                                        {{ $review->user->name }}
                                    </h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ $review->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                            <div
                                class="flex items-center gap-1 bg-yellow-50 dark:bg-yellow-900/20 px-3 py-2 rounded-lg self-start">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                @endfor
                            </div>
                        </div>
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-3">
                            {{ $review->comment }}
                        </p>

                        @if ($review->admin_reply)
                            <div
                                class="mt-4 pl-6 border-l-4 border-blue-500 bg-gradient-to-r from-blue-50 via-blue-50/50 to-transparent dark:from-blue-900/30 dark:via-blue-900/10 p-4 rounded-r-lg">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z">
                                            </path>
                                            <path
                                                d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z">
                                            </path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-bold text-blue-600 dark:text-blue-400">
                                        Balasan dari Admin
                                    </span>
                                </div>
                                <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed pl-10">
                                    {{ $review->admin_reply }}
                                </p>
                            </div>
                        @endif
                    </div>
                @empty
                    <div
                        class="text-center py-12 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-700">
                        <div
                            class="w-20 h-20 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-gray-400 dark:text-gray-500" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Belum ada review</h3>
                        <p class="text-gray-600 dark:text-gray-400">Jadilah yang pertama memberikan review untuk produk
                            ini.</p>
                    </div>
                @endforelse

                @if ($reviewCount > 4)
                    <div class="text-center mt-8">
                        <a href="/products/{{ $product->slug }}/reviews"
                            class="inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold rounded-lg transition-all shadow-sm hover:shadow-md">
                            Lihat Semua Review ({{ $reviewCount }})
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
</div>
