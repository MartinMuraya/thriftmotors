<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with(['car.brand', 'latestPayment'])
            ->orderBy('created_at', 'desc');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $reservations = $query->paginate(15);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['car.brand', 'payments']);

        return view('admin.reservations.show', compact('reservation'));
    }

    public function markSold(Reservation $reservation)
    {
        $reservation->update(['status' => 'paid']); // keep as paid (deal done)
        $reservation->car?->update(['status' => 'sold']);

        return back()->with('success', 'Car marked as sold.');
    }

    public function cancel(Reservation $reservation)
    {
        $reservation->update(['status' => 'cancelled']);
        $reservation->car?->update(['status' => 'available']);

        return back()->with('success', 'Reservation cancelled and car restored to available.');
    }
}
