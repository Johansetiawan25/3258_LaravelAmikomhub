@extends('layouts.admin')

@section('content')
<div class="p-6 w-full">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800">Manajemen Kategori</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola kategori event yang tersedia</p>
        </div>
        <button class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Kategori
        </button>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden w-full">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="text-left px-6 py-4 font-bold text-slate-600">No</th>
                    <th class="text-left px-6 py-4 font-bold text-slate-600">Nama Kategori</th>
                    <th class="text-left px-6 py-4 font-bold text-slate-600">Slug</th>
                    <th class="text-left px-6 py-4 font-bold text-slate-600">Jumlah Event</th>
                    <th class="text-left px-6 py-4 font-bold text-slate-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">

                {{-- Data dummy --}}
                @php
                $categories = [
                ['id' => 1, 'name' => 'Seminar', 'slug' => 'seminar', 'total' => 5],
                ['id' => 2, 'name' => 'Konser', 'slug' => 'konser', 'total' => 3],
                ['id' => 3, 'name' => 'Workshop', 'slug' => 'workshop', 'total' => 8],
                ['id' => 4, 'name' => 'Hackathon','slug' => 'hackathon','total' => 2],
                ];
                @endphp

                @foreach($categories as $category)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4 text-slate-400">{{ $category['id'] }}</td>
                    <td class="px-6 py-4 font-semibold text-slate-800">
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-lg">
                            {{ $category['name'] }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-slate-500 font-mono text-xs">{{ $category['slug'] }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ $category['total'] }} event</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            {{-- Tombol Edit --}}
                            <button class="px-3 py-1.5 bg-amber-50 text-amber-600 rounded-lg font-bold text-xs hover:bg-amber-100 transition flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </button>
                            {{-- Tombol Hapus --}}
                            <button class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg font-bold text-xs hover:bg-red-100 transition flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection