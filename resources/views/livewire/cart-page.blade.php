<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto px-4">
        <h1
            class="text-3xl font-bold mb-6 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent animate-fade-in-up">
            Keranjang Belanja</h1>
        <div class="flex flex-col md:flex-row gap-4">
            <div class="md:w-3/4 animate-fade-in-up animation-delay-200">
                <div
                    class="bg-white dark:bg-gray-800 overflow-x-auto rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 p-6 mb-4">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b-2 border-gray-200 dark:border-gray-700">
                                <th class="text-left font-semibold text-gray-700 dark:text-gray-300 pb-3">Produk</th>
                                <th class="text-left font-semibold text-gray-700 dark:text-gray-300 pb-3">Harga</th>
                                <th class="text-left font-semibold text-gray-700 dark:text-gray-300 pb-3">Kuantitas</th>
                                <th class="text-left font-semibold text-gray-700 dark:text-gray-300 pb-3">Total</th>
                                <th class="text-left font-semibold text-gray-700 dark:text-gray-300 pb-3">Menghapus</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse (is_iterable($cart_items) ? $cart_items : [] as $item)
                                <tr wire:key='{{ $item['product_id'] }}'
                                    class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-300 animate-fade-in-up"
                                    style="animation-delay: {{ $loop->index * 50 }}ms">
                                    <td class="py-4">
                                        <div class="flex items-center group">
                                            <div class="relative overflow-hidden rounded-lg mr-4">
                                                <img class="h-16 w-16 object-cover transform group-hover:scale-110 transition-transform duration-300"
                                                    src="{{ url('storage', $item['image']) }}" alt="{{ $item['name'] }}"
                                                    loading="lazy" width="64" height="64"
                                                    onerror="this.src='{{ asset('images/pp.jpeg') }}'">
                                            </div>
                                            <span
                                                class="font-semibold text-gray-800 dark:text-gray-200 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">{{ $item['name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 text-gray-700 dark:text-gray-300 font-medium">
                                        {{ Number::currency($item['unit_amount'], 'IDR') }}</td>
                                    <td class="py-4">
                                        <div class="flex items-center gap-2">
                                            <button wire:click='decreaseQty({{ $item['product_id'] }})'
                                                class="border-2 border-gray-300 dark:border-gray-600 rounded-lg py-2 px-4 hover:bg-blue-500 hover:text-white hover:border-blue-500 transition-all duration-300 transform hover:scale-110 active:scale-95">-</button>
                                            <span
                                                class="text-center w-8 font-semibold text-gray-800 dark:text-gray-200">{{ $item['quantity'] }}</span>
                                            <button wire:click='increaseQty({{ $item['product_id'] }})'
                                                class="border-2 border-gray-300 dark:border-gray-600 rounded-lg py-2 px-4 hover:bg-blue-500 hover:text-white hover:border-blue-500 transition-all duration-300 transform hover:scale-110 active:scale-95">+</button>
                                        </div>
                                    </td>
                                    <td class="py-4 text-gray-800 dark:text-gray-200 font-bold">
                                        {{ Number::currency($item['total_amount'], 'IDR') }}
                                    </td>
                                    <td>
                                        <button wire:click="removeItem({{ $item['product_id'] }})"
                                            class="bg-slate-300 dark:bg-slate-700 border-2 border-slate-400 dark:border-slate-600 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700 transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 active:scale-95"><span
                                                wire:loading.remove
                                                wire:target="removeItem({{ $item['product_id'] }})">Hapus</span><span
                                                wire:loading
                                                wire:target="removeItem({{ $item['product_id'] }})">Menghapus...</span></button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="animate-fade-in">
                                    <td colspan="5"
                                        class="text-center py-8 text-lg font-semibold text-slate-500 dark:text-slate-400">
                                        <div class="flex flex-col items-center gap-3">
                                            <svg class="w-16 h-16 text-slate-400 animate-bounce" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                            Tidak Ada Item Yang Tersedia di Keranjang!
                                        </div>
                                    </td>
                                </tr>
                            @endforelse


                            <!-- More product rows -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="md:w-1/4 animate-fade-in-up animation-delay-400">
                <div
                    class="bg-gradient-to-br from-white to-blue-50 dark:from-gray-800 dark:to-gray-900 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 p-6 sticky top-24">
                    <h2 class="text-xl font-bold mb-6 text-gray-800 dark:text-gray-200 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                            </path>
                        </svg>
                        Ringkasan
                    </h2>
                    <div class="space-y-3 mb-4">
                        <div
                            class="flex justify-between text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-300">
                            <span>Subtotal</span>
                            <span class="font-medium">{{ Number::currency($grand_total, 'IDR') }}</span>
                        </div>
                        <div
                            class="flex justify-between text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-300">
                            <span>Pajak</span>
                            <span class="font-medium">{{ Number::currency(0, 'IDR') }}</span>
                        </div>
                        <div
                            class="flex justify-between text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-300">
                            <span>Pengiriman</span>
                            <span class="font-medium">{{ Number::currency(0, 'IDR') }}</span>
                        </div>
                    </div>
                    <hr class="my-4 border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between mb-6 text-lg">
                        <span class="font-bold text-gray-800 dark:text-gray-200">Jumlah Keseluruhan</span>
                        <span
                            class="font-bold text-blue-600 dark:text-blue-400">{{ Number::currency($grand_total, 'IDR') }}</span>
                    </div>
                    @if ($cart_items)
                        <a href="/checkout"
                            class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-center text-white py-3 px-4 rounded-lg mt-4 w-full font-semibold shadow-md hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2">
                            <span>Checkout</span>
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
