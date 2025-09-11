<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-slate-500">Checkout</h1>

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-@push('scripts')
<script src="https://app.stg.midtrans.com/snap/snap.js" data-client-key="Mid-client-lsDRXNXg-3GjT2qJ"></script>
<script>
document.addEventListener('livewire:init', () => {
    Livewire.on('openMidtransPayment', (snapToken) => {
        const token = Array.isArray(snapToken) ? snapToken[0] : snapToken;
        
        if (typeof snap !== 'undefined' && token) {
            snap.pay(token, {
                onSuccess: function(result) {
                    window.location.href = '/midtrans/finish';
                },
                onPending: function(result) {
                    window.location.href = '/midtrans/unfinish';
                },
                onError: function(result) {
                    window.location.href = '/midtrans/error';
                },
                onClose: function() {
                    window.location.href = '/checkout';
                }
            });
        } else {
            alert('Payment system error. Please try again.');
        }
    });
});
</script>rounded mb-4">
				{{ session('error') }}
			</div>
		@endif

		@if (session()->has('success'))
			<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
				{{ session('success') }}
			</div>
		@endif

		<form wire:submit.prevent="placeOrder">
 <div class="grid grid-cols-12 gap-4">
 <div class="md:col-span-12 lg:col-span-8 col-span-12">
 <!-- Card -->
 <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
 <!-- Shipping Address -->
 <div class="mb-6">
 <h2 class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
 Alamat Pengirim
 </h2>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-gray-700 dark:text-white mb-1" for="first_name">
 Nama Depan
 </label>
 <input wire:model="first_name"
 class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('first_name') border-red-500 @enderror"
 id="first_name" type="text">
 @error('first_name')
     <div class="text-red-500 text-sm">{{ $message }}</div>
 @enderror
 </div>
 <div>
 <label class="block text-gray-700 dark:text-white mb-1" for="last_name">
 Nama Belakang
 </label>
 <input wire:model="last_name"
 class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('last_name') border-red-500 @enderror"
 id="last_name" type="text">
 @error('last_name')
     <div class="text-red-500 text-sm">{{ $message }}</div>
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
 <div class="text-lg font-semibold mb-4">
 Pilih Metode Pembayaran
 </div>
 <ul class="grid w-full gap-6 md:grid-cols-2">
 <li>
 <input wire:model='payment_method' class="hidden peer" id="hosting-small"
 required="" type="radio" value="cod" />
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
 <div class="md:col-span-12 lg:col-span-4 col-span-12">
 <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
 <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
 RINGKASAN PESANAN
 </div>
 <div class="flex justify-between mb-2 font-bold">
 <span>
 Subtotal
 </span>
 <span>
 {{ Number::currency($grand_total, 'IDR') }}
 </span>
 </div>
 <div class="flex justify-between mb-2 font-bold">
 <span>
 Pajak
 </span>
 <span>
 {{ Number::currency(0, 'IDR') }}
 </span>
 </div>
 <div class="flex justify-between mb-2 font-bold">
 <span>
 Biaya Pengiriman
 </span>
 <span>
 {{ Number::currency(0, 'IDR') }}
 </span>
 </div>
 <hr class="bg-slate-400 my-4 h-1 rounded">
 <div class="flex justify-between mb-2 font-bold">
 <span>
 Jumlah Keseluruhan
 </span>
 <span>
 {{ Number::currency($grand_total, 'IDR') }}
 </span>
 </div>
 </div>
 <button type="submit"
 class="bg-green-500 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600">
 <span wire:loading.remove wire:target="placeOrder">Tempatkan Pesanan</span>
                                     <span wire:loading wire:target="placeOrder">
                                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Memproses Payment...
                                    </span>
 </button>
 <div class="bg-white mt-4 rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
 <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
 RINGKASAN KERANJANG
 </div>
 <ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
 @foreach ($cart_items as $ci)
 <li class="py-3 sm:py-4" wire:key="{{ $ci['product_id'] }}">
 <div class="flex items-center">
 <div class="flex-shrink-0">
 <img alt="{{ $ci['name'] }}"
 class="w-12 h-12 rounded-full object-cover"
 src="{{ url('storage', $ci['image']) }}"
 onerror="this.src='{{ asset('images/pp.jpeg') }}'">
 </div>
 <div class="flex-1 min-w-0 ms-4">
 <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
 {{ $ci['name'] }}
 </p>
 <p class="text-sm text-gray-500 truncate dark:text-gray-400">
 Kuantitas: {{ $ci['quantity'] }}
 </p>
 </div>
 <div
 class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
 {{ Number::currency($ci['total_amount'], 'IDR') }}
 </div>
 </div>
 </li>
 @endforeach
 </ul>
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
            console.log('Token type:', typeof snapToken);                 if (typeof snap === 'undefined') {
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
