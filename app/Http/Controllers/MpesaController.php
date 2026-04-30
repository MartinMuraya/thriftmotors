<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller
{
    /**
     * Handle M-Pesa STK Push callback.
     * Must be publicly accessible — registered in api.php (CSRF-exempt).
     */
    public function callback(Request $request)
    {
        $payload = $request->all();
        Log::info('M-Pesa Callback', $payload);

        $body = $payload['Body']['stkCallback'] ?? null;

        if (! $body) {
            // Malformed — acknowledge to stop Safaricom retries
            return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Accepted']);
        }

        $resultCode        = $body['ResultCode'];
        $checkoutRequestId = $body['CheckoutRequestID'];

        $payment = Payment::where('checkout_request_id', $checkoutRequestId)
            ->with('reservation.car')
            ->first();

        if (! $payment) {
            Log::warning('M-Pesa Callback: no matching payment', compact('checkoutRequestId'));
            return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Accepted']);
        }

        // Idempotency — skip already-processed payments
        if ($payment->status === 'paid') {
            return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Accepted']);
        }

        // Always persist raw callback for audit
        $payment->update(['raw_callback' => $payload]);

        if ($resultCode === 0) {
            // ✅ Payment successful
            $items   = collect($body['CallbackMetadata']['Item'] ?? []);
            $receipt = $items->firstWhere('Name', 'MpesaReceiptNumber')['Value'] ?? null;
            $amount  = $items->firstWhere('Name', 'Amount')['Value'] ?? $payment->amount;

            $payment->update([
                'status'        => 'paid',
                'mpesa_receipt' => $receipt,
                'amount'        => $amount,
            ]);

            $reservation = $payment->reservation;
            if ($reservation) {
                $days = (int) config('thriftmotors.reservation_days', 14);

                $reservation->update([
                    'status'      => 'paid',
                    'amount_paid' => $amount,
                    'expires_at'  => now()->addDays($days),
                ]);

                $reservation->car?->update(['status' => 'reserved']);

                Log::info('M-Pesa: Car reserved', [
                    'car_id'        => $reservation->car_id,
                    'receipt'       => $receipt,
                    'expires_at'    => $reservation->expires_at,
                ]);
            }
        } else {
            // ❌ Payment failed or cancelled by user
            $payment->update(['status' => 'failed']);

            $reservation = $payment->reservation;
            if ($reservation && $reservation->status === 'pending') {
                $reservation->update(['status' => 'cancelled']);
            }

            Log::info('M-Pesa: Payment not completed', [
                'ResultCode' => $resultCode,
                'ResultDesc' => $body['ResultDesc'] ?? '',
            ]);
        }

        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Accepted']);
    }
}
