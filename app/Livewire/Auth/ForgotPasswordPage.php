<?php

namespace App\Livewire\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Password;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\WithAlert;

#[Title('Lupa Password')]
class ForgotPasswordPage extends Component
{
    use LivewireAlert, WithAlert;

    public $email;
    
    public function save() {
        $this->validate([
            'email' => 'required|email|max:255|exists:users,email',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.exists' => 'Email tidak terdaftar dalam sistem',
        ]);

        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            $this->alertSuccess('Link reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam.');
            $this->email = '';
        } else {
            $this->alertError('Gagal mengirim link reset password. Pastikan email Anda terdaftar.');
        }
    }
    public function render()
    {
        return view('livewire.auth.forgot-password-page');
    }
}
