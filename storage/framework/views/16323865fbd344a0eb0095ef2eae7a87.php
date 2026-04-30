

<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition-colors duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Total Cars</p>
                    <p class="text-3xl font-bold text-red-600 dark:text-red-500"><?php echo e($totalCars); ?></p>
                </div>
                <i class="fas fa-car text-5xl text-gray-200 dark:text-gray-700"></i>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition-colors duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Active Cars</p>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-500"><?php echo e($activeCars); ?></p>
                </div>
                <i class="fas fa-check-circle text-5xl text-gray-200 dark:text-gray-700"></i>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition-colors duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Total Inquiries</p>
                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-500"><?php echo e($totalInquiries); ?></p>
                </div>
                <i class="fas fa-envelope text-5xl text-gray-200 dark:text-gray-700"></i>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition-colors duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Unread Inquiries</p>
                    <p class="text-3xl font-bold text-orange-600 dark:text-orange-500"><?php echo e($unreadInquiries); ?></p>
                </div>
                <i class="fas fa-bell text-5xl text-gray-200 dark:text-gray-700"></i>
            </div>
        </div>
    </div>

    <!-- Recent Cars -->
    <!-- Recent Cars -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-transparent dark:border-gray-700 transition-colors duration-300">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold dark:text-white">Recent Cars</h2>
            <a href="<?php echo e(route('admin.cars.create')); ?>" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                <i class="fas fa-plus mr-2"></i> Add Car
            </a>
        </div>

        <?php if($recentCars->count() > 0): ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b dark:border-gray-700">
                        <tr>
                            <th class="text-left py-3 px-4 dark:text-gray-300">Car</th>
                            <th class="text-left py-3 px-4 dark:text-gray-300">Brand</th>
                            <th class="text-left py-3 px-4 dark:text-gray-300">Price</th>
                            <th class="text-left py-3 px-4 dark:text-gray-300">Status</th>
                            <th class="text-left py-3 px-4 dark:text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $recentCars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="py-3 px-4">
                                    <div class="flex items-center">
                                        <?php if($car->images->count() > 0): ?>
                                            <img src="<?php echo e($car->images->first()->image_url); ?>" alt="" class="w-12 h-12 rounded object-cover mr-3">
                                        <?php endif; ?>
                                        <span class="dark:text-white"><?php echo e($car->title); ?></span>
                                    </div>
                                </td>
                                <td class="py-3 px-4 dark:text-gray-300"><?php echo e($car->brand->name); ?></td>
                                <td class="py-3 px-4 font-semibold dark:text-white">KES <?php echo e(number_format($car->price, 0)); ?></td>
                                <td class="py-3 px-4">
                                    <?php if($car->is_active): ?>
                                        <span class="bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 px-3 py-1 rounded text-sm">Active</span>
                                    <?php else: ?>
                                        <span class="bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 px-3 py-1 rounded text-sm">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 px-4">
                                    <a href="<?php echo e(route('admin.cars.show', $car)); ?>" class="text-blue-600 hover:text-blue-800 mr-3">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('admin.cars.edit', $car)); ?>" class="text-yellow-600 hover:text-yellow-800">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- Recent Inquiries -->
    <!-- Recent Inquiries -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold dark:text-white">Recent Inquiries</h2>
            <a href="<?php echo e(route('admin.inquiries.index')); ?>" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
                View All
            </a>
        </div>

        <?php if($recentInquiries->count() > 0): ?>
            <div class="space-y-3">
                <?php $__currentLoopData = $recentInquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="border dark:border-gray-700 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold dark:text-white"><?php echo e($inquiry->customer_name); ?></p>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">Interested in: <?php echo e($inquiry->car->title); ?></p>
                                <p class="text-gray-600 dark:text-gray-400 text-sm"><?php echo e($inquiry->created_at->diffForHumans()); ?></p>
                            </div>
                            <a href="<?php echo e(route('admin.inquiries.show', $inquiry)); ?>" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 font-semibold">
                                View <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\thriftmotors\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>