<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\Transaction;


class DashboardController extends Controller
{

    /**
     * Dashboard Organizer
     */
    public function index()
    {
        $organizer = Auth::guard('organizer')->user();


        // Total event milik organizer
        $totalEvent = Event::where(
            'organizer_id',
            $organizer->id
        )->count();



        // Total tiket terjual
        $totalTicket = Transaction::whereHas(
            'event',
            function ($query) use ($organizer) {

                $query->where(
                    'organizer_id',
                    $organizer->id
                );

            }
        )
        ->where('status','success')
        ->count();



        // Total pendapatan
        $totalIncome = Transaction::whereHas(
            'event',
            function ($query) use ($organizer) {

                $query->where(
                    'organizer_id',
                    $organizer->id
                );

            }
        )
        ->where('status','success')
        ->sum('total_price');



        // Event paling banyak terjual
        $bestEvent = Event::where(
            'organizer_id',
            $organizer->id
        )
        ->withCount([
            'transactions as sold_ticket'
            => function($query){

                $query->where(
                    'status',
                    'success'
                );

            }
        ])
        ->orderByDesc('sold_ticket')
        ->first();


        return view(
            'organizer.dashboard',
            compact(
                'organizer',
                'totalEvent',
                'totalTicket',
                'totalIncome',
                'bestEvent'
            )
        );
    }

    /**
     * Halaman Pendapatan Organizer
     */
    public function income()
    {

        $organizer = Auth::guard('organizer')->user();



        $transactions = Transaction::whereHas(
            'event',
            function($query) use ($organizer){

                $query->where(
                    'organizer_id',
                    $organizer->id
                );

            }
        )
        ->where(
            'status',
            'success'
        )
        ->latest()
        ->paginate(10);


        $totalIncome = Transaction::whereHas(
            'event',
            function($query) use ($organizer){

                $query->where(
                    'organizer_id',
                    $organizer->id
                );

            }
        )
        ->where(
            'status',
            'success'
        )
        ->sum('total_price');


        return view(
            'organizer.income',
            compact(
                'transactions',
                'totalIncome'
            )
        );

    }


    /**
     * Profile Organizer
     */
    public function profile()
    {

        $organizer = Auth::guard('organizer')->user();


        return view(
            'organizer.profile',
            compact('organizer')
        );

    }

    /**
     * Update Profile Organizer
     */
    public function updateProfile(Request $request)
    {

        $organizer = Auth::guard('organizer')->user();

        $request->validate([

            'name' =>
            'required|max:255',

            'description' =>
            'nullable',

            'logo' =>
            'nullable|image|max:2048'

        ]);


        if($request->hasFile('logo')){


            if($organizer->logo &&
                Storage::disk('public')->exists($organizer->logo)
            ){

                Storage::disk('public')
                    ->delete($organizer->logo);

            }

            $organizer->logo =
                $request->file('logo')
                ->store(
                    'organizers',
                    'public'
                );

        }


        $organizer->update([

            'name'=>$request->name,

            'description'=>$request->description,

            'logo'=>$organizer->logo

        ]);

        return back()
            ->with(
                'success',
                'Profile organizer berhasil diperbarui.'
            );

    }

}