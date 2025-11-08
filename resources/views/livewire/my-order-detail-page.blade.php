<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-slate-500">Detail Pesanan</h1>

    <!-- Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-5">
        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg">
                    <svg class="flex-shrink-0 size-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            Pelanggan
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        <div>{{ $address->full_name }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg">
                    <svg class="flex-shrink-0 size-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 22h14" />
                        <path d="M5 2h14" />
                        <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22" />
                        <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            Tanggal Pemesanan
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl font-medium text-gray-800">
                            {{ $order->created_at->format('d-m-Y') }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg">
                    <svg class="flex-shrink-0 size-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 11V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6" />
                        <path d="m12 12 4 10 1.7-4.3L22 16Z" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            Status Pemesanan
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        @php
                            $status = '';
                            if ($order->status == 'new') {
                                $status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Baru</span>';
                            }
                            if ($order->status == 'processing') {
                                $status =
                                    '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Diproses</span>';
                            }
                            if ($order->status == 'shipped') {
                                $status =
                                    '<span class="bg-indigo-500 py-1 px-3 rounded text-white shadow">Dikirim</span>';
                            }
                            if ($order->status == 'delivered') {
                                $status =
                                    '<span class="bg-green-700 py-1 px-3 rounded text-white shadow">Selesai</span>';
                            }
                            if ($order->status == 'canceled') {
                                $status =
                                    '<span class="bg-red-700 py-1 px-3 rounded text-white shadow">Dibatalkan</span>';
                            }
                        @endphp
                        {!! $status !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg">
                    <svg class="flex-shrink-0 size-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12s2.545-5 7-5c4.454 0 7 5 7 5s-2.546 5-7 5c-4.455 0-7-5-7-5z" />
                        <path d="M12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        <path d="M21 17v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2" />
                        <path d="M21 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            Status Pembayaran
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        @php
                            $payment_status = '';
                            if ($order->payment_status == 'pending') {
                                $payment_status = '<span
                            class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Menunggu</span>';
                            }
                            if ($order->payment_status == 'paid') {
                                $payment_status = '<span
                            class="bg-green-500 py-1 px-3 rounded text-white shadow">Lunas</span>';
                            }
                            if ($order->payment_status == 'failed') {
                                $payment_status =
                                    '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Gagal</span>';
                            }
                        @endphp
                        {!! $payment_status !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Grid -->

    <!-- Shipping Info Card (if exists) -->
    @if ($order->shipping_method || $order->shipping_amount > 0)
        <div class="bg-white rounded-lg shadow-md p-6 mt-4">
            <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
                Informasi Pengiriman
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @if ($order->shipping_method)
                    <div>
                        <p class="text-sm text-gray-600">Metode Pengiriman</p>
                        <p class="font-semibold text-gray-800">{{ $order->shipping_method }}</p>
                    </div>
                @endif
                @if ($order->shipping_etd)
                    <div>
                        <p class="text-sm text-gray-600">Estimasi Pengiriman</p>
                        <p class="font-semibold text-gray-800">{{ $order->shipping_etd }}</p>
                    </div>
                @endif
                @if ($order->shipping_amount > 0)
                    <div>
                        <p class="text-sm text-gray-600">Biaya Pengiriman</p>
                        <p class="font-semibold text-blue-600">{{ Number::currency($order->shipping_amount, 'IDR') }}
                        </p>
                    </div>
                @endif
                @if ($order->shipping_destination_name)
                    <div class="md:col-span-3">
                        <p class="text-sm text-gray-600">Tujuan Pengiriman</p>
                        <p class="font-semibold text-gray-800">{{ $order->shipping_destination_name }}</p>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <div class="flex flex-col md:flex-row gap-4 mt-4">
        <div class="md:w-3/4">
            <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                <h2 class="text-xl font-semibold mb-4">Detail Produk</h2>

                <!-- Mobile View -->
                <div class="block md:hidden space-y-4">
                    @foreach ($order_items as $item)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center mb-3">
                                <img class="h-16 w-16 mr-4 object-cover rounded"
                                    src="{{ is_array($item->product->image) && !empty($item->product->image) ? url('storage', $item->product->image[0]) : url('images/no-image.png') }}"
                                    alt="{{ $item->product->name }}" loading="lazy" width="64" height="64">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-800">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-gray-600">Kuantitas: {{ $item->quantity }}</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-600">Harga Satuan</p>
                                    <p class="font-semibold">{{ Number::currency($item->unit_amount, 'IDR') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-600">Total</p>
                                    <p class="font-semibold text-lg">
                                        {{ Number::currency($item->total_amount, 'IDR') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Desktop Table View -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left font-semibold py-3 px-4">Produk</th>
                                <th class="text-left font-semibold py-3 px-4">Harga</th>
                                <th class="text-left font-semibold py-3 px-4">Kuantitas</th>
                                <th class="text-left font-semibold py-3 px-4">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order_items as $item)
                                <tr wire:key="{{ $item->id }}" class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-4 px-4">
                                        <div class="flex items-center">
                                            <img class="h-16 w-16 mr-4 object-cover rounded"
                                                src="{{ is_array($item->product->image) && !empty($item->product->image) ? url('storage', $item->product->image[0]) : url('images/no-image.png') }}"
                                                alt="{{ $item->product->name }}" loading="lazy" width="64"
                                                height="64">
                                            <span class="font-semibold">{{ $item->product->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">{{ Number::currency($item->unit_amount, 'IDR') }}</td>
                                    <td class="py-4 px-4">
                                        <span class="text-center w-8">{{ $item->quantity }}</span>
                                    </td>
                                    <td class="py-4 px-4 font-semibold">
                                        {{ Number::currency($item->total_amount, 'IDR') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
                <h1 class="font-3xl font-bold text-slate-500 mb-3">Alamat Pengirim</h1>
                <div class="flex justify-between items-center">
                    <div>
                        <p>{{ $address->street_address }}, {{ $address->city }}, {{ $address->state }},
                            {{ $address->zip_code }}</p>
                    </div>
                    <div>
                        <p class="font-semibold">Telepon:</p>
                        <p>{{ $address->phone }}</p>
                    </div>
                </div>
            </div>

        </div>
        <div class="md:w-1/4">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold mb-4">Ringkasan Pesanan</h2>
                <div class="flex justify-between mb-2">
                    <span>Subtotal</span>
                    <span>{{ Number::currency($order->grand_total - $order->shipping_amount, 'IDR') }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Pajak</span>
                    <span>{{ Number::currency(0, 'IDR') }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Ongkos Kirim</span>
                    <span>{{ Number::currency($order->shipping_amount ?? 0, 'IDR') }}</span>
                </div>
                @if ($order->shipping_method)
                    <div class="flex justify-between mb-2 text-sm text-gray-600">
                        <span>Metode Pengiriman:</span>
                        <span class="font-medium">{{ $order->shipping_method }}</span>
                    </div>
                @endif
                @if ($order->shipping_etd)
                    <div class="flex justify-between mb-2 text-sm text-gray-600">
                        <span>Estimasi:</span>
                        <span>{{ $order->shipping_etd }}</span>
                    </div>
                @endif
                <hr class="my-2">
                <div class="flex justify-between mb-2">
                    <span class="font-semibold">Total</span>
                    <span class="font-semibold">{{ Number::currency($order->grand_total, 'IDR') }}</span>
                </div>

                @if ($order->payment_status === 'pending' && $order->payment_method === 'midtrans')
                    <div class="mt-4 pt-4 border-t">
                        <a href="/payment/midtrans/{{ $order->id }}"
                            class="w-full bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 text-center font-semibold block">
                            💳 Bayar Sekarang
                        </a>
                        <p class="text-xs text-gray-500 mt-2 text-center">
                            Klik untuk melanjutkan pembayaran
                        </p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
