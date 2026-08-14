@extends('layouts.admin')

@section('title', 'Review')
@section('page_title', 'Manajemen Review')
@section('page_subtitle', 'Kelola review pengguna terhadap organizer.')

@section('content')

<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">

    <!-- Header -->
    <div class="p-6 flex justify-between items-center border-b border-slate-100">

        <div>
            <h2 class="text-xl font-bold text-slate-800">
                Daftar Review
            </h2>

            <p class="text-slate-500 text-sm mt-1">
                Total {{ $reviews->total() }} Review
            </p>
        </div>

    </div>

    <!-- Table -->
    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-slate-50 text-slate-500 text-[11px] uppercase tracking-wider font-bold">

                <tr>

                    <th class="px-6 py-5 text-left">User</th>

                    <th class="px-6 py-5 text-left">Organizer</th>

                    <th class="px-6 py-5 text-left">Event</th>

                    <th class="px-6 py-5 text-center">Rating</th>

                    <th class="px-6 py-5 text-left">Review</th>

                    <th class="px-6 py-5 text-center">Tanggal</th>

                    <th class="px-6 py-5 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($reviews as $review)

                <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                    <!-- User -->
                    <td class="px-6 py-5">

                        <div class="font-semibold text-slate-800">

                            {{ $review->user->name }}

                        </div>

                    </td>

                    <!-- Organizer -->
                    <td class="px-6 py-5">

                        {{ $review->organizer->name }}

                    </td>

                    <!-- Event -->
                    <td class="px-6 py-5">

                        {{ $review->transaction->event->title }}

                    </td>

                    <!-- Rating -->
                    <td class="px-6 py-5 text-center">

                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full font-bold">

                            ⭐ {{ $review->rating }}/5

                        </span>

                    </td>

                    <!-- Review -->
                    <td class="px-6 py-5 max-w-sm">

                        {{ \Illuminate\Support\Str::limit($review->review,60) }}

                    </td>

                    <!-- Tanggal -->
                    <td class="px-6 py-5 text-center">

                        {{ $review->created_at->format('d M Y') }}

                    </td>

                    <!-- Aksi -->
                    <td class="px-6 py-5">

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('admin.reviews.show',$review) }}"
                                class="px-4 py-2 bg-blue-100 text-blue-700 rounded-xl hover:bg-blue-200 transition font-semibold">

                                Detail

                            </a>

                            <form action="{{ route('admin.reviews.destroy',$review) }}"
                                method="POST"
                                onsubmit="return confirm('Hapus review ini?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="px-4 py-2 bg-red-100 text-red-700 rounded-xl hover:bg-red-200 transition font-semibold">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7" class="text-center py-20 text-slate-500">

                        Belum ada review.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="p-6">

        {{ $reviews->links() }}

    </div>

</div>

@endsection