<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'brand_id' => 'required|exists:brands,id',
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'transmission_id' => 'required|exists:transmissions,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
            'is_negotiable' => 'boolean',
            'mileage' => 'required|integer|min:0',
            'color' => 'required|string|max:50',
            'seats' => 'required|integer|min:1|max:20',
            'features' => 'nullable|array',
            'is_for_hire' => 'boolean',
            'seller_name' => 'required|string|max:255',
            'seller_phone' => 'required|string|max:20',
            'seller_whatsapp' => 'nullable|string|max:20',
            'images' => 'array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ];
    }

    public function messages()
    {
        return [
            'brand_id.required' => 'Please select a brand',
            'images.min' => 'Please upload at least one image',
            'images.*.image' => 'Each file must be an image',
            'images.*.max' => 'Each image must not exceed 5MB',
        ];
    }
}
