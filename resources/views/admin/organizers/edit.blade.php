@extends('layouts.admin')

@section('title', 'Edit Organizer')
@section('page_title', 'Edit Organizer')
@section('page_subtitle', 'Mengubah data organizer')

@section('content')

<div class="max-w-3xl">

    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8">

        <form
            action="{{ route('admin.organizers.update',$organizer) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="space-y-6">

                <div>

                    <label class="block font-bold mb-2">
                        Nama Organizer
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name',$organizer->name) }}"
                        class="w-full border border-slate-200 rounded-2xl px-5 py-3">

                </div>


                <div>

                    <label class="block font-bold mb-2">
                        Deskripsi
                    </label>

                    <textarea
                        rows="5"
                        name="description"
                        class="w-full border border-slate-200 rounded-2xl px-5 py-3">{{ old('description',$organizer->description) }}</textarea>

                </div>


                @if($organizer->logo)

                <div>

                    <p class="font-bold mb-2">
                        Logo Saat Ini
                    </p>

                    <img
                        src="{{ asset('storage/'.$organizer->logo) }}"
                        class="w-28 h-28 rounded-2xl object-cover border">

                </div>

                @endif


                <div>

                    <label class="block font-bold mb-2">
                        Ganti Logo
                    </label>

                    <input
                        type="file"
                        name="logo"
                        accept="image/*"
                        class="block w-full rounded-xl border border-slate-200 p-3">

                </div>


                <div class="flex gap-3 pt-4">

                    <button
                        class="px-8 py-3 bg-indigo-600 text-white rounded-2xl font-bold">

                        Update Organizer

                    </button>

                    <a
                        href="{{ route('admin.organizers.index') }}"
                        class="px-8 py-3 bg-slate-200 rounded-2xl font-bold">

                        Batal

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection