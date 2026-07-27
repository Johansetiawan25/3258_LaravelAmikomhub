<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use App\Models\Transaction;


class EventController extends Controller
{
    public function show(Event $event)
    {
        $event->load([
            'organizer.reviews',
            'reviews.user'
        ]);

        $categories = Category::all();

        // Statistik review event
        $averageRating = round($event->reviews->avg('rating') ?? 0, 1);

        $totalReviews = $event->reviews->count();

        $rating5 = $event->reviews->where('rating', 5)->count();
        $rating4 = $event->reviews->where('rating', 4)->count();
        $rating3 = $event->reviews->where('rating', 3)->count();
        $rating2 = $event->reviews->where('rating', 2)->count();
        $rating1 = $event->reviews->where('rating', 1)->count();

        return view('event-detail', compact(
            'categories',
            'event',
            'averageRating',
            'totalReviews',
            'rating5',
            'rating4',
            'rating3',
            'rating2',
            'rating1'
        ));
    }


    public function checkout()
    {
        return view('checkout');
    }

    public function ticket()
    {
        $transactions = Transaction::with([
            'event.organizer',
            'review'
        ])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('ticket', compact('transactions'));
    }

    public function indexAdmin()
    {
        return view('admin.events'); // halaman admin event list
    }

    public function ticketDetail(Transaction $transaction)
    {
        abort_if($transaction->user_id != auth()->id(), 403);

        $transaction->load([
            'event.organizer',
            'review'
        ]);

        return view('ticket-detail', compact('transaction'));
    }
}
