<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:255'],
            'phone'         => ['required', 'string', 'regex:/^(?:\+254|0)[17]\d{8}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'Enter a valid Kenyan phone number (e.g. 0712345678 or +254712345678).',
        ];
    }
}
