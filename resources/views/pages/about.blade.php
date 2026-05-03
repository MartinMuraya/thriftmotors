@extends('layouts.app')

@section('title', 'About Us - ThriftMotors')

@section('content')
<div class="bg-white dark:bg-gray-900 transition-colors duration-300">
    {{-- Hero Section --}}
    <div class="relative py-20 overflow-hidden bg-gray-900">
        <div class="absolute inset-0 opacity-40">
            <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&q=80&w=2000" alt="About Hero" class="w-full h-full object-cover">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6">Redefining the <span class="text-red-600">Car Marketplace</span></h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
                ThriftMotors is Kenya's premier destination for high-quality vehicles, built on the pillars of transparency, trust, and technological excellence.
            </p>
        </div>
    </div>

    {{-- Mission & Vision --}}
    <div class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-3xl font-bold dark:text-white mb-6 border-l-4 border-red-600 pl-4">Our Mission</h2>
                <p class="text-gray-600 dark:text-gray-400 text-lg leading-relaxed mb-6">
                    To simplify the car buying and hiring process by providing a secure, transparent, and user-centric platform that connects quality vehicles with happy owners. We believe everyone deserves a reliable ride without the stress of traditional car dealerships.
                </p>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center text-red-600">
                            <i class="fas fa-shield-alt text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold dark:text-white">Trusted Transactions</h4>
                            <p class="text-gray-500 text-sm">Verified sellers and secure deposit systems.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center text-red-600">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold dark:text-white">Quality Assurance</h4>
                            <p class="text-gray-500 text-sm">Every car listed meets our strict quality standards.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&q=80&w=1000" alt="Mission" class="rounded-2xl shadow-2xl">
                <div class="absolute -bottom-6 -right-6 bg-red-600 text-white p-8 rounded-2xl shadow-xl hidden md:block">
                    <p class="text-4xl font-bold">10+</p>
                    <p class="text-sm uppercase tracking-wider">Years Experience</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Section --}}
    <div class="bg-gray-50 dark:bg-gray-800/50 py-16 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <p class="text-4xl font-bold text-red-600 mb-2">500+</p>
                    <p class="text-gray-500 dark:text-gray-400 uppercase tracking-widest text-xs">Cars Sold</p>
                </div>
                <div>
                    <p class="text-4xl font-bold text-red-600 mb-2">1.2k</p>
                    <p class="text-gray-500 dark:text-gray-400 uppercase tracking-widest text-xs">Happy Clients</p>
                </div>
                <div>
                    <p class="text-4xl font-bold text-red-600 mb-2">50+</p>
                    <p class="text-gray-500 dark:text-gray-400 uppercase tracking-widest text-xs">Partner Dealers</p>
                </div>
                <div>
                    <p class="text-4xl font-bold text-red-600 mb-2">24/7</p>
                    <p class="text-gray-500 dark:text-gray-400 uppercase tracking-widest text-xs">Customer Support</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Why Choose Us --}}
    <div class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold dark:text-white mb-16">Why Choose <span class="text-red-600">ThriftMotors?</span></h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-transparent dark:border-gray-700 hover:border-red-500 transition duration-300 group">
                <div class="w-16 h-16 bg-red-50 dark:bg-red-900/20 rounded-full flex items-center justify-center text-red-600 mx-auto mb-6 group-hover:scale-110 transition">
                    <i class="fas fa-handshake text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold dark:text-white mb-4">Direct Connection</h3>
                <p class="text-gray-600 dark:text-gray-400">We connect you directly with sellers and hire services, cutting out the unnecessary middleman.</p>
            </div>
            <div class="p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-transparent dark:border-gray-700 hover:border-red-500 transition duration-300 group">
                <div class="w-16 h-16 bg-red-50 dark:bg-red-900/20 rounded-full flex items-center justify-center text-red-600 mx-auto mb-6 group-hover:scale-110 transition">
                    <i class="fas fa-mobile-alt text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold dark:text-white mb-4">M-Pesa Integration</h3>
                <p class="text-gray-600 dark:text-gray-400">Secure your reservation instantly using our seamless M-Pesa STK Push payment system.</p>
            </div>
            <div class="p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-transparent dark:border-gray-700 hover:border-red-500 transition duration-300 group">
                <div class="w-16 h-16 bg-red-50 dark:bg-red-900/20 rounded-full flex items-center justify-center text-red-600 mx-auto mb-6 group-hover:scale-110 transition">
                    <i class="fas fa-search text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold dark:text-white mb-4">Verified Listings</h3>
                <p class="text-gray-600 dark:text-gray-400">Our team verifies every listing to ensure accuracy and prevent fraud on our platform.</p>
            </div>
        </div>
    </div>
</div>
@endsection
