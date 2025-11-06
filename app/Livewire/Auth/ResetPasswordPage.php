<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Url;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\WithAlert;

#[Title('Atur Ulang Password - Munir Jaya Abadi')]
class ResetPasswordPage extends Component
{
    use LivewireAlert, WithAlert;

    public $token;
    #[Url]
    public $email;
    public $password;
    public $password_confirmation;

    public function mount($token) {
        $this->token = $token;
    }

    public function save() {
        $this->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password baru harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $status = Password::reset([
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'token' => $this->token
        ],
        function(User $user, string $password) {
            $password = $this->password;
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
            $user->save();
            event(new PasswordReset($user));
        }
    );
    
    if ($status === Password::PASSWORD_RESET) {
        $this->alertSuccess('Password berhasil diubah! Silakan login dengan password baru Anda.');
        return redirect()->route('login');
    } else {
        $this->alertError('Gagal mengubah password. Link mungkin sudah kadaluarsa atau tidak valid.');
        return;
    }
        
    }

    public function render()
    {
        return view('livewire.auth.reset-password-page');
    }
}
