<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilePage extends Component
{
    use WithFileUploads;

    #[Title('Profil Saya - Munir Jaya Abadi')]

    // User data
    public $name;
    public $email;
    public $phone;
    public $avatar;
    
    // Password change
    public $current_password = '';
    public $new_password = '';
    public $new_password_confirmation = '';
    
    // Messages
    public $successMessage = '';
    public $errorMessage = '';
    public $passwordSuccessMessage = '';
    public $passwordErrorMessage = '';

    // Statistics
    public $totalOrders = 0;
    public $totalSpent = 0;
    public $completedOrders = 0;
    public $pendingOrders = 0;

    protected $rules = [
        'name' => 'required|min:3|max:100',
        'email' => 'required|email|max:100',
        'phone' => 'nullable|min:10|max:15',
        'avatar' => 'nullable|image|max:2048', // 2MB max
    ];

    protected $passwordRules = [
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ];

    public function mount()
    {
        $user = Auth::user();
        
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone ?? '';
        
        // Load statistics
        $this->loadStatistics();
    }

    public function loadStatistics()
    {
        $user = Auth::user();

        $this->totalOrders = $user->orders()->count();
        $this->totalSpent = $user->orders()
            ->where('payment_status', 'paid')
            ->sum('grand_total');
        $this->completedOrders = $user->orders()
            ->where('payment_status', 'paid')
            ->where('status', 'delivered')
            ->count();
        $this->pendingOrders = $user->orders()
            ->whereIn('status', ['new', 'processing', 'shipped'])
            ->count();
    }

    public function updateProfile()
    {
        $this->validate();

        try {
            $user = Auth::user();
            
            // Handle avatar upload
            if ($this->avatar && is_object($this->avatar)) {
                // Delete old avatar if exists
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
                
                // Store new avatar
                $avatarPath = $this->avatar->store('avatars', 'public');
                $user->avatar = $avatarPath;
            }
            
            // Update user data
            $user->name = $this->name;
            $user->email = $this->email;
            $user->phone = $this->phone;
            
            $user->save();
            
            $this->successMessage = 'Profil berhasil diperbarui!';
            $this->errorMessage = '';
            
            // Reset avatar input
            $this->reset('avatar');
            
            // Reload user to show new avatar
            $this->mount();
            
        } catch (\Exception $e) {
            $this->errorMessage = 'Gagal memperbarui profil: ' . $e->getMessage();
            $this->successMessage = '';
            
            \Illuminate\Support\Facades\Log::error('Profile update error', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function updatePassword()
    {
        $this->validate($this->passwordRules, [
            'current_password.required' => 'Password saat ini wajib diisi',
            'new_password.required' => 'Password baru wajib diisi',
            'new_password.min' => 'Password minimal 8 karakter',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        try {
            $user = Auth::user();
            
            // Verify current password
            if (!Hash::check($this->current_password, $user->password)) {
                $this->passwordErrorMessage = 'Password saat ini tidak sesuai.';
                $this->passwordSuccessMessage = '';
                return;
            }
            
            // Update password
            $user->password = Hash::make($this->new_password);
            User::save();
            
            $this->passwordSuccessMessage = 'Password berhasil diubah!';
            $this->passwordErrorMessage = '';
            
            // Reset password fields
            $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
            
        } catch (\Exception $e) {
            $this->passwordErrorMessage = 'Gagal mengubah password. Silakan coba lagi.';
            $this->passwordSuccessMessage = '';
            
            \Illuminate\Support\Facades\Log::error('Password update error', [
                'error' => $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.profile-page');
    }
}
