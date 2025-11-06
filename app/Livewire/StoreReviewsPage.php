<?php

namespace App\Livewire;

use App\Models\StoreReview;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Auth;
use App\Traits\WithAlert;

#[Title('Penilaian Pelanggan')]
class StoreReviewsPage extends Component
{
    use WithPagination, LivewireAlert, WithAlert;

    public $rating = 5;
    public $review = '';

    public function submitReview()
    {
        if (!Auth::check()) {
            $this->alertError('Anda harus login untuk memberikan ulasan');
            return redirect()->route('login');
        }

        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|min:20',
        ], [
            'rating.required' => 'Rating harus diisi',
            'rating.min' => 'Rating minimal 1 bintang',
            'rating.max' => 'Rating maksimal 5 bintang',
            'review.required' => 'Ulasan harus diisi',
            'review.min' => 'Ulasan harus minimal 20 karakter'
        ]);

        StoreReview::create([
            'user_id' => Auth::id(),
            'rating' => $this->rating,
            'review' => $this->review,
            'is_published' => true,
        ]);

        $this->alertSuccess('Terima kasih! Ulasan Anda berhasil dikirim dan sangat berharga bagi kami.');

        $this->rating = 5;
        $this->review = '';
    }

    public function render()
    {
        $reviews = StoreReview::where('is_published', true)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $averageRating = StoreReview::where('is_published', true)->avg('rating');
        $totalReviews = StoreReview::where('is_published', true)->count();

        return view('livewire.store-reviews-page', [
            'reviews' => $reviews,
            'averageRating' => $averageRating ? round($averageRating, 1) : 0,
            'totalReviews' => $totalReviews,
        ]);
    }
}
