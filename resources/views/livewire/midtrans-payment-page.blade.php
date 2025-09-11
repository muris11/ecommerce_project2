<div>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <h1 class="text-4xl font-bold text-slate-500 text-center mb-8">Pembayaran Midtrans</h1>

        @if ($error)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-center">
                <p>{{ $error }}</p>
                <a href="/checkout" class="bg-blue-500 text-white px-4 py-2 rounded mt-2 inline-block">Kembali ke
                    Checkout</a>
            </div>
        @elseif(!$order)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-center">
                <p class="font-bold">Transaksi Tidak Ditemukan</p>
                <p>Order yang Anda cari tidak ditemukan atau telah dihapus.</p>
                <div class="mt-4 space-x-2">
                    <a href="/checkout" class="bg-blue-500 text-white px-4 py-2 rounded inline-block">Checkout Ulang</a>
                    <a href="/my-orders" class="bg-gray-500 text-white px-4 py-2 rounded inline-block">Lihat Pesanan
                        Saya</a>
                </div>
            </div>
        @elseif($snapToken)
            <div class="bg-white shadow-lg rounded-lg p-8 max-w-md mx-auto">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Detail Pesanan</h2>
                    <p class="text-gray-600">Order ID: #{{ $order->id }}</p>
                    <p class="text-2xl font-bold text-green-600 mt-2">Rp
                        {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                </div>

                <div class="text-center">
                    <button id="pay-button"
                        class="w-full bg-green-500 text-white py-3 px-6 rounded-lg hover:bg-green-600 text-lg font-semibold">
                        Bayar Sekarang
                    </button>

                    <p class="text-sm text-gray-500 mt-4">
                        Powered by Midtrans Sandbox - Testing Mode
                    </p>

                    <a href="/my-orders" class="text-blue-500 hover:underline text-sm mt-2 inline-block">
                        Lihat Pesanan Saya
                    </a>
                </div>
            </div>
        @else
            <div class="text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-green-500 mx-auto mb-4"></div>
                <p class="text-gray-600">Memproses pembayaran...</p>
            </div>
        @endif
    </div>
</div>

@if ($snapToken)
    <script
        src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        // Log token info untuk debugging
        console.log('Midtrans Snap Token:', '{{ substr($snapToken, 0, 20) }}***');
        console.log('Environment:', '{{ config('midtrans.is_production') ? 'Production' : 'Sandbox' }}');

        document.getElementById('pay-button').onclick = function() {
            // Validate snap object tersedia
            if (typeof snap === 'undefined') {
                alert('Midtrans Snap belum dimuat. Silakan refresh halaman.');
                return;
            }

            // SnapToken acquired from previous step
            snap.pay('{{ $snapToken }}', {
                // Optional
                onSuccess: function(result) {
                    console.log('Payment Success:', result);
                    // Clear cart dari frontend juga
                    window.location.href = '/midtrans/finish';
                },
                // Optional
                onPending: function(result) {
                    console.log('Payment Pending:', result);
                    alert('Pembayaran sedang diproses. Silakan cek status di halaman pesanan Anda.');
                    window.location.href = '/my-orders';
                },
                // Optional
                onError: function(result) {
                    console.log('Payment Error:', result);
                    alert('Terjadi kesalahan pada pembayaran: ' + (result.status_message ||
                        'Unknown error'));
                    // Don't redirect, let user try again or refresh token
                },
                onClose: function() {
                    console.log('Payment popup closed by user');
                    // User closed the popup, stay on page
                }
            });
        };
    </script>
@endif
