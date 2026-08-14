<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('category')
            ->where(
                'organizer_id',
                Auth::guard('organizer')->id()
            )
            ->latest()
            ->paginate(10);

        return view('organizer.events.index', compact('events'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('organizer.events.create', compact(
            'categories'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required',
            'description' => 'nullable',
            'date' => 'required|date',
            'location' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'poster' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('poster')) {
            $data['poster_path'] =
                $request->file('poster')->store('posters', 'public');
        }

        $data['organizer_id'] =
            Auth::guard('organizer')->id();

        Event::create($data);

        return redirect()
            ->route('organizer.events.index')
            ->with('success', 'Event berhasil dibuat');
    }

    public function edit(Event $event)
    {
        abort_if(
            $event->organizer_id != Auth::guard('organizer')->id(),
            403
        );

        $categories = Category::all();

        return view(
            'organizer.events.edit',
            compact('event', 'categories')
        );
    }

    public function update(Request $request, Event $event)
    {
        abort_if(
            $event->organizer_id != Auth::guard('organizer')->id(),
            403
        );

        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required',
            'description' => 'nullable',
            'date' => 'required|date',
            'location' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'poster' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('poster')) {

            if ($event->poster_path) {
                Storage::disk('public')
                    ->delete($event->poster_path);
            }

            $data['poster_path'] =
                $request->file('poster')->store('posters', 'public');
        }

        $event->update($data);

        return redirect()
            ->route('organizer.events.index')
            ->with('success', 'Event berhasil diupdate');
    }

    public function destroy(Event $event)
    {
        abort_if(
            $event->organizer_id != Auth::guard('organizer')->id(),
            403
        );

        if ($event->poster_path) {
            Storage::disk('public')
                ->delete($event->poster_path);
        }

        $event->delete();

        return redirect()
            ->route('organizer.events.index')
            ->with('success', 'Event berhasil dihapus');
    }
}
