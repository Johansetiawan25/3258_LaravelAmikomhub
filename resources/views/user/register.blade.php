<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - AmikomEventHub</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>

        body{
            font-family:'Plus Jakarta Sans',sans-serif;
        }

    </style>

</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-700 via-indigo-800 to-slate-900 flex items-center justify-center px-5">

<div class="bg-white w-full max-w-md rounded-[2rem] shadow-2xl p-10">

    <div class="text-center">

        <div class="w-20 h-20 bg-indigo-600 rounded-3xl flex items-center justify-center mx-auto text-white text-3xl font-black">
            AH
        </div>

        <h1 class="mt-6 text-3xl font-black">
            Buat Akun
        </h1>

        <p class="text-slate-500 mt-2">
            Daftar untuk mulai membeli tiket event.
        </p>

    </div>


    @if($errors->any())

        <div class="mt-6 bg-red-100 text-red-700 px-4 py-3 rounded-xl">

            {{ $errors->first() }}

        </div>

    @endif


    <form action="{{ route('register') }}" method="POST" class="space-y-5 mt-8">

        @csrf

        <div>

            <label class="font-bold text-sm block mb-2">

                Nama

            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="w-full border rounded-2xl px-5 py-4"
                required>

        </div>


        <div>

            <label class="font-bold text-sm block mb-2">

                Email

            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="w-full border rounded-2xl px-5 py-4"
                required>

        </div>


        <div>

            <label class="font-bold text-sm block mb-2">

                Password

            </label>

            <input
                type="password"
                name="password"
                class="w-full border rounded-2xl px-5 py-4"
                required>

        </div>


        <div>

            <label class="font-bold text-sm block mb-2">

                Konfirmasi Password

            </label>

            <input
                type="password"
                name="password_confirmation"
                class="w-full border rounded-2xl px-5 py-4"
                required>

        </div>


        <button
            type="submit"
            class="w-full py-4 rounded-2xl bg-indigo-600 text-white font-bold hover:bg-indigo-700">

            Daftar

        </button>

    </form>


    <div class="mt-8 text-center">

        <p class="text-slate-500">

            Sudah punya akun?

            <a href="{{ route('login') }}"
                class="text-indigo-600 font-bold">

                Login

            </a>

        </p>

    </div>


    <div class="mt-5 text-center">

        <a href="{{ route('home') }}"
            class="text-slate-500 hover:text-indigo-600">

            ← Kembali ke Beranda

        </a>

    </div>

</div>

</body>

</html>