<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Event;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with('event');

        // 🔎 SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('order_id', 'like', '%' . $request->search . '%')
                    ->orWhere('customer_name', 'like', '%' . $request->search . '%')
                    ->orWhere('customer_email', 'like', '%' . $request->search . '%');
            });
        }

        // 🎟 EVENT FILTER
        if ($request->event) {
            $query->where('event_id', $request->event);
        }

        // 📊 STATUS FILTER
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // 📅 DATE FILTER
        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $transactions = $query->latest()->paginate(20);
        $transactions->appends($request->all());

        $events = Event::orderBy('title')->get();

        // 📊 STATISTIK
        $totalTransactions = Transaction::count();
        $totalRevenue = Transaction::whereIn('status', ['success', 'settlement'])->sum('total_price');
        $pending = Transaction::where('status', 'pending')->count();
        $success = Transaction::whereIn('status', ['success', 'settlement'])->count();

        return view('admin.transactions.index', compact(
            'transactions',
            'events',
            'totalTransactions',
            'totalRevenue',
            'pending',
            'success'
        ));
    }
}
