

<?php $__env->startSection('page-title', $car->title); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold dark:text-white"><?php echo e($car->title); ?></h2>
        <div class="flex gap-3">
            <a href="<?php echo e(route('admin.cars.edit', $car)); ?>" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 transition">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <form action="<?php echo e(route('admin.cars.destroy', $car)); ?>" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                    <i class="fas fa-trash mr-2"></i> Delete
                </button>
            </form>
        </div>
    </div>

    <!-- Basic Details -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Images -->
        <div class="md:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-transparent dark:border-gray-700 transition-colors duration-300">
                <div class="bg-gray-100 dark:bg-gray-900/50 p-4 text-center">
                    <?php if($car->images->count() > 0): ?>
                        <img src="<?php echo e($car->images->first()->image_url); ?>" alt="<?php echo e($car->title); ?>" class="w-full max-h-96 object-cover">
                    <?php else: ?>
                        <div class="py-16">
                            <i class="fas fa-image text-gray-400 dark:text-gray-600 text-6xl"></i>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if($car->images->count() > 1): ?>
                    <div class="p-4 grid grid-cols-6 gap-2">
                        <?php $__currentLoopData = $car->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img src="<?php echo e($image->image_url); ?>" alt="" class="w-full h-16 object-cover rounded cursor-pointer hover:opacity-70">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Status Cards -->
        <div class="space-y-4">
            <!-- Price Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
                <p class="text-gray-600 dark:text-gray-400 text-sm">Listed Price</p>
                <p class="text-3xl font-bold text-red-600 dark:text-red-500 mb-2">KES <?php echo e(number_format($car->price, 0)); ?></p>
                <?php if($car->is_negotiable): ?>
                    <span class="inline-block bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 px-3 py-1 rounded text-sm">✓ Negotiable</span>
                <?php endif; ?>
            </div>

            <!-- Status Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
                <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold mb-3">Status</p>
                <?php if($car->is_active): ?>
                    <form action="<?php echo e(route('admin.cars.toggle-active', $car)); ?>" method="POST" class="mb-2">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full block bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 px-3 py-2 rounded text-sm hover:bg-green-200 dark:hover:bg-green-900/50 transition">
                            ✓ Active - Click to Deactivate
                        </button>
                    </form>
                <?php else: ?>
                    <form action="<?php echo e(route('admin.cars.toggle-active', $car)); ?>" method="POST" class="mb-2">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full block bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 px-3 py-2 rounded text-sm hover:bg-red-200 dark:hover:bg-red-900/50 transition">
                            ✗ Inactive - Click to Activate
                        </button>
                    </form>
                <?php endif; ?>
            </div>

            <!-- Featured Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
                <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold mb-3">Featured Status</p>
                <?php if($car->is_hot_deal): ?>
                    <form action="<?php echo e(route('admin.cars.toggle-hot-deal', $car)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full block bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 px-3 py-2 rounded text-sm hover:bg-red-200 dark:hover:bg-red-900/50 transition mb-2">
                            🔥 Hot Deal - Click to Remove
                        </button>
                    </form>
                <?php elseif($car->is_featured): ?>
                    <form action="<?php echo e(route('admin.cars.toggle-featured', $car)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full block bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 px-3 py-2 rounded text-sm hover:bg-yellow-200 dark:hover:bg-yellow-900/50 transition mb-2">
                            ⭐ Featured - Click to Remove
                        </button>
                    </form>
                <?php else: ?>
                    <form action="<?php echo e(route('admin.cars.toggle-featured', $car)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full block bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 px-3 py-2 rounded text-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                            Mark as Featured
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Detailed Information -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
            <h3 class="text-lg font-bold mb-4 dark:text-white">Specifications</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Brand:</span>
                    <span class="font-semibold dark:text-white"><?php echo e($car->brand->name); ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Year:</span>
                    <span class="font-semibold dark:text-white"><?php echo e($car->year); ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Mileage:</span>
                    <span class="font-semibold dark:text-white"><?php echo e($car->mileage); ?> km</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Color:</span>
                    <span class="font-semibold dark:text-white"><?php echo e($car->color); ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Fuel Type:</span>
                    <span class="font-semibold dark:text-white"><?php echo e($car->fuelType->name); ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Transmission:</span>
                    <span class="font-semibold dark:text-white"><?php echo e($car->transmission->name); ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Seats:</span>
                    <span class="font-semibold dark:text-white"><?php echo e($car->seats); ?></span>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
            <h3 class="text-lg font-bold mb-4 dark:text-white">Seller Information</h3>
            <div class="space-y-3">
                <div>
                    <span class="text-gray-600 dark:text-gray-400">Name:</span>
                    <p class="font-semibold dark:text-white"><?php echo e($car->seller_name); ?></p>
                </div>
                <div>
                    <span class="text-gray-600 dark:text-gray-400">Phone:</span>
                    <p class="font-semibold"><a href="tel:<?php echo e($car->seller_phone); ?>" class="text-red-600 dark:text-red-400 hover:underline"><?php echo e($car->seller_phone); ?></a></p>
                </div>
                <?php if($car->seller_whatsapp): ?>
                    <div>
                        <span class="text-gray-600 dark:text-gray-400">WhatsApp:</span>
                        <p class="font-semibold"><a href="https://wa.me/<?php echo e(str_replace([' ', '-', '(', ')'], '', $car->seller_whatsapp)); ?>" class="text-green-600 dark:text-green-400 hover:underline" target="_blank"><?php echo e($car->seller_whatsapp); ?></a></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Description -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
        <h3 class="text-lg font-bold mb-4 dark:text-white">Description</h3>
        <p class="text-gray-700 dark:text-gray-300"><?php echo e($car->description); ?></p>
    </div>

    <!-- Inquiries -->
    <?php if($car->inquiries->count() > 0): ?>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
            <h3 class="text-lg font-bold mb-4 dark:text-white">Inquiries (<?php echo e($car->inquiries->count()); ?>)</h3>
            <div class="space-y-3">
                <?php $__currentLoopData = $car->inquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="border dark:border-gray-700 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold dark:text-white"><?php echo e($inquiry->customer_name); ?></p>
                                <p class="text-sm text-gray-600 dark:text-gray-400"><?php echo e($inquiry->customer_email); ?></p>
                                <p class="text-sm text-gray-600 dark:text-gray-400"><?php echo e($inquiry->customer_phone); ?></p>
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1"><?php echo e($inquiry->created_at->format('M d, Y H:i')); ?></p>
                            </div>
                            <a href="<?php echo e(route('admin.inquiries.show', $inquiry)); ?>" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
                                View <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\thriftmotors\resources\views/admin/cars/show.blade.php ENDPATH**/ ?>