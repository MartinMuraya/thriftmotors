<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Car;
use App\Models\Payment;
use App\Models\Reservation;
use App\Services\MpesaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function __construct(private readonly MpesaService $mpesa) {}

    /**
     * Create reservation and fire STK Push.
     */
    public function store(StoreReservationRequest $request, Car $car): JsonResponse
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to make a reservation.',
            ], 401);
        }

        // Car must be available
        if ($car->status !== 'available') {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, this car is no longer available for reservation.',
            ], 422);
        }

        $formattedPhone = $this->mpesa->formatPhone($request->phone);

        // Prevent duplicate reservation from same phone
        $exists = Reservation::where('car_id', $car->id)
            ->whereIn('status', ['pending', 'paid'])
            ->where('phone', $formattedPhone)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'You already have an active reservation for this car.',
            ], 422);
        }

        $deposit = (float) config('thriftmotors.deposit_amount', 5000);

        DB::beginTransaction();
        try {
            $reservation = Reservation::create([
                'user_id'       => auth()->id(),
                'car_id'        => $car->id,
                'customer_name' => $request->customer_name,
                'phone'         => $formattedPhone,
                'amount_paid'   => $deposit,
                'status'        => 'pending',
            ]);

            $payment = Payment::create([
                'reservation_id' => $reservation->id,
                'amount'         => $deposit,
                'status'         => 'pending',
            ]);

            $result = $this->mpesa->stkPush(
                phone:       $request->phone,
                amount:      $deposit,
                accountRef:  'CAR-' . $car->id,
                description: 'Car Deposit - ' . $car->title,
            );

            if (isset($result['ResponseCode']) && $result['ResponseCode'] === '0') {
                $payment->update([
                    'checkout_request_id' => $result['CheckoutRequestID'],
                    'merchant_request_id' => $result['MerchantRequestID'],
                ]);

                DB::commit();

                return response()->json([
                    'success'        => true,
                    'message'        => 'M-Pesa prompt sent! Enter your PIN on your phone to complete.',
                    'reservation_id' => $reservation->id,
                    'whatsapp_url'   => $this->whatsappUrl($car, $request->customer_name),
                ]);
            }

            // STK Push rejected — roll back
            $payment->update(['status' => 'failed']);
            $reservation->update(['status' => 'cancelled']);
            DB::commit();

            return response()->json([
                'success' => false,
                'message' => $result['errorMessage'] ?? 'M-Pesa payment failed. Check your phone number and try again.',
            ], 422);

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ReservationController@store', ['error' => $e->getMessage(), 'car' => $car->id]);

            return response()->json([
                'success' => false,
                'message' => 'Payment service unavailable. Please try again shortly.',
            ], 500);
        }
    }

    /**
     * Poll reservation payment status (called from frontend JS every 5 s).
     */
    public function checkStatus(Reservation $reservation): JsonResponse
    {
        return response()->json([
            'status'     => $reservation->status,
            'paid'       => $reservation->status === 'paid',
            'expires_at' => $reservation->expires_at?->format('d M Y'),
        ]);
    }

    private function whatsappUrl(Car $car, string $name): string
    {
        $raw     = preg_replace('/\D/', '', $car->seller_whatsapp ?? $car->seller_phone);
        $message = urlencode(
            "Hi, I'm {$name}. I just paid a deposit for the {$car->title} on ThriftMotors. Please advise on next steps."
        );

        return "https://wa.me/{$raw}?text={$message}";
    }
}
