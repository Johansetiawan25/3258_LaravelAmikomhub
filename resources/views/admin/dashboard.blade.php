@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard Ringkasan')

@section('content')

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-10">

    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                </path>
            </svg>
        </div>

        <p class="text-slate-400 text-sm font-bold uppercase mb-1">
            Total Pendapatan
        </p>

        <h3 class="text-2xl font-black">
            Rp {{ number_format($totalRevenue,0,',','.') }}
        </h3>
    </div>

    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                </path>
            </svg>
        </div>

        <p class="text-slate-400 text-sm font-bold uppercase mb-1">
            Tiket Terjual
        </p>

        <h3 class="text-2xl font-black">
            {{ number_format($ticketsSold,0,',','.') }}
        </h3>
    </div>

    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                </path>
            </svg>
        </div>

        <p class="text-slate-400 text-sm font-bold uppercase mb-1">
            Event Aktif
        </p>

        <h3 class="text-2xl font-black">
            {{ $activeEvents }} Event
        </h3>
    </div>

    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                </path>
            </svg>
        </div>

        <p class="text-slate-400 text-sm font-bold uppercase mb-1">
            Pesanan Pending
        </p>

        <h3 class="text-2xl font-black">
            {{ $pendingOrders }} Pesanan
        </h3>
    </div>


    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">

        <div class="w-12 h-12 bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center mb-4">

            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5V4H2v16h5m10 0v-4H7v4m10 0H7">
                </path>
            </svg>

        </div>

        <p class="text-slate-400 text-sm font-bold uppercase mb-1">
            Total Organizer
        </p>

        <h3 class="text-2xl font-black">
            {{ $totalOrganizers }}
        </h3>

    </div>



    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">

        <div class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-2xl flex items-center justify-center mb-4">

            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3">
                </path>
            </svg>

        </div>

        <p class="text-slate-400 text-sm font-bold uppercase mb-1">
            Organizer Pending
        </p>

        <h3 class="text-2xl font-black">
            {{ $pendingOrganizers }}
        </h3>

    </div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

    <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">

        <h3 class="text-xl font-black mb-6">
            📈 Pendapatan Bulanan
        </h3>

        <div id="revenueChart"></div>

    </div>


    <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">

        <h3 class="text-xl font-black mb-6">
            📊 Jumlah Transaksi
        </h3>

        <div id="transactionChart"></div>

    </div>

</div>


<!-- Latest Sales Table -->
<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">

    <div class="p-8 border-b flex justify-between items-center">

        <h3 class="font-black text-xl">
            Transaksi Terakhir
        </h3>

        <a href="{{ route('admin.transactions.index') }}"
            class="text-indigo-600 font-bold hover:underline">
            Lihat Semua
        </a>

    </div>



    <div class="overflow-x-auto">

        <table class="w-full text-left border-collapse">

            <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">

                <tr>
                    <th class="px-8 py-4 w-1/4">Tanggal</th>
                    <th class="px-8 py-4 w-1/4">Pembeli</th>
                    <th class="px-8 py-4 w-1/4">Event</th>
                    <th class="px-8 py-4">Status</th>
                    <th class="px-8 py-4 text-right">Total</th>
                </tr>

            </thead>

            <tbody class="divide-y border-t">

                @forelse($recentTransactions as $trx)

                <tr class="hover:bg-slate-50 transition">

                    <td class="px-8 py-6">

                        <p class="font-medium">
                            {{ $trx->created_at->format('d M Y') }}
                        </p>

                        <p class="text-xs text-slate-400">
                            {{ $trx->order_id }}
                        </p>

                    </td>

                    <td class="px-8 py-6">

                        <p class="font-bold uppercase tracking-wide text-sm">
                            {{ $trx->customer_name }}
                        </p>

                        <p class="text-xs text-slate-400">
                            {{ $trx->customer_email }}
                        </p>

                    </td>

                    <td class="px-8 py-6 font-medium text-slate-600">
                        {{ $trx->event->title ?? '-' }}
                    </td>

                    <td class="px-8 py-6">

                        @if($trx->status == 'settlement' || $trx->status == 'success')

                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-bold uppercase">
                            Success
                        </span>

                        @elseif($trx->status == 'pending')

                        <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-lg text-xs font-bold uppercase">
                            Pending
                        </span>

                        @else

                        <span class="px-3 py-1 bg-rose-100 text-rose-700 rounded-lg text-xs font-bold uppercase">
                            {{ $trx->status }}
                        </span>

                        @endif

                    </td>

                    <td class="px-8 py-6 text-right font-black text-indigo-600">
                        Rp {{ number_format($trx->total_price,0,',','.') }}
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="px-8 py-10 text-center text-slate-500">
                        Belum ada transaksi
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<div class="bg-white rounded-3xl border border-slate-100 shadow-sm mt-8">

    <div class="p-8 border-b">

        <h3 class="font-black text-xl">
            Top 5 Event Terlaris
        </h3>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-slate-50 text-slate-500 uppercase text-[11px] tracking-wider">

                <tr>

                    <th class="px-8 py-4 text-left">
                        Event
                    </th>

                    <th class="px-8 py-4 text-right">
                        Tiket Terjual
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y">

                @forelse($topEvents as $event)

                <tr class="hover:bg-slate-50">

                    <td class="px-8 py-5 font-medium">
                        {{ $event->title }}
                    </td>

                    <td class="px-8 py-5 text-right font-black text-indigo-600">
                        {{ $event->sold_ticket }}
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="2" class="text-center py-8 text-slate-400">
                        Belum ada data penjualan.
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@push('scripts')

<script>
    const months = @json(array_values($months));

    const revenue = @json($revenueChart);

    const transaction = @json($transactionChart);


    // =======================
    // Grafik Pendapatan
    // =======================

    new ApexCharts(document.querySelector("#revenueChart"), {

        chart: {
            type: 'area',
            height: 340,
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            },
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 900
            }
        },

        series: [{
            name: 'Pendapatan',
            data: revenue
        }],

        xaxis: {
            categories: months
        },

        stroke: {
            curve: 'smooth',
            width: 4
        },

        markers: {
            size: 5
        },

        dataLabels: {
            enabled: false
        },

        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.6,
                opacityTo: 0.1
            }
        },

        yaxis: {
            labels: {
                formatter: function(value) {

                    if (value >= 1000000) {
                        return 'Rp ' + (value / 1000000).toFixed(1) + ' Jt';
                    }

                    if (value >= 1000) {
                        return 'Rp ' + (value / 1000).toFixed(0) + ' Rb';
                    }

                    return 'Rp ' + value;
                }
            }
        },

        tooltip: {
            y: {
                formatter: function(value) {
                    return 'Rp ' + value.toLocaleString('id-ID');
                }
            }
        }

    }).render();




    // =======================
    // Grafik Transaksi
    // =======================

    new ApexCharts(document.querySelector("#transactionChart"), {

        chart: {
            type: 'bar',
            height: 340,
            toolbar: {
                show: false
            },
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 900
            }
        },

        series: [{
            name: 'Jumlah Transaksi',
            data: transaction
        }],

        xaxis: {
            categories: months
        },

        dataLabels: {
            enabled: false
        },

        plotOptions: {
            bar: {
                borderRadius: 8,
                columnWidth: '45%'
            }
        },

        tooltip: {
            y: {
                formatter: function(value) {
                    return value + ' transaksi';
                }
            }
        }

    }).render();
</script>

@endpush

@endsection