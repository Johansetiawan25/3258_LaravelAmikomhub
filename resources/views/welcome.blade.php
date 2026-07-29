@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-10 md:py-20 flex flex-col-reverse md:flex-row items-center gap-8 md:gap-12 overflow-x-hidden md:overflow-visible">
    <div class="flex-1 space-y-6 md:space-y-8 mt-4 md:mt-0">
        <span
            class="inline-block px-3 py-1 md:px-4 md:py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-xs md:text-sm font-bold uppercase tracking-wider">#1
            Event Platform</span>
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold leading-tight">
            Temukan & Pesan <span class="text-indigo-600">Tiket Event</span> Impianmu.
        </h1>
        <p class="text-sm md:text-lg text-slate-500 max-w-lg leading-relaxed">
            Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan aman & cepat dengan
            Midtrans.
        </p>
        <div class="flex flex-col sm:flex-row gap-3 md:gap-4">
            <a href="#events"
                class="px-6 py-3 md:px-8 md:py-4 bg-indigo-600 text-white rounded-xl md:rounded-2xl font-bold text-base md:text-lg shadow-xl shadow-indigo-200 hover:scale-105 transition-transform text-center">
                Mulai Jelajah
            </a>
            <a href="#"
                class="px-6 py-3 md:px-8 md:py-4 border-2 border-slate-200 rounded-xl md:rounded-2xl font-bold text-base md:text-lg hover:border-indigo-600 hover:text-indigo-600 transition text-center">
                Cara Pesan
            </a>
        </div>
    </div>
    <div class="flex-1 relative w-full">
        <!-- Blob background diperkecil di mobile -->
        <div
            class="absolute -top-6 -left-6 md:-top-10 md:-left-10 w-48 h-48 md:w-64 md:h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
        </div>
        <div
            class="absolute -bottom-6 -right-6 md:-bottom-10 md:-right-10 w-48 h-48 md:w-64 md:h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
        </div>

        <img src="assets/concert.png" alt="Concert"
            class="rounded-[1.5rem] md:rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">

        <!-- Card melayang disesuaikan posisinya di mobile agar tidak keluar layar -->
        <div class="absolute bottom-4 left-4 right-4 md:right-auto md:-bottom-6 md:-left-6 glass p-4 md:p-6 rounded-xl md:rounded-2xl shadow-xl z-20 border border-white bg-white/80 backdrop-blur-md">
            <div class="flex items-center gap-3 md:gap-4">
                <div class="w-10 h-10 md:w-12 md:h-12 flex-shrink-0 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                    <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] md:text-xs text-slate-500 font-bold uppercase">Terverifikasi</p>
                    <p class="font-bold text-sm md:text-base leading-tight">Pembayaran Aman via Midtrans</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Partner Section -->
<section class="relative py-16 md:py-24 overflow-hidden bg-gradient-to-b from-slate-50 via-white to-slate-100">

    <!-- Top Glow -->
    <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-r from-indigo-400/10 via-purple-400/10 to-pink-400/10 blur-3xl">
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6">

        <!-- Heading -->
        <div class="text-center mb-10 md:mb-16">
            <span
                class="inline-block px-3 py-1.5 md:px-4 md:py-2 bg-indigo-100 text-indigo-700 rounded-full text-xs md:text-sm font-bold uppercase tracking-widest mb-3 md:mb-4">
                Official Partner
            </span>
            <h2 class="text-3xl md:text-5xl font-black text-slate-900 leading-tight mb-4">
                Didukung Oleh <span class="text-indigo-600">Partner Terbaik</span>
            </h2>
            <p class="text-slate-500 text-sm md:text-lg max-w-2xl mx-auto leading-relaxed">
                Berbagai brand, komunitas, dan perusahaan terpercaya ikut mendukung pengalaman event terbaik di AmikomEventHub.
            </p>
        </div>

        <!-- Partner Grid -->
        <!-- Ubah padding dan tinggi agar logo tidak terjepit di HP -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-8">
            @foreach($partners as $partner)
            <div
                class="group relative bg-white/80 backdrop-blur-xl border border-white/50 rounded-xl md:rounded-[2rem] p-4 sm:p-6 md:p-10 min-h-[100px] md:min-h-[190px] flex items-center justify-center shadow-md hover:shadow-2xl hover:-translate-y-1 md:hover:-translate-y-2 transition-all duration-500 overflow-hidden">

                <!-- Glow Effect -->
                <div
                    class="absolute inset-0 bg-gradient-to-br from-indigo-500/0 via-transparent to-purple-500/0 group-hover:from-indigo-500/10 group-hover:to-purple-500/10 transition duration-500">
                </div>

                <!-- Logo dinamis sizenya -->
                <img src="{{ asset('storage/' . $partner->logo_url) }}"
                    alt="{{ $partner->name }}"
                    class="relative z-10 h-10 sm:h-14 md:h-24 object-contain grayscale group-hover:grayscale-0 transition duration-500">
            </div>
            @endforeach
        </div>

    </div>
</section>

