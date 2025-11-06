<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1
        class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-6 animate-fade-in-up">
        Checkout</h1>

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 animate-fade-in shadow-md">
            {{ session('error') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 animate-fade-in shadow-md">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('info'))
        <div
            class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-lg mb-4 animate-fade-in shadow-md">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                {{ session('info') }}
            </div>
        </div>
    @endif

    <form wire:submit.prevent="placeOrder">
        <div class="grid grid-cols-12 gap-4">
            <div class="md:col-span-12 lg:col-span-8 col-span-12 animate-fade-in-up">
                <!-- Card -->
                <div
                    class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-500 p-4 sm:p-7 dark:bg-slate-900">
                    <!-- Shipping Address -->
                    <div class="mb-6">
                        <h2
                            class="text-xl font-bold underline text-gray-700 dark:text-white mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Alamat Pengirim
                        </h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="first_name">
                                    Nama Depan
                                </label>
                                <input wire:model="first_name"
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 @error('first_name') border-red-500 @enderror"
                                    id="first_name" type="text">
                                @error('first_name')
                                    <div class="text-red-500 text-sm animate-fade-in">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="last_name">
                                    Nama Belakang
                                </label>
                                <input wire:model="last_name"
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 @error('last_name') border-red-500 @enderror"
                                    id="last_name" type="text">
                                @error('last_name')
                                    <div class="text-red-500 text-sm animate-fade-in">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-white mb-1" for="phone">
                                Telepon
                            </label>
                            <input wire:model="phone"
                                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('phone') border-red-500 @enderror"
                                id="phone" type="text">
                            @error('phone')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-white mb-1" for="address">
                                Alamat
                            </label>
                            <input wire:model="street_address"
                                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('street_address') border-red-500 @enderror"
                                id="address" type="text">
                            @error('street_address')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-white mb-1" for="city">
                                Kota
                            </label>
                            <input wire:model="city"
                                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('city') border-red-500 @enderror"
                                id="city" type="text">
                            @error('city')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="state">
                                    Negara
                                </label>
                                <input wire:model="state"
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('state') border-red-500 @enderror"
                                    id="state" type="text">
                                @error('state')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="zip">
                                    Kode Pos
                                </label>
                                <input wire:model="zip_code"
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('zip_code') border-red-500 @enderror"
                                    id="zip" type="text">
                                @error('zip_code')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Destination Search -->
                    <div class="mb-6 mt-8 animate-fade-in-up" style="animation-delay: 100ms">
                        <h2
                            class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-600 mb-4 flex items-center gap-2 animate-fade-in">
                            <svg class="w-6 h-6 text-green-600 animate-bounce-x" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                            Tujuan Pengiriman
                        </h2>

                        <div class="animate-fade-in" style="animation-delay: 150ms">
                            <label class="block text-gray-700 dark:text-white mb-2 font-semibold">
                                Cari Kota/Kecamatan Tujuan
                            </label>
                            <input wire:model.live.debounce.300ms="search_city" type="text"
                                placeholder="Ketik nama kota atau kecamatan..."
                                class="w-full rounded-lg border py-3 px-4 dark:bg-gray-700 dark:text-white dark:border-none focus:ring-2 focus:ring-green-500 focus:border-transparent focus:scale-[1.02] transition-all duration-300 shadow-sm hover:shadow-md @error('selected_destination') border-red-500 @enderror">

                            @error('selected_destination')
                                <div class="text-red-500 text-sm mt-1 animate-fade-in flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror

                            <!-- Search Results Dropdown -->
                            @if (count($search_results) > 0)
                                <div
                                    class="mt-2 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 max-h-60 overflow-y-auto animate-fade-in-up backdrop-blur-sm">
                                    @foreach ($search_results as $index => $result)
                                        <div wire:click="selectDestination({{ json_encode($result) }})"
                                            class="p-4 hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 dark:hover:from-green-900/20 dark:hover:to-emerald-900/20 cursor-pointer border-b border-gray-100 dark:border-gray-600 last:border-b-0 transition-all duration-300 hover:scale-[1.02] hover:shadow-md animate-fade-in-right"
                                            style="animation-delay: {{ $index * 50 }}ms">
                                            <div
                                                class="font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                                                <svg class="w-4 h-4 text-green-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ $result['subdistrict_name'] ?? '' }}
                                            </div>
                                            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1 ml-6">
                                                {{ $result['district_name'] ?? '' }},
                                                {{ $result['city_name'] ?? '' }}, {{ $result['province_name'] ?? '' }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Selected Destination -->
                            @if ($selected_destination)
                                <div
                                    class="mt-3 p-4 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl border-2 border-green-300 dark:border-green-800 animate-fade-in-up shadow-md hover:shadow-lg transition-all duration-300">
                                    <div class="flex items-center gap-2 text-green-700 dark:text-green-400 mb-2">
                                        <svg class="w-5 h-5 animate-pulse-slow" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="font-bold">Tujuan Terpilih:</span>
                                    </div>
                                    <div class="text-gray-800 dark:text-white font-medium">
                                        {{ $selected_destination['subdistrict_name'] ?? '' }},
                                        {{ $selected_destination['district_name'] ?? '' }},
                                        {{ $selected_destination['city_name'] ?? '' }},
                                        {{ $selected_destination['province_name'] ?? '' }}
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Courier Selection -->
                        @if ($selected_destination)
                            <div class="mt-6 animate-fade-in-up" style="animation-delay: 200ms">
                                <label
                                    class="flex items-center gap-2 text-gray-700 dark:text-white mb-2 font-semibold">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                    </svg>
                                    Pilih Kurir
                                </label>
                                <select wire:model.live="courier"
                                    class="w-full rounded-lg border-2 py-3 px-4 dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:scale-[1.02] transition-all duration-300 shadow-sm hover:shadow-md font-medium">
                                    <option value="">-- Pilih Kurir Pengiriman --</option>
                                    @foreach ($available_couriers as $code => $name)
                                        <option value="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <!-- Shipping Options -->
                        @if (count($shipping_options) > 0)
                            <div class="mt-6 animate-fade-in-up" style="animation-delay: 250ms">
                                <label class="flex items-center gap-2 text-gray-700 dark:text-white mb-3 font-bold">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                    Pilih Layanan Pengiriman
                                </label>
                                <div class="space-y-3">
                                    @foreach ($shipping_options as $optionIndex => $option)
                                        @foreach ($option['cost'] as $cost)
                                            <div wire:click="selectShippingService({{ json_encode($option) }})"
                                                class="group p-5 rounded-xl border-2 cursor-pointer transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] animate-fade-in-up
                                                {{ $selected_shipping && $selected_shipping['service'] == $option['service']
                                                    ? 'border-green-500 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/30 shadow-lg'
                                                    : 'border-gray-200 dark:border-gray-700 hover:border-green-400 bg-white dark:bg-gray-800' }}"
                                                style="animation-delay: {{ $optionIndex * 100 }}ms">
                                                <div class="flex justify-between items-center">
                                                    <div class="flex-1">
                                                        <div
                                                            class="font-bold text-gray-800 dark:text-white text-lg flex items-center gap-2 group-hover:text-green-600 transition-colors">
                                                            <span
                                                                class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-full text-sm font-semibold">
                                                                {{ strtoupper($courier) }}
                                                            </span>
                                                            {{ $option['service'] }}
                                                        </div>
                                                        <div
                                                            class="text-sm text-gray-600 dark:text-gray-400 mt-2 ml-1">
                                                            {{ $option['description'] }}
                                                        </div>
                                                        <div class="flex items-center gap-2 mt-2 ml-1">
                                                            <svg class="w-4 h-4 text-amber-500" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            <span
                                                                class="text-sm text-amber-600 dark:text-amber-400 font-semibold">
                                                                Estimasi: {{ $cost['etd'] }} hari
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="text-right ml-4">
                                                        <div
                                                            class="font-bold text-2xl bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
                                                            {{ Number::currency($cost['value'], 'IDR') }}
                                                        </div>
                                                        @if ($selected_shipping && $selected_shipping['service'] == $option['service'])
                                                            <div
                                                                class="mt-2 flex items-center gap-1 text-green-600 dark:text-green-400 text-sm font-semibold animate-pulse-slow">
                                                                <svg class="w-4 h-4" fill="currentColor"
                                                                    viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd"
                                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                                Terpilih
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>

                                @error('selected_shipping')
                                    <div class="text-red-500 text-sm mt-2 animate-fade-in flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                    </div>

                    <div class="text-lg font-semibold mb-4 animate-fade-in-up" style="animation-delay: 300ms">
                        Pilih Metode Pembayaran
                    </div>
                    <ul class="grid w-full gap-6 md:grid-cols-2">
                        <li>
                            <input wire:model='payment_method' class="hidden peer" id="hosting-small" required=""
                                type="radio" value="cod" />
                            <label
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                                for="hosting-small">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">
                                        Bayar Di Tempat
                                    </div>
                                </div>
                                <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                                    viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2">
                                    </path>
                                </svg>
                            </label>
                        </li>
                        <li>
                            <input wire:model='payment_method' class="hidden peer" id="hosting-big" type="radio"
                                value="midtrans">
                            <label
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                                for="hosting-big">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">
                                        Midtrans (Bank Transfer, E-Wallet, Credit Card)
                                    </div>
                                </div>
                                <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                                    viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2">
                                    </path>
                                </svg>
                            </label>
                        </li>
                    </ul>
                    @error('payment_method')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <!-- End Card -->
            </div>
            <div class="md:col-span-12 lg:col-span-4 col-span-12 space-y-6">
                <!-- Ringkasan Pesanan -->
                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 p-6 dark:bg-slate-900 animate-fade-in-up"
                    style="animation-delay: 350ms">
                    <div class="flex items-center gap-2 mb-6">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <h3
                            class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            RINGKASAN PESANAN
                        </h3>
                    </div>

                    <!-- Subtotal -->
                    <div
                        class="flex justify-between items-center mb-4 p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:shadow-md transition-all duration-300">
                        <span class="text-gray-700 dark:text-gray-300 font-medium flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Subtotal
                        </span>
                        <span class="font-bold text-gray-900 dark:text-white">
                            {{ Number::currency($grand_total, 'IDR') }}
                        </span>
                    </div>

                    <!-- Pajak -->
                    <div
                        class="flex justify-between items-center mb-4 p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:shadow-md transition-all duration-300">
                        <span class="text-gray-700 dark:text-gray-300 font-medium flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            Pajak
                        </span>
                        <span class="font-bold text-gray-900 dark:text-white">
                            {{ Number::currency(0, 'IDR') }}
                        </span>
                    </div>

                    <!-- Biaya Pengiriman -->
                    <div
                        class="flex justify-between items-center mb-4 p-3 rounded-lg transition-all duration-300
                        {{ $shipping_cost > 0 ? 'bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border-2 border-green-300 dark:border-green-700 shadow-md' : 'bg-gray-50 dark:bg-gray-800' }}">
                        <span class="text-gray-700 dark:text-gray-300 font-medium flex items-center gap-2">
                            <svg class="w-5 h-5 {{ $shipping_cost > 0 ? 'text-green-600 animate-bounce-x' : 'text-gray-500' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                            </svg>
                            Biaya Pengiriman
                        </span>
                        <span
                            class="font-bold {{ $shipping_cost > 0 ? 'text-green-600 dark:text-green-400 text-lg' : 'text-gray-900 dark:text-white' }}">
                            {{ Number::currency($shipping_cost, 'IDR') }}
                        </span>
                    </div>

                    <!-- Divider -->
                    <div class="my-6 relative">
                        <div class="absolute inset-0 flex items-center">
                            <div
                                class="w-full border-t-2 border-gradient-to-r from-blue-300 to-purple-300 dark:from-blue-700 dark:to-purple-700">
                            </div>
                        </div>
                    </div>

                    <!-- Grand Total -->
                    <div
                        class="p-4 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl shadow-lg mb-6 animate-pulse-slow">
                        <div class="flex justify-between items-center">
                            <span class="text-white font-bold text-lg flex items-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Grand Total
                            </span>
                            <span class="text-white font-bold text-2xl">
                                {{ Number::currency($grand_total + $shipping_cost, 'IDR') }}
                            </span>
                        </div>
                    </div>

                    <!-- Place Order Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-2xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-2">
                        <span wire:loading.remove wire:target="placeOrder" class="flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Tempatkan Pesanan
                        </span>
                        <span wire:loading wire:target="placeOrder" class="flex items-center gap-2">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Memproses Payment...
                        </span>
                    </button>
                </div>

                <!-- Ringkasan Keranjang -->
                <div class="bg-white mt-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 p-6 dark:bg-slate-900 animate-fade-in-up"
                    style="animation-delay: 400ms">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <h3
                            class="text-xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                            RINGKASAN KERANJANG
                        </h3>
                    </div>

                    <ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
                        @foreach ($cart_items as $index => $ci)
                            <li class="py-4 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg px-2 transition-all duration-300 animate-fade-in-right"
                                wire:key="{{ $ci['product_id'] }}"
                                style="animation-delay: {{ 450 + $index * 50 }}ms">
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0 relative group">
                                        <img alt="{{ $ci['name'] }}"
                                            class="w-16 h-16 rounded-xl object-cover shadow-md group-hover:shadow-xl group-hover:scale-110 transition-all duration-300"
                                            src="{{ url('storage', $ci['image']) }}" loading="lazy" width="64"
                                            height="64" onerror="this.src='{{ asset('images/pp.jpeg') }}'">
                                        <div
                                            class="absolute -top-2 -right-2 bg-blue-600 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center shadow-lg">
                                            {{ $ci['quantity'] }}
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-gray-900 dark:text-white line-clamp-2 mb-1">
                                            {{ $ci['name'] }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" />
                                            </svg>
                                            {{ Number::currency($ci['unit_amount'], 'IDR') }} × {{ $ci['quantity'] }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <div
                                            class="text-base font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
                                            {{ Number::currency($ci['total_amount'], 'IDR') }}
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Total Items -->
                    <div class="mt-4 pt-4 border-t-2 border-gray-200 dark:border-gray-700">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400 font-medium flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                Total Items
                            </span>
                            <span class="text-lg font-bold text-gray-900 dark:text-white">
                                {{ array_sum(array_column($cart_items, 'quantity')) }} Item
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</form>
</div>
@push('scripts')
    <script src="https://app.stg.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            console.log('Livewire initialized, waiting for Midtrans payment event...');

            Livewire.on('openMidtransPayment', (snapToken) => {
                console.log('Midtrans event triggered');
                console.log('Received snap token:', snapToken);
                console.log('Token type:', typeof snapToken);
                if (typeof snap === 'undefined') {
                    console.error('Midtrans Snap is not loaded!');
                    alert('Payment system not loaded. Please refresh the page.');
                    return;
                }

                const token = Array.isArray(snapToken) ? snapToken[0] : snapToken;
                console.log('Opening Midtrans with token:', token);

                if (!token) {
                    console.error('Invalid token received');
                    alert('Payment token invalid. Please try again.');
                    return;
                }

                snap.pay(token, {
                    onSuccess: function(result) {
                        console.log('Pembayaran berhasil:', result);
                        window.location.href = '/midtrans/finish';
                    },
                    onPending: function(result) {
                        console.log('Pembayaran pending:', result);
                        window.location.href = '/midtrans/unfinish';
                    },
                    onError: function(result) {
                        console.log('Pembayaran gagal:', result);
                        window.location.href = '/midtrans/error';
                    },
                    onClose: function() {
                        console.log('Popup pembayaran ditutup');
                        window.location.href = '/midtrans/unfinish';
                    }
                });
            });
        });
    </script>
@endpush
<script>
    // Simple timeout handling for stuck processing
    setTimeout(() => {
        const loadingElements = document.querySelectorAll('[wire\\:loading]');
        loadingElements.forEach(el => {
            if (el.style.display !== 'none' && el.offsetParent !== null) {
                console.warn('Processing stuck - showing warning');
                alert('Processing is taking longer than expected. Please wait or refresh the page.');
            }
        });
    }, 25000); // 25 seconds timeout
</script>
