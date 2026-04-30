<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ExpireReservations extends Command
{
    protected $signature   = 'reservations:expire';
    protected $description = 'Expire paid reservations past their 14-day window and restore car availability';

    public function handle(): int
    {
        $expired = Reservation::where('status', 'paid')
            ->where('expires_at', '<', now())
            ->with('car')
            ->get();

        $count = 0;
        foreach ($expired as $reservation) {
            $reservation->update(['status' => 'expired']);

            // Only restore car if it is still in reserved state
            if ($reservation->car && $reservation->car->status === 'reserved') {
                $reservation->car->update(['status' => 'available']);
            }

            $count++;
        }

        $msg = "Expired {$count} reservation(s).";
        $this->info($msg);
        Log::info("ExpireReservations: {$msg}");

        return self::SUCCESS;
    }
}
