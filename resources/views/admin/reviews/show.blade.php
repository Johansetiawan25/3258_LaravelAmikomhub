@extends('layouts.admin')

@section('title', 'Detail Review')
@section('page_title', 'Detail Review')
@section('page_subtitle', 'Informasi lengkap review pengguna.')

@section('content')

<div class="max-w-4xl bg-white rounded-3xl border border-slate-100 shadow-sm p-8">


    <!-- Header -->

    <div class="flex justify-between items-start mb-8">


        <div>

            <h2 class="text-2xl font-bold text-slate-800">
                Detail Review
            </h2>


            <p class="text-sm text-slate-500 mt-1">
                Review dari pengguna terhadap organizer
            </p>


        </div>


        <a href="{{ route('admin.reviews.index') }}"
            class="px-5 py-3 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition font-semibold">

            Kembali

        </a>


    </div>




    <!-- User -->

    <div class="grid md:grid-cols-2 gap-6">


        <div class="bg-slate-50 rounded-2xl p-5">


            <p class="text-xs uppercase text-slate-500 font-bold tracking-wide">
                Pengguna
            </p>


            <p class="mt-2 font-bold text-lg text-slate-800">

                {{ $review->user->name ?? '-' }}

            </p>


            <p class="text-sm text-slate-500">

                {{ $review->user->email ?? '-' }}

            </p>


        </div>





        <!-- Organizer -->

        <div class="bg-slate-50 rounded-2xl p-5">


            <p class="text-xs uppercase text-slate-500 font-bold tracking-wide">
                Organizer
            </p>


            <p class="mt-2 font-bold text-lg text-slate-800">

                {{ $review->organizer->name ?? '-' }}

            </p>


        </div>


    </div>





    <!-- Event -->

    <div class="mt-6 bg-slate-50 rounded-2xl p-5">


        <p class="text-xs uppercase text-slate-500 font-bold tracking-wide">
            Event
        </p>


        <p class="mt-2 text-lg font-bold text-slate-800">

            {{ $review->transaction->event->title ?? '-' }}

        </p>


    </div>





    <!-- Rating -->

    <div class="mt-6">


        <p class="text-xs uppercase text-slate-500 font-bold tracking-wide">
            Rating
        </p>


        <div class="mt-3">

            <span class="inline-flex items-center bg-yellow-100 text-yellow-700 px-5 py-2 rounded-full font-bold text-lg">

                ⭐ {{ $review->rating }}/5

            </span>


        </div>


    </div>





    <!-- Review -->

    <div class="mt-6">


        <p class="text-xs uppercase text-slate-500 font-bold tracking-wide">
            Isi Review
        </p>


        <div class="mt-3 bg-slate-50 rounded-2xl p-5 text-slate-700 leading-relaxed">


            {{ $review->review }}


        </div>


    </div>





    <!-- Tanggal -->

    <div class="mt-6 text-sm text-slate-500">


        Dibuat pada:

        <span class="font-semibold text-slate-700">

            {{ $review->created_at->format('d F Y H:i') }}

        </span>


    </div>



</div>


@endsection