<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class Chatbot extends Component
{
    public $isOpen = false;
    public $message = '';
    public $messages = [];
    public $isTyping = false;
    public $useAI = true;
    public $conversationContext = [];

    public function mount()
    {
        // Check if Gemini API is configured
        if (config('gemini.api_key')) {
            $this->useAI = true;
        } else {
            $this->useAI = false;
            Log::warning('Gemini API key not configured.');
        }

        // Start with empty messages for better UX (welcome screen in view)
        $this->messages = [];

        // Initialize conversation context
        $this->conversationContext = [];
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

        $this->message = '';
        $this->isTyping = true;
        
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
        
        $this->isTyping = false;
        $this->dispatch('scroll-to-bottom');
    }

    private function getSystemPrompt()
    {
        $productLink = route('products');
        return "Anda adalah chatbot customer service untuk Munir Jaya Abadi, toko online produk pertanian berkualitas di Indonesia.

INFORMASI TOKO:
- Nama: Munir Jaya Abadi
- Produk: Beras, pupuk, pestisida, herbisida, obat pertanian
- Lokasi: Jl. Raya Pertanian No. 123, Jakarta Selatan
- WhatsApp: 081234567890
- Email: info@munirjayaabadi.com
- Jam: Senin-Jumat 08:00-17:00, Sabtu 08:00-15:00, Minggu tutup
- Website: munirjayaabadi.com

LAYANAN:
- Pengiriman seluruh Indonesia (2-5 hari)
- Pembayaran: Bank (BCA, Mandiri, BRI, BNI), E-Wallet (GoPay, OVO, DANA), QRIS
- Garansi & return 7 hari

INSTRUKSI:
1. Jawab dalam Bahasa Indonesia ramah & profesional
2. Berikan info spesifik tentang produk
3. Sertakan link HTML: <a href='{$productLink}' class='text-blue-500 underline'>Produk</a>
4. Gunakan emoji yang sesuai
5. Jika tidak tahu, arahkan ke customer service
6. Fokus membantu petani menemukan produk tepat
7. Promosikan keunggulan produk berkualitas
8. Berikan rekomendasi berdasarkan kebutuhan

TONE: Ramah, membantu, profesional, peduli kebutuhan petani.";
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

        if ((str_contains($userMessage, 'produk') || str_contains($userMessage, 'barang')) 
            && !str_contains($response, '/products')) {
            $response .= "\n\n<a href='" . route('products') . "' class='text-blue-500 underline font-semibold'>🔍 Lihat Katalog Produk</a>";
        }

        if ((str_contains($userMessage, 'kontak') || str_contains($userMessage, 'hubungi')) 
            && !str_contains($response, '/contact')) {
            $response .= "\n\n<a href='" . route('contact') . "' class='text-blue-500 underline font-semibold'>📞 Hubungi Kami</a>";
        }

        if (str_contains($userMessage, 'lacak') || str_contains($userMessage, 'track')) {
            if (auth()->check()) {
                $response .= "\n\n<a href='" . route('my-orders') . "' class='text-blue-500 underline font-semibold'>📦 Lihat Pesanan</a>";
            } else {
                $response .= "\n\n<a href='" . route('login') . "' class='text-blue-500 underline font-semibold'>🔐 Login</a>";
            }
        }

        return $response;
    }

    private function getFallbackResponse($message)
    {
        // Pertanyaan tentang produk
        if (str_contains($message, 'produk') || str_contains($message, 'barang') || str_contains($message, 'jual')) {
            return '📦 Kami menjual berbagai produk pertanian berkualitas seperti beras, pupuk, pestisida, dan obat-obatan pertanian. Silakan kunjungi halaman <a href="' . route('products') . '" class="text-blue-500 underline">Produk</a> untuk melihat katalog lengkap kami!';
        }
        
        // Pertanyaan tentang harga
        if (str_contains($message, 'harga') || str_contains($message, 'berapa')) {
            return '💰 Untuk informasi harga produk, silakan lihat di halaman <a href="' . route('products') . '" class="text-blue-500 underline">Produk</a>. Kami menyediakan harga terbaik dengan kualitas terjamin!';
        }
        
        // Pertanyaan tentang pengiriman
        if (str_contains($message, 'kirim') || str_contains($message, 'ongkir') || str_contains($message, 'pengiriman')) {
            return '🚚 Kami melayani pengiriman ke seluruh Indonesia. Biaya pengiriman akan dihitung otomatis saat checkout berdasarkan lokasi Anda. Estimasi pengiriman 2-5 hari kerja.';
        }
        
        // Pertanyaan tentang pembayaran
        if (str_contains($message, 'bayar') || str_contains($message, 'payment') || str_contains($message, 'transfer')) {
            return '💳 Kami menerima berbagai metode pembayaran: Transfer Bank (BCA, Mandiri, BRI, BNI), E-Wallet (GoPay, OVO, DANA), dan QRIS. Pembayaran diproses melalui Midtrans yang aman dan terpercaya.';
        }
        
        // Pertanyaan tentang cara pesan
        if (str_contains($message, 'pesan') || str_contains($message, 'order') || str_contains($message, 'beli')) {
            return '🛒 Cara order sangat mudah:<br>1. Pilih produk di <a href="' . route('products') . '" class="text-blue-500 underline">halaman Produk</a><br>2. Klik "Add to Cart"<br>3. Lihat keranjang dan klik "Checkout"<br>4. Isi alamat pengiriman<br>5. Pilih metode pembayaran<br>6. Selesai! Pesanan akan kami proses.';
        }
        
        // Pertanyaan tentang kontak
        if (str_contains($message, 'kontak') || str_contains($message, 'hubungi') || str_contains($message, 'telepon') || str_contains($message, 'whatsapp')) {
            return '📞 Anda bisa menghubungi kami melalui:<br>📱 WhatsApp: 081234567890<br>📧 Email: info@munirjayaabadi.com<br>📍 Alamat: Jl. Raya Pertanian No. 123, Jakarta<br><br>Atau kunjungi halaman <a href="' . route('contact') . '" class="text-blue-500 underline">Kontak</a> untuk info lengkap!';
        }
        
        // Pertanyaan tentang jam operasional
        if (str_contains($message, 'jam') || str_contains($message, 'buka') || str_contains($message, 'operasional')) {
            return '🕒 Jam Operasional Toko:<br>Senin - Jumat: 08:00 - 17:00 WIB<br>Sabtu: 08:00 - 15:00 WIB<br>Minggu & Tanggal Merah: Tutup<br><br>Namun, Anda tetap bisa order online 24/7!';
        }
        
        // Pertanyaan tentang lokasi
        if (str_contains($message, 'lokasi') || str_contains($message, 'alamat') || str_contains($message, 'dimana')) {
            return '📍 Lokasi toko kami:<br>Jl. Raya Pertanian No. 123, Jakarta Selatan<br><br>Lihat peta di halaman <a href="' . route('contact') . '" class="text-blue-500 underline">Kontak</a> untuk arah lebih detail!';
        }
        
        // Pertanyaan tentang akun/register
        if (str_contains($message, 'daftar') || str_contains($message, 'register') || str_contains($message, 'akun')) {
            return '👤 Untuk membuat akun, silakan klik <a href="' . route('register') . '" class="text-blue-500 underline">Daftar</a> di pojok kanan atas. Dengan akun, Anda bisa melacak pesanan, melihat riwayat belanja, dan mendapat promo eksklusif!';
        }
        
        // Pertanyaan tentang tracking order
        if (str_contains($message, 'lacak') || str_contains($message, 'tracking') || str_contains($message, 'pesanan saya')) {
            return '📦 Untuk melacak pesanan Anda, silakan login dan kunjungi halaman <a href="' . route('my-orders') . '" class="text-blue-500 underline">Pesanan Saya</a>. Anda bisa melihat status pesanan real-time di sana.';
        }
        
        // Pertanyaan tentang return/komplain
        if (str_contains($message, 'return') || str_contains($message, 'kembalikan') || str_contains($message, 'komplain') || str_contains($message, 'rusak')) {
            return '🔄 Jika ada masalah dengan produk, kami menerima return/pengembalian dalam 7 hari. Silakan hubungi customer service kami di WhatsApp 081234567890 atau email info@munirjayaabadi.com dengan menyertakan foto produk dan nomor order.';
        }
        
        // Pertanyaan tentang promo
        if (str_contains($message, 'promo') || str_contains($message, 'diskon') || str_contains($message, 'sale')) {
            return '🎉 Kami sering memberikan promo menarik! Follow Instagram kami @munirjayaabadi atau subscribe newsletter untuk info promo terbaru. Cek juga halaman <a href="' . route('products') . '" class="text-blue-500 underline">Produk</a> untuk produk dengan harga spesial!';
        }
        
        // Greeting
        if (str_contains($message, 'hai') || str_contains($message, 'halo') || str_contains($message, 'hello') || str_contains($message, 'hi')) {
            return '👋 Halo! Senang bisa membantu Anda. Ada yang ingin ditanyakan tentang produk atau layanan kami?';
        }
        
        // Thank you
        if (str_contains($message, 'terima kasih') || str_contains($message, 'thanks') || str_contains($message, 'thank you')) {
            return '😊 Sama-sama! Senang bisa membantu. Jangan ragu untuk bertanya lagi jika ada yang ingin ditanyakan. Selamat berbelanja!';
        }
        
        // Default response
        return '� Maaf, saya kurang paham. Topik yang bisa saya bantu:

📦 Produk • 💰 Harga • 🛒 Order
💳 Pembayaran • 🚚 Pengiriman
📞 Kontak • 🕐 Jam Buka

WhatsApp: 081234567890';
    }

    public function clearChat()
    {
        $this->messages = [
            [
                'type' => 'bot',
                'message' => '🔄 Chat direset. Ada yang bisa saya bantu?',
                'time' => now()->format('H:i')
            ]
        ];
        
        $this->conversationContext = [];
    }

    public function render()
    {
        return view('livewire.chatbot');
    }
}
