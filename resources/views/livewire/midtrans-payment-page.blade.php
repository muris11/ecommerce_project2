<div>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <!-- Header dengan Gradient Modern -->
        <div class="text-center mb-8 animate-fade-in-up">
            <h1
                class="text-4xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent mb-2">
                Pembayaran Midtrans</h1>
            <p class="text-gray-600">Selesaikan pembayaran Anda dengan aman</p>
        </div>

        <!-- Breadcrumb -->
        <div class="flex items-center justify-center gap-2 mb-8 text-sm animate-fade-in-up"
            style="animation-delay: 100ms">
            <a href="/checkout" class="text-gray-500 hover:text-green-600 transition-colors">Checkout</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-green-600 font-semibold">Pembayaran</span>
        </div>

        @if ($error)
            <div
                class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-lg mb-6 shadow-md animate-fade-in">
                <div class="flex items-start">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div class="flex-1">
                        <p class="font-bold mb-1">Terjadi Kesalahan</p>
                        <p class="text-sm">{{ $error }}</p>
                        <div class="mt-4 flex gap-2">
                            <a href="/checkout"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                Kembali ke Checkout
                            </a>
                            @if ($order)
                                <button wire:click="refreshToken"
                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                    <span wire:loading.remove wire:target="refreshToken">Refresh Token</span>
                                    <span wire:loading wire:target="refreshToken">Memuat...</span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @elseif(!$order)
            <div class="bg-white shadow-xl rounded-2xl p-8 max-w-md mx-auto text-center animate-fade-in-up">
                <div
                    class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-bounce-x">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Transaksi Tidak Ditemukan</h2>
                <p class="text-gray-600 mb-6">Order yang Anda cari tidak ditemukan atau telah
                    dihapus.</p>
                <div class="flex gap-2 justify-center">
                    <a href="/checkout"
                        class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-all transform hover:scale-105">
                        Checkout Ulang
                    </a>
                    <a href="/my-orders"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition-all transform hover:scale-105">
                        Lihat Pesanan
                    </a>
                </div>
            </div>
        @elseif($snapToken)
            <div class="bg-white shadow-xl rounded-2xl p-8 max-w-2xl mx-auto animate-fade-in-up overflow-hidden">
                <!-- Decorative Header -->
                <div
                    class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-green-500 via-emerald-500 to-teal-500">
                </div>

                <!-- Order Info Section -->
                <div class="text-center mb-8 pt-4">
                    <div
                        class="inline-flex items-center gap-2 bg-green-50 px-4 py-2 rounded-full mb-4 animate-pulse-slow">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-green-700 font-semibold text-sm">Pesanan Berhasil
                            Dibuat</span>
                    </div>

                    <h2
                        class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-3">
                        Detail Pesanan</h2>

                    <!-- Order ID Badge -->
                    <div class="inline-flex items-center gap-2 bg-gray-100 px-4 py-2 rounded-lg mb-4">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <span class="text-gray-700 font-mono">Order #{{ $order->id }}</span>
                    </div>

                    <!-- Grand Total -->
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl p-6 mb-6 shadow-lg">
                        <p class="text-white/80 text-sm font-medium mb-1">Total Pembayaran</p>
                        <p class="text-white text-4xl font-bold tracking-tight">
                            Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                        </p>
                    </div>

                    <!-- Order Items Summary -->
                    @if ($order->items && $order->items->count() > 0)
                        <div class="bg-gray-50 rounded-xl p-4 mb-6 text-left">
                            <div class="flex items-center gap-2 mb-3">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                <h3 class="font-semibold text-gray-800">Ringkasan Produk</h3>
                            </div>
                            <div class="space-y-2 max-h-40 overflow-y-auto">
                                @foreach ($order->items as $item)
                                    <div class="flex justify-between items-start text-sm">
                                        <div class="flex-1">
                                            <p class="font-medium text-gray-700">
                                                {{ $item->product->name ?? 'Product' }}</p>
                                            <p class="text-gray-500">{{ $item->quantity }}x Rp
                                                {{ number_format($item->unit_amount, 0, ',', '.') }}</p>
                                        </div>
                                        <p class="font-semibold text-gray-800">
                                            Rp {{ number_format($item->total_amount, 0, ',', '.') }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Shipping Information -->
                    @if ($order->address)
                        <div class="bg-blue-50 rounded-xl p-4 mb-6 text-left">
                            <div class="flex items-center gap-2 mb-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <h3 class="font-semibold text-gray-800">Alamat Pengiriman</h3>
                            </div>
                            <div class="text-sm space-y-1">
                                <p class="font-semibold text-gray-800">
                                    {{ $order->address->first_name }} {{ $order->address->last_name }}
                                </p>
                                <p class="text-gray-600">
                                    {{ $order->address->phone }}
                                </p>
                                <p class="text-gray-600">
                                    {{ $order->address->street_address }}
                                </p>
                                <p class="text-gray-600">
                                    {{ $order->address->city }}, {{ $order->address->state }}
                                    {{ $order->address->zip_code }}
                                </p>
                            </div>

                            <!-- Shipping Method & Cost -->
                            @if ($order->shipping_method || $order->shipping_amount > 0)
                                <div class="mt-3 pt-3 border-t border-blue-200">
                                    <div class="flex items-center justify-between text-sm">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                            </svg>
                                            <span class="text-gray-700">
                                                @if ($order->shipping_method)
                                                    {{ $order->shipping_method }}
                                                    @if ($order->shipping_etd)
                                                        <span
                                                            class="text-gray-500">({{ $order->shipping_etd }})</span>
                                                    @endif
                                                @else
                                                    Pengiriman
                                                @endif
                                            </span>
                                        </div>
                                        <span class="font-semibold text-blue-700">
                                            Rp {{ number_format($order->shipping_amount, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Payment Button -->
                <div class="text-center">
                    <button id="pay-button"
                        class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white py-4 px-6 rounded-xl font-bold text-lg shadow-lg hover:shadow-2xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Bayar Sekarang
                    </button>

                    <!-- Info Box -->
                    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="text-left flex-1">
                                <p class="text-blue-800 text-sm font-semibold mb-1">Informasi
                                    Pembayaran</p>
                                <ul class="text-blue-700 text-xs space-y-1">
                                    <li>• Klik tombol "Bayar Sekarang" untuk melanjutkan</li>
                                    <li>• Pilih metode pembayaran yang Anda inginkan</li>
                                    <li>• Mode: <span
                                            class="font-mono font-bold">{{ config('midtrans.is_production') ? 'Production' : 'Sandbox (Testing)' }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Alternative Actions -->
                    <div class="mt-6 flex gap-3 justify-center text-sm">
                        <a href="/my-orders"
                            class="text-blue-600 hover:text-blue-700 font-medium hover:underline transition-colors flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Lihat Pesanan Saya
                        </a>
                        <span class="text-gray-300">|</span>
                        <button wire:click="refreshToken"
                            class="text-gray-600 hover:text-gray-700 font-medium hover:underline transition-colors flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            <span wire:loading.remove wire:target="refreshToken">Refresh Token</span>
                            <span wire:loading wire:target="refreshToken">Loading...</span>
                        </button>
                    </div>

                    <!-- Powered by Midtrans -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-center gap-2 text-gray-500 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Powered by <strong>Midtrans</strong> - Pembayaran Aman & Terpercaya</span>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Loading State -->
            <div class="text-center py-16 animate-fade-in-up">
                <div class="relative w-20 h-20 mx-auto mb-6">
                    <div class="absolute top-0 left-0 w-full h-full border-4 border-green-200 rounded-full">
                    </div>
                    <div
                        class="absolute top-0 left-0 w-full h-full border-4 border-green-500 rounded-full border-t-transparent animate-spin">
                    </div>
                </div>
                <p class="text-gray-600 font-medium text-lg mb-2">Memproses pembayaran...</p>
                <p class="text-gray-500 text-sm">Mohon tunggu sebentar</p>
            </div>
        @endif
    </div>
</div>

@if ($snapToken)
    <script
        src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        // Debug info
        console.log('🔐 Midtrans Snap Token:', '{{ substr($snapToken, 0, 20) }}***');
        console.log('🌍 Environment:', '{{ config('midtrans.is_production') ? 'Production' : 'Sandbox' }}');
        console.log('💳 Order ID:', '{{ $order->id }}');
        console.log('💰 Grand Total:', 'Rp {{ number_format($order->grand_total, 0, ',', '.') }}');

        // Wait for DOM to be ready
        document.addEventListener('DOMContentLoaded', function() {
            const payButton = document.getElementById('pay-button');

            if (!payButton) {
                console.error('❌ Pay button not found');
                return;
            }

            payButton.onclick = function() {
                // Disable button untuk prevent double click
                payButton.disabled = true;
                payButton.classList.add('opacity-75', 'cursor-not-allowed');

                const originalHTML = payButton.innerHTML;
                payButton.innerHTML = `
                    <svg class="animate-spin h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Membuka Pembayaran...
                `;

                // Validate snap object tersedia
                if (typeof snap === 'undefined') {
                    console.error('❌ Midtrans Snap not loaded');
                    alert('⚠️ Midtrans Snap belum dimuat. Silakan refresh halaman dan coba lagi.');

                    // Re-enable button
                    payButton.disabled = false;
                    payButton.classList.remove('opacity-75', 'cursor-not-allowed');
                    payButton.innerHTML = originalHTML;
                    return;
                }

                // Validate token
                const snapToken = '{{ $snapToken }}';
                if (!snapToken || snapToken.length < 10) {
                    console.error('❌ Invalid snap token');
                    alert('⚠️ Token pembayaran tidak valid. Silakan refresh halaman.');

                    payButton.disabled = false;
                    payButton.classList.remove('opacity-75', 'cursor-not-allowed');
                    payButton.innerHTML = originalHTML;
                    return;
                }

                console.log('✅ Opening Midtrans payment popup...');

                // Open Midtrans Snap popup
                try {
                    snap.pay(snapToken, {
                        onSuccess: function(result) {
                            console.log('✅ Payment Success:', result);

                            // Show success message
                            alert('🎉 Pembayaran berhasil! Terima kasih atas pesanan Anda.');

                            // Redirect to success page
                            window.location.href = '/midtrans/finish';
                        },

                        onPending: function(result) {
                            console.log('⏳ Payment Pending:', result);

                            // Show pending message
                            alert(
                                '⏳ Pembayaran sedang diproses. Silakan cek status di halaman pesanan Anda.'
                            );

                            // Redirect to my orders
                            window.location.href = '/my-orders';
                        },

                        onError: function(result) {
                            console.error('❌ Payment Error:', result);

                            // Show error message
                            const errorMsg = result.status_message || result.message ||
                                'Terjadi kesalahan yang tidak diketahui';
                            alert('❌ Pembayaran gagal: ' + errorMsg +
                                '\n\nSilakan coba lagi atau hubungi customer service.');

                            // Re-enable button
                            payButton.disabled = false;
                            payButton.classList.remove('opacity-75', 'cursor-not-allowed');
                            payButton.innerHTML = originalHTML;
                        },

                        onClose: function() {
                            console.log('⚠️ Payment popup closed by user');

                            // Re-enable button
                            payButton.disabled = false;
                            payButton.classList.remove('opacity-75', 'cursor-not-allowed');
                            payButton.innerHTML = originalHTML;

                            // Optional: Show message
                            console.log('ℹ️ User dapat mencoba pembayaran kembali');
                        }
                    });
                } catch (error) {
                    console.error('❌ Exception when opening Midtrans:', error);
                    alert('⚠️ Terjadi kesalahan saat membuka pembayaran: ' + error.message);

                    // Re-enable button
                    payButton.disabled = false;
                    payButton.classList.remove('opacity-75', 'cursor-not-allowed');
                    payButton.innerHTML = originalHTML;
                }
            };

            console.log('✅ Payment button initialized successfully');
        });

        // Check if Snap script loaded successfully
        window.addEventListener('load', function() {
            if (typeof snap === 'undefined') {
                console.warn('⚠️ Midtrans Snap script failed to load. Check your internet connection.');

                // Show warning to user
                const payButton = document.getElementById('pay-button');
                if (payButton) {
                    payButton.innerHTML = `
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        Refresh Halaman untuk Mencoba Lagi
                    `;
                    payButton.onclick = function() {
                        window.location.reload();
                    };
                }
            } else {
                console.log('✅ Midtrans Snap loaded successfully');
            }
        });
    </script>
@endif
