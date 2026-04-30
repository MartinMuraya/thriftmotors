

<?php $__env->startSection('page-title', 'Customer Inquiries'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <h2 class="text-2xl font-bold dark:text-white">All Inquiries</h2>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-transparent dark:border-gray-700 transition-colors duration-300">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700/50 border-b dark:border-gray-700">
                    <tr>
                        <th class="text-left py-3 px-6 dark:text-gray-300">Customer</th>
                        <th class="text-left py-3 px-6 dark:text-gray-300">Car</th>
                        <th class="text-left py-3 px-6 dark:text-gray-300">Contact</th>
                        <th class="text-left py-3 px-6 dark:text-gray-300">Source</th>
                        <th class="text-left py-3 px-6 dark:text-gray-300">Status</th>
                        <th class="text-left py-3 px-6 dark:text-gray-300">Date</th>
                        <th class="text-left py-3 px-6 dark:text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y dark:divide-gray-700">
                    <?php $__empty_1 = true; $__currentLoopData = $inquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition <?php echo e(!$inquiry->is_read ? 'bg-blue-50 dark:bg-blue-900/20' : ''); ?>">
                            <td class="py-3 px-6">
                                <div>
                                    <p class="font-semibold dark:text-white"><?php echo e($inquiry->customer_name); ?></p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400"><?php echo e($inquiry->customer_email); ?></p>
                                </div>
                            </td>
                            <td class="py-3 px-6">
                                <a href="<?php echo e(route('admin.cars.show', $inquiry->car)); ?>" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
                                    <?php echo e($inquiry->car->title); ?>

                                </a>
                            </td>
                            <td class="py-3 px-6">
                                <a href="tel:<?php echo e($inquiry->customer_phone); ?>" class="text-blue-600 dark:text-blue-400 hover:underline">
                                    <?php echo e($inquiry->customer_phone); ?>

                                </a>
                            </td>
                            <td class="py-3 px-6">
                                <?php switch($inquiry->source):
                                    case ('whatsapp'): ?>
                                        <span class="bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 px-3 py-1 rounded text-sm">WhatsApp</span>
                                        <?php break; ?>
                                    <?php case ('phone'): ?>
                                        <span class="bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 px-3 py-1 rounded text-sm">Phone</span>
                                        <?php break; ?>
                                    <?php default: ?>
                                        <span class="bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 px-3 py-1 rounded text-sm">Form</span>
                                <?php endswitch; ?>
                            </td>
                            <td class="py-3 px-6">
                                <?php if($inquiry->is_read): ?>
                                    <span class="bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 px-3 py-1 rounded text-sm">Read</span>
                                <?php else: ?>
                                    <span class="bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 px-3 py-1 rounded text-sm">New</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3 px-6 text-sm text-gray-600 dark:text-gray-400">
                                <?php echo e($inquiry->created_at->format('M d, Y')); ?>

                            </td>
                            <td class="py-3 px-6">
                                <div class="flex gap-2">
                                    <a href="<?php echo e(route('admin.inquiries.show', $inquiry)); ?>" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.inquiries.destroy', $inquiry)); ?>" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-600 dark:text-gray-400">
                                <i class="fas fa-inbox text-3xl mb-2 block text-gray-400 dark:text-gray-600"></i>
                                No inquiries yet.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div>
        <?php echo e($inquiries->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\thriftmotors\resources\views/admin/inquiries/index.blade.php ENDPATH**/ ?>