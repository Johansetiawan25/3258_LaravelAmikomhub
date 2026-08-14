<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Organizer;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Pendapatan
        $totalRevenue = Transaction::whereIn('status', [
            'settlement',
            'success'
        ])->sum('total_price');

        // Tiket Terjual
        $ticketsSold = Transaction::whereIn('status', [
            'settlement',
            'success'
        ])->count();

        // Event Aktif
        $activeEvents = Event::whereDate(
            'date',
            '>=',
            now()
        )->count();

        // Pesanan Pending
        $pendingOrders = Transaction::where(
            'status',
            'pending'
        )->count();

        // Total Organizer
        $totalOrganizers = Organizer::count();

        // Organizer Pending
        $pendingOrganizers = Organizer::where(
            'status',
            'pending'
        )->count();

        // Transaksi Terbaru
        $recentTransactions = Transaction::with('event')
            ->latest()
            ->take(5)
            ->get();

        // Pendapatan Bulanan
        $monthlyRevenue = Transaction::selectRaw("
                MONTH(created_at) as month,
                SUM(total_price) as total
            ")
            ->whereIn('status', [
                'settlement',
                'success'
            ])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Jumlah Transaksi Bulanan
        $monthlyTransaction = Transaction::selectRaw("
                MONTH(created_at) as month,
                COUNT(*) as total
            ")
            ->whereIn('status', [
                'settlement',
                'success'
            ])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Top 5 Event Terlaris
        $topEvents = Event::withCount([
            'transactions as sold_ticket' => function ($query) {
                $query->whereIn('status', [
                    'settlement',
                    'success'
                ]);
            }
        ])
            ->orderByDesc('sold_ticket')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Data Grafik ApexCharts
        |--------------------------------------------------------------------------
        */

        $months = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des',
        ];

        // Pendapatan per bulan
        $revenueChart = [];

        foreach ($months as $number => $month) {

            $item = $monthlyRevenue->firstWhere('month', $number);

            $revenueChart[] = $item
                ? (int) $item->total
                : 0;
        }

        // Transaksi per bulan
        $transactionChart = [];

        foreach ($months as $number => $month) {

            $item = $monthlyTransaction->firstWhere('month', $number);

            $transactionChart[] = $item
                ? (int) $item->total
                : 0;
        }

        return view(
            'admin.dashboard',
            compact(
                'totalRevenue',
                'ticketsSold',
                'activeEvents',
                'pendingOrders',
                'totalOrganizers',
                'pendingOrganizers',
                'recentTransactions',
                'topEvents',
                'months',
                'revenueChart',
                'transactionChart'
            )
        );
    }
}