@extends('layouts.admin')

@section('title', 'Tambah Organizer')
@section('page_title', 'Tambah Organizer')
@section('page_subtitle', 'Menambahkan penyelenggara event')

@section('content')

<div class="max-w-3xl">

    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8">

        <form action="{{ route('admin.organizers.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="space-y-6">

                <div>

                    <label class="block font-bold mb-2">
                        Nama Organizer
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full border border-slate-200 rounded-2xl px-5 py-3 focus:border-indigo-500 focus:outline-none">

                    @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror

                </div>


                <div>

                    <label class="block font-bold mb-2">
                        Deskripsi
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        class="w-full border border-slate-200 rounded-2xl px-5 py-3 focus:border-indigo-500 focus:outline-none">{{ old('description') }}</textarea>

                </div>


                <div>

                    <label class="block font-bold mb-2">
                        Logo Organizer
                    </label>

                    <input
                        type="file"
                        name="logo"
                        accept="image/*"
                        class="block w-full rounded-xl border border-slate-200 p-3">

                    @error('logo')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror

                </div>


                <div class="flex gap-3 pt-4">

                    <button
                        class="px-8 py-3 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition">

                        Simpan Organizer

                    </button>

                    <a href="{{ route('admin.organizers.index') }}"
                        class="px-8 py-3 bg-slate-200 rounded-2xl font-bold hover:bg-slate-300 transition">

                        Batal

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection