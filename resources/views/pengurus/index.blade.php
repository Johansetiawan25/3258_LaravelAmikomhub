@extends('layouts.admin')

@section('title','Jelola Data Pengurus - Admin')
@section('page_title', 'Kelola Pengurus')
@section('page_subtitle', 'Membuat dan Mengatur Pengurus anda.')

@section('content')

<div class="container mx-auto py-10">

    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Data Pengurus
            </h1>

            <p class="text-slate-500 mt-1">
                Kelola seluruh data pengurus organisasi.
            </p>
        </div>

        <a href="{{ route('admin.pengurus.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-semibold shadow">

            + Tambah Pengurus

        </a>

    </div>

    @if(session('success'))

    <div class="mb-6 rounded-xl bg-green-100 border border-green-300 text-green-700 px-5 py-4">

        {{ session('success') }}

    </div>

    @endif

    <div class="overflow-hidden rounded-2xl shadow-xl border border-slate-200">

        <table class="min-w-full bg-white">

            <thead class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white">

                <tr>

                    <th class="px-6 py-4 text-center w-20">
                        No
                    </th>

                    <th class="px-6 py-4">
                        Jabatan
                    </th>

                    <th class="px-6 py-4">
                        Nama Pengurus
                    </th>

                    <th class="px-6 py-4">
                        Deskripsi
                    </th>

                    <th class="px-6 py-4 text-right">
                        Gaji
                    </th>

                    <th class="px-6 py-4 text-center w-56">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-slate-200">

                @forelse($pengurus as $item)

                <tr class="hover:bg-indigo-50 transition duration-200">

                    <td class="px-6 py-5 text-center font-semibold">

                        {{ $loop->iteration }}

                    </td>

                    <td class="px-6 py-5">

                        @php

                        $color = match(strtoupper($item->jabatan->name)) {

                        'KETUA' => 'bg-red-100 text-red-700',

                        'SEKRETARIS' => 'bg-blue-100 text-blue-700',

                        'BENDAHARA' => 'bg-green-100 text-green-700',

                        'MANAGER' => 'bg-purple-100 text-purple-700',

                        default => 'bg-slate-100 text-slate-700',

                        };

                        @endphp

                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold {{ $color }}">

                            {{ strtoupper($item->jabatan->name) }}

                        </span>

                    </td>

                    <td class="px-6 py-5 font-semibold text-slate-800">

                        {{ $item->name }}

                    </td>

                    <td class="px-6 py-5 text-slate-600">

                        {{ $item->description }}

                    </td>

                    <td class="px-6 py-5 text-right">

                        <span class="font-bold text-green-600">

                            Rp {{ number_format($item->salary,0,',','.') }}

                        </span>

                    </td>

                    <td class="px-6 py-5">

                        <div class="flex justify-center gap-3">

                            <a href="{{ route('admin.pengurus.edit',$item->id) }}"
                                class="bg-amber-400 hover:bg-amber-500 text-white px-4 py-2 rounded-lg font-semibold shadow">

                                Edit

                            </a>

                            <form action="{{ route('admin.pengurus.destroy',$item->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Yakin ingin menghapus data pengurus ini?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold shadow">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="text-center py-12 text-slate-500">

                        Belum ada data pengurus.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection