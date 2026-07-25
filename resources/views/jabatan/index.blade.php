@extends('layouts.admin')

@section('title','Kelola Data Jabatan - Admin')
@section('page_title', 'Kelola Jabatan')
@section('page_subtitle', 'Membuat dan Mengatur Jabatan anda.')

@section('content')

<div class="container mx-auto py-10">

    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Data Jabatan
            </h1>

            <p class="text-slate-500 mt-1">
                Kelola seluruh data jabatan organisasi.
            </p>
        </div>

        <a href="{{ route('admin.jabatan.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-semibold shadow">

            + Tambah Jabatan

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

                    <th class="px-6 py-4 text-left">
                        Nama Jabatan
                    </th>

                    <th class="px-6 py-4 text-center w-56">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-slate-200">

                @forelse($jabatans as $jabatan)

                <tr class="hover:bg-indigo-50 transition duration-200">

                    <td class="px-6 py-5 text-center font-semibold">

                        {{ $loop->iteration }}

                    </td>

                    <td class="px-6 py-5">

                        @php

                        $color = match(strtoupper($jabatan->name)) {

                        'KETUA' => 'bg-red-100 text-red-700',

                        'SEKRETARIS' => 'bg-blue-100 text-blue-700',

                        'BENDAHARA' => 'bg-green-100 text-green-700',

                        'MANAGER' => 'bg-purple-100 text-purple-700',

                        default => 'bg-slate-100 text-slate-700',

                        };

                        @endphp

                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold {{ $color }}">

                            {{ strtoupper($jabatan->name) }}

                        </span>

                    </td>

                    <td class="px-6 py-5">

                        <div class="flex justify-center gap-3">

                            <a href="{{ route('admin.jabatan.edit',$jabatan->id) }}"
                                class="bg-amber-400 hover:bg-amber-500 text-white px-4 py-2 rounded-lg font-semibold shadow">

                                Edit

                            </a>

                            <form
                                action="{{ route('admin.jabatan.destroy',$jabatan->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Yakin ingin menghapus jabatan ini?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold shadow">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="3" class="text-center py-12 text-slate-500">

                        Belum ada data jabatan.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection