<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AmikomEventHub</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>

</head>

<body class="bg-gradient-to-br from-indigo-700 via-indigo-800 to-slate-900 min-h-screen flex items-center justify-center">

    <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl p-10">

        <div class="text-center">

            <div class="w-20 h-20 bg-indigo-600 rounded-3xl mx-auto flex items-center justify-center text-white font-black text-3xl">
                AH
            </div>

            <h1 class="mt-6 text-3xl font-black text-slate-800">
                Selamat Datang
            </h1>

            <p class="text-slate-500 mt-2">
                Login untuk memesan tiket event dengan mudah menggunakan akun Google.
            </p>

        </div>

        <div class="mt-10">

            <a href="{{ route('google.login') }}"
                class="w-full flex items-center justify-center gap-3 border-2 border-slate-200 rounded-2xl py-4 hover:bg-slate-50 transition">

                <img
                    src="https://www.svgrepo.com/show/475656/google-color.svg"
                    class="w-6 h-6">

                <span class="font-bold text-slate-700">
                    Continue with Google
                </span>

            </a>

        </div>

        <div class="mt-8 text-center">

            <a href="{{ route('home') }}"
                class="text-indigo-600 font-semibold hover:underline">

                ← Kembali ke Beranda

            </a>

        </div>

    </div>

</body>

</html>