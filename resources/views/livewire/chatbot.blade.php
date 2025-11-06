<div x-data="{ showWelcome: false }" x-init="setTimeout(() => showWelcome = !@entangle('isOpen').value, 3000)" class="fixed bottom-6 right-6 z-[9999]">
    {{-- Welcome Tooltip - Enhanced with animations --}}
    <div x-show="showWelcome && !@entangle('isOpen').value" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2" @click="showWelcome = false"
        class="absolute bottom-20 right-0 bg-gradient-to-br from-white to-blue-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-2xl p-4 w-72 cursor-pointer border-2 border-blue-200 dark:border-blue-900 transform hover:scale-105 transition-all duration-300"
        style="display: none;">
        <div class="flex items-start space-x-3">
            <div
                class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg animate-bounce-slow">
                <span class="text-xl">👋</span>
            </div>
            <div class="flex-1 min-w-0">
                <p
                    class="text-sm font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-1">
                    Hai! Ada yang bisa saya bantu?
                </p>
                <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                    Tanyakan tentang produk pertanian kami!
                </p>
            </div>
            <button @click.stop="showWelcome = false"
                class="text-gray-400 hover:text-red-500 flex-shrink-0 transform hover:rotate-90 transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Floating Chat Button - Enhanced with glow effect --}}
    <button wire:click="toggleChat" @click="showWelcome = false" @class([
        'relative flex items-center justify-center w-16 h-16 rounded-2xl shadow-2xl transition-all duration-300 transform hover:scale-110 focus:outline-none group',
        'bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 text-white hover:shadow-blue-500/50' => !$isOpen,
        'bg-gradient-to-br from-red-500 to-pink-600 text-white hover:shadow-red-500/50' => $isOpen,
    ])>
        {{-- Glow Effect --}}
        <div
            class="absolute inset-0 rounded-2xl bg-gradient-to-r from-blue-400 to-purple-600 opacity-75 blur-lg animate-pulse">
        </div>

        {{-- Ripple Effect --}}
        @if (!$isOpen)
            <span class="absolute inset-0 rounded-2xl bg-blue-400 opacity-30 animate-ping"
                style="animation-duration: 2s;"></span>
        @endif

        @if ($isOpen)
            {{-- Close Icon --}}
            <svg class="w-7 h-7 relative z-10 transform transition-transform duration-300 group-hover:rotate-180"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        @else
            {{-- Chat Icon with AI badge --}}
            <div class="relative z-10">
                <svg class="w-7 h-7 transform transition-transform duration-300 group-hover:scale-125 group-hover:rotate-12"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                    </path>
                </svg>
                {{-- AI Badge --}}
                @if ($useAI)
                    <span
                        class="absolute -top-2 -right-2 px-1.5 py-0.5 bg-gradient-to-r from-green-400 to-emerald-500 text-white text-[9px] font-bold rounded-full shadow-lg animate-pulse border-2 border-white">
                        AI
                    </span>
                @endif
            </div>
        @endif
    </button>

    {{-- Chat Modal - Enhanced Design --}}
    <div x-data="{ show: @entangle('isOpen') }" x-show="show" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-90 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-90 translate-y-4"
        class="absolute bottom-20 right-0 w-96 max-w-[calc(100vw-3rem)] bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden border-2 border-blue-200 dark:border-gray-700"
        style="display: none;">

        {{-- Chat Header - More Modern Design --}}
        <div class="relative bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 px-5 py-4 text-white">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="flex items-center justify-between relative z-10">
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <div
                            class="w-11 h-11 bg-white rounded-2xl flex items-center justify-center shadow-lg transform hover:rotate-12 transition-transform duration-300">
                            <span class="text-2xl">🤖</span>
                        </div>
                        @if ($useAI)
                            <span class="absolute -top-1 -right-1 flex h-4 w-4">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span
                                    class="relative inline-flex rounded-full h-4 w-4 bg-green-500 border-2 border-white"></span>
                            </span>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-lg flex items-center gap-2">
                            <span
                                class="bg-gradient-to-r from-yellow-200 to-yellow-100 bg-clip-text text-transparent">Asisten
                                MJA</span>
                            @if ($useAI)
                                <span
                                    class="text-[10px] font-bold bg-gradient-to-r from-green-400 to-emerald-500 px-2 py-1 rounded-full shadow-md animate-pulse">AI</span>
                            @endif
                        </h3>
                        <p class="text-xs text-blue-100 flex items-center gap-1.5 mt-0.5">
                            <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span>
                            <span>Online • @if ($useAI)
                                    Powered by
                                    Gemini
                                @else
                                    24/7
                            </span>
                        </p>
                        @endif
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex space-x-1">
                    <button wire:click="clearChat"
                        class="p-2 hover:bg-white/20 rounded-xl transition-all duration-200 transform hover:scale-110 backdrop-blur-sm group"
                        title="Hapus Percakapan">
                        <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Chat Messages with Enhanced Design --}}
        <div id="chatMessages"
            class="h-96 overflow-y-auto p-4 space-y-4 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 scroll-smooth">

            {{-- Welcome Message (only shown when empty) --}}
            @if (count($messages) === 0)
                <div class="flex flex-col items-center justify-center h-full space-y-3 px-4 text-center py-6">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-blue-100 to-purple-100 dark:from-blue-900 dark:to-purple-900 rounded-2xl flex items-center justify-center">
                        <span class="text-3xl">👋</span>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-gray-800 dark:text-white mb-1">
                            Selamat datang di MJA! ✨
                        </h4>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-3">
                            Saya siap membantu Anda dengan informasi produk pertanian
                        </p>
                    </div>
                    <div class="grid grid-cols-1 gap-2 w-full">
                        <button wire:click="$set('message', 'Apa produk terbaik untuk padi?')"
                            class="px-3 py-2 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl text-xs hover:shadow-md transition-all duration-200 border border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-500 text-left">
                            💡 Apa produk terbaik untuk padi?
                        </button>
                        <button wire:click="$set('message', 'Bagaimana cara menggunakan pupuk NPK?')"
                            class="px-3 py-2 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl text-xs hover:shadow-md transition-all duration-200 border border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-500 text-left">
                            🌾 Bagaimana cara menggunakan pupuk NPK?
                        </button>
                        <button wire:click="$set('message', 'Dimana saya bisa melihat katalog produk?')"
                            class="px-3 py-2 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl text-xs hover:shadow-md transition-all duration-200 border border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-500 text-left">
                            📦 Dimana saya bisa melihat katalog produk?
                        </button>
                    </div>
                </div>
            @endif

            @foreach ($messages as $index => $msg)
                @if ($msg['type'] === 'bot')
                    {{-- Bot Message --}}
                    <div class="flex items-start space-x-2 animate-fade-in-up">
                        <div
                            class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0 shadow">
                            <span class="text-white text-sm">🤖</span>
                        </div>
                        <div class="flex-1 max-w-[80%]">
                            <div
                                class="bg-white dark:bg-gray-700 rounded-2xl rounded-tl-sm px-3 py-2 shadow-sm border border-gray-100 dark:border-gray-600">
                                <p class="text-sm text-gray-800 dark:text-gray-200 leading-relaxed">
                                    {!! nl2br($msg['message']) !!}
                                </p>
                            </div>
                            <div class="flex items-center space-x-2 mt-1 ml-2">
                                <span class="text-[10px] text-gray-500 dark:text-gray-400">{{ $msg['time'] }}</span>
                                @if ($useAI && $index === count($messages) - 1 && $msg['type'] === 'bot')
                                    <span class="text-xs text-green-500 flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z">
                                            </path>
                                        </svg>
                                        AI
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    {{-- User Message --}}
                    <div class="flex items-start space-x-2 justify-end animate-fade-in-up">
                        <div class="flex-1 text-right max-w-[80%] ml-auto">
                            <div
                                class="bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-2xl rounded-tr-sm px-3 py-2 shadow-sm inline-block">
                                <p class="text-sm leading-relaxed">{{ $msg['message'] }}</p>
                            </div>
                            <div class="flex items-center justify-end space-x-1.5 mt-1 mr-2">
                                <span class="text-[10px] text-gray-500 dark:text-gray-400">{{ $msg['time'] }}</span>
                                <svg class="w-3 h-3 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <div
                            class="w-8 h-8 bg-gradient-to-br from-green-400 to-blue-500 rounded-lg flex items-center justify-center flex-shrink-0 shadow">
                            <span class="text-white text-sm">👤</span>
                        </div>
                    </div>
                @endif
            @endforeach

            {{-- Typing Indicator --}}
            @if ($isTyping)
                <div class="flex items-start space-x-2 animate-fade-in">
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0 shadow">
                        <span class="text-white text-sm">🤖</span>
                    </div>
                    <div
                        class="bg-white dark:bg-gray-700 rounded-2xl rounded-tl-sm px-3 py-2 shadow-sm border border-gray-100 dark:border-gray-600">
                        <div class="flex space-x-1">
                            <div class="w-2 h-2 bg-blue-400 rounded-full animate-bounce" style="animation-delay: 0s">
                            </div>
                            <div class="w-2 h-2 bg-purple-400 rounded-full animate-bounce"
                                style="animation-delay: 0.15s"></div>
                            <div class="w-2 h-2 bg-pink-400 rounded-full animate-bounce"
                                style="animation-delay: 0.3s"></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Chat Input - Cleaner Design --}}
        <div class="p-3 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            <form wire:submit.prevent="sendMessage" class="space-y-2">
                <div
                    class="flex items-center space-x-2 bg-gray-50 dark:bg-gray-700 rounded-xl px-3 py-2 border border-gray-200 dark:border-gray-600 focus-within:ring-2 focus-within:ring-blue-400 focus-within:border-transparent transition-all">
                    {{-- Emoji Button --}}
                    <button type="button" class="flex-shrink-0 text-gray-400 hover:text-blue-500 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    {{-- Input Field --}}
                    <input type="text" wire:model="message" placeholder="Ketik pesan..."
                        class="flex-1 px-2 py-1.5 bg-transparent border-0 focus:outline-none focus:ring-0 text-sm text-gray-800 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
                        autofocus>

                    {{-- Send Button --}}
                    <button type="submit"
                        class="flex-shrink-0 p-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-md transform hover:scale-105 active:scale-95 transition-all duration-200 focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed"
                        @disabled(!$message)>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </div>

                {{-- Quick Suggestions (only when no messages) --}}
                @if (count($messages) === 0)
                    <div class="flex items-center gap-1.5 overflow-x-auto scrollbar-hide">
                        <button type="button" wire:click="$set('message', 'Info produk pupuk')"
                            class="flex-shrink-0 px-2.5 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-full text-[10px] font-medium hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors">
                            🌱 Info produk
                        </button>
                        <button type="button" wire:click="$set('message', 'Cara pemesanan')"
                            class="flex-shrink-0 px-2.5 py-1 bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 rounded-full text-[10px] font-medium hover:bg-purple-100 dark:hover:bg-purple-900/50 transition-colors">
                            📦 Pemesanan
                        </button>
                        <button type="button" wire:click="$set('message', 'Kontak admin')"
                            class="flex-shrink-0 px-2.5 py-1 bg-pink-50 dark:bg-pink-900/30 text-pink-600 dark:text-pink-400 rounded-full text-[10px] font-medium hover:bg-pink-100 dark:hover:bg-pink-900/50 transition-colors">
                            💬 Kontak
                        </button>
                    </div>
                @endif

                {{-- Footer Info --}}
                <div class="flex items-center justify-center text-[10px] text-gray-500 dark:text-gray-400">
                    @if ($useAI)
                        <div class="flex items-center gap-1">
                            <span class="relative flex h-1.5 w-1.5">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-green-500"></span>
                            </span>
                            <span>AI Active • Gemini ✨</span>
                        </div>
                    @else
                        <span>💡 Asisten 24/7</span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
    <style>
        /* Custom Animations */
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.3s ease-out;
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        /* Custom Scrollbar */
        #chatMessages::-webkit-scrollbar {
            width: 6px;
        }

        #chatMessages::-webkit-scrollbar-track {
            background: transparent;
        }

        #chatMessages::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #3b82f6, #8b5cf6);
            border-radius: 10px;
        }

        #chatMessages::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #2563eb, #7c3aed);
        }

        /* Hide scrollbar for suggestions */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Smooth transitions */
        * {
            scroll-behavior: smooth;
        }

        /* Glassmorphism effect */
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
        }

        /* Link styles in messages (converted from Tailwind @apply) */
        #chatMessages a {
            color: #2563eb;
            /* text-blue-600 */
            text-decoration: underline;
            text-decoration-thickness: 2px;
            /* decoration-2 */
            text-underline-offset: 2px;
            /* underline-offset-2 */
            font-weight: 600;
            /* font-semibold */
            transition: color 150ms;
            /* transition-colors */
        }

        .dark #chatMessages a {
            color: #60a5fa;
            /* dark:text-blue-400 */
        }

        #chatMessages a:hover {
            color: #1d4ed8;
            /* hover:text-blue-700 */
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            /* shadow-sm */
        }

        .dark #chatMessages a:hover {
            color: #93c5fd;
            /* dark:hover:text-blue-300 */
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Auto scroll to bottom with smooth animation
        function smoothScrollToBottom() {
            const chatMessages = document.getElementById('chatMessages');
            if (chatMessages) {
                chatMessages.scrollTo({
                    top: chatMessages.scrollHeight,
                    behavior: 'smooth'
                });
            }
        }

        // Auto scroll when new message arrives
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('scroll-to-bottom', () => {
                setTimeout(smoothScrollToBottom, 100);
            });
        });

        // Auto scroll on component update
        document.addEventListener('livewire:update', () => {
            setTimeout(smoothScrollToBottom, 150);
        });

        // Initial scroll on page load
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(smoothScrollToBottom, 200);
        });

        // Focus input when chat opens
        window.addEventListener('livewire:initialized', () => {
            Livewire.on('chat-opened', () => {
                setTimeout(() => {
                    const input = document.querySelector(
                        '#chatMessages ~ div form input[type="text"]');
                    if (input) input.focus();
                }, 300);
            });
        });
    </script>
@endpush
