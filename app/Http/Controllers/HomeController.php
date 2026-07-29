<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Event;
use App\Models\Partner;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Tidak ada redirect admin atau organizer

        $categories = Category::all();
        $partners = Partner::latest()->get();

        $query = Event::with('category')
            ->orderByRaw("
        CASE
            WHEN date >= NOW() THEN 0
            ELSE 1
        END
    ")
            ->orderBy('date', 'asc');

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $events = $query->get();

        return view('welcome', compact(
            'events',
            'categories',
            'partners'
        ));
    }
}
