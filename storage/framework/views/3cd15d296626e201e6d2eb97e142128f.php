<!DOCTYPE html>
<html lang="en" x-data="themeManager()" :class="{ 'dark': isDark }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin Dashboard - ThriftMotors'); ?></title>
    
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
<body class="bg-gray-100 text-gray-800 dark:bg-gray-950 dark:text-gray-200 antialiased transition-colors duration-200">
    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">
        
        <!-- Mobile Sidebar Backdrop -->
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-black bg-opacity-50 md:hidden" @click="sidebarOpen = false"></div>

        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-900 dark:bg-gray-900 border-r dark:border-gray-800 text-white transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:flex md:flex-col">
            <div class="p-6 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-red-600 dark:text-red-500">
                        <i class="fas fa-car"></i> ThriftMotors
                    </h1>
                    <p class="text-sm text-gray-400 mt-1">Admin Panel</p>
                </div>
                <button @click="sidebarOpen = false" class="md:hidden text-gray-400 hover:text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <nav class="flex-1 px-4 space-y-2 overflow-y-auto">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="block px-4 py-2 rounded hover:bg-gray-800 transition <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-red-500' : ''); ?>">
                    <i class="fas fa-chart-line mr-2 w-5"></i> Dashboard
                </a>
                <a href="<?php echo e(route('admin.cars.index')); ?>" class="block px-4 py-2 rounded hover:bg-gray-800 transition <?php echo e(request()->routeIs('admin.cars.index') ? 'bg-gray-800 text-red-500' : ''); ?>">
                    <i class="fas fa-car mr-2 w-5"></i> Manage Cars
                </a>
                <a href="<?php echo e(route('admin.cars.create')); ?>" class="block px-4 py-2 rounded hover:bg-gray-800 transition <?php echo e(request()->routeIs('admin.cars.create') ? 'bg-gray-800 text-red-500' : ''); ?>">
                    <i class="fas fa-plus mr-2 w-5"></i> Add New Car
                </a>
                <a href="<?php echo e(route('admin.inquiries.index')); ?>" class="block px-4 py-2 rounded hover:bg-gray-800 transition <?php echo e(request()->routeIs('admin.inquiries.*') ? 'bg-gray-800 text-red-500' : ''); ?>">
                    <i class="fas fa-envelope mr-2 w-5"></i> Inquiries
                    <?php $unread = \App\Models\Inquiry::where('is_read', false)->count(); ?>
                    <?php if($unread > 0): ?>
                        <span class="ml-2 bg-red-600 text-white text-xs px-2 py-0.5 rounded"><?php echo e($unread); ?></span>
                    <?php endif; ?>
                </a>
                <a href="<?php echo e(route('admin.reservations.index')); ?>" class="block px-4 py-2 rounded hover:bg-gray-800 transition <?php echo e(request()->routeIs('admin.reservations.*') ? 'bg-gray-800 text-red-500' : ''); ?>">
                    <i class="fas fa-key mr-2 w-5"></i> Reservations
                    <?php $pendingRes = \App\Models\Reservation::where('status', 'pending')->count(); ?>
                    <?php if($pendingRes > 0): ?>
                        <span class="ml-2 bg-orange-500 text-white text-xs px-2 py-0.5 rounded"><?php echo e($pendingRes); ?></span>
                    <?php endif; ?>
                </a>
                <a href="<?php echo e(route('admin.about.index')); ?>" class="block px-4 py-2 rounded hover:bg-gray-800 transition <?php echo e(request()->routeIs('admin.about.*') ? 'bg-gray-800 text-red-500' : ''); ?>">
                    <i class="fas fa-info-circle mr-2 w-5"></i> Manage About Us
                </a>
                <a href="<?php echo e(route('home')); ?>" class="block px-4 py-2 rounded hover:bg-gray-800 transition md:hidden text-gray-300">
                    <i class="fas fa-globe mr-2 w-5"></i> View Site
                </a>
            </nav>

            <div class="p-4 border-t border-gray-800">
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-gray-800 transition">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <div class="bg-white dark:bg-gray-800 border-b border-transparent dark:border-gray-700 shadow-sm h-16 flex items-center px-4 md:px-8 transition-colors duration-200">
                <button @click="sidebarOpen = true" class="md:hidden mr-4 text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                
                <h2 class="text-xl font-semibold dark:text-white truncate"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h2>
                
                <div class="ml-auto flex items-center space-x-4">
                    <!-- Dark Mode Toggle -->
                    <button @click="toggleTheme()" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="fas fa-sun" x-show="isDark" x-cloak></i>
                        <i class="fas fa-moon" x-show="!isDark" x-cloak></i>
                    </button>

                    <a href="<?php echo e(route('home')); ?>" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 hidden sm:block">
                        <i class="fas fa-globe mr-1"></i> View Site
                    </a>
                </div>
            </div>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 md:p-8">
                <?php if(session('success')): ?>
                    <div class="mb-4 p-4 bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-400 rounded">
                        <i class="fas fa-check-circle mr-2"></i><?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="mb-4 p-4 bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-400 rounded">
                        <i class="fas fa-exclamation-circle mr-2"></i><?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>

    <!-- Theme Manager Script -->
    <script>
        function themeManager() {
            return {
                isDark: false,
                init() {
                    this.isDark = localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
                    
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
<?php /**PATH F:\thriftmotors\resources\views/layouts/admin.blade.php ENDPATH**/ ?>