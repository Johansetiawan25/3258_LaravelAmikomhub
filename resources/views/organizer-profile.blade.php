@extends('layouts.detail')

@section('content')

<div class="max-w-6xl mx-auto px-6 py-12">

    {{-- HEADER --}}
    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8">

        <div class="flex flex-col md:flex-row gap-8 items-center">

            {{-- Logo --}}
            @if($organizer->logo)

            <img src="{{ asset('storage/'.$organizer->logo) }}"
                class="w-32 h-32 rounded-3xl object-cover border shadow">

            @else

            <div class="w-32 h-32 rounded-3xl bg-indigo-100 flex items-center justify-center text-5xl font-black text-indigo-700">

                {{ strtoupper(substr($organizer->name,0,2)) }}

            </div>

            @endif


            <div class="flex-1">

                <h1 class="text-4xl font-black text-slate-800">

                    {{ $organizer->name }}

                </h1>

                <p class="mt-4 text-slate-500 leading-relaxed">

                    {{ $organizer->description }}

                </p>

                <div class="flex items-center gap-3 mt-6">

                    <span class="text-3xl font-black text-yellow-500">

                        ⭐ {{ number_format($averageRating ?? 0,1) }}

                    </span>

                    <span class="text-slate-500">

                        ({{ $totalReviews }} Review)

                    </span>

                    <span class="ml-3 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-sm font-bold">

                        ✔ Verified Organizer

                    </span>

                </div>

            </div>

        </div>

    </div>



    {{-- FORM REVIEW --}}
    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8 mt-10">

        <h2 class="text-2xl font-black mb-6">

            Berikan Review Organizer

        </h2>

        @if(session('success'))

        <div class="bg-green-100 text-green-700 rounded-xl p-4 mb-6">

            {{ session('success') }}

        </div>

        @endif

        @if(session('error'))

        <div class="bg-red-100 text-red-700 rounded-xl p-4 mb-6">

            {{ session('error') }}

        </div>

        @endif


        @if($transaction && !$hasReviewed)

        <form method="POST"
            action="{{ route('reviews.store',$organizer) }}"
            class="space-y-6">

            @csrf

            <input type="hidden"
                name="transaction_id"
                value="{{ $transaction->id }}">


            <div>

                <label class="font-bold">

                    Rating

                </label>

                <select
                    name="rating"
                    class="mt-2 w-full rounded-xl border-slate-200">

                    <option value="5">⭐⭐⭐⭐⭐ Sangat Baik</option>
                    <option value="4">⭐⭐⭐⭐ Baik</option>
                    <option value="3">⭐⭐⭐ Cukup</option>
                    <option value="2">⭐⭐ Kurang</option>
                    <option value="1">⭐ Buruk</option>

                </select>

            </div>


            <div>

                <label class="font-bold">

                    Ceritakan pengalamanmu

                </label>

                <textarea
                    name="review"
                    rows="5"
                    class="mt-2 w-full rounded-xl border-slate-200"
                    placeholder="Bagaimana pengalamanmu mengikuti event dari organizer ini?"></textarea>

            </div>

            <button
                class="px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold">

                Kirim Review

            </button>

        </form>

        @elseif($hasReviewed)

        <div class="bg-green-50 border border-green-200 rounded-xl p-5 text-green-700">

            ✅ Terima kasih, kamu sudah memberikan review untuk organizer ini.

        </div>

        @else

        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-5 text-yellow-700">

            Kamu harus membeli tiket dari organizer ini dan transaksi harus
            <strong>Success</strong> sebelum bisa memberikan review.

        </div>

        @endif

    </div>




    {{-- REVIEW LIST --}}
    <div class="mt-10">

        <h2 class="text-3xl font-black mb-8">

            Review Pengunjung

        </h2>

        @forelse($organizer->reviews as $review)

        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-7 mb-6">

            <div class="flex justify-between items-center">

                <div>

                    <h4 class="font-bold text-lg">

                        {{ $review->user->name }}

                    </h4>

                    <p class="text-slate-400 text-sm">

                        {{ $review->created_at->format('d M Y') }}

                    </p>

                </div>

                <div class="text-yellow-500 font-black text-lg">

                    ⭐ {{ $review->rating }}/5

                </div>

            </div>

            <p class="mt-5 text-slate-600 leading-relaxed">

                {{ $review->review }}

            </p>

        </div>

        @empty

        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-10 text-center">

            <div class="text-6xl mb-4">

                ⭐

            </div>

            <h3 class="text-xl font-bold">

                Belum Ada Review

            </h3>

            <p class="text-slate-500 mt-2">

                Jadilah orang pertama yang memberikan ulasan.

            </p>

        </div>

        @endforelse

    </div>

</div>

@endsection