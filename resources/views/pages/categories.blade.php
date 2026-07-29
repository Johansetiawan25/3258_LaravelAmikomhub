@extends('layouts.app')

@section('title','Kategori Event')

@section('content')

<section class="max-w-7xl mx-auto px-6 py-20">

    <h1 class="text-5xl font-black text-slate-800 mb-3">
        Kategori Event
    </h1>

    <p class="text-slate-500 mb-12">
        Temukan berbagai kategori event sesuai minat Anda.
    </p>

    <div class="grid md:grid-cols-3 gap-8">

        @foreach($categories as $category)

        <a href="{{ route('home',['category'=>$category->slug]) }}"
            class="bg-white rounded-3xl shadow hover:shadow-xl transition p-8 border">

            <div class="w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center mb-6">

                📂

            </div>

            <h2 class="text-2xl font-bold mb-2">

                {{ $category->name }}

            </h2>

            <p class="text-slate-500">

                {{ $category->events_count }} Event

            </p>

        </a>

        @endforeach

    </div>

</section>

@endsection