<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\WithAlert;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class Footer extends Component
{
    use LivewireAlert, WithAlert;

    public $newsletterEmail = '';

    public function subscribe()
    {
        $validated = $this->validate([
            'newsletterEmail' => ['required', 'string', 'email', 'max:255'],
        ], [
            'newsletterEmail.required' => 'Email wajib diisi.',
            'newsletterEmail.email' => 'Format email tidak valid.',
            'newsletterEmail.max' => 'Email terlalu panjang.',
        ]);

        try {
            // Implementasi penyimpanan bisa ditambahkan di sini (DB / service pihak ketiga)
            // Untuk saat ini, kita hanya log agar non-intrusif.
            Log::info('[Newsletter] New subscriber', ['email' => $validated['newsletterEmail']]);

            $this->reset('newsletterEmail');
            $this->alertSuccess('Terima kasih! Anda berhasil berlangganan newsletter.');
        } catch (\Throwable $e) {
            Log::error('[Newsletter] Subscribe failed: ' . $e->getMessage());
            $this->alertError('Maaf, terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.partials.footer');
    }
}
