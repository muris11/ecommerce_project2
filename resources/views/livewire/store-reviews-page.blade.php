<div class="bg-white py-20">
    <div class="w-full max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="mb-12 text-center">
                <div class="relative flex flex-col items-center">
                    <h1 class="text-5xl font-bold  mb-2">
                        Penilaian <span class="text-blue-500">Pelanggan</span>
                    </h1>
                    <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200"></div>
                        <div class="flex-1 h-2 bg-blue-400"></div>
                        <div class="flex-1 h-2 bg-blue-600"></div>
                    </div>
                </div>
                <p class="text-gray-600  text-lg">
                    Apa kata pelanggan kami tentang toko ini
                </p>
            </div>

            <!-- Average Rating Card -->
            <div
                class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-8 mb-10 text-white hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-center flex-col md:flex-row gap-6">
                    <div class="text-center">
                        <div class="text-7xl font-bold mb-3">{{ $averageRating }}</div>
                        <div class="flex items-center justify-center gap-1 mb-3">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-7 h-7 {{ $i <= floor($averageRating) ? 'text-yellow-300' : 'text-white/30' }}"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-white/95 text-lg font-medium">Berdasarkan {{ $totalReviews }} ulasan</p>
                    </div>
                </div>
            </div>

            <!-- Submit Review Form -->
            @auth
                <div
                    class="bg-white  rounded-xl shadow-md hover:shadow-lg transition-shadow border border-gray-100  p-6 md:p-8 mb-10">
                    <h2 class="text-2xl font-bold text-gray-900  mb-6 flex items-center gap-2">
                        <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Bagikan Pengalaman Anda
                    </h2>
                    <form wire:submit.prevent="submitReview">
                        <!-- Rating Stars -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700  mb-3">
                                Berikan Rating
                            </label>
                            <div class="flex items-center space-x-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <button type="button" wire:click="$set('rating', {{ $i }})"
                                        class="focus:outline-none transition-all hover:scale-110">
                                        <svg class="w-10 h-10 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    </button>
                                @endfor
                                <span class="ml-3 text-lg font-medium text-gray-700 ">{{ $rating }}
                                    /
                                    5</span>
                            </div>
                            @error('rating')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Review Text -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700  mb-2">
                                Ulasan Anda
                            </label>
                            <textarea wire:model="review" rows="5"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500   "
                                placeholder="Ceritakan pengalaman Anda berbelanja di toko kami... (minimal 20 karakter)"></textarea>
                            @error('review')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full md:w-auto px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                            <span wire:loading.remove wire:target="submitReview">
                                <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Kirim Ulasan
                            </span>
                            <span wire:loading wire:target="submitReview" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
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
                    class="bg-gradient-to-br from-gray-50 to-gray-100   rounded-xl shadow-md border border-gray-200  p-10 mb-10 text-center">
                    <div
                        class="w-20 h-20 bg-blue-100  rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-blue-600 " fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900  mb-2">
                        Login untuk Memberikan Ulasan
                    </h3>
                    <p class="text-gray-600  mb-6">
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

            <!-- Reviews List -->
            <div class="space-y-6">
                <div class="flex items-center gap-3 mb-8">
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                        </path>
                    </svg>
                    <h2 class="text-3xl font-bold text-gray-900 ">
                        Semua Ulasan <span class="text-blue-500">({{ $totalReviews }})</span>
                    </h2>
                </div>

                @forelse($reviews as $review)
                    <div
                        class="bg-white  rounded-xl shadow-md hover:shadow-lg transition-all border border-gray-100  p-6">
                        <!-- User Info & Rating -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-4">
                                <div class="flex-shrink-0">
                                    @if ($review->user->avatar)
                                        <img src="{{ Storage::url($review->user->avatar) }}"
                                            alt="{{ $review->user->name }}"
                                            class="w-16 h-16 rounded-full object-cover border-4 border-blue-100  shadow-lg"
                                            loading="lazy" width="64" height="64">
                                    @else
                                        <div
                                            class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                                            {{ strtoupper(substr($review->user->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 ">
                                        {{ $review->user->name }}
                                    </h3>
                                    <p class="text-sm text-gray-500  flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
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
                                class="flex items-center gap-1 bg-yellow-50  px-3 py-2 rounded-lg">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-6 h-6 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
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
                            <p class="text-gray-700  leading-relaxed text-base">
                                {{ $review->review }}
                            </p>
                        </div>

                        <!-- Admin Reply -->
                        @if ($review->admin_reply)
                            <div
                                class="mt-4 pl-6 border-l-4 border-blue-500 bg-gradient-to-r from-blue-50 via-blue-50/50 to-transparent   p-5 rounded-r-lg">
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
                                    <span class="text-sm font-bold text-blue-600 ">
                                        Balasan dari Admin Toko
                                    </span>
                                    @if ($review->replied_at)
                                        <span class="text-xs text-gray-500  flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $review->replied_at->format('F d, Y') }}
                                        </span>
                                    @endif
                                </div>
                                <p class="text-gray-700  leading-relaxed pl-10">
                                    {{ $review->admin_reply }}
                                </p>
                            </div>
                        @endif
                    </div>
                @empty
                    <div
                        class="text-center py-20 bg-gradient-to-br from-gray-50 to-gray-100   rounded-xl border-2 border-dashed border-gray-300 ">
                        <div
                            class="w-20 h-20 bg-gray-200  rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="h-10 w-10 text-gray-400 " fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900  mb-2">Belum Ada Ulasan</h3>
                        <p class="text-gray-600 ">
                            Jadilah yang pertama memberikan ulasan untuk toko kami!
                        </p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($reviews->hasPages())
                <div class="mt-10">
                    {{ $reviews->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
