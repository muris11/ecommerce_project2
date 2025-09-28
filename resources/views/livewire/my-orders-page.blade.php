<div>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <h1 class="text-4xl font-bold text-slate-500">Pesanan Saya</h1>

        <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
            @if ($orders->count() > 0)
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                            ID Pesanan</th>
                                        <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                            Tanggal</th>
                                        <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                            Status Pesanan</th>
                                        <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                            Status Pembayaran</th>
                                        <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                            Total</th>
                                        <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($orders as $order)
                                        <tr class="hover:bg-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                                #{{ $order->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                {{ $order->created_at->format('d-m-Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                @php
                                                    $statusClasses = match ($order->status) {
                                                        'new' => 'bg-blue-100 text-blue-800', // Baru
                                                        'processing' => 'bg-yellow-100 text-yellow-800', // Diproses
                                                        'shipped' => 'bg-green-100 text-green-800', // Dikirim
                                                        'delivered' => 'bg-green-100 text-green-800', // Diterima
                                                        default => 'bg-red-100 text-red-800',
                                                    };
                                                @endphp
                                                <span class="px-2 py-1 rounded-full text-xs {{ $statusClasses }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                @php
                                                    $paymentStatusClasses = match ($order->payment_status) {
                                                        'paid' => 'bg-green-100 text-green-800',
                                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                                        default => 'bg-red-100 text-red-800',
                                                    };
                                                @endphp
                                                <span
                                                    class="px-2 py-1 rounded-full text-xs {{ $paymentStatusClasses }}">
                                                    {{ ucfirst($order->payment_status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Rp
                                                {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                <div class="flex gap-2 justify-end">
                                                    <a href="/my-orders/{{ $order->id }}"
                                                        class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500 text-xs">
                                                        Detail
                                                    </a>

                                                    @if ($order->payment_status === 'pending' && $order->payment_method === 'midtrans')
                                                        <a href="/payment/midtrans/{{ $order->id }}"
                                                            class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-500 text-xs">
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
