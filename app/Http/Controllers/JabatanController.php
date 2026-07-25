<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatans = Jabatan::latest()->get();

        return view('jabatan.index', compact('jabatans'));
    }

    public function create()
    {
        return view('jabatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);

        Jabatan::create([
            'name'       => $request->name,
            'created_by' => 'Admin',
            'updated_by' => 'Admin',
        ]);

        return redirect()->route('admin.jabatan.index')
            ->with('success', 'Data jabatan berhasil ditambahkan.');
    }

    public function edit(Jabatan $jabatan)
    {
        return view('jabatan.edit', compact('jabatan'));
    }

    public function update(Request $request, Jabatan $jabatan)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);

        $jabatan->update([
            'name'       => $request->name,
            'updated_by' => 'Admin',
        ]);

        return redirect()->route('admin.jabatan.index')
            ->with('success', 'Data jabatan berhasil diperbarui.');
    }

    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();

        return redirect()->route('admin.jabatan.index')
            ->with('success', 'Data jabatan berhasil dihapus.');
    }
}