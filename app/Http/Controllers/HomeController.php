<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\FuelType;
use App\Models\Transmission;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index(): View
    {
        $featuredCars = Car::where('is_active', true)
            ->where('is_featured', true)
            ->with(['brand', 'fuelType', 'transmission', 'images'])
            ->orderBy('featured_until', 'desc')
            ->limit(6)
            ->get();

        $hotDeals = Car::where('is_active', true)
            ->where('is_hot_deal', true)
            ->with(['brand', 'fuelType', 'transmission', 'images'])
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        $recentCars = Car::where('is_active', true)
            ->with(['brand', 'fuelType', 'transmission', 'images'])
            ->orderBy('created_at', 'desc')
            ->limit(12)
            ->get();

        $brands = Brand::withCount('cars')->get();
        $fuelTypes = FuelType::all();

        return view('pages.home', compact('featuredCars', 'hotDeals', 'recentCars', 'brands', 'fuelTypes'));
    }
}
