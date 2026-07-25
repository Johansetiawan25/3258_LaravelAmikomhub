<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class PengurusController extends Controller
{
    public function index()
    {
        $pengurus = Pengurus::with('jabatan')->latest()->get();

        return view('pengurus.index', compact('pengurus'));
    }

    public function create()
    {
        $jabatans = Jabatan::all();

        return view('pengurus.create', compact('jabatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan_id' => 'required',
            'name' => 'required|max:100',
            'description' => 'required|max:255',
            'salary' => 'required|numeric',
        ]);

        Pengurus::create([
            'jabatan_id' => $request->jabatan_id,
            'name' => $request->name,
            'description' => $request->description,
            'salary' => $request->salary,
            'created_by' => 'Admin',
            'updated_by' => 'Admin',
        ]);

        return redirect()->route('admin.pengurus.index')
            ->with('success', 'Data pengurus berhasil ditambahkan.');
    }

    public function edit(Pengurus $penguru)
    {
        $jabatans = Jabatan::all();

        return view('pengurus.edit', [
            'pengurus' => $penguru,
            'jabatans' => $jabatans,
        ]);
    }

    public function update(Request $request, Pengurus $penguru)
    {
        $request->validate([
            'jabatan_id' => 'required',
            'name' => 'required|max:100',
            'description' => 'required|max:255',
            'salary' => 'required|numeric',
        ]);

        $penguru->update([
            'jabatan_id' => $request->jabatan_id,
            'name' => $request->name,
            'description' => $request->description,
            'salary' => $request->salary,
            'updated_by' => 'Admin',
        ]);

        return redirect()->route('admin.pengurus.index')
            ->with('success', 'Data pengurus berhasil diperbarui.');
    }

    public function destroy(Pengurus $penguru)
    {
        $penguru->delete();

        return redirect()->route('admin.pengurus.index')
            ->with('success', 'Data pengurus berhasil dihapus.');
    }
}