<!-- Events Grid -->
<section id="events" class="max-w-7xl mx-auto px-4 sm:px-6 py-16 md:py-20">
    <div class="relative mb-10 md:mb-16 overflow-hidden rounded-2xl md:rounded-[2rem] bg-white border border-slate-100 shadow-sm p-6 md:p-10">

        <!-- Blue Blur Background -->
        <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-r from-indigo-400/10 via-blue-400/10 to-purple-400/10 blur-3xl">
        </div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 md:gap-8">

            <!-- Text -->
            <div>
                <span
                    class="inline-block px-3 py-1.5 md:px-4 md:py-2 bg-indigo-100 text-indigo-700 rounded-full text-xs font-bold uppercase tracking-widest mb-3 md:mb-4">
                    Upcoming Events
                </span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-2 md:mb-3">
                    Event <span class="text-indigo-600">Terdekat</span>
                </h2>
                <p class="text-slate-500 text-sm md:text-lg leading-relaxed max-w-2xl">
                    Temukan konser, seminar, workshop, dan berbagai acara menarik yang sedang berlangsung minggu ini.
                </p>
            </div>

            <!-- Filter (Scrollable on very small screens or wrapped) -->
            <div class="flex flex-wrap gap-2 md:gap-3">
                <!-- Semua -->
                <a href="/"
                    class="px-4 py-2 md:px-5 md:py-3 rounded-xl md:rounded-2xl font-semibold text-xs md:text-sm transition-all duration-300
                {{ request('category') == '' || !request()->has('category') 
                    ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-200' 
                    : 'bg-white border border-indigo-100 text-indigo-600 hover:bg-indigo-600 hover:text-white' }}">
                    Semua
                </a>

                @foreach($categories as $cat)
                <a href="/?category={{ $cat->slug }}"
                    class="px-4 py-2 md:px-5 md:py-3 rounded-xl md:rounded-2xl font-semibold text-xs md:text-sm transition-all duration-300
                {{ request('category') == $cat->slug 
                    ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-200'
                    : 'bg-white border border-indigo-100 text-indigo-600 hover:bg-indigo-600 hover:text-white' }}">
                    {{ $cat->name }}
                </a>
                @endforeach
            </div>

        </div>
    </div>

    <!-- Zona Menampilkan Grid List Event -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        @foreach($events as $event)
        @php
        $isExpired = \Carbon\Carbon::parse($event->date)->isPast();
        @endphp
        <div class="group rounded-2xl md:rounded-3xl border shadow-sm overflow-hidden flex flex-col transition-all duration-300 {{ $isExpired
    ? 'bg-slate-100 border-slate-300 opacity-90'
    : 'bg-white border-slate-100 hover:shadow-2xl'
    }}">
            <div class="relative overflow-hidden aspect-[3/4]">

                <img src="{{ ($event->poster_path && Storage::disk('public')->exists($event->poster_path)) ? asset('storage/' . $event->poster_path) : 'https://placehold.co/200x600' }}"
                    alt="{{ $event->title }}"
                    class="w-full h-full object-cover {{ $isExpired ? 'grayscale' : 'group-hover:scale-110' }} transition duration-500">

                <div class="absolute top-3 left-3 md:top-4 md:left-4 px-2 py-1 md:px-3 md:py-1 bg-white/90 backdrop-blur rounded-lg text-[10px] md:text-xs font-bold uppercase text-indigo-600">
                    {{ $event->category->name }}
                </div>

                @if($isExpired)

                <div class="absolute top-3 right-3 md:top-4 md:right-4 bg-red-600 text-white px-3 py-1 rounded-lg text-[10px] md:text-xs font-bold uppercase shadow-lg">
                    EVENT SELESAI
                </div>

                @elseif($event->price == 0)

                <div class="absolute top-3 right-3 md:top-4 md:right-4 bg-green-500 text-white px-3 py-1 rounded-lg text-[10px] md:text-xs font-bold uppercase shadow-lg">
                    GRATIS
                </div>

                @endif

            </div>
            <div class="p-4 md:p-6 flex flex-col flex-1">
                <h3 class="text-lg md:text-xl font-bold mb-2 {{ $isExpired ? 'text-slate-500' : 'group-hover:text-indigo-600' }} transition">{{ $event->title }}</h3>
                <div class="flex items-center gap-2 text-slate-500 text-xs md:text-sm mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ \Carbon\Carbon::parse($event->date)->format('d-m-Y H:i') }}</span>
                </div>

                <!-- Spacer to push footer to bottom if titles vary in length -->
                <div class="mt-auto pt-4 border-t flex justify-between items-center">
                    <div>
                        @if($isExpired)

                        <div>
                            <span class="text-lg font-black text-red-600">
                                Event Berakhir
                            </span>

                            <p class="text-xs text-slate-500 mt-1">
                                Tiket sudah tidak tersedia
                            </p>
                        </div>

                        @elseif($event->price == 0)

                        <div>
                            <span class="text-lg md:text-2xl font-black text-green-600">
                                GRATIS
                            </span>

                            <p class="text-xs text-green-500 mt-1">
                                Tanpa biaya
                            </p>
                        </div>

                        @else

                        <div>
                            <span class="text-lg md:text-2xl font-black text-indigo-600">
                                Rp {{ number_format($event->price,0,',','.') }}
                            </span>
                        </div>

                        @endif
                    </div>
                    <a href="{{ route('events.show', $event->id) }}"
                        class="px-4 py-2 rounded-xl text-sm font-bold transition
{{ $isExpired
    ? 'bg-slate-300 text-slate-700 hover:bg-slate-400'
    : 'bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white'
}}">
                        Detail Event
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection