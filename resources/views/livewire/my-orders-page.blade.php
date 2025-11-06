<div>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <h1
            class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-6 animate-fade-in-up">
            Pesanan Saya</h1>

        <div
            class="flex flex-col bg-white dark:bg-gray-800 p-5 rounded-xl mt-4 shadow-lg hover:shadow-2xl transition-shadow duration-500 animate-fade-in-up animation-delay-200">
            @if ($orders->count() > 0)
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-900">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                                            ID Pesanan</th>
                                        <th
                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                                            Tanggal</th>
                                        <th
                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                                            Status Pesanan</th>
                                        <th
                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                                            Status Pembayaran</th>
                                        <th
                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                                            Total</th>
                                        <th
                                            class="px-6 py-3 text-end text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($orders as $order)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-300 animate-fade-in-up"
                                            style="animation-delay: {{ $loop->index * 50 }}ms">
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                #{{ $order->id }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-300">
                                                {{ $order->created_at->format('d-m-Y') }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-300">
                                                @php
                                                    $statusClasses = match ($order->status) {
                                                        'new'
                                                            => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                                        'processing'
                                                            => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                                        'shipped'
                                                            => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300',
                                                        'delivered'
                                                            => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                                        'canceled'
                                                            => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                                        default
                                                            => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300',
                                                    };

                                                    $statusLabel = match ($order->status) {
                                                        'new' => 'Baru',
                                                        'processing' => 'Diproses',
                                                        'shipped' => 'Dikirim',
                                                        'delivered' => 'Selesai',
                                                        'canceled' => 'Dibatalkan',
                                                        default => ucfirst($order->status),
                                                    };
                                                @endphp
                                                <span
                                                    class="px-2 py-1 rounded-full text-xs {{ $statusClasses }} transform hover:scale-110 transition-transform duration-300 inline-block">
                                                    {{ $statusLabel }}
                                                </span>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-300">
                                                @php
                                                    $paymentStatusClasses = match ($order->payment_status) {
                                                        'paid'
                                                            => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                                        'pending'
                                                            => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                                        'failed'
                                                            => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                                        default
                                                            => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300',
                                                    };

                                                    $paymentLabel = match ($order->payment_status) {
                                                        'paid' => 'Lunas',
                                                        'pending' => 'Menunggu',
                                                        'failed' => 'Gagal',
                                                        default => ucfirst($order->payment_status),
                                                    };
                                                @endphp
                                                <span
                                                    class="px-2 py-1 rounded-full text-xs {{ $paymentStatusClasses }} transform hover:scale-110 transition-transform duration-300 inline-block">
                                                    {{ $paymentLabel }}
                                                </span>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800 dark:text-gray-200">
                                                Rp
                                                {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                <div class="flex gap-2 justify-end">
                                                    <a href="/my-orders/{{ $order->id }}"
                                                        class="bg-slate-600 text-white py-2 px-4 rounded-lg hover:bg-slate-500 text-xs transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 shadow-md hover:shadow-lg">
                                                        Detail
                                                    </a>

                                                    @if ($order->payment_status === 'pending' && $order->payment_method === 'midtrans')
                                                        <a href="/payment/midtrans/{{ $order->id }}"
                                                            class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-500 text-xs transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 shadow-md hover:shadow-lg">
                                                            Bayar
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <div class="text-gray-400 text-6xl mb-4">📦</div>
                    <h3 class="text-xl font-medium text-gray-600 mb-2">Belum ada pesanan</h3>
                    <p class="text-gray-500 mb-6">Mulai berbelanja untuk melihat pesanan Anda di sini</p>
                    <a href="/products" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                        Mulai Belanja
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
