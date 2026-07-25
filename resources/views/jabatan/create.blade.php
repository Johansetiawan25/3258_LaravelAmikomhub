@extends('layouts.app')

@section('title','Tambah Jabatan')

@section('content')

<div class="container mx-auto py-10">

    <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow">

        <h1 class="text-2xl font-bold mb-6">
            Tambah Jabatan
        </h1>

        <form action="{{ route('admin.jabatan.store') }}" method="POST">

            @csrf

            <div class="mb-5">

                <label class="block font-semibold mb-2">
                    Nama Jabatan
                </label>

                <input
                    type="text"
                    name="name"
                    class="w-full border rounded-lg p-3"
                    required>

            </div>

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                Simpan

            </button>

            <a href="{{ route('admin.jabatan.index') }}"
                class="ml-3">

                Kembali

            </a>

        </form>

    </div>

</div>

@endsection