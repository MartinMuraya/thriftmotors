<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Car;
use App\Models\FuelType;
use App\Models\Transmission;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@thriftmotors.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // Create brands
        $brands = [
            ['name' => 'Toyota', 'slug' => 'toyota', 'description' => 'Reliable and fuel-efficient vehicles'],
            ['name' => 'Honda', 'slug' => 'honda', 'description' => 'Performance and quality'],
            ['name' => 'BMW', 'slug' => 'bmw', 'description' => 'Luxury and performance'],
            ['name' => 'Mercedes-Benz', 'slug' => 'mercedes-benz', 'description' => 'Premium luxury vehicles'],
            ['name' => 'Ford', 'slug' => 'ford', 'description' => 'Powerful and durable'],
            ['name' => 'Chevrolet', 'slug' => 'chevrolet', 'description' => 'American classic'],
            ['name' => 'Nissan', 'slug' => 'nissan', 'description' => 'Innovation and reliability'],
            ['name' => 'Volkswagen', 'slug' => 'volkswagen', 'description' => 'German engineering'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }

        // Create fuel types
        $fuelTypes = [
            ['name' => 'Gasoline', 'slug' => 'gasoline'],
            ['name' => 'Diesel', 'slug' => 'diesel'],
            ['name' => 'Hybrid', 'slug' => 'hybrid'],
            ['name' => 'Electric', 'slug' => 'electric'],
        ];

        foreach ($fuelTypes as $fuel) {
            FuelType::create($fuel);
        }

        // Create transmissions
        $transmissions = [
            ['name' => 'Manual', 'slug' => 'manual'],
            ['name' => 'Automatic', 'slug' => 'automatic'],
            ['name' => 'CVT', 'slug' => 'cvt'],
        ];

        foreach ($transmissions as $transmission) {
            Transmission::create($transmission);
        }

        // Create sample cars
        $carData = [
            [
                'brand_id' => 1, // Toyota
                'fuel_type_id' => 1,
                'transmission_id' => 2,
                'title' => '2022 Toyota Camry SE',
                'description' => 'Beautiful and well-maintained Toyota Camry with low mileage. Perfect family car with excellent fuel economy. Features include backup camera, Bluetooth connectivity, and cruise control.',
                'year' => 2022,
                'price' => 24999,
                'is_negotiable' => true,
                'mileage' => 15000,
                'color' => 'Silver',
                'seats' => 5,
                'seller_name' => 'John Smith',
                'seller_phone' => '+1-555-0101',
                'seller_whatsapp' => '+1-555-0101',
                'is_featured' => true,
                'is_hot_deal' => false,
            ],
            [
                'brand_id' => 2, // Honda
                'fuel_type_id' => 1,
                'transmission_id' => 2,
                'title' => '2021 Honda Civic EX',
                'description' => 'Sporty and fuel-efficient Honda Civic. Recently serviced with new tires. Great for commuting or weekend drives. Clean interior, no accidents.',
                'year' => 2021,
                'price' => 22500,
                'is_negotiable' => true,
                'mileage' => 28000,
                'color' => 'Blue',
                'seats' => 5,
                'seller_name' => 'Sarah Johnson',
                'seller_phone' => '+1-555-0102',
                'seller_whatsapp' => '+1-555-0102',
                'is_featured' => false,
                'is_hot_deal' => true,
            ],
            [
                'brand_id' => 3, // BMW
                'fuel_type_id' => 2,
                'transmission_id' => 2,
                'title' => '2019 BMW 3 Series',
                'description' => 'Luxury sedan with premium features. Leather interior, navigation system, premium sound system. Well maintained by single owner.',
                'year' => 2019,
                'price' => 35000,
                'is_negotiable' => false,
                'mileage' => 45000,
                'color' => 'Black',
                'seats' => 5,
                'seller_name' => 'Michael Davis',
                'seller_phone' => '+1-555-0103',
                'seller_whatsapp' => '+1-555-0103',
                'is_featured' => true,
                'is_hot_deal' => false,
            ],
            [
                'brand_id' => 4, // Mercedes-Benz
                'fuel_type_id' => 2,
                'transmission_id' => 2,
                'title' => '2020 Mercedes-Benz C-Class',
                'description' => 'Premium luxury vehicle with latest technology. Panoramic sunroof, advanced safety features, and elegant design.',
                'year' => 2020,
                'price' => 45000,
                'is_negotiable' => true,
                'mileage' => 32000,
                'color' => 'White',
                'seats' => 5,
                'seller_name' => 'Robert Wilson',
                'seller_phone' => '+1-555-0104',
                'seller_whatsapp' => '+1-555-0104',
                'is_featured' => false,
                'is_hot_deal' => false,
            ],
            [
                'brand_id' => 5, // Ford
                'fuel_type_id' => 1,
                'transmission_id' => 2,
                'title' => '2020 Ford F-150',
                'description' => 'Powerful pickup truck, perfect for work or play. Towing capacity, spacious bed, and comfortable cabin. Well maintained.',
                'year' => 2020,
                'price' => 32000,
                'is_negotiable' => true,
                'mileage' => 38000,
                'color' => 'Red',
                'seats' => 5,
                'seller_name' => 'James Brown',
                'seller_phone' => '+1-555-0105',
                'seller_whatsapp' => '+1-555-0105',
                'is_featured' => false,
                'is_hot_deal' => true,
            ],
            [
                'brand_id' => 1, // Toyota
                'fuel_type_id' => 3,
                'transmission_id' => 2,
                'title' => '2023 Toyota Prius',
                'description' => 'Eco-friendly hybrid vehicle. Excellent fuel economy and smooth ride. Perfect for environmentally conscious buyers.',
                'year' => 2023,
                'price' => 28999,
                'is_negotiable' => false,
                'mileage' => 5000,
                'color' => 'Green',
                'seats' => 5,
                'seller_name' => 'Emma Garcia',
                'seller_phone' => '+1-555-0106',
                'seller_whatsapp' => '+1-555-0106',
                'is_featured' => true,
                'is_hot_deal' => false,
            ],
            [
                'brand_id' => 7, // Nissan
                'fuel_type_id' => 1,
                'transmission_id' => 1,
                'title' => '2018 Nissan Altima',
                'description' => 'Reliable midsize sedan. Manual transmission for driving enthusiasts. Good condition with regular maintenance.',
                'year' => 2018,
                'price' => 18500,
                'is_negotiable' => true,
                'mileage' => 62000,
                'color' => 'Gray',
                'seats' => 5,
                'seller_name' => 'Lisa Martinez',
                'seller_phone' => '+1-555-0107',
                'seller_whatsapp' => '+1-555-0107',
                'is_featured' => false,
                'is_hot_deal' => true,
            ],
            [
                'brand_id' => 8, // Volkswagen
                'fuel_type_id' => 2,
                'transmission_id' => 2,
                'title' => '2021 Volkswagen Golf',
                'description' => 'German engineering at its best. Compact sedan with great handling. Recently inspected and certified.',
                'year' => 2021,
                'price' => 21000,
                'is_negotiable' => true,
                'mileage' => 35000,
                'color' => 'White',
                'seats' => 5,
                'seller_name' => 'Thomas Anderson',
                'seller_phone' => '+1-555-0108',
                'seller_whatsapp' => '+1-555-0108',
                'is_featured' => false,
                'is_hot_deal' => false,
            ],
        ];

        foreach ($carData as $car) {
            Car::create($car);
        }
    }
}
