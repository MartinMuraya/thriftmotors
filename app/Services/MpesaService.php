<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MpesaService
{
    private string $consumerKey;
    private string $consumerSecret;
    private string $shortCode;
    private string $passkey;
    private string $callbackUrl;
    private bool   $sandbox;
    private string $baseUrl;

    public function __construct()
    {
        $this->consumerKey    = config('mpesa.consumer_key');
        $this->consumerSecret = config('mpesa.consumer_secret');
        $this->shortCode      = config('mpesa.short_code');
        $this->passkey        = config('mpesa.passkey');
        $this->callbackUrl    = config('mpesa.callback_url');
        $this->sandbox        = (bool) config('mpesa.sandbox', true);
        $this->baseUrl        = $this->sandbox
            ? 'https://sandbox.safaricom.co.ke'
            : 'https://api.safaricom.co.ke';
    }

    /**
     * Get OAuth access token from Safaricom.
     */
    public function getAccessToken(): string
    {
        $credentials = base64_encode("{$this->consumerKey}:{$this->consumerSecret}");

        $response = Http::withHeaders([
            'Authorization' => "Basic {$credentials}",
        ])->get("{$this->baseUrl}/oauth/v1/generate?grant_type=client_credentials");

        if ($response->failed()) {
            Log::error('M-Pesa: Failed to get access token', $response->json() ?? []);
            throw new \RuntimeException('M-Pesa authentication failed. Please try again.');
        }

        return $response->json('access_token');
    }

    /**
     * Initiate Lipa Na M-Pesa Online (STK Push).
     */
    public function stkPush(string $phone, float $amount, string $accountRef, string $description): array
    {
        $token     = $this->getAccessToken();
        $timestamp = now()->format('YmdHis');
        $password  = base64_encode($this->shortCode . $this->passkey . $timestamp);
        $phone     = $this->formatPhone($phone);

        $payload = [
            'BusinessShortCode' => $this->shortCode,
            'Password'          => $password,
            'Timestamp'         => $timestamp,
            'TransactionType'   => 'CustomerPayBillOnline',
            'Amount'            => (int) ceil($amount),
            'PartyA'            => $phone,
            'PartyB'            => $this->shortCode,
            'PhoneNumber'       => $phone,
            'CallBackURL'       => $this->callbackUrl,
            'AccountReference'  => $accountRef,
            'TransactionDesc'   => $description,
        ];

        $response = Http::withToken($token)
            ->post("{$this->baseUrl}/mpesa/stkpush/v1/processrequest", $payload);

        Log::info('M-Pesa STK Push Response', $response->json() ?? []);

        return $response->json() ?? [];
    }

    /**
     * Normalise phone to 254XXXXXXXXX format.
     */
    public function formatPhone(string $phone): string
    {
        $phone = preg_replace('/\D/', '', $phone);

        if (str_starts_with($phone, '0') && strlen($phone) === 10) {
            $phone = '254' . substr($phone, 1);
        }

        return $phone;
    }
}
