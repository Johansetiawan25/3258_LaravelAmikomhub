@extends('layouts.admin')

@section('title', 'Laporan Transaksi - Admin')
@section('page_title', 'Laporan Transaksi')
@section('page_subtitle', 'Pantau arus kas dan penjualan tiket Anda.')

@section('content')

<div class="bg-white rounded-3xl border border-slate-100 shadow-lg overflow-hidden">

    {{-- HEADER --}}
    <div class="px-8 py-7 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-xl font-bold">Laporan Transaksi</h1>
                <p class="text-sm text-white/80">Monitoring semua transaksi tiket secara real-time</p>
            </div>
        </div>
    </div>

    <div class="px-8 py-8">

        {{-- 📊 CARD STAT --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

            <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white p-6 rounded-2xl shadow">
                <p class="text-xs opacity-80">Total Transaksi</p>
                <h2 class="text-3xl font-bold mt-2">{{ $totalTransactions }}</h2>
            </div>

            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 text-white p-6 rounded-2xl shadow">
                <p class="text-xs opacity-80">Pendapatan</p>
                <h2 class="text-2xl font-bold mt-2">
                    Rp {{ number_format($totalRevenue,0,',','.') }}
                </h2>
            </div>

            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-2xl shadow">
                <p class="text-xs opacity-80">Success</p>
                <h2 class="text-3xl font-bold mt-2">{{ $success }}</h2>
            </div>

            <div class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white p-6 rounded-2xl shadow">
                <p class="text-xs opacity-80">Pending</p>
                <h2 class="text-3xl font-bold mt-2">{{ $pending }}</h2>
            </div>

        </div>

        {{-- 🔎 FILTER --}}
        <form method="GET" class="mb-8">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-5">

                <input type="text" name="search"
                    value="{{ request('search') }}"
                    placeholder="Search order / nama / email"
                    class="px-4 py-2.5 rounded-xl border">

                <select name="event" class="px-4 py-2.5 rounded-xl border">
                    <option value="">Semua Event</option>
                    @foreach($events as $event)
                    <option value="{{ $event->id }}" {{ request('event') == $event->id ? 'selected' : '' }}>
                        {{ $event->title }}
                    </option>
                    @endforeach
                </select>

                <select name="status" class="px-4 py-2.5 rounded-xl border">
                    <option value="">Semua Status</option>
                    <option value="success">Success</option>
                    <option value="pending">Pending</option>
                    <option value="failed">Failed</option>
                </select>

                <input type="date" name="date"
                    value="{{ request('date') }}"
                    class="px-4 py-2.5 rounded-xl border">

            </div>

            <div class="mt-5 flex gap-3">
                <button class="px-6 py-2.5 bg-indigo-600 text-white rounded-xl">Cari</button>
                <a href="{{ route('admin.transactions.index') }}"
                    class="px-6 py-2.5 bg-slate-100 rounded-xl">Reset</a>
            </div>

        </form>

        {{-- 📊 TABLE --}}
        <div class="overflow-x-auto rounded-2xl">

            <table class="min-w-full">

                <thead class="bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-600 text-white uppercase tracking-wider text-xs font-semibold">
                    <tr>
                        <th class="px-10 py-5 rounded-tl-2xl">Order ID</th>
                        <th class="px-10 py-5">Customer</th>
                        <th class="px-10 py-5">Event</th>
                        <th class="px-10 py-5">Tanggal</th>
                        <th class="px-10 py-5">Status</th>
                        <th class="px-10 py-5 text-right rounded-tr-2xl">Total</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($transactions as $trx)

                    <tr class="hover:bg-indigo-50/30 transition-all duration-300">

                        <td class="px-10 py-6">
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-700">
                                #{{ $trx->order_id }}
                            </span>
                        </td>

                        <td class="px-10 py-6">
                            <p class="font-semibold text-slate-800">{{ $trx->customer_name }}</p>
                            <p class="text-xs text-slate-500">{{ $trx->customer_email }}</p>
                        </td>

                        <td class="px-10 py-6 text-slate-700 font-medium">
                            {{ $trx->event->title ?? '-' }}
                        </td>

                        <td class="px-10 py-6 text-sm text-slate-500">
                            {{ $trx->created_at->format('d M Y, H:i') }}
                        </td>

                        <td class="px-10 py-6">

                            @if(in_array($trx->status, ['success','settlement']))
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700">
                                Success
                            </span>

                            @elseif($trx->status == 'pending')
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-700">
                                Pending
                            </span>

                            @else
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-700">
                                {{ $trx->status }}
                            </span>
                            @endif

                        </td>

                        <td class="px-10 py-6 text-right font-extrabold text-slate-900">
                            Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="text-center py-20">
                            <div class="text-5xl">📊</div>
                            <p class="text-slate-400 mt-2">Belum ada transaksi</p>
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- 📄 TOTAL BAWAH (JANGAN HILANG) --}}
        <div class="mt-8 px-4 py-5 bg-slate-50 rounded-2xl flex justify-between items-center">

            <p class="text-xs text-slate-500">
                Menampilkan {{ $transactions->count() }} dari {{ $transactions->total() }} transaksi
            </p>

            <div>
                {{ $transactions->links() }}
            </div>

        </div>

    </div>

</div>

@endsection