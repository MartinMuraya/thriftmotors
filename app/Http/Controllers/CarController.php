<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Models\Brand;
use App\Models\Car;
use App\Models\FuelType;
use App\Models\Inquiry;
use App\Models\Transmission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarController extends Controller
{
    /**
     * Display a listing of cars.
     */
    public function index(Request $request): View
    {
        $query = Car::where('is_active', true)
            ->where('is_for_hire', false)
            ->with(['brand', 'fuelType', 'transmission', 'images']);

        // Filters
        if ($request->has('brand') && $request->brand) {
            $query->whereHas('brand', function ($q) use ($request) {
                $q->where('slug', $request->brand);
            });
        }

        if ($request->has('fuel_type') && $request->fuel_type) {
            $query->whereHas('fuelType', function ($q) use ($request) {
                $q->where('slug', $request->fuel_type);
            });
        }

        if ($request->has('transmission') && $request->transmission) {
            $query->whereHas('transmission', function ($q) use ($request) {
                $q->where('slug', $request->transmission);
            });
        }

        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->has('min_year') && $request->min_year) {
            $query->where('year', '>=', $request->min_year);
        }

        if ($request->has('max_year') && $request->max_year) {
            $query->where('year', '<=', $request->max_year);
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        match ($sort) {
            'price_low' => $query->orderBy('price', 'asc'),
            'price_high' => $query->orderBy('price', 'desc'),
            'oldest' => $query->orderBy('created_at', 'asc'),
            default => $query->orderBy('created_at', 'desc'),
        };

        $cars = $query->paginate(12);
        $brands = Brand::all();
        $fuelTypes = FuelType::all();
        $transmissions = Transmission::all();

        return view('pages.listings', compact('cars', 'brands', 'fuelTypes', 'transmissions'));
    }

    /**
     * Display a single car detail page.
     */
    public function show(string $slug): View
    {
        $car = Car::where('slug', $slug)
            ->where('is_active', true)
            ->with(['brand', 'fuelType', 'transmission', 'images'])
            ->firstOrFail();

        $relatedCars = Car::where('brand_id', $car->brand_id)
            ->where('id', '!=', $car->id)
            ->where('is_active', true)
            ->with(['brand', 'fuelType', 'transmission', 'images'])
            ->limit(6)
            ->get();

        return view('pages.car-detail', compact('car', 'relatedCars'));
    }

    /**
     * Store an inquiry for a car.
     */
    public function storeInquiry(Car $car, StoreInquiryRequest $request)
    {
        Inquiry::create([
            'car_id' => $car->id,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'message' => $request->message,
            'source' => 'form',
        ]);

        return back()->with('success', 'Your inquiry has been sent successfully! The seller will contact you soon.');
    }
}
