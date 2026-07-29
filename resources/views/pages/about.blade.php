@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')

<section class="max-w-6xl mx-auto px-6 py-20">

    <div class="text-center mb-16">

        <h1 class="text-5xl font-black text-slate-800">
            Tentang AmikomEventHub
        </h1>

        <p class="mt-5 text-lg text-slate-600 max-w-3xl mx-auto leading-8">
            <strong>AmikomEventHub</strong> merupakan aplikasi web pemesanan tiket
            event yang dikembangkan sebagai <strong>proyek akademik</strong>
            oleh mahasiswa Universitas Amikom Yogyakarta.
            Website ini dibuat sebagai media pembelajaran dan demonstrasi
            implementasi teknologi pengembangan aplikasi web menggunakan Laravel,
            Tailwind CSS, Midtrans Payment Gateway, serta berbagai fitur pendukung
            manajemen event.
        </p>

    </div>

    <div class="grid md:grid-cols-3 gap-8">

        <div class="bg-white rounded-3xl shadow-sm border p-8">

            <div class="text-5xl mb-5">
                🎯
            </div>

            <h3 class="text-2xl font-bold mb-4">
                Tujuan Proyek
            </h3>

            <p class="text-slate-600 leading-7">
                Mengembangkan sebuah platform digital yang mampu membantu
                penyelenggara dalam mengelola event serta memudahkan peserta
                melakukan pemesanan tiket secara online dengan antarmuka modern
                dan mudah digunakan.
            </p>

        </div>

        <div class="bg-white rounded-3xl shadow-sm border p-8">

            <div class="text-5xl mb-5">
                🚀
            </div>

            <h3 class="text-2xl font-bold mb-4">
                Teknologi
            </h3>

            <ul class="space-y-2 text-slate-600">

                <li>✔ Laravel Framework</li>
                <li>✔ Tailwind CSS</li>
                <li>✔ MySQL Database</li>
                <li>✔ Midtrans Payment Gateway</li>
                <li>✔ Google OAuth Login</li>
                <li>✔ ApexCharts Dashboard</li>

            </ul>

        </div>

        <div class="bg-white rounded-3xl shadow-sm border p-8">

            <div class="text-5xl mb-5">
                👨‍💻
            </div>

            <h3 class="text-2xl font-bold mb-4">
                Pengembang
            </h3>

            <p class="text-slate-600 leading-7">

                <strong>Johan Setiawan</strong><br>

                Mahasiswa Universitas Amikom Yogyakarta.<br><br>

                Website ini dibuat sebagai bagian dari
                tugas pengembangan aplikasi berbasis web dan hanya digunakan
                untuk kebutuhan pembelajaran, penelitian, serta demonstrasi
                implementasi sistem informasi.

            </p>

        </div>

    </div>

    <div class="mt-16 bg-indigo-50 border border-indigo-100 rounded-3xl p-10">

        <h2 class="text-3xl font-black text-indigo-700 mb-4">

            Informasi

        </h2>

        <p class="text-slate-700 leading-8">

            Seluruh data, event, transaksi, maupun penyelenggara yang terdapat
            pada website ini digunakan sebagai contoh implementasi sistem.
            Website <strong>AmikomEventHub</strong> bukan merupakan platform
            komersial dan tidak digunakan untuk transaksi nyata.
            Aplikasi ini dikembangkan sebagai proyek akademik untuk
            mendemonstrasikan kemampuan dalam membangun sistem Event Management
            menggunakan framework Laravel.

        </p>

    </div>

</section>

@endsection