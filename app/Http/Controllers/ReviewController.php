<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Organizer $organizer)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        $transaction = Transaction::with('event')
            ->findOrFail($request->transaction_id);

        // Harus milik user yang login
        if ($transaction->user_id != auth()->id()) {
            abort(403);
        }

        // Harus status success
        if ($transaction->status != 'success') {
            return back()->with('error', 'Pembayaran belum berhasil.');
        }

        // Harus organizer yang sama
        if ($transaction->event->organizer_id != $organizer->id) {
            abort(403);
        }

        // Tidak boleh review dua kali
        if (Review::where('transaction_id', $transaction->id)->exists()) {

            return back()->with(
                'error',
                'Anda sudah memberikan review.'
            );
        }

        Review::create([

            'user_id' => auth()->id(),

            'organizer_id' => $organizer->id,

            'transaction_id' => $transaction->id,

            'rating' => $request->rating,

            'review' => $request->review,

        ]);

        return redirect()
            ->route('organizer.show', $organizer)
            ->with('success', 'Review berhasil dikirim.');
    }
}
