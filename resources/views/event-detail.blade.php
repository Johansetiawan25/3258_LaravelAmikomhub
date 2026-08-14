@extends('layouts.detail')

@section('content')

<main class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-3 gap-12">
    <!-- Left: Poster -->
    <div class="lg:col-span-1">
        <div class="sticky top-32">
            <img src="{{ ($event->poster_path && Storage::disk('public')->exists($event->poster_path))
                  ? asset('storage/' . $event->poster_path)
                  : 'https://placehold.co/200x600' }}"
                alt="{{ $event->title }}"
                class="w-full rounded-[2.5rem] shadow-2xl border-8 border-white object-cover aspect-[3/4]">
            <div class="mt-8 bg-white rounded-3xl border border-slate-100 shadow-sm p-6">

                <h4 class="font-bold text-lg mb-5">
                    Penyelenggara
                </h4>


                @if($event->organizer)

                <a href="{{ route('organizer.show', $event->organizer) }}"
                    class="flex items-center gap-4 hover:bg-slate-50 rounded-2xl p-3 transition">


                    {{-- Logo --}}
                    @if($event->organizer->logo)

                    <img
                        src="{{ asset('storage/'.$event->organizer->logo) }}"
                        class="w-16 h-16 rounded-2xl object-cover border">

                    @else

                    <div
                        class="w-16 h-16 rounded-2xl bg-indigo-100 flex items-center justify-center text-indigo-700 text-xl font-bold">

                        {{ strtoupper(substr($event->organizer->name,0,2)) }}

                    </div>

                    @endif



                    <div class="flex-1">

                        <h3 class="font-bold text-lg text-slate-800">
                            {{ $event->organizer->name }}
                        </h3>


                        <div class="flex items-center gap-2 mt-1">

                            <span class="text-yellow-500 font-bold">

                                ⭐ {{ number_format($event->organizer->reviews->avg('rating') ?? 0,1) }}

                            </span>


                            <span class="text-slate-500 text-sm">

                                ({{ $event->organizer->reviews->count() }} Review)

                            </span>

                        </div>


                        <p class="text-xs text-emerald-600 font-semibold mt-1">

                            ✔ Verified Organizer

                        </p>

                    </div>



                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-slate-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7" />

                    </svg>


                </a>


                @else


                {{-- Jika belum ada organizer --}}

                <div class="flex items-center gap-4 rounded-2xl p-3 bg-slate-50">

                    <div
                        class="w-16 h-16 rounded-2xl bg-slate-200 flex items-center justify-center text-slate-500 text-xl font-bold">

                        ?

                    </div>


                    <div>

                        <h3 class="font-bold text-lg text-slate-700">
                            Organizer belum tersedia
                        </h3>


                        <p class="text-sm text-slate-500 mt-1">
                            Informasi penyelenggara event ini belum ditambahkan.
                        </p>

                    </div>


                </div>


                @endif


            </div>
        </div>
    </div>



    <!-- Right: Details -->
    <div class="lg:col-span-2 space-y-12">
        <div class="space-y-4">
            <span
                class="px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">
                {{ $event->category->name }}
            </span>
            <h1 class="text-4xl md:text-5xl font-black leading-tight">
                {{ $event->title }}
            </h1>
            <div class="flex flex-wrap gap-6 text-slate-500 font-medium">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span>{{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>{{ $event->location }}</span>
                </div>
            </div>
        </div>

        <div class="prose prose-slate max-w-none">
            <h3 class="text-2xl font-bold mb-4">Deskripsi Event</h3>
            <p class="text-lg text-slate-600 leading-relaxed">
                {{ $event->description }}
            </p>
        </div>

        <div
            class="bg-indigo-600 rounded-[2.5rem] p-8 md:p-12 text-white shadow-2xl shadow-indigo-200 relative overflow-hidden">
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
                <div>

                    <p class="text-indigo-200 font-bold uppercase tracking-widest text-sm mb-2">
                        Harga Tiket
                    </p>

                    @if($event->price == 0)

                    <h2 class="text-5xl font-black text-green-300">
                        GRATIS
                    </h2>

                    <div class="mt-4 inline-flex items-center px-4 py-2 rounded-xl bg-green-500/20 border border-green-300 text-green-100 font-semibold">
                        🎉 Event Gratis - Tidak perlu pembayaran Midtrans
                    </div>

                    @else

                    <h2 class="text-5xl font-black">
                        Rp {{ number_format($event->price, 0, ',', '.') }}
                        <span class="text-lg font-medium text-indigo-200">
                            / orang
                        </span>
                    </h2>

                    @endif

                    <p class="mt-4 text-indigo-100 flex items-center gap-2">

                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>

                        Sisa stok :
                        <span class="font-bold underline">
                            {{ $event->stock }} Tiket lagi!
                        </span>

                    </p>

                </div>
                <div>
                    <a href="{{ route('checkout.create', $event->id) }}"
                        class="inline-block px-10 py-5 bg-white text-indigo-600 rounded-2xl font-black text-xl hover:scale-105 transition-transform shadow-xl">
                        Pesan Sekarang
                    </a>
                </div>
            </div>
            <!-- Decoration -->
            <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-white opacity-10 rounded-full"></div>
            <div class="absolute -left-10 -top-10 w-32 h-32 bg-indigo-400 opacity-20 rounded-full"></div>
        </div>

        <div class="space-y-4">
            <h3 class="text-xl font-bold">Kebijakan Tiket</h3>
            <ul class="space-y-3 text-slate-500">
                <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-green-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                        </path>
                    </svg>
                    E-Ticket akan dikirimkan otomatis setelah pembayaran berhasil.
                </li>
                <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-green-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                        </path>
                    </svg>
                    Tiket dapat discan di pintu masuk (Check-in).
                </li>
                <li class="flex items-start gap-2 text-rose-500">
                    <svg class="w-5 h-5 text-rose-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Tiket yang sudah dibeli tidak dapat direfund.
                </li>
            </ul>
        </div>
    </div>
</main>

<!-- ========================= -->
<!-- Ulasan & Penilaian -->
<!-- ========================= -->

<section class="max-w-7xl mx-auto px-6 mt-20">

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">

        <div class="flex justify-between items-center mb-8">

            <h2 class="text-2xl font-black">
                Ulasan & Penilaian
            </h2>

            @guest
            <a href="{{ route('login') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl font-bold">
                Login untuk Review
            </a>
            @endguest

        </div>

        <div class="grid lg:grid-cols-3 gap-8">

            {{-- Rating Besar --}}
            <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-3xl text-white p-8 text-center">

                <h1 class="text-6xl font-black">

                    {{ number_format($averageRating,1) }}

                </h1>

                <div class="text-yellow-300 text-xl mt-3">

                    ⭐⭐⭐⭐⭐

                </div>

                <p class="mt-4">

                    {{ $totalReviews }} Ulasan

                </p>

            </div>


            {{-- Progress Bar --}}
            <div class="lg:col-span-2 space-y-5">

                @foreach([5,4,3,2,1] as $star)

                @php
                $count = ${'rating'.$star};
                $percent = $totalReviews ? ($count/$totalReviews)*100 : 0;
                @endphp

                <div class="flex items-center gap-4">

                    <span class="font-bold w-8">

                        {{ $star }}★

                    </span>

                    <div class="flex-1 h-3 rounded-full bg-slate-200">

                        <div
                            class="h-3 rounded-full bg-indigo-600"
                            style="width: {{ $percent }}%">

                        </div>

                    </div>

                    <span class="text-slate-500 w-6 text-right">

                        {{ $count }}

                    </span>

                </div>

                @endforeach

            </div>

        </div>

        <hr class="my-10">

        @forelse($event->reviews as $review)

        <div class="bg-slate-50 rounded-2xl p-6 mb-5">

            <div class="flex justify-between">

                <div>

                    <h3 class="font-bold">

                        {{ $review->user->name }}

                    </h3>

                    <small class="text-slate-400">

                        {{ $review->created_at->format('d M Y') }}

                    </small>

                </div>

                <span class="text-yellow-500 font-bold">

                    ⭐ {{ $review->rating }}/5

                </span>

            </div>

            <p class="mt-4 text-slate-600">

                {{ $review->review }}

            </p>

        </div>

        @empty

        <div class="bg-slate-50 rounded-3xl p-16 text-center">

            <svg class="w-16 h-16 mx-auto text-slate-300 mb-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M8 10h.01M12 10h.01M16 10h.01M9 16h6M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4-.8L3 20l1.1-3.3A7.944 7.944 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />

            </svg>

            <h3 class="text-xl font-bold text-slate-700">

                Belum ada ulasan

            </h3>

            <p class="text-slate-500 mt-2">

                Jadilah yang pertama memberikan ulasan untuk acara ini.

            </p>

        </div>

        @endforelse

    </div>

</section>


@endsection