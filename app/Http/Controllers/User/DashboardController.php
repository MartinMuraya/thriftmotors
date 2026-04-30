<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $reservations = $user->reservations()->with('car')->orderBy('created_at', 'desc')->get();

        $stats = [
            'total_bookings' => $reservations->count(),
            'active_bookings' => $reservations->whereIn('status', ['pending', 'paid'])->count(),
            'done_deals' => $reservations->where('status', 'sold')->count(),
            'total_spent' => $reservations->whereIn('status', ['paid', 'sold'])->sum('amount_paid'),
        ];

        return view('user.dashboard', compact('reservations', 'stats'));
    }
}
