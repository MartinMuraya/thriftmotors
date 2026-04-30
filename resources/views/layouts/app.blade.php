<!DOCTYPE html>
<html lang="en" x-data="themeManager()" :class="{ 'dark': isDark }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ThriftMotors - Your Premium Car Marketplace')</title>
    
    <!-- FOUC Prevention Script -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'thrift-red': '#DC2626',
                        'thrift-dark': '#1F2937',
                    }
                }
            }
        }
    </script>
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-200 transition-colors duration-200 antialiased">
    <!-- Navigation -->
    <nav class="sticky top-0 z-40 bg-white dark:bg-gray-800 shadow-md border-b border-transparent dark:border-gray-700 transition-colors duration-200" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-red-600 dark:text-red-500">
                        <i class="fas fa-car"></i> ThriftMotors
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="py-5 hover:text-red-600 dark:hover:text-red-400 transition {{ request()->routeIs('home') ? 'border-b-2 border-red-600 text-red-600 dark:text-red-400 dark:border-red-400 font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Home</a>
                    <a href="{{ route('cars.index') }}" class="py-5 hover:text-red-600 dark:hover:text-red-400 transition {{ request()->routeIs('cars.index') ? 'border-b-2 border-red-600 text-red-600 dark:text-red-400 dark:border-red-400 font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Buy a Car</a>
                    <a href="{{ route('cars.hire') }}" class="py-5 hover:text-red-600 dark:hover:text-red-400 transition {{ request()->routeIs('cars.hire') ? 'border-b-2 border-red-600 text-red-600 dark:text-red-400 dark:border-red-400 font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Hire a Car</a>
                    <a href="{{ route('services') }}" class="py-5 hover:text-red-600 dark:hover:text-red-400 transition {{ request()->routeIs('services') ? 'border-b-2 border-red-600 text-red-600 dark:text-red-400 dark:border-red-400 font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Services</a>
                    <a href="{{ route('contact') }}" class="py-5 hover:text-red-600 dark:hover:text-red-400 transition {{ request()->routeIs('contact') ? 'border-b-2 border-red-600 text-red-600 dark:text-red-400 dark:border-red-400 font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Contact</a>
                </div>

                <!-- Right Side -->
                <div class="hidden md:flex items-center space-x-4">
                    <!-- Dark Mode Toggle -->
                    <button @click="toggleTheme()" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="fas fa-sun" x-show="isDark" x-cloak></i>
                        <i class="fas fa-moon" x-show="!isDark" x-cloak></i>
                    </button>

                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-red-600 dark:text-red-500 font-semibold hover:text-red-700 dark:hover:text-red-400">Admin Dashboard</a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="text-red-600 dark:text-red-500 font-semibold hover:text-red-700 dark:hover:text-red-400">My Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 transition">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 transition">Login</a>
                        <a href="{{ route('register') }}" class="bg-red-600 text-white px-4 py-2 rounded-full hover:bg-red-700 transition font-semibold">Sign Up</a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden space-x-2">
                    <button @click="toggleTheme()" class="text-gray-500 dark:text-gray-400 p-2">
                        <i class="fas fa-sun" x-show="isDark" x-cloak></i>
                        <i class="fas fa-moon" x-show="!isDark" x-cloak></i>
                    </button>
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white focus:outline-none p-2">
                        <i class="fas fa-bars text-2xl" x-show="!mobileMenuOpen"></i>
                        <i class="fas fa-times text-2xl" x-show="mobileMenuOpen" x-cloak></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="mobileMenuOpen" x-collapse x-cloak class="md:hidden bg-white dark:bg-gray-800 border-t dark:border-gray-700">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">Home</a>
                <a href="{{ route('cars.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('cars.index') ? 'bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">Buy a Car</a>
                <a href="{{ route('cars.hire') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('cars.hire') ? 'bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">Hire a Car</a>
                <a href="{{ route('services') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('services') ? 'bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">Services</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('contact') ? 'bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">Contact</a>
            </div>
            <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700">
                <div class="px-4 flex items-center justify-between">
                    @auth
                        <div>
                            <div class="text-base font-medium text-gray-800 dark:text-white">{{ auth()->user()->name }}</div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</div>
                        </div>
                    @endauth
                </div>
                <div class="mt-3 px-2 space-y-1">
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-700">Admin Dashboard</a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-700">My Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-700">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-700">Login</a>
                        <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-red-600 dark:text-red-500 hover:bg-gray-50 dark:hover:bg-gray-700">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            @if(session('success'))
                <div class="bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-400 px-4 py-3 rounded relative mb-4 shadow-sm">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-400 px-4 py-3 rounded relative mb-4 shadow-sm">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
        </div>

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16 py-8 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">ThriftMotors</h3>
                    <p class="text-gray-400">Premium car marketplace for finding your perfect vehicle.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('cars.index') }}" class="hover:text-white transition">Buy a Car</a></li>
                        <li><a href="{{ route('cars.hire') }}" class="hover:text-white transition">Hire a Car</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact</h4>
                    <p class="text-gray-400">Email: info@thriftmotors.com</p>
                    <p class="text-gray-400">Phone: +254 700 000000</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition text-xl">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition text-xl">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition text-xl">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} ThriftMotors. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Theme Manager Alpine Script -->
    <script>
        function themeManager() {
            return {
                isDark: false,
                init() {
                    this.isDark = localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
                    
                    // Listen for system preference changes
                    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                        if (!localStorage.theme) {
                            this.isDark = e.matches;
                            this.applyTheme();
                        }
                    });
                },
                toggleTheme() {
                    this.isDark = !this.isDark;
                    localStorage.theme = this.isDark ? 'dark' : 'light';
                    this.applyTheme();
                },
                applyTheme() {
                    if (this.isDark) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }
            }
        }
    </script>
    @stack('scripts')
</body>
</html>
