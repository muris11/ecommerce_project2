<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Address;
use App\Models\Order;
use App\Services\MidtransService;
use App\Services\RajaOngkirService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Checkout')]
class CheckoutPage extends Component
{
    public $first_name;
    public $last_name;
    public $phone;
    public $street_address;
    public $city;
    public $state;
    public $zip_code;
    public $payment_method = 'midtrans';
    public $snap_token = null;

    // Shipping fields
    public $search_city = '';
    public $search_results = [];
    public $selected_destination = null;
    public $courier = '';
    public $shipping_options = [];
    public $selected_shipping = null;
    public $shipping_cost = 0;

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'street_address' => 'required|string|max:500',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'zip_code' => 'required|string|max:10',
        'payment_method' => 'required|in:midtrans,cod',
        'selected_destination' => 'required',
        'selected_shipping' => 'required',
    ];

    protected $midtransService;
    protected $rajaOngkirService;

    public function boot()
    {
        $this->midtransService = app(MidtransService::class);
        $this->rajaOngkirService = app(RajaOngkirService::class);
    }

    public function mount()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        CartManagement::fixCartImages();
        
        if(count($cart_items) == 0) {
            return redirect()->route('products');
        }
    }

    public function searchCity()
    {
        if(strlen($this->search_city) < 3) {
            $this->search_results = [];
            return;
        }

        $response = $this->rajaOngkirService->searchDomesticDestination($this->search_city, 10, 0);
        
        if($response && isset($response['data'])) {
            $this->search_results = $response['data'];
        } else {
            $this->search_results = [];
        }
    }

    public function selectDestination($destination)
    {
        $this->selected_destination = $destination;
        $this->city = ($destination['district_name'] ?? '') . ', ' . ($destination['city_name'] ?? '');
        $this->state = $destination['province_name'] ?? '';
        $this->search_city = ($destination['subdistrict_name'] ?? '') . ', ' . ($destination['district_name'] ?? '') . ', ' . ($destination['city_name'] ?? '');
        $this->search_results = [];
        
        // Reset shipping when destination changes
        $this->shipping_options = [];
        $this->selected_shipping = null;
        $this->shipping_cost = 0;
    }

    public function calculateShipping()
    {
        if(!$this->selected_destination || !$this->courier) {
            session()->flash('error', 'Silakan pilih kota tujuan dan kurir terlebih dahulu.');
            return;
        }

        $cart_items = CartManagement::getCartItemsFromCookie();
        $total_weight = 0;
        
        foreach($cart_items as $item) {
            $weight = $item['weight'] ?? 1000; // Default 1000 grams if not set
            $total_weight += $weight * $item['quantity'];
        }

        // Origin: Bunder, Kec. Widasari, Kabupaten Indramayu, Jawa Barat 45271
        // ID: 16238 (Desa/Kelurahan BUNDER, Kecamatan WIDASARI)
        $origin = '16238';

        $response = $this->rajaOngkirService->calculateCost(
            $origin,
            $this->selected_destination['id'], // Use 'id' from API response
            $total_weight,
            $this->courier
        );

        // Check if API response is valid
        if($response && isset($response['data']) && !empty($response['data'])) {
            // API berhasil
            if(isset($response['data'][0]['costs'])) {
                $this->shipping_options = $response['data'][0]['costs'];
                $this->selected_shipping = null;
                $this->shipping_cost = 0;
                return;
            }
        }

        // FALLBACK: Jika API gagal, gunakan estimasi manual
        // Estimasi berdasarkan berat dan jenis kurir
        $base_rate = 10000; // Base rate Rp 10.000
        $per_kg_rate = 8000; // Rp 8.000 per kg
        $weight_in_kg = ceil($total_weight / 1000);
        
        $courier_multipliers = [
            'jne' => ['REG' => 1.0, 'YES' => 1.5, 'OKE' => 0.8],
            'tiki' => ['REG' => 1.1, 'ECO' => 0.9, 'ONS' => 1.6],
            'pos' => ['Paket Kilat Khusus' => 0.9, 'Express Next Day' => 1.4],
            'anteraja' => ['Reguler' => 1.0, 'Same Day' => 2.0],
            'jnt' => ['Reguler' => 0.9, 'Express' => 1.3],
            'sicepat' => ['REGULER' => 1.0, 'BEST' => 1.4],
            'ninja' => ['Reguler' => 0.95, 'Next Day' => 1.5],
            'lion' => ['REGULER' => 0.9, 'ONE DAY' => 1.6],
            'pcp' => ['Reguler' => 0.85, 'Express' => 1.3],
            'jet' => ['Reguler' => 0.9, 'Express' => 1.4],
        ];

        $services = $courier_multipliers[$this->courier] ?? ['Reguler' => 1.0, 'Express' => 1.5];
        $this->shipping_options = [];

        foreach($services as $service => $multiplier) {
            $cost = (int)(($base_rate + ($weight_in_kg * $per_kg_rate)) * $multiplier);
            $etd = $multiplier > 1.3 ? '1-2 HARI' : '2-4 HARI';
            
            $this->shipping_options[] = [
                'service' => $service,
                'description' => ucwords(strtolower($service)) . ' Service',
                'cost' => [
                    [
                        'value' => $cost,
                        'etd' => $etd,
                        'note' => 'Estimasi ongkir (API dalam pengembangan)'
                    ]
                ]
            ];
        }

        $this->selected_shipping = null;
        $this->shipping_cost = 0;
        
        // Info to user
        session()->flash('info', 'Menampilkan estimasi ongkir. Ongkir aktual akan dikonfirmasi oleh admin.');
    }

    public function selectShippingService($cost)
    {
        $this->selected_shipping = $cost;
        $this->shipping_cost = $cost['cost'][0]['value'];
    }

    public function updatedSearchCity()
    {
        $this->searchCity();
    }

    public function updatedCourier()
    {
        $this->calculateShipping();
    }

    public function placeOrder()
    {
        $this->validate();

        $cart_items = CartManagement::getCartItemsFromCookie();
        
        if(empty($cart_items)) {
            session()->flash('error', 'Keranjang belanja Anda kosong. Silakan tambahkan produk terlebih dahulu.');
            return;
        }

        $line_items = [];
        foreach($cart_items as $item) {
            $line_items[] = [
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_amount' => $item['unit_amount'],
                'total_amount' => $item['total_amount'],
            ];
        }

        $order = new Order();
        $order->user_id = Auth::id();
        $order->grand_total = CartManagement::calculateGrandTotal($cart_items) + $this->shipping_cost;
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->currency = 'IDR';
        $order->shipping_amount = $this->shipping_cost;
        $order->notes = 'Order placed by ' . Auth::user()->name;
        
        // Save shipping information
        if($this->selected_destination && $this->selected_shipping) {
            $courierUpper = strtoupper($this->courier);
            $service = $this->selected_shipping['service'];
            
            $order->shipping_destination_id = $this->selected_destination['id'];
            $order->shipping_destination_name = ($this->selected_destination['subdistrict_name'] ?? '') . ', ' . 
                                                 ($this->selected_destination['district_name'] ?? '') . ', ' . 
                                                 ($this->selected_destination['city_name'] ?? '') . ', ' . 
                                                 ($this->selected_destination['province_name'] ?? '');
            $order->shipping_courier = $courierUpper;
            $order->shipping_service = $service;
            $order->shipping_method = $courierUpper . ' - ' . $service; // Backward compatibility
            $order->shipping_cost = $this->shipping_cost; // Kolom shipping_cost untuk detail
            $order->shipping_etd = $this->selected_shipping['cost'][0]['etd'] ?? null;
        } else {
            $order->shipping_method = 'none';
        }

        $address = new Address();
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->street_address = $this->street_address;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->zip_code = $this->zip_code;

        if($this->payment_method == 'midtrans') {
            $order->save();
            $address->order_id = $order->id;
            $address->save();
            $order->items()->createMany($line_items);
            
            // do not clear cart here; keep until payment confirmed
            return redirect()->route('payment.midtrans', ['order' => $order->id]);
        }

        // For COD orders
        $order->save();
        $address->order_id = $order->id;
        $address->save();
        $order->items()->createMany($line_items);

        // Send order confirmation email for COD
        try {
            \Illuminate\Support\Facades\Mail::to(Auth::user()->email)
                ->send(new \App\Mail\OrderPlaced($order));
            
            \Illuminate\Support\Facades\Log::info('COD order confirmation email sent', [
                'order_id' => $order->id,
                'email' => Auth::user()->email
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to send COD order confirmation email', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
        }

        CartManagement::clearCartItemsFromCookies();
        return redirect()->route('success');
    }

    public function clearCart()
    {
        CartManagement::clearCartItemsFromCookies();
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);
        $available_couriers = $this->rajaOngkirService->getAvailableCouriers();
        
        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total,
            'available_couriers' => $available_couriers
        ]);
    }
}
