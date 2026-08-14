<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Organizer</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-slate-100 min-h-screen flex items-center justify-center">


    <div class="bg-white w-full max-w-md rounded-3xl shadow-xl p-8">


        <h1 class="text-3xl font-black text-center text-indigo-700">
            Organizer Login
        </h1>

        <p class="text-center text-slate-500 mt-2 mb-8">
            Masuk untuk mengelola event Anda
        </p>


        @if(session('success'))

        <div class="bg-green-100 text-green-700 p-3 rounded-xl mb-5">
            {{ session('success') }}
        </div>

        @endif


        @if($errors->any())

        <div class="bg-red-100 text-red-700 p-3 rounded-xl mb-5">

            @foreach($errors->all() as $error)

            <p>{{ $error }}</p>

            @endforeach

        </div>

        @endif



        <form action="{{ route('organizer.login') }}"
            method="POST"
            class="space-y-5">

            @csrf


            <div>

                <label class="font-bold text-sm">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="w-full mt-2 px-5 py-3 rounded-xl bg-slate-50 border"
                    required>

            </div>



            <div>

                <label class="font-bold text-sm">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="w-full mt-2 px-5 py-3 rounded-xl bg-slate-50 border"
                    required>

            </div>



            <button
                class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold hover:bg-indigo-700">

                Login

            </button>


        </form>


        <p class="text-center mt-6 text-sm">

            Belum punya akun?

            <a href="{{ route('organizer.register') }}"
                class="text-indigo-600 font-bold">

                Daftar Organizer

            </a>

        </p>


    </div>


</body>

</html>