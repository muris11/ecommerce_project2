<div class="bg-white py-20">
    <div class="w-full max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="max-w-4xl mx-auto">
            <!-- Back Button -->
            <div class="mb-8">
                <a href="/products/{{ $product->slug }}"
                    class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium transition-colors group">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                    Kembali ke Produk
                </a>
            </div>

            <!-- Header -->
            <div class="mb-10 text-center">
                <div class="relative flex flex-col items-center">
                    <h1 class="text-4xl md:text-5xl font-bold dark:text-gray-200 mb-2">
                        Review <span class="text-blue-500">Produk</span>
                    </h1>
                    <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200"></div>
                        <div class="flex-1 h-2 bg-blue-400"></div>
                        <div class="flex-1 h-2 bg-blue-600"></div>
                    </div>
                </div>
                <h2 class="text-xl md:text-2xl text-gray-700 dark:text-gray-300 font-semibold mb-2">
                    {{ $product->name }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Total <span class="font-semibold text-blue-600">{{ $reviews->total() }}</span> review dari pelanggan
                </p>
            </div>

            <!-- Reviews List -->
            <div class="space-y-6">
                @forelse($reviews as $review)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg transition-all border border-gray-100 dark:border-gray-700 p-6">
                        <!-- User Info -->
                        <div class="flex items-start justify-between mb-4 flex-wrap gap-4">
                            <div class="flex items-center gap-4">
                                <div class="flex-shrink-0">
                                    @if ($review->user->avatar)
                                        <img src="{{ Storage::url($review->user->avatar) }}"
                                            alt="{{ $review->user->name }}"
                                            class="w-14 h-14 rounded-full object-cover border-4 border-blue-100 dark:border-blue-900 shadow-lg"
                                            loading="lazy" width="56" height="56">
                                    @else
                                        <div
                                            class="w-14 h-14 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                            {{ strtoupper(substr($review->user->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                        {{ $review->user->name }}
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ $review->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Rating -->
                            <div
                                class="flex items-center gap-1 bg-yellow-50 dark:bg-yellow-900/20 px-3 py-2 rounded-lg">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                @endfor
                                <span class="ml-1 text-sm font-bold text-gray-700 dark:text-gray-300">
                                    {{ $review->rating }}/5
                                </span>
                            </div>
                        </div>

                        <!-- Review Comment -->
                        <div class="mb-4">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-base">
                                {{ $review->comment }}
                            </p>
                        </div>

                        <!-- Admin Reply -->
                        @if ($review->admin_reply)
                            <div
                                class="mt-4 pl-6 border-l-4 border-blue-500 bg-gradient-to-r from-blue-50 via-blue-50/50 to-transparent dark:from-blue-900/30 dark:via-blue-900/10 p-5 rounded-r-lg">
                                <div class="flex items-center gap-2 mb-3">
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
                                    @if ($review->replied_at)
                                        <span class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $review->replied_at->format('d M Y') }}
                                        </span>
                                    @endif
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed pl-10">
                                    {{ $review->admin_reply }}
                                </p>
                            </div>
                        @endif
                    </div>
                @empty
                    <div
                        class="text-center py-20 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-700">
                        <div
                            class="w-20 h-20 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="h-10 w-10 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Belum ada review</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Jadilah yang pertama memberikan review untuk produk ini.
                        </p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
</div>
