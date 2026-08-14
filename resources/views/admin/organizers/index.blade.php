@extends('layouts.admin')

@section('title', 'Organizer')
@section('page_title', 'Manajemen Organizer')
@section('page_subtitle', 'Kelola data penyelenggara event')

@section('content')

<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">

    <!-- Header -->
    <div class="p-6 flex justify-between items-center border-b border-slate-100">

        <div>
            <h2 class="text-xl font-black text-slate-800">
                Data Organizer
            </h2>

            <p class="text-sm text-slate-500">
                Daftar penyelenggara event
            </p>
        </div>


        <a href="{{ route('admin.organizers.create') }}"
            class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition flex items-center gap-2">

            +
            Tambah Organizer

        </a>

    </div>

    <!-- Table -->

    <div class="overflow-x-auto">

        <table class="w-full text-sm">


            <thead class="bg-slate-50">

                <tr>

                    <th class="px-6 py-4 text-left font-bold text-slate-500">
                        No
                    </th>


                    <th class="px-6 py-4 text-left font-bold text-slate-500">
                        Logo
                    </th>


                    <th class="px-6 py-4 text-left font-bold text-slate-500">
                        Nama Organizer
                    </th>


                    <th class="px-6 py-4 text-left font-bold text-slate-500">
                        Deskripsi
                    </th>


                    <th class="px-6 py-4 text-left font-bold text-slate-500">
                        Jumlah Event
                    </th>


                    <th class="px-6 py-4 text-left font-bold text-slate-500">
                        Status
                    </th>


                    <th class="px-6 py-4 text-left font-bold text-slate-500">
                        Aksi
                    </th>


                </tr>

            </thead>



            <tbody class="divide-y divide-slate-100">


                @forelse($organizers as $index => $organizer)


                <tr class="hover:bg-slate-50">


                    <td class="px-6 py-4">
                        {{ $organizers->firstItem() + $index }}
                    </td>



                    <td class="px-6 py-4">


                        @if($organizer->logo)


                        <img
                            src="{{ asset('storage/'.$organizer->logo) }}"
                            class="w-14 h-14 rounded-xl object-cover border">


                        @else


                        <div class="w-14 h-14 rounded-xl bg-indigo-100 flex items-center justify-center font-bold text-indigo-700">

                            {{ strtoupper(substr($organizer->name,0,1)) }}

                        </div>


                        @endif


                    </td>




                    <td class="px-6 py-4">

                        <p class="font-bold text-slate-800">
                            {{ $organizer->name }}
                        </p>

                        <p class="text-xs text-slate-400">
                            {{ $organizer->email }}
                        </p>

                    </td>





                    <td class="px-6 py-4 text-slate-600">

                        {{ Str::limit($organizer->description,60) }}

                    </td>





                    <td class="px-6 py-4 font-bold">

                        {{ $organizer->events()->count() }}

                    </td>






                    <!-- STATUS -->

                    <td class="px-6 py-4">


                        @if($organizer->status == 'approved')


                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">

                            Approved

                        </span>



                        @elseif($organizer->status == 'pending')


                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">

                            Pending

                        </span>



                        @else


                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">

                            Rejected

                        </span>


                        @endif


                    </td>







                    <!-- AKSI -->

                    <td class="px-6 py-4">


                        <div class="flex gap-2 flex-wrap">



                            @if($organizer->status == 'pending')


                            <form action="{{ route('admin.organizers.approve',$organizer) }}"
                                method="POST">

                                @csrf

                                <button
                                    class="px-4 py-2 bg-green-100 text-green-700 rounded-xl text-xs font-bold">

                                    Approve

                                </button>

                            </form>




                            <form action="{{ route('admin.organizers.reject',$organizer) }}"
                                method="POST">

                                @csrf

                                <button
                                    class="px-4 py-2 bg-red-100 text-red-700 rounded-xl text-xs font-bold">

                                    Reject

                                </button>

                            </form>


                            @endif






                            <a href="{{ route('admin.organizers.edit',$organizer) }}"
                                class="px-4 py-2 bg-amber-100 text-amber-700 rounded-xl text-xs font-bold">

                                Edit

                            </a>







                            <form action="{{ route('admin.organizers.destroy',$organizer) }}"
                                method="POST">


                                @csrf

                                @method('DELETE')


                                <button
                                    onclick="return confirm('Hapus organizer ini?')"
                                    class="px-4 py-2 bg-red-100 text-red-700 rounded-xl text-xs font-bold">


                                    Hapus


                                </button>


                            </form>



                        </div>


                    </td>




                </tr>



                @empty


                <tr>


                    <td colspan="7"
                        class="py-10 text-center text-slate-400">


                        Belum ada organizer.


                    </td>


                </tr>


                @endforelse



            </tbody>


        </table>


    </div>



    <div class="p-6">

        {{ $organizers->links() }}

    </div>



</div>


@endsection