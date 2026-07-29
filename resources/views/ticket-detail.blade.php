@extends('layouts.app')

@section('content')

@php
$isExpired = \Carbon\Carbon::parse($transaction->event->date)->isPast();
@endphp

<div class="max-w-md mx-auto py-10">

    <!-- Header -->
    <div class="text-center mb-8">

        <div
            class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-green-200">

            <svg class="w-10 h-10 text-green-600"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="3"
                    d="M5 13l4 4L19 7" />

            </svg>

        </div>

        <h1 class="text-3xl font-black text-slate-800">

            Detail Tiket

        </h1>

        <p class="text-slate-500 mt-2">

            Tunjukkan QR Code ini saat check-in event.

        </p>
        @if($isExpired)

        <div class="mt-6 bg-red-50 border border-red-200 rounded-2xl p-4">

            <div class="flex items-center gap-3">

                <svg class="w-7 h-7 text-red-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v3m0 4h.01M10.29 3.86L1.82 18A2 2 0 003.53 21h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />

                </svg>

                <div>

                    <p class="font-bold text-red-700">
                        Event Sudah Berakhir
                    </p>

                    <p class="text-sm text-red-600">
                        Event ini telah selesai dilaksanakan. Tiket hanya dapat digunakan sebagai arsip transaksi.
                    </p>

                </div>

            </div>

        </div>

        @endif

    </div>

    <!-- Ticket -->
    <div class="bg-white rounded-2xl overflow-hidden shadow-xl border border-slate-200">
        
        <!-- Header Ticket -->
        <div
            class="{{ $isExpired ? 'bg-red-50 border-red-200' : 'bg-indigo-50 border-indigo-100' }} border-b-4 border-dashed">

            @if($isExpired)

            <div class="flex justify-center mb-3">

                <span class="px-4 py-2 bg-red-100 text-red-600 rounded-full text-xs font-bold uppercase tracking-widest">
                    Event Selesai
                </span>

            </div>

            @else

            <div class="flex justify-center mb-3">

                <span class="px-4 py-2 bg-indigo-100 text-indigo-600 rounded-full text-xs font-bold uppercase tracking-widest">
                    E-Ticket Resmi
                </span>

            </div>

            @endif

            <h2 class="text-2xl font-black text-center leading-tight">
                {{ $transaction->event->title }}
            </h2>

            <div
                class="absolute -left-4 -bottom-4 w-8 h-8 bg-slate-50 rounded-full"></div>

            <div
                class="absolute -right-4 -bottom-4 w-8 h-8 bg-slate-50 rounded-full"></div>

        </div>

        <!-- Body -->
        <div class="p-8">

            <div class="grid grid-cols-2 gap-6">

                <div>

                    <p class="text-xs text-slate-400 uppercase font-bold">

                        Nama Pembeli

                    </p>

                    <p class="font-bold">

                        {{ $transaction->customer_name }}

                    </p>

                </div>

                <div>

                    <p class="text-xs text-slate-400 uppercase font-bold">

                        Organizer

                    </p>

                    <p class="font-bold">

                        {{ $transaction->event->organizer->name }}

                    </p>

                </div>

                <div>

                    <p class="text-xs text-slate-400 uppercase font-bold">

                        Tanggal

                    </p>

                    <p class="font-bold">

                        {{ $transaction->event->date->format('d M Y H:i') }}

                    </p>

                </div>

                <div>

                    <p class="text-xs text-slate-400 uppercase font-bold">

                        Lokasi

                    </p>

                    <p class="font-bold">

                        {{ $transaction->event->location }}

                    </p>

                </div>

                <div class="col-span-2">

                    <p class="text-xs text-slate-400 uppercase font-bold">

                        Order ID

                    </p>

                    <p class="font-bold break-all">

                        {{ $transaction->order_id }}

                    </p>

                </div>

            </div>

            <!-- QR -->
            <div class="mt-8 {{ $isExpired ? 'bg-red-50' : 'bg-slate-100' }} rounded-3xl p-6 flex flex-col items-center">

                <p class="text-xs uppercase text-slate-400 font-bold mb-4">

                    Scan QR saat Check-In

                </p>

                <div class="w-52 h-52 bg-white rounded-2xl shadow-inner flex items-center justify-center {{ $isExpired ? 'opacity-60 grayscale' : '' }}">
                    <!-- Dummy QR -->

                    <div class="w-40 h-40 border-4 border-slate-900 flex flex-wrap p-1">

                        @for($i=0;$i<16;$i++)

                            <div class="w-1/4 h-1/4 {{ $i%2==0 ? 'bg-slate-900':'' }}">
                    </div>

                    @endfor

                </div>

            </div>

            <p class="mt-5 font-mono font-bold">

                {{ $transaction->order_id }}

                @if($isExpired)

            <div class="mt-5 px-4 py-2 rounded-xl bg-red-100 text-red-700 font-bold">
                Event Telah Berakhir
            </div>

            @endif

            </p>

        </div>

    </div>

    <!-- Footer -->
    <div class="px-8 pb-8 space-y-3">

        <button
            onclick="window.print()"
            class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold transition">

            🖨 Cetak / Simpan PDF

        </button>

        @if(
        strtolower($transaction->status)=='success'
        && !$transaction->review
        )

        <a
            href="{{ route('organizer.show',$transaction->event->organizer) }}"
            class="block w-full text-center py-4 bg-yellow-400 hover:bg-yellow-500 rounded-2xl font-bold">

            ⭐ Beri Review Organizer

        </a>

        @elseif($transaction->review)

        <div
            class="w-full py-4 text-center rounded-2xl bg-green-100 text-green-700 font-bold">

            ✅ Anda sudah memberikan review

        </div>

        @endif

        <a
            href="{{ route('ticket') }}"
            class="block w-full text-center py-4 border border-slate-300 rounded-2xl font-bold hover:bg-slate-50">

            ← Kembali ke Daftar Tiket

        </a>

    </div>

</div>

</div>

@endsection