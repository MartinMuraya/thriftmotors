<!DOCTYPE html>
<html lang="en" x-data="themeManager()" :class="{ 'dark': isDark }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'ThriftMotors - Your Premium Car Marketplace'); ?></title>
    
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
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-200 transition-colors duration-200 antialiased">
    <!-- Navigation -->
    <nav class="sticky top-0 z-40 bg-white dark:bg-gray-800 shadow-md border-b border-transparent dark:border-gray-700 transition-colors duration-200" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="<?php echo e(route('home')); ?>" class="text-2xl font-bold text-red-600 dark:text-red-500">
                        <i class="fas fa-car"></i> ThriftMotors
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="<?php echo e(route('home')); ?>" class="py-5 hover:text-red-600 dark:hover:text-red-400 transition <?php echo e(request()->routeIs('home') ? 'border-b-2 border-red-600 text-red-600 dark:text-red-400 dark:border-red-400 font-semibold' : 'text-gray-700 dark:text-gray-300'); ?>">Home</a>
                    <a href="<?php echo e(route('about')); ?>" class="py-5 hover:text-red-600 dark:hover:text-red-400 transition <?php echo e(request()->routeIs('about') ? 'border-b-2 border-red-600 text-red-600 dark:text-red-400 dark:border-red-400 font-semibold' : 'text-gray-700 dark:text-gray-300'); ?>">About Us</a>
                    
                    
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="py-5 flex items-center hover:text-red-600 dark:hover:text-red-400 transition <?php echo e(request()->routeIs('services') || request()->routeIs('cars.index') || request()->routeIs('cars.hire') ? 'text-red-600 dark:text-red-400 font-semibold' : 'text-gray-700 dark:text-gray-300'); ?>">
                            Services
                            <i class="fas fa-chevron-down ml-1 text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute left-0 mt-0 w-48 bg-white dark:bg-gray-800 shadow-xl py-2 border border-gray-100 dark:border-gray-700 z-50">
                            <a href="<?php echo e(route('cars.index')); ?>" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 <?php echo e(request()->routeIs('cars.index') ? 'text-red-600 font-bold' : ''); ?>">
                                <i class="fas fa-shopping-cart mr-2 text-xs opacity-50"></i> Buy a Car
                            </a>
                            <a href="<?php echo e(route('cars.hire')); ?>" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 <?php echo e(request()->routeIs('cars.hire') ? 'text-red-600 font-bold' : ''); ?>">
                                <i class="fas fa-key mr-2 text-xs opacity-50"></i> Hire a Car
                            </a>
                            <div class="border-t dark:border-gray-700 my-1"></div>
                            <a href="<?php echo e(route('services')); ?>" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <i class="fas fa-concierge-bell mr-2 text-xs opacity-50"></i> All Services
                            </a>
                        </div>
                    </div>

                    <a href="<?php echo e(route('contact')); ?>" class="py-5 hover:text-red-600 dark:hover:text-red-400 transition <?php echo e(request()->routeIs('contact') ? 'border-b-2 border-red-600 text-red-600 dark:text-red-400 dark:border-red-400 font-semibold' : 'text-gray-700 dark:text-gray-300'); ?>">Contact</a>
                </div>

                <!-- Right Side -->
                <div class="hidden md:flex items-center space-x-4">
                    <!-- Dark Mode Toggle -->
                    <button @click="toggleTheme()" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="fas fa-sun" x-show="isDark" x-cloak></i>
                        <i class="fas fa-moon" x-show="!isDark" x-cloak></i>
                    </button>

                    <?php if(auth()->guard()->check()): ?>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 focus:outline-none">
                                <img src="<?php echo e(auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&color=7F9CF5&background=EBF4FF'); ?>" 
                                     alt="<?php echo e(auth()->user()->name); ?>" 
                                     class="w-8 h-8 rounded-full border border-gray-200 dark:border-gray-700 object-cover">
                                <span class="font-semibold"><?php echo e(auth()->user()->name); ?></span>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                            </button>

                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-xl py-2 border border-gray-100 dark:border-gray-700 z-50">
                                
                                <div class="px-4 py-2 border-b dark:border-gray-700">
                                    <p class="text-sm font-semibold dark:text-white"><?php echo e(auth()->user()->name); ?></p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate"><?php echo e(auth()->user()->email); ?></p>
                                </div>

                                <?php if(auth()->user()->is_admin): ?>
                                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <i class="fas fa-chart-line mr-2"></i> Admin Dashboard
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('user.dashboard')); ?>" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <i class="fas fa-tachometer-alt mr-2"></i> My Dashboard
                                    </a>
                                <?php endif; ?>

                                <a href="<?php echo e(route('user.profile.edit')); ?>" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <i class="fas fa-user-edit mr-2"></i> My Profile
                                </a>

                                <a href="<?php echo e(route('user.settings')); ?>" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <i class="fas fa-cog mr-2"></i> Settings
                                </a>

                                <div class="border-t dark:border-gray-700 mt-2"></div>

                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/10">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="text-gray-600 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 transition">Login</a>
                        <a href="<?php echo e(route('register')); ?>" class="bg-red-600 text-white px-4 py-2 rounded-full hover:bg-red-700 transition font-semibold">Sign Up</a>
                    <?php endif; ?>
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
                <a href="<?php echo e(route('home')); ?>" class="block px-3 py-2 rounded-md text-base font-medium <?php echo e(request()->routeIs('home') ? 'bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'); ?>">Home</a>
                <a href="<?php echo e(route('about')); ?>" class="block px-3 py-2 rounded-md text-base font-medium <?php echo e(request()->routeIs('about') ? 'bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'); ?>">About Us</a>
                
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <span>Services</span>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                    </button>
                    <div x-show="open" x-collapse class="pl-4 space-y-1">
                        <a href="<?php echo e(route('cars.index')); ?>" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-red-600">Buy a Car</a>
                        <a href="<?php echo e(route('cars.hire')); ?>" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-red-600">Hire a Car</a>
                        <a href="<?php echo e(route('services')); ?>" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-red-600">All Services</a>
                    </div>
                </div>

                <a href="<?php echo e(route('contact')); ?>" class="block px-3 py-2 rounded-md text-base font-medium <?php echo e(request()->routeIs('contact') ? 'bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'); ?>">Contact</a>
            </div>
            <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700">
                <div class="px-4 flex items-center justify-between">
                    <?php if(auth()->guard()->check()): ?>
                        <div>
                            <div class="text-base font-medium text-gray-800 dark:text-white"><?php echo e(auth()->user()->name); ?></div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400"><?php echo e(auth()->user()->email); ?></div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mt-3 px-2 space-y-1">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->is_admin): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-700">Admin Dashboard</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('user.dashboard')); ?>" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-700">My Dashboard</a>
                        <?php endif; ?>
                        
                        <a href="<?php echo e(route('user.profile.edit')); ?>" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                            My Profile
                        </a>

                        <a href="<?php echo e(route('user.settings')); ?>" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Settings
                        </a>

                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="block">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-700">Logout</button>
                        </form>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-700">Login</a>
                        <a href="<?php echo e(route('register')); ?>" class="block px-3 py-2 rounded-md text-base font-medium text-red-600 dark:text-red-500 hover:bg-gray-50 dark:hover:bg-gray-700">Sign Up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <?php if(session('success')): ?>
                <div x-data="{ show: true }" 
                     x-show="show" 
                     x-init="setTimeout(() => show = false, 8000)"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-400 px-4 py-3 rounded relative mb-4 shadow-sm flex justify-between items-center">
                    <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                    <button @click="show = false" class="text-green-700 dark:text-green-400 hover:text-green-900 dark:hover:text-white transition">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div x-data="{ show: true }" 
                     x-show="show" 
                     x-init="setTimeout(() => show = false, 8000)"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-400 px-4 py-3 rounded relative mb-4 shadow-sm flex justify-between items-center">
                    <span class="block sm:inline"><?php echo e(session('error')); ?></span>
                    <button @click="show = false" class="text-red-700 dark:text-red-400 hover:text-red-900 dark:hover:text-white transition">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            <?php endif; ?>
        </div>

        <?php if(!request()->routeIs('home')): ?>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                <button onclick="history.back()" class="flex items-center text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition font-semibold group">
                    <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition-transform"></i>
                    Back
                </button>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-900 text-gray-800 dark:text-white mt-16 py-12 border-t border-gray-200 dark:border-gray-800 transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 mb-12">
                <div class="space-y-4">
                    <h3 class="text-xl font-bold text-red-600 dark:text-red-500">ThriftMotors</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">Your premium marketplace for quality vehicles. We bring transparency and trust to your car buying experience.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-6 text-gray-900 dark:text-white uppercase tracking-wider text-sm">Quick Links</h4>
                    <ul class="space-y-3 text-gray-600 dark:text-gray-400">
                        <li><a href="<?php echo e(route('home')); ?>" class="hover:text-red-600 dark:hover:text-red-400 transition flex items-center"><i class="fas fa-chevron-right text-xs mr-2 opacity-50"></i>Home</a></li>
                        <li><a href="<?php echo e(route('cars.index')); ?>" class="hover:text-red-600 dark:hover:text-red-400 transition flex items-center"><i class="fas fa-chevron-right text-xs mr-2 opacity-50"></i>Buy a Car</a></li>
                        <li><a href="<?php echo e(route('cars.hire')); ?>" class="hover:text-red-600 dark:hover:text-red-400 transition flex items-center"><i class="fas fa-chevron-right text-xs mr-2 opacity-50"></i>Hire a Car</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6 text-gray-900 dark:text-white uppercase tracking-wider text-sm">Contact Us</h4>
                    <ul class="space-y-3 text-gray-600 dark:text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3 text-red-600 dark:text-red-500"></i>
                            <span>info@thriftmotors.com</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone mt-1 mr-3 text-red-600 dark:text-red-500"></i>
                            <span>+254 700 000000</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6 text-gray-900 dark:text-white uppercase tracking-wider text-sm">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-red-600 hover:text-white dark:hover:bg-red-600 dark:hover:text-white transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-red-600 hover:text-white dark:hover:bg-red-600 dark:hover:text-white transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-red-600 hover:text-white dark:hover:bg-red-600 dark:hover:text-white transition">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-200 dark:border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-gray-500 dark:text-gray-500 text-sm">
                <p>&copy; <?php echo e(date('Y')); ?> ThriftMotors. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-red-600 dark:hover:text-red-400 transition">Privacy Policy</a>
                    <a href="#" class="hover:text-red-600 dark:hover:text-red-400 transition">Terms of Service</a>
                </div>
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
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH F:\thriftmotors\resources\views/layouts/app.blade.php ENDPATH**/ ?>