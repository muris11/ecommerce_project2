<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\ContactMessage;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactPage extends Component
{
    #[Title('Hubungi Kami - Munir Jaya Abadi')]

    public $name = '';
    public $email = '';
    public $phone = '';
    public $subject = '';
    public $message = '';
    
    public $successMessage = '';
    public $errorMessage = '';

    protected $rules = [
        'name' => 'required|min:3|max:100',
        'email' => 'required|email|max:100',
        'phone' => 'required|min:10|max:15',
        'subject' => 'required|min:5|max:200',
        'message' => 'required|min:10|max:1000',
    ];

    protected $messages = [
        'name.required' => 'Nama wajib diisi',
        'name.min' => 'Nama minimal 3 karakter',
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Format email tidak valid',
        'phone.required' => 'Nomor telepon wajib diisi',
        'phone.min' => 'Nomor telepon minimal 10 digit',
        'subject.required' => 'Subjek wajib diisi',
        'subject.min' => 'Subjek minimal 5 karakter',
        'message.required' => 'Pesan wajib diisi',
        'message.min' => 'Pesan minimal 10 karakter',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitContact()
    {
        $this->validate();

        try {
            // 1. Simpan ke database
            $contactMessage = ContactMessage::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'subject' => $this->subject,
                'message' => $this->message,
                'status' => 'new',
            ]);

            // 2. Siapkan data untuk email
            $contactData = [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'subject' => $this->subject,
                'message' => $this->message,
            ];

            // 3. Kirim email ke admin
            $adminEmail = config('mail.admin_email', 'rifqysaputra1102@gmail.com');
            Mail::to($adminEmail)->send(new ContactFormMail($contactData));

            // 4. Success message
            $this->successMessage = 'Terima kasih! Pesan Anda telah terkirim dan email notifikasi sudah dikirim ke admin. Tim kami akan segera menghubungi Anda.';
            $this->errorMessage = '';
            
            // Log success
            Log::info('Contact form submitted and email sent', [
                'id' => $contactMessage->id,
                'name' => $this->name,
                'email' => $this->email,
                'admin_email' => $adminEmail,
            ]);

            // Reset form
            $this->reset(['name', 'email', 'phone', 'subject', 'message']);
            
        } catch (\Exception $e) {
            $this->errorMessage = 'Maaf, terjadi kesalahan saat mengirim pesan: ' . $e->getMessage();
            $this->successMessage = '';
            
            Log::error('Contact form error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.contact-page');
    }
}
