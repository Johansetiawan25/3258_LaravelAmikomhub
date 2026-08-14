@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto py-12">

    <div class="mb-10">

        <h1 class="text-4xl font-black">
            Tiket Saya
        </h1>

        <p class="text-slate-500 mt-2">
            Semua tiket yang telah berhasil dibeli.
        </p>

    </div>

    @forelse($transactions as $transaction)

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 mb-6">

        <div class="flex justify-between items-center">

            <div class="flex gap-5">

                <img
                    src="{{ asset('storage/'.$transaction->event->poster_path) }}"
                    class="w-28 h-36 rounded-2xl object-cover">

                <div>

                    <h2 class="text-2xl font-black">

                        {{ $transaction->event->title }}

                    </h2>

                    <p class="text-slate-500 mt-2">

                        {{ $transaction->event->date->format('d M Y H:i') }}

                    </p>

                    <p class="text-slate-500">

                        {{ $transaction->event->location }}

                    </p>

                    <div class="mt-4">

                        <span
                            class="px-3 py-2 rounded-full bg-green-100 text-green-700 font-bold">

                            {{ strtoupper($transaction->status) }}

                        </span>

                    </div>

                </div>

            </div>

            <div class="text-right">

                <p class="text-slate-500 text-sm">

                    Order ID

                </p>

                <p class="font-bold">

                    {{ $transaction->order_id }}

                </p>

                <p class="mt-4 text-2xl font-black text-indigo-600">

                    Rp {{ number_format($transaction->total_price,0,',','.') }}

                </p>

                <a href="{{ route('ticket.detail',$transaction) }}"
                    class="mt-6 inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-bold">

                    Lihat Tiket

                </a>

            </div>

        </div>

    </div>

    @empty

    <div class="bg-white rounded-3xl p-16 text-center">

        <h2 class="text-2xl font-bold">

            Belum ada tiket.

        </h2>

        <a href="{{ route('home') }}"
            class="mt-6 inline-block bg-indigo-600 text-white px-6 py-3 rounded-xl">

            Cari Event

        </a>

    </div>

    @endforelse

</div>

@endsection