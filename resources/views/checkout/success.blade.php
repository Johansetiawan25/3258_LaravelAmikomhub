@extends('layouts.app')

@section('title', 'Pembayaran Berhasil')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-slate-50 px-4">

    <div class="w-full max-w-md bg-white rounded-[30px] shadow-xl p-10 text-center border border-slate-100">

        <!-- Icon -->
        <div class="w-24 h-24 mx-auto rounded-full bg-green-100 flex items-center justify-center mb-8">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-12 h-12 text-green-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="3">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M5 13l4 4L19 7" />

            </svg>

        </div>

        <!-- Title -->
        <h1 class="text-4xl font-black text-slate-800 mb-5">
            Terima Kasih!
        </h1>

        <!-- Description -->
        <p class="text-slate-500 leading-7 text-[16px]">

            Pembayaran untuk pesanan
            <strong>{{ $transaction->order_id }}</strong>

            @if(strtolower($transaction->status) == 'pending')

                sedang diproses.

            @else

                telah berhasil.

            @endif

            <br><br>

            <strong>E-Ticket akan dikirim ke email</strong>

            <br>

            <span class="font-semibold text-slate-700">
                {{ $transaction->customer_email }}
            </span>

            <br>

            setelah pembayaran berhasil terkonfirmasi.

        </p>

        <!-- Status -->
        <div class="mt-8">

            @php
                $status = strtolower($transaction->status);
            @endphp

            @if($status == 'success' || $status == 'settlement')

                <span class="inline-flex px-5 py-2 rounded-full bg-green-100 text-green-700 font-bold">
                    SUCCESS
                </span>

            @elseif($status == 'pending')

                <span class="inline-flex px-5 py-2 rounded-full bg-yellow-100 text-yellow-700 font-bold">
                    PENDING
                </span>

            @else

                <span class="inline-flex px-5 py-2 rounded-full bg-red-100 text-red-700 font-bold">
                    {{ strtoupper($transaction->status) }}
                </span>

            @endif

        </div>

        <!-- Button -->
        <a href="{{ route('home') }}"
            class="inline-flex justify-center items-center w-full mt-10 bg-indigo-600 hover:bg-indigo-700 transition-all duration-300 text-white font-bold py-4 rounded-2xl shadow-lg">

            Kembali ke Beranda

        </a>

    </div>

</div>

@endsection