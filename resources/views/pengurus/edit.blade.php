@extends('layouts.app')

@section('title','Edit Pengurus')

@section('content')

<div class="container mx-auto py-10">

    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8">

        <h1 class="text-3xl font-bold mb-8">
            Edit Pengurus
        </h1>

        <form action="{{ route('admin.pengurus.update',$pengurus->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-5">

                <label class="block mb-2 font-semibold">
                    Jabatan
                </label>

                <select
                    name="jabatan_id"
                    class="w-full border rounded-lg p-3"
                    required>

                    @foreach($jabatans as $jabatan)

                        <option
                            value="{{ $jabatan->id }}"
                            {{ $pengurus->jabatan_id==$jabatan->id ? 'selected':'' }}>

                            {{ $jabatan->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-5">

                <label class="block mb-2 font-semibold">
                    Nama Pengurus
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name',$pengurus->name) }}"
                    class="w-full border rounded-lg p-3">

            </div>

            <div class="mb-5">

                <label class="block mb-2 font-semibold">
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="w-full border rounded-lg p-3">{{ old('description',$pengurus->description) }}</textarea>

            </div>

            <div class="mb-6">

                <label class="block mb-2 font-semibold">
                    Salary
                </label>

                <input
                    type="number"
                    name="salary"
                    value="{{ old('salary',$pengurus->salary) }}"
                    class="w-full border rounded-lg p-3">

            </div>

            <div class="flex gap-3">

                <button
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg">

                    Update

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