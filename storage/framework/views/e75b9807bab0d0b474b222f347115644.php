<?php $__env->startSection('title', 'My Dashboard - ThriftMotors'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-3xl font-bold dark:text-white">Welcome, <?php echo e(auth()->user()->name); ?></h1>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border-l-4 border-red-600 p-6 transition-colors duration-300">
            <h3 class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider mb-2">Total Bookings</h3>
            <p class="text-3xl font-bold dark:text-white"><?php echo e($stats['total_bookings']); ?></p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border-l-4 border-yellow-500 p-6 transition-colors duration-300">
            <h3 class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider mb-2">Active Bookings</h3>
            <p class="text-3xl font-bold dark:text-white"><?php echo e($stats['active_bookings']); ?></p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border-l-4 border-green-500 p-6 transition-colors duration-300">
            <h3 class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider mb-2">Done Deals</h3>
            <p class="text-3xl font-bold dark:text-white"><?php echo e($stats['done_deals']); ?></p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border-l-4 border-blue-500 p-6 transition-colors duration-300">
            <h3 class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider mb-2">Total Spent</h3>
            <p class="text-3xl font-bold dark:text-white">KES <?php echo e(number_format($stats['total_spent'])); ?></p>
        </div>
    </div>

    <!-- Booking History -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden border border-transparent dark:border-gray-700 transition-colors duration-300">
        <div class="px-6 py-4 border-b dark:border-gray-700">
            <h2 class="text-xl font-bold dark:text-white">My Track Record & Bookings</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Car</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Amount Paid</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    <?php $__empty_1 = true; $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <td class="px-6 py-4">
                                <a href="<?php echo e(route('cars.show', $res->car->slug)); ?>" class="text-red-600 dark:text-red-400 hover:underline font-semibold">
                                    <?php echo e($res->car->title); ?>

                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300"><?php echo e($res->created_at->format('M d, Y')); ?></td>
                            <td class="px-6 py-4 text-sm font-medium dark:text-white">KES <?php echo e(number_format($res->amount_paid)); ?></td>
                            <td class="px-6 py-4">
                                <?php
                                    $color = match($res->status) {
                                        'paid' => 'green',
                                        'pending' => 'yellow',
                                        'sold' => 'blue',
                                        'cancelled' => 'red',
                                        'expired' => 'gray',
                                        default => 'gray'
                                    };
                                ?>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-<?php echo e($color); ?>-100 text-<?php echo e($color); ?>-800 dark:bg-<?php echo e($color); ?>-900/30 dark:text-<?php echo e($color); ?>-400 border border-transparent dark:border-<?php echo e($color); ?>-800/50">
                                    <?php echo e(ucfirst($res->status)); ?>

                                </span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                You haven't made any bookings yet.
                                <br><br>
                                <a href="<?php echo e(route('cars.index')); ?>" class="text-red-600 dark:text-red-400 font-semibold hover:underline">Browse Cars</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\thriftmotors\resources\views/user/dashboard.blade.php ENDPATH**/ ?>