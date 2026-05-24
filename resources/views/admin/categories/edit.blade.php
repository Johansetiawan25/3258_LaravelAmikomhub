@extends('layouts.admin')

@section('title', 'Edit Categories - Admin')
@section('page_title', 'Edit Categories')
@section('page_subtitle', 'Edit detail Categories.')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">Edit Kategori</h1>

    <form action="{{ route('admin.categories.update', $category->id) }}"
        method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-2 font-semibold">Nama Kategori</label>

            <input type="text"
                name="name"
                value="{{ old('name', $category->name) }}"
                class="w-full border rounded-xl px-4 py-3"
                required>
        </div>

        <button type="submit"
            class="bg-indigo-600 text-white px-6 py-3 rounded-xl">
            Update
        </button>

    </form>
</div>
@endsection