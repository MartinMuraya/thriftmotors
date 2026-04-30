<?php

return [
    /*
    |--------------------------------------------------------------------------
    | M-Pesa API Credentials
    |--------------------------------------------------------------------------
    | Get these from https://developer.safaricom.co.ke
    | Sandbox short code: 174379
    | Sandbox passkey is provided in the developer portal
    */

    'consumer_key'    => env('MPESA_CONSUMER_KEY', ''),
    'consumer_secret' => env('MPESA_CONSUMER_SECRET', ''),

    // Paybill or Till Number
    'short_code'      => env('MPESA_SHORT_CODE', '174379'),

    // Lipa Na M-Pesa passkey from Safaricom Developer Portal
    'passkey'         => env('MPESA_PASSKEY', 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919'),

    // Must be a publicly accessible HTTPS URL (use ngrok for local testing)
    'callback_url'    => env('MPESA_CALLBACK_URL', env('APP_URL').'/api/mpesa/callback'),

    // Set to false in production
    'sandbox'         => env('MPESA_SANDBOX', true),
];
