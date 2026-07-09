@extends('layouts.app')

@section('title','Pembayaran')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-blue-100 py-16">

    <div class="max-w-5xl mx-auto grid lg:grid-cols-2 gap-10 items-center">

        <!-- Kiri -->
        <div>

            <span class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-full text-sm font-bold">
                Secure Payment
            </span>

            <h1 class="text-5xl font-black mt-6 leading-tight">
                Selesaikan
                <span class="text-indigo-600">Pembayaran</span>
            </h1>

            <p class="text-slate-500 mt-5 text-lg">
                Tiket akan otomatis dikirim setelah pembayaran berhasil diverifikasi oleh Midtrans.
            </p>

            <div class="mt-10 space-y-5">

                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center">
                        ✅
                    </div>

                    <div>
                        <p class="font-bold">100% Aman</p>
                        <p class="text-slate-500 text-sm">
                            Diproses oleh Midtrans Payment Gateway
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center">
                        💳
                    </div>

                    <div>
                        <p class="font-bold">Banyak Metode Pembayaran</p>
                        <p class="text-slate-500 text-sm">
                            VA, QRIS, GoPay, ShopeePay, Kartu Kredit
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center">
                        ⚡
                    </div>

                    <div>
                        <p class="font-bold">Instan</p>
                        <p class="text-slate-500 text-sm">
                            Pembayaran langsung diproses otomatis.
                        </p>
                    </div>
                </div>

            </div>

        </div>

        <!-- Kanan -->
        <div class="bg-white rounded-[35px] shadow-2xl p-10 border border-slate-100">

            <div class="flex justify-between items-center">

                <h2 class="text-2xl font-black">
                    Ringkasan Pesanan
                </h2>

                <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-bold">
                    ORDER
                </span>

            </div>

            <div class="mt-8 space-y-5">

                <div class="flex justify-between">
                    <span class="text-slate-500">Order ID</span>
                    <span class="font-bold">{{ $transaction->order_id }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Nama</span>
                    <span class="font-bold">{{ $transaction->customer_name }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Email</span>
                    <span class="font-bold">{{ $transaction->customer_email }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">No HP</span>
                    <span class="font-bold">{{ $transaction->customer_phone }}</span>
                </div>

                <hr>

                <div class="flex justify-between items-center">

                    <span class="text-lg font-bold">
                        Total Pembayaran
                    </span>

                    <span class="text-4xl font-black text-indigo-600">
                        Rp {{ number_format($transaction->total_price,0,',','.') }}
                    </span>

                </div>

            </div>

            <button id="pay-button"
                class="w-full mt-10 py-5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 transition text-white text-lg font-bold shadow-lg">

                💳 Bayar Sekarang

            </button>

            <p class="text-center text-xs text-slate-400 mt-6">
                Dengan menekan tombol di atas, pembayaran akan diproses menggunakan Midtrans Sandbox.
            </p>

        </div>

    </div>

</div>

@endsection


@section('scripts')

<script
    type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
</script>

<script>
    document.getElementById('pay-button').onclick = function() {

        snap.pay("{{ $transaction->snap_token }}", {

            onSuccess: function(result) {

                window.location.href = "{{ route('checkout.success',$transaction->order_id) }}";

            },

            onPending: function(result) {

                window.location.href = "{{ route('checkout.success',$transaction->order_id) }}";

            },

            onError: function(result) {

                alert("Pembayaran gagal.");

            },

            onClose: function() {

                alert("Anda menutup popup pembayaran.");

            }

        });

    };
</script>

@endsection