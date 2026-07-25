@extends('layouts.app')

@section('title','Tambah Pengurus')

@section('content')

<div class="container mx-auto py-10">

    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8">

        <h1 class="text-3xl font-bold mb-8">
            Tambah Pengurus
        </h1>

        <form action="{{ route('admin.pengurus.store') }}" method="POST">

            @csrf

            <div class="mb-5">
                <label class="block mb-2 font-semibold">
                    Jabatan
                </label>

                <select
                    name="jabatan_id"
                    class="w-full border rounded-lg p-3"
                    required>

                    <option value="">-- Pilih Jabatan --</option>

                    @foreach($jabatans as $jabatan)

                        <option
                            value="{{ $jabatan->id }}"
                            {{ old('jabatan_id')==$jabatan->id ? 'selected':'' }}>

                            {{ $jabatan->name }}

                        </option>

                    @endforeach

                </select>

                @error('jabatan_id')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">

                <label class="block mb-2 font-semibold">
                    Nama Pengurus
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full border rounded-lg p-3"
                    required>

                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <div class="mb-5">

                <label class="block mb-2 font-semibold">
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="w-full border rounded-lg p-3"
                    required>{{ old('description') }}</textarea>

                @error('description')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <div class="mb-6">

                <label class="block mb-2 font-semibold">
                    Salary
                </label>

                <input
                    type="number"
                    name="salary"
                    value="{{ old('salary') }}"
                    class="w-full border rounded-lg p-3"
                    required>

                @error('salary')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <div class="flex gap-3">

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                    Simpan

                </button>

                <a
                    href="{{ route('admin.pengurus.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 px-6 py-3 rounded-lg">

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

@endsection