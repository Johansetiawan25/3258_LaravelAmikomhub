<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganizerController extends Controller
{
    public function index()
    {
        $organizers = Organizer::latest()->paginate(10);

        return view('admin.organizers.index', compact('organizers'));
    }

    public function create()
    {
        return view('admin.organizers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'logo' => 'nullable|image|max:2048',
        ]);

        $logo = null;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('organizers', 'public');
        }

        Organizer::create([
            'name' => $request->name,
            'description' => $request->description,
            'logo' => $logo,
        ]);

        return redirect()
            ->route('admin.organizers.index')
            ->with('success', 'Organizer berhasil ditambahkan.');
    }

    public function show(Organizer $organizer)
    {
        return redirect()->route('admin.organizers.index');
    }

    public function edit(Organizer $organizer)
    {
        return view('admin.organizers.edit', compact('organizer'));
    }

    public function update(Request $request, Organizer $organizer)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'logo' => 'nullable|image|max:2048',
        ]);

        $logo = $organizer->logo;

        if ($request->hasFile('logo')) {

            if ($organizer->logo && Storage::disk('public')->exists($organizer->logo)) {
                Storage::disk('public')->delete($organizer->logo);
            }

            $logo = $request->file('logo')->store('organizers', 'public');
        }

        $organizer->update([
            'name' => $request->name,
            'description' => $request->description,
            'logo' => $logo,
        ]);

        return redirect()
            ->route('admin.organizers.index')
            ->with('success', 'Organizer berhasil diperbarui.');
    }

    public function approve(Organizer $organizer)
    {
        $organizer->update([
            'status' => 'approved'
        ]);

        return redirect()
            ->route('admin.organizers.index')
            ->with('success', 'Organizer berhasil disetujui.');
    }
    public function reject(Organizer $organizer)
    {
        $organizer->update([
            'status' => 'rejected'
        ]);


        return redirect()
            ->route('admin.organizers.index')
            ->with(
                'success',
                'Organizer ditolak.'
            );
    }

    public function destroy(Organizer $organizer)
    {
        if ($organizer->logo && Storage::disk('public')->exists($organizer->logo)) {
            Storage::disk('public')->delete($organizer->logo);
        }

        $organizer->delete();

        return redirect()
            ->route('admin.organizers.index')
            ->with('success', 'Organizer berhasil dihapus.');
    }
}
