<?php $__env->startSection('title', 'Our Services - ThriftMotors'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 py-16">
    <div class="text-center mb-16">
        <h1 class="text-4xl font-bold mb-4 dark:text-white">Our Services</h1>
        <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Whether you are looking to purchase your dream car or simply need a reliable ride for the weekend, ThriftMotors has you covered.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Buy a Car -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-transparent dark:border-gray-700 transition transform hover:-translate-y-1 hover:shadow-xl dark:hover:shadow-red-900/20">
            <div class="h-64 bg-gray-200 dark:bg-gray-700 relative">
                <!-- Fallback background image -->
                <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Buy a Car" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                    <h2 class="text-3xl font-bold text-white tracking-wider">BUY A CAR</h2>
                </div>
            </div>
            <div class="p-8 text-center">
                <p class="text-gray-600 dark:text-gray-300 mb-6">Browse our extensive inventory of premium, thoroughly inspected vehicles available for immediate purchase. Find exactly what you need at the best prices.</p>
                <a href="<?php echo e(route('cars.index')); ?>" class="inline-block bg-red-600 text-white font-bold py-3 px-8 rounded-full hover:bg-red-700 transition">
                    View Cars for Sale
                </a>
            </div>
        </div>

        <!-- Hire a Car -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-transparent dark:border-gray-700 transition transform hover:-translate-y-1 hover:shadow-xl dark:hover:shadow-red-900/20">
            <div class="h-64 bg-gray-200 dark:bg-gray-700 relative">
                <!-- Fallback background image -->
                <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Hire a Car" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                    <h2 class="text-3xl font-bold text-white tracking-wider">HIRE A CAR</h2>
                </div>
            </div>
            <div class="p-8 text-center">
                <p class="text-gray-600 dark:text-gray-300 mb-6">Need a car for a short trip, business meeting, or special event? Explore our fleet of luxury and economy rentals tailored for your mobility needs.</p>
                <a href="<?php echo e(route('cars.hire')); ?>" class="inline-block bg-blue-600 text-white font-bold py-3 px-8 rounded-full hover:bg-blue-700 transition">
                    View Cars for Hire
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\thriftmotors\resources\views/pages/services.blade.php ENDPATH**/ ?>