<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Inquiry;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(): View
    {
        $totalCars = Car::count();
        $activeCars = Car::where('is_active', true)->count();
        $totalInquiries = Inquiry::count();
        $unreadInquiries = Inquiry::where('is_read', false)->count();

        $recentCars = Car::with(['brand', 'images'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentInquiries = Inquiry::with('car')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalCars',
            'activeCars',
            'totalInquiries',
            'unreadInquiries',
            'recentCars',
            'recentInquiries'
        ));
    }
}
