@extends('layouts.organizer')

@section('title','Profile Organizer')

@section('page_title')
Profile Organizer
@endsection

@section('page_subtitle')
Kelola informasi dan identitas penyelenggara event Anda.
@endsection


@section('content')


<div class="max-w-4xl">

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">


        <!-- Header Profile -->

        <div class="bg-indigo-600 px-8 py-10 text-white">

            <h2 class="text-2xl font-black">
                Informasi Organizer
            </h2>

            <p class="text-indigo-200 mt-2">
                Perbarui data organisasi Anda.
            </p>

        </div>





        <form
            action="{{ route('organizer.profile.update') }}"
            method="POST"
            enctype="multipart/form-data"
            class="p-8 space-y-6">


            @csrf
            @method('PUT')



            <!-- Logo -->

            <div>

                <label class="block font-bold mb-3">
                    Logo Organizer
                </label>



                <div class="flex items-center gap-6">


                    @if($organizer->logo)

                    <img
                        src="{{ asset('storage/'.$organizer->logo) }}"
                        class="w-28 h-28 rounded-3xl object-cover border shadow-sm">


                    @else


                    <div class="w-28 h-28 rounded-3xl bg-indigo-100 flex items-center justify-center text-indigo-700 text-4xl font-black">

                        {{ strtoupper(substr($organizer->name,0,1)) }}

                    </div>


                    @endif



                    <div>

                        <input
                            type="file"
                            name="logo"
                            accept="image/*"
                            class="block w-full text-sm 
                            text-slate-500
                            file:mr-4 
                            file:px-4 
                            file:py-2
                            file:rounded-xl
                            file:border-0
                            file:bg-indigo-100
                            file:text-indigo-700
                            file:font-bold">


                        <p class="text-xs text-slate-400 mt-2">
                            Format JPG/PNG maksimal 2MB
                        </p>


                    </div>


                </div>


                @error('logo')
                <p class="text-red-500 text-sm mt-2">
                    {{ $message }}
                </p>
                @enderror


            </div>

            <!-- Nama Organizer -->

            <div>


                <label class="block font-bold mb-2">
                    Nama Organizer
                </label>


                <input
                    type="text"
                    name="name"
                    value="{{ old('name',$organizer->name) }}"
                    class="w-full px-5 py-4 bg-slate-50 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-indigo-500">


                @error('name')

                <p class="text-red-500 text-sm mt-2">
                    {{ $message }}
                </p>

                @enderror


            </div>





            <!-- Email -->

            <div>


                <label class="block font-bold mb-2">
                    Email
                </label>


                <input
                    type="email"
                    value="{{ $organizer->email }}"
                    disabled
                    class="w-full px-5 py-4 bg-slate-100 rounded-2xl text-slate-400">


                <p class="text-xs text-slate-400 mt-2">
                    Email tidak dapat diubah.
                </p>


            </div>

            <!-- Deskripsi -->

            <div>


                <label class="block font-bold mb-2">
                    Deskripsi Organizer
                </label>


                <textarea
                    name="description"
                    rows="5"
                    class="w-full px-5 py-4 bg-slate-50 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-indigo-500">{{ old('description',$organizer->description) }}</textarea>



            </div>

            <!-- Status -->

            <div class="bg-slate-50 rounded-2xl p-5">


                <p class="text-sm text-slate-400 font-bold">
                    Status Organizer
                </p>


                @if($organizer->status == 'approved')

                <span class="inline-block mt-2 px-4 py-2 bg-green-100 text-green-700 rounded-xl font-bold text-sm">

                    Approved

                </span>


                @else


                <span class="inline-block mt-2 px-4 py-2 bg-yellow-100 text-yellow-700 rounded-xl font-bold text-sm">

                    Pending

                </span>


                @endif


            </div>





            <!-- Button -->

            <div class="flex justify-end pt-4">


                <button
                    type="submit"
                    class="px-8 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition">


                    Simpan Perubahan


                </button>


            </div>



        </form>


    </div>


</div>


@endsection