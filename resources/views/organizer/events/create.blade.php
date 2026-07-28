@extends('layouts.organizer')

@section('title', 'Tambah Event')
@section('page_title', 'Tambah Event')
@section('page_subtitle', 'Buat event baru sebagai organizer.')

@section('content')

<div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm max-w-3xl">

    <form action="{{ route('organizer.events.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6">

        @csrf


        <!-- Judul -->
        <div>

            <label class="block text-sm font-bold mb-2">
                Judul Event
            </label>

            <input
                type="text"
                name="title"
                value="{{ old('title') }}"
                class="w-full px-5 py-4 bg-slate-50 rounded-2xl"
                required>

            @error('title')
            <span class="text-red-500 text-sm">
                {{ $message }}
            </span>
            @enderror

        </div>



        <!-- Kategori -->
        <div>

            <label class="block text-sm font-bold mb-2">
                Kategori
            </label>


            <select
                name="category_id"
                class="w-full px-5 py-4 bg-slate-50 rounded-2xl"
                required>


                <option value="">
                    Pilih Kategori
                </option>


                @foreach($categories as $category)

                <option
                    value="{{ $category->id }}"
                    {{ old('category_id') == $category->id ? 'selected':'' }}>

                    {{ $category->name }}

                </option>

                @endforeach


            </select>


            @error('category_id')
            <span class="text-red-500 text-sm">
                {{ $message }}
            </span>
            @enderror


        </div>




        <!-- Deskripsi -->

        <div>

            <label class="block text-sm font-bold mb-2">
                Deskripsi
            </label>


            <textarea
                name="description"
                rows="5"
                class="w-full px-5 py-4 bg-slate-50 rounded-2xl">{{ old('description') }}</textarea>


        </div>




        <!-- Tanggal & Lokasi -->

        <div class="grid md:grid-cols-2 gap-6">


            <div>

                <label class="block text-sm font-bold mb-2">
                    Tanggal Event
                </label>


                <input
                    type="datetime-local"
                    name="date"
                    value="{{ old('date') }}"
                    class="w-full px-5 py-4 bg-slate-50 rounded-2xl"
                    required>


                @error('date')
                <span class="text-red-500 text-sm">
                    {{ $message }}
                </span>
                @enderror


            </div>



            <div>

                <label class="block text-sm font-bold mb-2">
                    Lokasi
                </label>


                <input
                    type="text"
                    name="location"
                    value="{{ old('location') }}"
                    class="w-full px-5 py-4 bg-slate-50 rounded-2xl"
                    required>


                @error('location')
                <span class="text-red-500 text-sm">
                    {{ $message }}
                </span>
                @enderror


            </div>


        </div>





        <!-- Harga & Stock -->

        <div class="grid md:grid-cols-2 gap-6">


            <div>

                <label class="block text-sm font-bold mb-2">
                    Harga Tiket
                </label>


                <input
                    type="number"
                    name="price"
                    min="0"
                    value="{{ old('price',0) }}"
                    class="w-full px-5 py-4 bg-slate-50 rounded-2xl"
                    required>


                @error('price')
                <span class="text-red-500 text-sm">
                    {{ $message }}
                </span>
                @enderror


            </div>



            <div>

                <label class="block text-sm font-bold mb-2">
                    Stok Tiket
                </label>


                <input
                    type="number"
                    name="stock"
                    min="1"
                    value="{{ old('stock',1) }}"
                    class="w-full px-5 py-4 bg-slate-50 rounded-2xl"
                    required>


                @error('stock')
                <span class="text-red-500 text-sm">
                    {{ $message }}
                </span>
                @enderror


            </div>


        </div>






        <!-- Poster -->

        <div>

            <label class="block text-sm font-bold mb-2">
                Poster Event
            </label>


            <input
                type="file"
                name="poster"
                accept="image/*"
                class="w-full px-5 py-4 bg-slate-50 border rounded-2xl">


            <img id="preview"
                class="hidden mt-4 w-40 rounded-xl shadow">



            @error('poster')
            <span class="text-red-500 text-sm">
                {{ $message }}
            </span>
            @enderror


        </div>







        <!-- Tombol -->

        <div class="flex justify-between pt-4">


            <a href="{{ route('organizer.events.index') }}"
                class="px-6 py-3 bg-red-100 text-red-600 rounded-xl hover:bg-red-200">

                Batal

            </a>



            <button
                type="submit"
                class="px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">

                Simpan Event

            </button>



        </div>


    </form>

</div>



<script>
    document.querySelector('input[name="poster"]')
        .addEventListener('change', function(e) {

            let preview = document.getElementById('preview');

            preview.src = URL.createObjectURL(e.target.files[0]);

            preview.classList.remove('hidden');

        });
</script>


@endsection