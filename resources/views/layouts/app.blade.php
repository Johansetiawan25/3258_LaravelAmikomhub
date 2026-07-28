<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmikomEventHub - Temukan Event Seru!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900">

    <!-- Navigation -->
    <nav
        class="glass sticky top-8 z-40 mx-4 mt-4 px-6 py-4 rounded-2xl border border-white/20 shadow-lg flex items-center">

        <!-- Logo -->
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl">
                AH
            </div>

            <span class="text-xl font-bold tracking-tight">
                AmikomEventHub
            </span>
        </div>

        <!-- Menu -->
        <div class="flex-1 flex justify-center">
            <div class="hidden md:flex items-center gap-10 font-medium">

                <a href="{{ route('home') }}"
                    class="text-indigo-600 hover:text-indigo-700 transition">
                    Jelajahi
                </a>

                <a href="#kategori"
                    class="hover:text-indigo-600 transition">
                    Kategori
                </a>

                <a href="#footer"
                    class="hover:text-indigo-600 transition">
                    Tentang Kami
                </a>

            </div>
        </div>

        <!-- Login / User -->
        <div class="flex items-center gap-3">

            @guest

            <a href="{{ route('login') }}"
                class="px-5 py-2.5 rounded-xl border border-slate-300 font-semibold hover:bg-slate-100 transition">

                Masuk

            </a>

            <a href="{{ route('register') }}"
                class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-semibold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition">

                Daftar

            </a>

            @else

            <div class="relative">

                <!-- Toggle -->
                <input
                    type="checkbox"
                    id="userMenu"
                    class="peer hidden">


                <!-- Button -->
                <label
                    for="userMenu"
                    class="cursor-pointer flex items-center gap-3 px-3 py-2 rounded-xl border border-slate-300 hover:bg-slate-100 transition">


                    <div
                        class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold">

                        {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                    </div>


                    <div class="hidden lg:block text-left">

                        <p class="font-bold text-sm leading-none">
                            {{ Auth::user()->name }}
                        </p>


                        <p class="text-xs text-slate-500 mt-1">
                            {{ Auth::user()->email }}
                        </p>


                    </div>


                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4 text-slate-500 transition peer-checked:rotate-180"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7" />

                    </svg>


                </label>



                <!-- Dropdown -->
                <div
                    class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden
        opacity-0 invisible scale-95 transition duration-200
        peer-checked:opacity-100 peer-checked:visible peer-checked:scale-100 z-50">


                    <!-- Header -->

                    <div class="px-5 py-4 border-b border-slate-100">

                        <p class="font-bold text-slate-800">
                            {{ Auth::user()->name }}
                        </p>


                        <p class="text-xs text-slate-500 mt-1">
                            {{ Auth::user()->email }}
                        </p>


                    </div>



                    <!-- Menu -->

                    <div class="py-2">


                        <a href="#"
                            class="block px-5 py-3 text-sm text-slate-700 hover:bg-slate-100 transition">

                            Profil Saya

                        </a>



                        <a href="{{ route('ticket') }}"
                            class="block px-5 py-3 text-sm text-slate-700 hover:bg-slate-100 transition">

                            Tiket Saya

                        </a>



                        <a href="#"
                            class="block px-5 py-3 text-sm text-slate-700 hover:bg-slate-100 transition">

                            Riwayat Transaksi

                        </a>


                    </div>



                    <!-- Setting -->

                    <div class="border-t border-slate-100 py-2">


                        <a href="#"
                            class="block px-5 py-3 text-sm text-slate-700 hover:bg-slate-100 transition">

                            Pengaturan Akun

                        </a>



                        <a href="#"
                            class="block px-5 py-3 text-sm text-slate-700 hover:bg-slate-100 transition">

                            Ubah Password

                        </a>


                    </div>



                    <!-- Logout -->

                    <div class="border-t border-slate-100 py-2">


                        <form action="{{ route('logout') }}" method="POST">

                            @csrf


                            <button
                                class="w-full text-left px-5 py-3 text-sm text-red-600 hover:bg-red-50 transition">

                                Logout

                            </button>


                        </form>


                    </div>


                </div>


            </div>


            @endguest

        </div>

    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-indigo-900 text-indigo-100 py-20 px-6 mt-20">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="space-y-4 col-span-2">
                <div class="flex items-center gap-2">
                    <div
                        class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-indigo-900 font-bold text-xl">
                        AH</div>
                    <span class="text-2xl font-bold text-white">AmikomEventHub</span>
                </div>
                <p class="max-w-xs text-indigo-300">Platform reservasi tiket event online terbaik untuk mahasiswa dan
                    penyelenggara profesional.</p>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6">Navigasi</h4>
                <ul class="space-y-4">
                    <li><a href="#" class="hover:text-white transition">Home</a></li>
                    <li><a href="#" class="hover:text-white transition">Semua Event</a></li>
                    <li><a href="#" class="hover:text-white transition">Cara Bayar</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6">Hubungi Kami</h4>
                <ul class="space-y-4">
                    <li>support@eventtiket.com</li>
                    <li>+62 812 3456 7890</li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto pt-12 mt-12 border-t border-indigo-800 text-center text-indigo-400 text-sm">
            &copy; 2026 AmikomEventHub. Built with Laravel & Tailwind CSS.
        </div>
    </footer>

    @yield('scripts')


</body>

</html>