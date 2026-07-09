@extends('layouts.app')

@section('title','Pembayaran Berhasil')

@section('content')

<div class="container mx-auto py-20">

    <div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-xl p-10 text-center">

        <div class="text-6xl mb-6">
            ✅
        </div>

        <h1 class="text-4xl font-black text-green-600 mb-3">
            Pembayaran Berhasil
        </h1>

        <p class="text-slate-500 mb-10">
            Terima kasih telah melakukan pemesanan tiket.
        </p>

        <div class="border rounded-2xl p-6 text-left">

            <div class="flex justify-between py-2">
                <span>Order ID</span>
                <strong>{{ $transaction->order_id }}</strong>
            </div>

            <div class="flex justify-between py-2">
                <span>Nama</span>
                <strong>{{ $transaction->customer_name }}</strong>
            </div>

            <div class="flex justify-between py-2">
                <span>Email</span>
                <strong>{{ $transaction->customer_email }}</strong>
            </div>

            <div class="flex justify-between py-2">
                <span>No HP</span>
                <strong>{{ $transaction->customer_phone }}</strong>
            </div>

            <div class="flex justify-between py-2">
                <span>Total</span>
                <strong>
                    Rp {{ number_format($transaction->total_price,0,',','.') }}
                </strong>
            </div>

            <div class="flex justify-between py-2">
                <span>Status</span>

                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-lg font-bold">
                    {{ strtoupper($transaction->status) }}
                </span>

            </div>

        </div>

        <a href="{{ route('home') }}"
            class="inline-block mt-8 bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-bold">

            Kembali ke Beranda

        </a>

    </div>

</div>

@endsection