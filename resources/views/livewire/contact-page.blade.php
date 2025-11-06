<div class="w-full">
    {{-- Hero Section --}}
    <div
        class="w-full bg-gradient-to-r from-blue-200 via-purple-200 to-cyan-200 py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="absolute inset-0 opacity-30">
            <div
                class="absolute top-10 left-10 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl animate-blob">
            </div>
            <div
                class="absolute top-10 right-10 w-72 h-72 bg-purple-400 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-200">
            </div>
            <div
                class="absolute -bottom-8 left-20 w-72 h-72 bg-cyan-400 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-400">
            </div>
        </div>
        <div class="max-w-[85rem] mx-auto text-center relative z-10 animate-fade-in-up">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-800 dark:text-white mb-6">
                Hubungi Kami <span
                    class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Munir Jaya
                    Abadi</span>
            </h1>
            <p class="text-lg sm:text-xl text-gray-700 dark:text-gray-300 max-w-3xl mx-auto">
                Kami siap membantu Anda. Hubungi kami untuk pertanyaan, saran, atau bantuan apapun yang Anda
                butuhkan.
            </p>
        </div>
    </div>

    {{-- Contact Info & Form Section --}}
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">

                {{-- Contact Information --}}
                <div class="lg:col-span-1 space-y-6 animate-fade-in-up">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                            Informasi Kontak
                        </h2>
                        <p class="text-gray-600 dark:text-gray-300 mb-8">
                            Jangan ragu untuk menghubungi kami. Tim kami siap membantu Anda dengan senang hati.
                        </p>
                    </div>

                    {{-- Contact Cards --}}
                    <div class="space-y-4">
                        {{-- Alamat --}}
                        <div
                            class="flex items-start gap-4 p-6 bg-gradient-to-br from-white to-blue-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 animate-fade-in-up animation-delay-200">
                            <div
                                class="w-14 h-14 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center flex-shrink-0 transform hover:rotate-12 transition-transform duration-300">
                                <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Alamat</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                    Jl. Jatibarang - Lelea, Bunder<br>
                                    Kec. Widasari, Kab. Indramayu<br>
                                    Jawa Barat 45271
                                </p>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div
                            class="flex items-start gap-4 p-6 bg-gradient-to-br from-white to-purple-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 animate-fade-in-up animation-delay-300">
                            <div
                                class="w-14 h-14 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center flex-shrink-0 transform hover:rotate-12 transition-transform duration-300">
                                <svg class="w-7 h-7 text-purple-600 dark:text-purple-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Email</h3>
                                <a href="mailto:rifqysaputra1102@gmail.com"
                                    class="text-sm text-blue-600 dark:text-blue-400 hover:underline break-all transform hover:translate-x-1 inline-block transition-transform duration-300">
                                    rifqysaputra1102@gmail.com
                                </a>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div
                            class="flex items-start gap-4 p-6 bg-gradient-to-br from-white to-green-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 animate-fade-in-up animation-delay-400">
                            <div
                                class="w-14 h-14 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center flex-shrink-0 transform hover:rotate-12 transition-transform duration-300">
                                <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Telepon</h3>
                                <a href="tel:+6285773818846"
                                    class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                    +62 857-7381-8846
                                </a>
                            </div>
                        </div>

                        {{-- WhatsApp --}}
                        <div
                            class="flex items-start gap-4 p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300">
                            <div
                                class="w-14 h-14 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">WhatsApp</h3>
                                <a href="https://wa.me/6285773818846" target="_blank"
                                    class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                    +62 857-7381-8846
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Business Hours --}}
                    <div
                        class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300">
                        <div
                            class="w-14 h-14 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-yellow-600 dark:text-yellow-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                            Jam Operasional
                        </h3>
                        <div class="space-y-3 text-sm text-gray-600 dark:text-gray-400">
                            <div class="flex justify-between items-center">
                                <span>Senin - Jumat</span>
                                <span class="font-semibold text-gray-900 dark:text-white">08:00 - 17:00</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span>Sabtu</span>
                                <span class="font-semibold text-gray-900 dark:text-white">08:00 - 14:00</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span>Minggu</span>
                                <span class="font-semibold text-red-600 dark:text-red-400">Tutup</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contact Form --}}
                <div class="lg:col-span-2">
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-shadow duration-300">
                        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                            Kirim Pesan
                        </h2>
                        <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">
                            Isi formulir di bawah ini dan kami akan segera merespons pesan Anda.
                        </p>

                        {{-- Success Message --}}
                        @if ($successMessage)
                            <div
                                class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg flex items-start gap-3">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400 flex-shrink-0 mt-0.5"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-sm text-green-800 dark:text-green-300">{{ $successMessage }}</p>
                            </div>
                        @endif

                        {{-- Error Message --}}
                        @if ($errorMessage)
                            <div
                                class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg flex items-start gap-3">
                                <svg class="w-5 h-5 text-red-600 dark:text-red-400 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-sm text-red-800 dark:text-red-300">{{ $errorMessage }}</p>
                            </div>
                        @endif

                        <form wire:submit.prevent="submitContact" class="space-y-6">
                            {{-- Name & Email --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="name" wire:model.blur="name"
                                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200 @error('name') @enderror"
                                        placeholder="Masukkan nama lengkap Anda">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" id="email" wire:model.blur="email"
                                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200 @error('email') @enderror"
                                        placeholder="nama@email.com">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Phone & Subject --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="phone"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Nomor Telepon <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" id="phone" wire:model.blur="phone"
                                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200 @error('phone') @enderror"
                                        placeholder="+62 857-7381-8846">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="subject"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Subjek <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="subject" wire:model.blur="subject"
                                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200 @error('subject') @enderror"
                                        placeholder="Subjek pesan Anda">
                                    @error('subject')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Message --}}
                            <div>
                                <label for="message"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Pesan <span class="text-red-500">*</span>
                                </label>
                                <textarea id="message" wire:model.blur="message" rows="6"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200 resize-none @error('message') @enderror"
                                    placeholder="Tulis pesan Anda di sini..."></textarea>
                                @error('message')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Minimal 10 karakter, maksimal 1000 karakter
                                </p>
                            </div>

                            {{-- Submit Button --}}
                            <div class="flex items-center justify-between pt-4">
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    <span class="text-red-500">*</span> Wajib diisi
                                </p>
                                <button type="submit"
                                    class="px-8 py-3 bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 disabled:opacity-50 disabled:cursor-not-allowed"
                                    wire:loading.attr="disabled">
                                    <span wire:loading.remove>
                                        Kirim Pesan
                                    </span>
                                    <span wire:loading class="flex items-center gap-2">
                                        <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        Mengirim...
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Map Section --}}
                    <div class="mt-8">
                        <div
                            class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                            <div class="p-6">
                                <div class="flex items-center gap-3 mb-4">
                                    <div
                                        class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Lokasi Kami</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">PT. Munir Jaya Abadi</p>
                                    </div>
                                </div>
                                <div class="rounded-xl overflow-hidden shadow-md">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.0438447728203!2d108.35190731476875!3d-6.371808395386851!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ec70000b49585%3A0xc50d3884faca6359!2sKantor%20PT.%20Munir%20Jaya%20Abadi!5e0!3m2!1sen!2sid!4v1699000000000!5m2!1sen!2sid"
                                        width="100%" height="400" style="border:0;" allowfullscreen=""
                                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                                        class="w-full h-64 lg:h-96">
                                    </iframe>
                                </div>
                                <div
                                    class="mt-4 p-4 bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-gray-700 dark:to-gray-600 rounded-xl">
                                    <p class="text-sm text-gray-700 dark:text-gray-200 font-medium mb-2">📍 Alamat
                                        Lengkap:</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">
                                        Jl. Jatibarang - Lelea, Bunder, Kec. Widasari,<br>
                                        Kabupaten Indramayu, Jawa Barat 45271
                                    </p>
                                    <a href="https://www.google.com/maps/dir//G7C3%2BRFQ+Kantor+PT.+Munir+Jaya+Abadi,+Jl.+Jatibarang+-+Lelea,+Bunder,+Kec.+Widasari,+Kabupaten+Indramayu,+Jawa+Barat+45271/@-6.3718084,108.3519073,17z"
                                        target="_blank"
                                        class="inline-flex items-center justify-center gap-2 mt-3 px-4 py-2 bg-white text-blue-600 rounded-lg font-semibold hover:bg-gray-100 transition-colors shadow-md">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                        </svg>
                                        Buka di Google Maps
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    {{-- FAQ Section (Optional) --}}
    <section class="py-20 bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-gray-800 dark:to-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                    Pertanyaan yang Sering Diajukan
                </h2>
                <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Temukan jawaban atas pertanyaan umum tentang produk dan layanan kami
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                {{-- FAQ Item 1 --}}
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-shadow duration-300">
                    <div
                        class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                        Bagaimana cara melakukan pemesanan?
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Anda dapat melakukan pemesanan melalui website kami dengan menambahkan produk ke keranjang dan
                        melakukan checkout. Kami menerima pembayaran melalui berbagai metode.
                    </p>
                </div>

                {{-- FAQ Item 2 --}}
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-shadow duration-300">
                    <div
                        class="w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                        Berapa lama waktu pengiriman?
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Estimasi pengiriman adalah 2-5 hari kerja untuk wilayah Jabodetabek dan 3-7 hari kerja untuk
                        luar kota, tergantung lokasi dan ketersediaan ekspedisi.
                    </p>
                </div>

                {{-- FAQ Item 3 --}}
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-shadow duration-300">
                    <div
                        class="w-16 h-16 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-yellow-600 dark:text-yellow-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                        Apakah produk memiliki garansi?
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Ya, semua produk kami dilengkapi dengan garansi resmi dari distributor. Durasi garansi
                        bervariasi tergantung jenis produk.
                    </p>
                </div>

                {{-- FAQ Item 4 --}}
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-shadow duration-300">
                    <div
                        class="w-16 h-16 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                        Bagaimana cara menghubungi customer service?
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Anda dapat menghubungi kami melalui email, telepon, atau WhatsApp. Tim customer service kami
                        siap membantu Anda pada jam operasional.
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
