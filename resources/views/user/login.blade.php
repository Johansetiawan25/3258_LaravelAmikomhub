<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - AmikomEventHub</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>

</head>

<body class="bg-gradient-to-br from-indigo-700 via-indigo-800 to-slate-900 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl p-10">

        <!-- Logo -->
        <div class="text-center">

            <div class="w-20 h-20 rounded-3xl bg-indigo-600 flex items-center justify-center mx-auto text-white text-3xl font-black">
                AH
            </div>

            <h1 class="text-3xl font-black mt-6 text-slate-800">
                Selamat Datang
            </h1>

            <p class="text-slate-500 mt-2">
                Masuk untuk memesan tiket event favoritmu.
            </p>

        </div>

        <!-- Error -->
        @if($errors->any())

        <div class="mt-6 bg-red-50 border border-red-200 rounded-xl p-4 text-red-600 text-sm">

            {{ $errors->first() }}

        </div>

        @endif

        <!-- Login Form -->
        <form
            action="{{ route('login') }}"
            method="POST"
            class="mt-8 space-y-5">

            @csrf

            <!-- Email -->
            <div>

                <label class="block text-sm font-bold text-slate-700 mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email"
                    required
                    class="w-full rounded-2xl border border-slate-300 px-5 py-4 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">

            </div>

            <!-- Password -->
            <div>

                <label class="block text-sm font-bold text-slate-700 mb-2">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                    class="w-full rounded-2xl border border-slate-300 px-5 py-4 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">

            </div>

            <!-- Remember -->
            <div class="flex items-center justify-between text-sm">

                <label class="flex items-center gap-2">

                    <input
                        type="checkbox"
                        name="remember">

                    <span class="text-slate-600">
                        Ingat saya
                    </span>

                </label>

                <a
                    href="#"
                    class="text-indigo-600 hover:underline">

                    Lupa Password?

                </a>

            </div>

            <!-- Button -->
            <button
                type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 transition text-white font-bold py-4 rounded-2xl">

                Masuk

            </button>

        </form>

        <!-- Divider -->
        <div class="flex items-center my-8">

            <div class="flex-1 border-t"></div>

            <span class="px-4 text-slate-400 text-sm">
                atau
            </span>

            <div class="flex-1 border-t"></div>

        </div>

        <!-- Google -->
        <a
            href="{{ route('google.login') }}"
            class="w-full border-2 border-slate-300 rounded-2xl py-4 flex items-center justify-center gap-3 hover:bg-slate-50 transition">

            <img
                src="https://www.svgrepo.com/show/475656/google-color.svg"
                class="w-6 h-6">

            <span class="font-bold text-slate-700">

                Masuk dengan Google

            </span>

        </a>

        <!-- Register -->
        <div class="text-center mt-8">

            <p class="text-slate-500">

                Belum punya akun?

                <a
                    href="{{ route('register') }}"
                    class="text-indigo-600 font-bold hover:underline">

                    Daftar

                </a>

            </p>

        </div>

        <!-- Back -->
        <div class="text-center mt-5">

            <a
                href="{{ route('home') }}"
                class="text-slate-500 hover:text-indigo-600 transition">

                ← Kembali ke Beranda

            </a>

        </div>

    </div>

</body>

</html>