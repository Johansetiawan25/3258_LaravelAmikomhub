<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;

class PageController extends Controller
{
    public function categories()
    {
        $categories = Category::withCount('events')->get();

        return view('pages.categories', compact('categories'));
    }

    public function about()
    {
        return view('pages.about');
    }
}