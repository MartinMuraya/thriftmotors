<?php $__env->startSection('title', 'Cars for Hire - ThriftMotors'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold dark:text-white">Cars Available for Hire</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Find the perfect rental for your next journey.</p>
        </div>
    </div>

    <?php if($cars->count() > 0): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-transparent dark:border-gray-700 overflow-hidden hover:shadow-md dark:hover:shadow-red-900/20 transition group">
                    <a href="<?php echo e(route('cars.show', $car->slug)); ?>" class="block relative h-48 overflow-hidden">
                        <?php if($car->primaryImage): ?>
                            <img src="<?php echo e($car->primaryImage->image_url); ?>" alt="<?php echo e($car->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        <?php else: ?>
                            <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <i class="fas fa-car text-gray-400 dark:text-gray-500 text-4xl"></i>
                            </div>
                        <?php endif; ?>
                        <div class="absolute top-2 right-2 flex flex-col gap-2">
                            <span class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded shadow">For Hire</span>
                        </div>
                    </a>
                    
                    <div class="p-4">
                        <div class="text-xs text-gray-500 dark:text-gray-400 mb-1 font-semibold uppercase tracking-wider"><?php echo e($car->brand->name ?? 'Unknown'); ?></div>
                        <h3 class="font-bold text-gray-900 dark:text-white mb-2 truncate">
                            <a href="<?php echo e(route('cars.show', $car->slug)); ?>" class="hover:text-red-600 transition"><?php echo e($car->title); ?></a>
                        </h3>
                        <div class="text-lg font-bold text-red-600 dark:text-red-500 mb-4">
                            KES <?php echo e(number_format($car->price)); ?> <span class="text-sm text-gray-500 dark:text-gray-400 font-normal">/ day</span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2 text-xs text-gray-600 dark:text-gray-400 border-t border-gray-100 dark:border-gray-700 pt-3">
                            <div class="flex items-center"><i class="fas fa-gas-pump w-4"></i> <?php echo e($car->fuelType->name ?? 'N/A'); ?></div>
                            <div class="flex items-center"><i class="fas fa-cogs w-4"></i> <?php echo e($car->transmission->name ?? 'N/A'); ?></div>
                            <div class="flex items-center"><i class="fas fa-users w-4"></i> <?php echo e($car->seats); ?> Seats</div>
                            <div class="flex items-center"><i class="fas fa-calendar w-4"></i> <?php echo e($car->year); ?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <div class="mt-8">
            <?php echo e($cars->links()); ?>

        </div>
    <?php else: ?>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-transparent dark:border-gray-700 p-12 text-center">
            <i class="fas fa-search text-gray-300 dark:text-gray-600 text-5xl mb-4"></i>
            <h3 class="text-xl font-bold text-gray-700 dark:text-gray-300 mb-2">No cars available for hire</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">Check back later or browse cars available for purchase.</p>
            <a href="<?php echo e(route('cars.index')); ?>" class="bg-red-600 text-white px-6 py-2 rounded-full font-semibold hover:bg-red-700 transition">
                Browse Cars for Sale
            </a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\thriftmotors\resources\views/pages/cars-hire.blade.php ENDPATH**/ ?>