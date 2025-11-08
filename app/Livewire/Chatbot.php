<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Order;

class Chatbot extends Component
{
    public $isOpen = false;
    public $message = '';
    public $messages = [];
    public $isTyping = false;
    public $useAI = true;
    public $conversationContext = [];

    // Persist chat state across page navigation
    protected function getListeners()
    {
        return ['echo:chatbot,MessageReceived' => 'handleMessage'];
    }

    public function mount()
    {
        // Check if Gemini API is configured
        if (config('gemini.api_key')) {
            $this->useAI = true;
        } else {
            $this->useAI = false;
            Log::warning('Gemini API key not configured.');
        }

        // Load messages from session to persist across pages
        $this->messages = session('chatbot_messages', []);
        $this->conversationContext = session('chatbot_context', []);
    }

    public function hydrate()
    {
        // Restore state after each request
        $this->messages = session('chatbot_messages', $this->messages);
        $this->conversationContext = session('chatbot_context', $this->conversationContext);
    }

    public function dehydrate()
    {
        // Save state before response
        session(['chatbot_messages' => $this->messages]);
        session(['chatbot_context' => $this->conversationContext]);
    }

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
        
        if ($this->isOpen) {
            $this->dispatch('chat-opened');
        }
    }

    public function sendMessage()
    {
        if (empty(trim($this->message))) {
            return;
        }

        $userMessage = trim($this->message);

        // Add user message
        $this->messages[] = [
            'type' => 'user',
            'message' => $userMessage,
            'time' => now()->format('H:i')
        ];

        // Add to context history
        $this->conversationContext[] = [
            'type' => 'user',
            'message' => $userMessage
        ];

        // Clear input IMMEDIATELY before processing
        $this->message = '';
        $this->isTyping = true;
        
        // Save to session
        session(['chatbot_messages' => $this->messages]);
        session(['chatbot_context' => $this->conversationContext]);
        
        // Force refresh UI
        $this->dispatch('$refresh');
        
        // Get response
        try {
            if ($this->useAI && config('gemini.api_key')) {
                $botResponse = $this->getAIResponse($userMessage);
            } else {
                $botResponse = $this->getFallbackResponse(strtolower($userMessage));
            }
        } catch (\Exception $e) {
            Log::error('Chatbot Error: ' . $e->getMessage());
            $botResponse = $this->getFallbackResponse(strtolower($userMessage));
        }
        
        // Add bot response
        $this->messages[] = [
            'type' => 'bot',
            'message' => $botResponse,
            'time' => now()->format('H:i')
        ];

        // Add to context history
        $this->conversationContext[] = [
            'type' => 'bot',
            'message' => $botResponse
        ];

        // Limit context (keep last 10 exchanges)
        if (count($this->conversationContext) > 20) {
            array_splice($this->conversationContext, 0, 2);
        }
        
        // Save to session
        session(['chatbot_messages' => $this->messages]);
        session(['chatbot_context' => $this->conversationContext]);
        
        $this->isTyping = false;
        
        // Dispatch events
        $this->dispatch('scroll-to-bottom');
        $this->dispatch('$refresh');
        
        // Ensure input is cleared and ready
        $this->reset('message');
    }

    private function getSystemPrompt()
    {
        // Get real-time data from database
        $productsCount = Cache::remember('chatbot_products_count', 3600, function() {
            return Product::where('is_active', 1)->count();
        });
        
        $categoriesCount = Cache::remember('chatbot_categories_count', 3600, function() {
            return Category::where('is_active', 1)->count();
        });
        
        $brandsCount = Cache::remember('chatbot_brands_count', 3600, function() {
            return Brand::where('is_active', 1)->count();
        });
        
        $categories = Cache::remember('chatbot_categories_list', 3600, function() {
            return Category::where('is_active', 1)
                ->withCount('products')
                ->get()
                ->map(fn($cat) => "- {$cat->name} ({$cat->products_count} produk)")
                ->join("\n");
        });
        
        $brands = Cache::remember('chatbot_brands_list', 3600, function() {
            return Brand::where('is_active', 1)
                ->withCount('products')
                ->get()
                ->map(fn($brand) => "- {$brand->name} ({$brand->products_count} produk)")
                ->join("\n");
        });
        
        $featuredProducts = Cache::remember('chatbot_featured_products', 3600, function() {
            return Product::where('is_active', 1)
                ->where('is_featured', 1)
                ->with(['category', 'brand'])
                ->take(5)
                ->get()
                ->map(fn($prod) => "- {$prod->name} - Rp " . number_format($prod->price, 0, ',', '.') . " ({$prod->category->name})")
                ->join("\n");
        });
        
        $productLink = route('products');
        $contactLink = route('contact');
        $myOrdersLink = route('my-orders');
        
        return "Anda adalah asisten AI yang cerdas dan ramah untuk Munir Jaya Abadi, toko online produk pertanian berkualitas di Indonesia.

INFORMASI TOKO:
- Nama: Munir Jaya Abadi
- Total Produk: {$productsCount} produk aktif
- Kategori: {$categoriesCount} kategori
- Merek: {$brandsCount} merek
- Lokasi: Indonesia
- Website: " . config('app.url') . "

KATEGORI TERSEDIA:
{$categories}

MEREK TERSEDIA:
{$brands}

PRODUK UNGGULAN:
{$featuredProducts}

LAYANAN PENGIRIMAN:
- Kurir: JNE, J&T, SiCepat, Ninja Express, AnterAja
- Coverage: Seluruh Indonesia (kota & kabupaten)
- Estimasi: 2-5 hari kerja (dalam kota), 5-7 hari (luar kota)
- Gratis Ongkir: Promo khusus untuk pembelian minimum tertentu
- COD: Tersedia untuk wilayah tertentu
- Tracking: Real-time tracking pesanan

METODE PEMBAYARAN (via Midtrans):
- Transfer Bank: BCA, Mandiri, BRI, BNI, Permata
- E-Wallet: GoPay, OVO, DANA, LinkAja, ShopeePay
- Credit/Debit Card: Visa, Mastercard, JCB, Amex
- QRIS: Scan QR semua e-wallet
- Cicilan: Kartu kredit 0% (min. pembelian tertentu)

KEMAMPUAN ANDA:
1. Menjawab pertanyaan APAPUN dengan cerdas (umum, teknis, atau tentang toko)
2. Memberikan informasi produk spesifik dengan nama dan harga real
3. Membantu customer menemukan produk yang tepat
4. Menjelaskan proses pembelian, pembayaran, dan pengiriman
5. Memberikan rekomendasi produk berdasarkan kebutuhan
6. Menjawab pertanyaan umum tentang apapun (tidak hanya toko)

INSTRUKSI PENTING:
1. Jawab dalam Bahasa Indonesia yang ramah, natural, dan mudah dipahami
2. Jika ditanya tentang produk, sebutkan nama produk ASLI dari database
3. Jika ditanya tentang pengiriman, jelaskan opsi kurir yang tersedia
4. Jika ditanya pertanyaan umum (bukan tentang toko), jawab dengan pengetahuan umum
5. Gunakan emoji yang sesuai untuk membuat percakapan menarik
6. Sertakan link HTML yang relevan:
   - Produk: <a href='{$productLink}' class='text-blue-500 underline font-semibold'>🛒 Lihat Katalog</a>
   - Kontak: <a href='{$contactLink}' class='text-blue-500 underline font-semibold'>📞 Hubungi Kami</a>
   - Pesanan: <a href='{$myOrdersLink}' class='text-blue-500 underline font-semibold'>📦 Lacak Pesanan</a>
7. Jika tidak yakin, akui dan berikan alternatif jawaban atau sumber informasi
8. Jadilah helpful dan proaktif dalam memberikan informasi

TONE: Ramah, cerdas, helpful, natural seperti berbicara dengan teman yang knowledgeable.

CONTOH INTERAKSI:
User: 'Apa itu fotosintesis?'
Assistant: '🌱 Fotosintesis adalah proses tumbuhan mengubah cahaya matahari, air, dan CO2 menjadi makanan (glukosa) dan oksigen. Ini penting untuk kehidupan di Bumi! Btw, kami juga jual produk pertanian untuk membantu tanaman tumbuh optimal.'

User: 'Ada pupuk NPK?'
Assistant: '✅ Ada! Kami punya [sebutkan produk spesifik dari database dengan harga]. Cocok untuk meningkatkan hasil panen.'";
    }

    private function getAIResponse($userMessage)
    {
        try {
            // Prepare conversation history for Gemini
            $conversationHistory = $this->getSystemPrompt() . "\n\n";
            
            // Add previous messages (limit to last 5 exchanges)
            $recentMessages = array_slice($this->conversationContext, -10);
            foreach ($recentMessages as $msg) {
                if ($msg['type'] === 'user') {
                    $conversationHistory .= "User: " . $msg['message'] . "\n";
                } else {
                    $conversationHistory .= "Assistant: " . $msg['message'] . "\n";
                }
            }
            
            $conversationHistory .= "User: " . $userMessage . "\nAssistant: ";

            // Call Gemini API
            $apiKey = config('gemini.api_key');
            $model = config('gemini.model', 'gemini-2.5-flash');
            $url = config('gemini.endpoint') . "/models/{$model}:generateContent?key={$apiKey}";

            $response = Http::timeout(30)->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $conversationHistory]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => config('gemini.temperature', 0.7),
                    'maxOutputTokens' => config('gemini.max_tokens', 500),
                    'topP' => 0.8,
                    'topK' => 40,
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    $aiMessage = $data['candidates'][0]['content']['parts'][0]['text'];
                    $aiMessage = $this->enrichResponseWithLinks($aiMessage, $userMessage);
                    return $aiMessage;
                }
            }

            throw new \Exception('Gemini API returned empty response');

        } catch (\Exception $e) {
            Log::error('Gemini API Error: ' . $e->getMessage());
            throw $e;
        }
    }

    private function enrichResponseWithLinks($response, $userMessage)
    {
        $userMessage = strtolower($userMessage);

        // Add product link if relevant
        if ((str_contains($userMessage, 'produk') || str_contains($userMessage, 'barang') || str_contains($userMessage, 'katalog')) 
            && !str_contains($response, '/products')) {
            $response .= "\n\n<a href='" . route('products') . "'>🔍 Lihat Katalog Lengkap</a>";
        }

        // Add contact link if relevant
        if ((str_contains($userMessage, 'kontak') || str_contains($userMessage, 'hubungi') || str_contains($userMessage, 'admin')) 
            && !str_contains($response, '/contact')) {
            $response .= "\n\n<a href='" . route('contact') . "'>📞 Hubungi Kami</a>";
        }

        // Add order tracking link if relevant
        if (str_contains($userMessage, 'lacak') || str_contains($userMessage, 'track') || str_contains($userMessage, 'pesanan')) {
            if (Auth::check()) {
                if (!str_contains($response, '/my-orders')) {
                    $response .= "\n\n<a href='" . route('my-orders') . "'>📦 Lihat Pesanan Saya</a>";
                }
            } else {
                if (!str_contains($response, '/login')) {
                    $response .= "\n\n<a href='" . route('login') . "'>🔐 Login untuk Lihat Pesanan</a>";
                }
            }
        }

        return $this->formatResponse($response);
    }

    private function formatResponse($text)
    {
        // Convert markdown-style bold to HTML
        $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);
        
        // Convert markdown-style links to HTML (but preserve existing HTML links)
        if (!str_contains($text, '<a href=')) {
            $text = preg_replace('/\[([^\]]+)\]\(([^)]+)\)/', '<a href="$2">$1</a>', $text);
        }
        
        // Convert line breaks to HTML br tags
        $text = nl2br($text);
        
        // Add proper spacing between sections
        $text = str_replace("<br />\n<br />", "<br /><br />", $text);
        
        // SECURITY: Sanitize HTML to prevent XSS
        // Allow only safe tags and attributes
        return Purify::clean($text, [
            'HTML.Allowed' => 'br,strong,b,em,i,a[href],p,ul,li,ol',
            'AutoFormat.RemoveEmpty' => true,
            'URI.AllowedSchemes' => ['http' => true, 'https' => true],
            'Attr.AllowedFrameTargets' => [],
        ]);
    }

    private function getFallbackResponse($message)
    {
        // Get real data for better responses
        $productsCount = Product::where('is_active', 1)->count();
        $categories = Category::where('is_active', 1)->take(5)->pluck('name')->toArray();
        $brands = Brand::where('is_active', 1)->take(5)->pluck('name')->toArray();
        
        // Pertanyaan tentang produk spesifik
        if (str_contains($message, 'pupuk') || str_contains($message, 'pestisida') || str_contains($message, 'herbisida') || str_contains($message, 'beras')) {
            $keyword = '';
            if (str_contains($message, 'pupuk')) $keyword = 'pupuk';
            elseif (str_contains($message, 'pestisida')) $keyword = 'pestisida';
            elseif (str_contains($message, 'herbisida')) $keyword = 'herbisida';
            elseif (str_contains($message, 'beras')) $keyword = 'beras';
            
            $products = Product::where('is_active', 1)
                ->where(function($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%")
                      ->orWhere('description', 'like', "%{$keyword}%");
                })
                ->with(['category', 'brand'])
                ->take(3)
                ->get();
            
            if ($products->count() > 0) {
                $productList = $products->map(function($p) {
                    return "📦 <strong>{$p->name}</strong> - Rp " . number_format($p->price, 0, ',', '.') . " ({$p->category->name})";
                })->join("<br>");
                
                return "🌾 Kami memiliki beberapa produk {$keyword} yang mungkin cocok untuk Anda:<br><br>{$productList}<br><br><a href='" . route('products') . "' class='text-blue-500 underline font-semibold'>🔍 Lihat Semua Produk {$keyword}</a>";
            }
        }
        
        // Pertanyaan tentang kategori
        if (str_contains($message, 'kategori') || str_contains($message, 'jenis')) {
            $categoriesList = implode(', ', $categories);
            return "📂 Kami memiliki berbagai kategori produk pertanian berkualitas, antara lain: <strong>{$categoriesList}</strong>, dan masih banyak lagi!<br><br><a href='" . route('products') . "' class='text-blue-500 underline font-semibold'>🔍 Lihat Semua Kategori</a>";
        }
        
        // Pertanyaan tentang merek
        if (str_contains($message, 'merek') || str_contains($message, 'brand')) {
            $brandsList = implode(', ', $brands);
            return "🏷️ Kami bekerja sama dengan merek-merek terpercaya seperti: <strong>{$brandsList}</strong>, dan masih banyak lagi!<br><br><a href='" . route('products') . "' class='text-blue-500 underline font-semibold'>🔍 Lihat Produk Berdasarkan Merek</a>";
        }
        
        // Pertanyaan tentang produk umum
        if (str_contains($message, 'produk') || str_contains($message, 'barang') || str_contains($message, 'jual')) {
            $featured = Product::where('is_active', 1)
                ->where('is_featured', 1)
                ->with(['category', 'brand'])
                ->take(3)
                ->get();
            
            if ($featured->count() > 0) {
                $featuredList = $featured->map(function($p) {
                    return "⭐ <strong>{$p->name}</strong> - Rp " . number_format($p->price, 0, ',', '.') . " ({$p->brand->name})";
                })->join("<br>");
                
                return "🌟 Kami memiliki <strong>{$productsCount} produk</strong> pertanian berkualitas! Berikut beberapa produk unggulan kami:<br><br>{$featuredList}<br><br><a href='" . route('products') . "' class='text-blue-500 underline font-semibold'>🔍 Lihat Katalog Lengkap</a>";
            }
            
            return "📦 Kami menjual berbagai produk pertanian berkualitas dengan total <strong>{$productsCount} produk</strong>. Silakan kunjungi halaman <a href='" . route('products') . "' class='text-blue-500 underline font-semibold'>Produk</a> untuk melihat katalog lengkap kami!";
        }
        
        // Pertanyaan tentang harga
        if (str_contains($message, 'harga') || str_contains($message, 'berapa')) {
            $priceRange = Product::where('is_active', 1)
                ->selectRaw('MIN(price) as min_price, MAX(price) as max_price')
                ->first();
            
            if ($priceRange) {
                $minPrice = number_format($priceRange->min_price, 0, ',', '.');
                $maxPrice = number_format($priceRange->max_price, 0, ',', '.');
                
                return "💰 Harga produk kami bervariasi mulai dari <strong>Rp {$minPrice}</strong> hingga <strong>Rp {$maxPrice}</strong>, tergantung jenis dan kualitas produk.<br><br>Untuk informasi harga detail, silakan lihat di halaman <a href='" . route('products') . "' class='text-blue-500 underline font-semibold'>Produk</a>. Kami menyediakan harga terbaik dengan kualitas terjamin!";
            }
        }
        
        // Pertanyaan tentang pengiriman
        if (str_contains($message, 'kirim') || str_contains($message, 'ongkir') || str_contains($message, 'pengiriman') || str_contains($message, 'kurir') || str_contains($message, 'ekspedisi')) {
            return $this->formatResponse("🚚 **Layanan Pengiriman Kami**

**Kurir Tersedia:**
✅ JNE (Reguler, YES, OKE)
✅ J&T Express
✅ SiCepat (REG, HALU)
✅ Ninja Express
✅ AnterAja

**Coverage:**
📍 Seluruh Indonesia (kota & kabupaten)

**Estimasi Pengiriman:**
🏙️ Dalam kota: 1-2 hari
🌆 Luar kota (Jawa): 2-4 hari
🏝️ Luar Pulau: 5-7 hari

**Fitur:**
🎁 Gratis ongkir untuk pembelian minimum tertentu
💵 COD tersedia untuk wilayah tertentu
📱 Real-time tracking pesanan
📦 Packing aman & rapi

Biaya dihitung otomatis saat checkout berdasarkan berat & tujuan!

<a href='" . route('products') . "'>🛒 Belanja Sekarang</a>");
        }
        
        // Pertanyaan tentang pembayaran
        if (str_contains($message, 'bayar') || str_contains($message, 'payment') || str_contains($message, 'transfer')) {
            return $this->formatResponse("💳 **Metode Pembayaran Kami (via Midtrans):**

**Transfer Bank:**
🏦 BCA, Mandiri, BRI, BNI, Permata, CIMB Niaga

**E-Wallet:**
📱 GoPay, OVO, DANA, LinkAja, ShopeePay

**Kartu Kredit/Debit:**
💳 Visa, Mastercard, JCB, American Express

**QRIS:**
📲 Scan QR dengan semua e-wallet

**Cicilan 0%:**
🎯 Kartu kredit (min. pembelian tertentu)

Semua pembayaran **aman & terenkripsi SSL**!

<a href='" . route('products') . "'>🛒 Mulai Belanja</a>");
        }
        
        // Pertanyaan tentang cara pesan
        if (str_contains($message, 'pesan') || str_contains($message, 'order') || str_contains($message, 'beli') || str_contains($message, 'checkout')) {
            return $this->formatResponse("🛒 **Cara Order Mudah:**

1️⃣ Pilih produk di <a href='" . route('products') . "'>Katalog</a>
2️⃣ Klik \"Tambah ke Keranjang\"
3️⃣ Lihat keranjang dan klik \"Checkout\"
4️⃣ Isi alamat pengiriman
5️⃣ Pilih metode pembayaran
6️⃣ Selesai! Pesanan akan diproses

<a href='" . route('products') . "'>🛍️ Mulai Belanja Sekarang</a>");
        }
        
        // Pertanyaan tentang kontak
        if (str_contains($message, 'kontak') || str_contains($message, 'hubungi') || str_contains($message, 'telepon') || str_contains($message, 'whatsapp') || str_contains($message, 'email')) {
            return "📞 <strong>Hubungi Kami:</strong><br><br>📧 Email: " . config('mail.from.address') . "<br>🌐 Website: " . config('app.url') . "<br>📍 Lokasi: Indonesia<br><br>Atau kunjungi halaman <a href='" . route('contact') . "' class='text-blue-500 underline font-semibold'>Kontak</a> untuk form kontak langsung!";
        }
        
        // Pertanyaan tentang tracking order
        if (str_contains($message, 'lacak') || str_contains($message, 'tracking') || str_contains($message, 'pesanan saya') || str_contains($message, 'status pesanan')) {
            if (Auth::check()) {
                $orderCount = Order::where('user_id', Auth::id())->count();
                return "📦 <strong>Lacak Pesanan Anda</strong><br><br>Anda memiliki <strong>{$orderCount} pesanan</strong>. Silakan kunjungi halaman <a href='" . route('my-orders') . "' class='text-blue-500 underline font-semibold'>Pesanan Saya</a> untuk melihat status pesanan real-time!";
            } else {
                return "🔐 Untuk melacak pesanan, silakan <a href='" . route('login') . "' class='text-blue-500 underline font-semibold'>Login</a> terlebih dahulu. Kemudian Anda bisa melihat semua status pesanan di halaman Pesanan Saya.";
            }
        }
        
        // Pertanyaan tentang return/komplain
        if (str_contains($message, 'return') || str_contains($message, 'kembalikan') || str_contains($message, 'komplain') || str_contains($message, 'rusak') || str_contains($message, 'garansi')) {
            return "🔄 <strong>Kebijakan Return & Garansi:</strong><br><br>✅ Garansi 7 hari untuk produk cacat<br>✅ Return mudah dengan bukti foto<br>✅ Refund cepat setelah verifikasi<br><br>Jika ada masalah, hubungi kami di halaman <a href='" . route('contact') . "' class='text-blue-500 underline font-semibold'>Kontak</a> dengan menyertakan nomor order!";
        }
        
        // Pertanyaan tentang promo
        if (str_contains($message, 'promo') || str_contains($message, 'diskon') || str_contains($message, 'sale') || str_contains($message, 'murah')) {
            $onSaleProducts = Product::where('is_active', 1)
                ->where('on_sale', 1)
                ->count();
            
            if ($onSaleProducts > 0) {
                return "🎉 <strong>Ada {$onSaleProducts} Produk Sedang Promo!</strong><br><br>Jangan lewatkan penawaran spesial kami. Cek halaman <a href='" . route('products') . "' class='text-blue-500 underline font-semibold'>Produk</a> untuk lihat semua promo menarik!";
            }
            
            return "🎉 <strong>Promo Spesial Menanti!</strong><br><br>Follow sosial media kami untuk info promo terbaru. Cek juga halaman <a href='" . route('products') . "' class='text-blue-500 underline font-semibold'>Produk</a> untuk penawaran spesial!";
        }
        
        // Pertanyaan tentang rekomendasi
        if (str_contains($message, 'rekomendasi') || str_contains($message, 'recommend') || str_contains($message, 'saran') || str_contains($message, 'terbaik')) {
            $bestSellers = Product::where('is_active', 1)
                ->where('is_featured', 1)
                ->with(['category', 'brand'])
                ->take(3)
                ->get();
            
            if ($bestSellers->count() > 0) {
                $recommendations = $bestSellers->map(function($p) {
                    return "⭐ <strong>{$p->name}</strong> - Rp " . number_format($p->price, 0, ',', '.') . " ({$p->category->name})";
                })->join("<br>");
                
                return "🌟 <strong>Rekomendasi Produk Terbaik:</strong><br><br>{$recommendations}<br><br><a href='" . route('products') . "' class='text-blue-500 underline font-semibold'>🔍 Lihat Lebih Banyak</a>";
            }
        }
        
        // Greeting
        if (str_contains($message, 'hai') || str_contains($message, 'halo') || str_contains($message, 'hello') || str_contains($message, 'hi') || str_contains($message, 'pagi') || str_contains($message, 'siang') || str_contains($message, 'sore') || str_contains($message, 'malam')) {
            $greeting = '👋';
            if (str_contains($message, 'pagi')) $greeting .= ' Selamat pagi';
            elseif (str_contains($message, 'siang')) $greeting .= ' Selamat siang';
            elseif (str_contains($message, 'sore')) $greeting .= ' Selamat sore';
            elseif (str_contains($message, 'malam')) $greeting .= ' Selamat malam';
            else $greeting .= ' Halo';
            
            return "{$greeting}! Senang bisa membantu Anda di <strong>Munir Jaya Abadi</strong>. Ada yang bisa saya bantu terkait produk pertanian kami?";
        }
        
        // Thank you
        if (str_contains($message, 'terima kasih') || str_contains($message, 'thanks') || str_contains($message, 'thank you') || str_contains($message, 'makasih')) {
            return "😊 Sama-sama! Senang bisa membantu. Jangan ragu untuk bertanya lagi jika ada yang ingin ditanyakan. <strong>Selamat berbelanja!</strong> 🛒";
        }
        
        // Help/bantuan
        if (str_contains($message, 'bantuan') || str_contains($message, 'help') || str_contains($message, 'tolong')) {
            return "💡 <strong>Saya bisa membantu Anda dengan:</strong><br><br>📦 Informasi produk & harga<br>🏷️ Kategori & merek<br>🛒 Cara pemesanan<br>💳 Metode pembayaran<br>🚚 Info pengiriman<br>📦 Lacak pesanan<br>📞 Kontak customer service<br><br>Silakan tanyakan apa yang Anda butuhkan!";
        }
        
        // Default response
        return "🤖 Maaf, saya kurang paham pertanyaan Anda. Namun saya bisa membantu dengan:<br><br>📦 <strong>Produk</strong> • 💰 <strong>Harga</strong> • 🛒 <strong>Cara Order</strong><br>💳 <strong>Pembayaran</strong> • 🚚 <strong>Pengiriman</strong><br>📞 <strong>Kontak</strong> • 📦 <strong>Lacak Pesanan</strong><br><br>Atau kunjungi <a href='" . route('products') . "' class='text-blue-500 underline font-semibold'>Katalog Produk</a> kami!";
    }

    public function clearChat()
    {
        $this->messages = [];
        $this->conversationContext = [];
        
        // Clear from session
        session()->forget('chatbot_messages');
        session()->forget('chatbot_context');
        
        $this->messages[] = [
            'type' => 'bot',
            'message' => '🔄 Chat direset. Ada yang bisa saya bantu hari ini?',
            'time' => now()->format('H:i')
        ];
        
        // Save to session
        session(['chatbot_messages' => $this->messages]);
    }

    public function render()
    {
        return view('livewire.chatbot');
    }
}
