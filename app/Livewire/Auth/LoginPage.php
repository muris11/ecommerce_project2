<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\WithAlert;

#[Title('Masuk - Munir Jaya Abadi')]
class LoginPage extends Component
{
    use LivewireAlert, WithAlert;

    public $email;
    public $password;

    public function save() {
        $this->validate([
            'email' => 'required|email|max:255|exists:users,email',
            'password' => 'required|min:6|max:255',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.exists' => 'Email tidak terdaftar dalam sistem',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        if(!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
           $this->alertError('Email atau password salah. Silakan periksa kembali.');
           return;
        }

        $this->alertSuccess('Selamat datang, ' . Auth::user()->name . '!');
        
        return redirect()->intended();
    }

    
    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
