<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register Organizer</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-slate-100 min-h-screen flex items-center justify-center">


    <div class="bg-white max-w-md w-full p-8 rounded-3xl shadow-xl">


        <h1 class="text-3xl font-black text-center text-indigo-700">

            Daftar Organizer

        </h1>


        <p class="text-center text-slate-500 mb-8 mt-2">

            Buat akun organisasi baru

        </p>



        @if($errors->any())

        <div class="bg-red-100 text-red-700 p-3 rounded-xl mb-5">

            @foreach($errors->all() as $error)

            <p>{{ $error }}</p>

            @endforeach

        </div>

        @endif




        <form action="{{ route('organizer.register') }}"
            method="POST"
            class="space-y-5">


            @csrf



            <div>

                <label class="font-bold text-sm">
                    Nama Organizer
                </label>

                <input
                    type="text"
                    name="name"
                    class="w-full mt-2 px-5 py-3 bg-slate-50 border rounded-xl"
                    required>

            </div>




            <div>

                <label class="font-bold text-sm">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="w-full mt-2 px-5 py-3 bg-slate-50 border rounded-xl"
                    required>

            </div>




            <div>

                <label class="font-bold text-sm">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="w-full mt-2 px-5 py-3 bg-slate-50 border rounded-xl"
                    required>

            </div>



            <div>

                <label class="font-bold text-sm">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="w-full mt-2 px-5 py-3 bg-slate-50 border rounded-xl"
                    required>

            </div>




            <button
                class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold hover:bg-indigo-700">

                Daftar

            </button>



        </form>



        <p class="text-center mt-6 text-sm">

            Sudah punya akun?

            <a href="{{ route('organizer.login') }}"
                class="text-indigo-600 font-bold">

                Login

            </a>

        </p>


    </div>


</body>

</html>