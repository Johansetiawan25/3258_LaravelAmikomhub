<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Organizer Dashboard - AmikomEventHub
    </title>


    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">


    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>


</head>



<body class="bg-slate-50 text-slate-900 flex min-h-screen">


    <!-- SIDEBAR -->

    <aside class="w-64 bg-indigo-900 text-white flex flex-col p-6">


        <!-- Logo -->

        <div class="flex items-center gap-3 mb-10">

            <div class="w-11 h-11 bg-white rounded-xl flex items-center justify-center text-indigo-900 font-black text-xl">

                AH

            </div>


            <div>

                <h1 class="font-bold text-lg">
                    AmikomEventHub
                </h1>


                <p class="text-xs text-indigo-300">
                    Organizer Panel
                </p>

            </div>


        </div>



        <!-- MENU -->

        <nav class="flex-1 space-y-3">


            <p class="text-xs uppercase tracking-widest text-indigo-300 px-3">
                Menu Organizer
            </p>



            <!-- Dashboard -->

            <a href="{{ route('organizer.dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold
            {{ request()->routeIs('organizer.dashboard')
            ? 'bg-indigo-700'
            : 'hover:bg-indigo-800' }}">

                📊

                Dashboard

            </a>




            <!-- Event -->

            <a href="{{ route('organizer.events.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold
            {{ request()->routeIs('organizer.events.*')
            ? 'bg-indigo-700'
            : 'hover:bg-indigo-800' }}">


                🎫

                Kelola Event


            </a>




            <!-- Pendapatan -->

            <a href="{{route('organizer.income')}}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold hover:bg-indigo-800">

                💰

                Pendapatan

            </a>




            <!-- Profile -->

            <a href="{{route('organizer.profile')}}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold hover:bg-indigo-800">


                🏢

                Profil Organizer


            </a>


        </nav>





        <!-- ACCOUNT -->


        <div class="border-t border-indigo-700 pt-5">


            <p class="font-bold">

                {{ Auth::guard('organizer')->user()->name }}

            </p>


            <p class="text-xs text-indigo-300 mb-4">

                Organizer

            </p>



            <form action="{{ route('organizer.logout') }}" method="POST">

                @csrf


                <button
                    class="w-full text-left px-4 py-3 rounded-xl hover:bg-indigo-800 font-bold">


                    🚪 Logout


                </button>


            </form>



        </div>



    </aside>


    <!-- MAIN -->

    <main class="flex-1 p-10">

        <header class="flex justify-between items-center mb-10">

            <div>

                <h1 class="text-3xl font-black">

                    @yield('page_title','Dashboard Organizer')

                </h1>


                <p class="text-slate-500">

                    @yield('page_subtitle','Kelola event dan pantau pendapatan')

                </p>


            </div>


            <div class="w-12 h-12 bg-white rounded-2xl shadow flex items-center justify-center font-black text-indigo-700">


                {{ strtoupper(substr(Auth::guard('organizer')->user()->name,0,2)) }}


            </div>



        </header>





        @if(session('success'))

        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 font-bold">

            {{ session('success') }}

        </div>

        @endif

        @yield('content')

    </main>

</body>

</html>