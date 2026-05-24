@extends('layouts.admin')

@section('title', 'Partner')
@section('page_title', 'Manajemen Partner')
@section('page_subtitle', 'Kelola data partner AmikomEventHub')

@section('content')

<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">

    <!-- Header -->
    <div class="p-6 flex justify-between items-center border-b border-slate-100">

        <div>
            <h2 class="text-xl font-black text-slate-800">
                Data Partner
            </h2>
            <p class="text-sm text-slate-500">
                Daftar partner yang bekerja sama
            </p>
        </div>

        <a href="{{ route('admin.partners.create') }}"
            class="px-5 py-3 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition">
            + Tambah Partner
        </a>

    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm">

            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left font-bold text-slate-500">No</th>
                    <th class="px-6 py-4 text-left font-bold text-slate-500">Logo</th>
                    <th class="px-6 py-4 text-left font-bold text-slate-500">Nama Partner</th>
                    <th class="px-6 py-4 text-left font-bold text-slate-500">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse($partners as $index => $partner)

                <tr class="hover:bg-slate-50 transition">

                    <td class="px-6 py-4">
                        {{ $index + 1 }}
                    </td>

                    <td class="px-6 py-4">
                        <img src="{{ asset('storage/' . $partner->logo_url) }}"
                            class="w-14 h-14 rounded-xl object-cover border">
                    </td>

                    <td class="px-6 py-4 font-semibold text-slate-700">
                        {{ $partner->name }}
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex gap-2">

                            <!-- Edit -->
                            <a href="{{ route('admin.partners.edit', $partner->id) }}"
                                class="px-4 py-2 bg-amber-100 text-amber-700 rounded-xl text-xs font-bold hover:bg-amber-200 transition">
                                Edit
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('admin.partners.destroy', $partner->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    onclick="return confirm('Yakin hapus partner ini?')"
                                    class="px-4 py-2 bg-red-100 text-red-700 rounded-xl text-xs font-bold hover:bg-red-200 transition">
                                    Hapus
                                </button>

                            </form>

                        </div>
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="4" class="text-center py-10 text-slate-400">
                        Belum ada data partner
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>
    </div>

</div>

@endsection