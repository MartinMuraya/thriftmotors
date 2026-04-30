<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarImage;
use App\Models\FuelType;
use App\Models\Transmission;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarController extends Controller
{
    /**
     * Display a listing of cars.
     */
    public function index(): View
    {
        $cars = Car::with(['brand', 'fuelType', 'transmission', 'images'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new car.
     */
    public function create(): View
    {
        $brands = Brand::all();
        $fuelTypes = FuelType::all();
        $transmissions = Transmission::all();

        return view('admin.cars.create', compact('brands', 'fuelTypes', 'transmissions'));
    }

    /**
     * Store a newly created car in storage.
     */
    public function store(StoreCarRequest $request)
    {
        $car = Car::create($request->validated());

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('cars', 'public');
                
                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $path,
                    'image_url' => '/storage/' . $path,
                    'sort_order' => $index,
                    'is_primary' => $index === 0,
                ]);
            }
        }

        return redirect()
            ->route('admin.cars.show', $car)
            ->with('success', 'Car listing created successfully!');
    }

    /**
     * Display the specified car.
     */
    public function show(Car $car): View
    {
        $car->load(['brand', 'fuelType', 'transmission', 'images', 'inquiries']);

        return view('admin.cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified car.
     */
    public function edit(Car $car): View
    {
        $car->load(['brand', 'fuelType', 'transmission', 'images']);
        $brands = Brand::all();
        $fuelTypes = FuelType::all();
        $transmissions = Transmission::all();

        return view('admin.cars.edit', compact('car', 'brands', 'fuelTypes', 'transmissions'));
    }

    /**
     * Update the specified car in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $car->update($request->validated());

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $currentImageCount = $car->images()->count();
            
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('cars', 'public');
                
                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $path,
                    'image_url' => '/storage/' . $path,
                    'sort_order' => $currentImageCount + $index,
                ]);
            }
        }

        return redirect()
            ->route('admin.cars.show', $car)
            ->with('success', 'Car listing updated successfully!');
    }

    /**
     * Remove the specified car from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()
            ->route('admin.cars.index')
            ->with('success', 'Car listing deleted successfully!');
    }

    /**
     * Toggle featured status.
     */
    public function toggleFeatured(Car $car)
    {
        $car->update(['is_featured' => !$car->is_featured]);

        return back()->with('success', 'Featured status updated!');
    }

    /**
     * Toggle hot deal status.
     */
    public function toggleHotDeal(Car $car)
    {
        $car->update(['is_hot_deal' => !$car->is_hot_deal]);

        return back()->with('success', 'Hot deal status updated!');
    }

    /**
     * Toggle active status.
     */
    public function toggleActive(Car $car)
    {
        $car->update(['is_active' => !$car->is_active]);

        return back()->with('success', 'Active status updated!');
    }
}
