@extends('layouts.organizer')

@section('title','Pendapatan Organizer')

@section('page_title')
Pendapatan Organizer
@endsection

@section('page_subtitle')
Pantau pemasukan dari seluruh event yang Anda selenggarakan.
@endsection


@section('content')


<!-- Total Pendapatan -->

<div class="grid md:grid-cols-3 gap-6 mb-8">


    <div class="bg-white rounded-[2rem] p-6 border shadow-sm">

        <p class="text-sm text-slate-400 font-bold">
            Total Pendapatan
        </p>


        <h2 class="text-3xl font-black text-indigo-600 mt-3">

            Rp {{ number_format($totalIncome,0,',','.') }}

        </h2>


    </div>




    <div class="bg-white rounded-[2rem] p-6 border shadow-sm">

        <p class="text-sm text-slate-400 font-bold">
            Total Transaksi
        </p>


        <h2 class="text-3xl font-black mt-3">

            {{ $transactions->total() }}

        </h2>


    </div>




    <div class="bg-white rounded-[2rem] p-6 border shadow-sm">

        <p class="text-sm text-slate-400 font-bold">
            Status
        </p>


        <h2 class="text-xl font-black text-green-600 mt-3">

            Pembayaran Berhasil

        </h2>


    </div>


</div>





<!-- Table Transaksi -->


<div class="bg-white rounded-[2.5rem] border shadow-sm overflow-hidden">


    <div class="p-6 border-b">

        <h2 class="text-xl font-black">

            Riwayat Pendapatan

        </h2>

        <p class="text-sm text-slate-400">

            Daftar transaksi tiket event Anda.

        </p>

    </div>




    <div class="overflow-x-auto">


        <table class="w-full text-left">


            <thead class="bg-slate-50 text-slate-400 text-xs uppercase">


                <tr>


                    <th class="px-8 py-5">
                        No
                    </th>


                    <th class="px-8 py-5">
                        Order ID
                    </th>


                    <th class="px-8 py-5">
                        Event
                    </th>


                    <th class="px-8 py-5">
                        Pembeli
                    </th>


                    <th class="px-8 py-5">
                        Tanggal
                    </th>


                    <th class="px-8 py-5">
                        Pendapatan
                    </th>


                </tr>


            </thead>




            <tbody class="divide-y">


                @forelse($transactions as $index => $transaction)


                <tr class="hover:bg-slate-50">


                    <td class="px-8 py-5 font-bold text-slate-400">

                        {{ $transactions->firstItem()+$index }}

                    </td>



                    <td class="px-8 py-5 font-bold">

                        {{ $transaction->order_id }}

                    </td>




                    <td class="px-8 py-5">


                        <p class="font-bold">

                            {{ $transaction->event->title }}

                        </p>


                        <p class="text-xs text-slate-400">

                            {{ $transaction->event->date }}

                        </p>


                    </td>




                    <td class="px-8 py-5">

                        {{ $transaction->customer_name }}

                        <br>

                        <span class="text-xs text-slate-400">

                            {{ $transaction->customer_email }}

                        </span>


                    </td>




                    <td class="px-8 py-5">

                        {{ $transaction->created_at->format('d M Y') }}

                    </td>




                    <td class="px-8 py-5">


                        <span class="font-black text-indigo-600">

                            Rp {{ number_format($transaction->total_price,0,',','.') }}

                        </span>


                    </td>



                </tr>



                @empty


                <tr>

                    <td colspan="6"
                        class="text-center py-10 text-slate-400">

                        Belum ada pendapatan.

                    </td>

                </tr>


                @endforelse



            </tbody>


        </table>


    </div>





    <div class="p-6 bg-slate-50 border-t">

        {{ $transactions->links() }}

    </div>


</div>


@endsection