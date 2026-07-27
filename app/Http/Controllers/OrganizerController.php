<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use App\Models\Transaction;

class OrganizerController extends Controller
{
    public function show(Organizer $organizer)
    {
        // Load review beserta user yang memberikan review
        $organizer->load([
            'reviews.user',
            'events.category'
        ]);

        // Statistik review
        $averageRating = $organizer->reviews()->avg('rating');
        $totalReviews = $organizer->reviews()->count();

        $transaction = null;
        $hasReviewed = false;

        if (auth()->check()) {

            // Ambil transaksi sukses milik user untuk organizer ini
            $transaction = Transaction::where('user_id', auth()->id())
                ->whereHas('event', function ($query) use ($organizer) {
                    $query->where('organizer_id', $organizer->id);
                })
                ->where('status', 'success')
                ->latest()
                ->first();

            // Cek apakah transaksi tersebut sudah memiliki review
            if ($transaction) {
                $hasReviewed = $transaction->review()->exists();
            }
        }

        return view('organizer-profile', compact(
            'organizer',
            'averageRating',
            'totalReviews',
            'transaction',
            'hasReviewed'
        ));
    }
}
