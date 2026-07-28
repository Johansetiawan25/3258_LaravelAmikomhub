@extends('layouts.organizer')

@section('title','Dashboard Organizer')

@section('page_title')
Dashboard Organizer
@endsection


@section('page_subtitle')
Kelola event dan pantau pendapatan organisasi Anda.
@endsection



@section('content')


<div class="grid md:grid-cols-3 gap-6 mb-8">


    <!-- Total Event -->

    <div class="bg-white rounded-[2rem] p-6 shadow-sm border">

        <p class="text-sm text-slate-400 font-bold">
            Total Event
        </p>


        <h2 class="text-3xl font-black mt-3">
            {{ $totalEvent }}
        </h2>


    </div>




    <!-- Tiket -->

    <div class="bg-white rounded-[2rem] p-6 shadow-sm border">

        <p class="text-sm text-slate-400 font-bold">
            Tiket Terjual
        </p>


        <h2 class="text-3xl font-black mt-3">
            {{ $totalTicket }}
        </h2>


    </div>




    <!-- Pendapatan -->

    <div class="bg-white rounded-[2rem] p-6 shadow-sm border">


        <p class="text-sm text-slate-400 font-bold">
            Pendapatan
        </p>


        <h2 class="text-3xl font-black mt-3 text-indigo-600">

            Rp {{ number_format($totalIncome,0,',','.') }}

        </h2>


    </div>



</div>





<!-- Event Terlaris -->

<div class="bg-white rounded-[2.5rem] p-8 shadow-sm border">


    <h2 class="font-black text-xl mb-6">
        Event Terlaris
    </h2>



    @if($bestEvent)


    <div class="flex items-center gap-5">


        @if($bestEvent->poster_path)

        <img
            src="{{ asset('storage/'.$bestEvent->poster_path) }}"
            class="w-24 h-28 rounded-2xl object-cover">

        @endif



        <div>


            <h3 class="font-black text-lg">

                {{ $bestEvent->title }}

            </h3>


            <p class="text-slate-400">

                {{ $bestEvent->sold_ticket }}
                Tiket Terjual

            </p>


        </div>


    </div>


    @else


    <p class="text-slate-400">
        Belum ada transaksi.
    </p>


    @endif


</div>



@endsection