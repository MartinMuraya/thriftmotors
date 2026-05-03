<?php $__env->startSection('title', 'Settings - ThriftMotors'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="mb-8">
        <h1 class="text-3xl font-bold dark:text-white">Account Settings</h1>
        <p class="text-gray-600 dark:text-gray-400">Manage your password and security settings.</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-transparent dark:border-gray-700 overflow-hidden transition-colors duration-300">
        <div class="p-8 border-b dark:border-gray-700">
            <h3 class="text-xl font-bold dark:text-white mb-2">Update Password</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">Ensure your account is using a long, random password to stay secure.</p>
        </div>

        <form action="<?php echo e(route('user.settings.password')); ?>" method="POST" class="p-8 space-y-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>

            <div class="max-w-xl space-y-4">
                <!-- Current Password -->
                <div>
                    <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Current Password</label>
                    <input type="password" name="current_password" required 
                           class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                    <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- New Password -->
                <div>
                    <label class="block text-sm font-semibold mb-2 dark:text-gray-300">New Password</label>
                    <input type="password" name="password" required 
                           class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Confirm New Password</label>
                    <input type="password" name="password_confirmation" required 
                           class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="bg-red-600 text-white px-8 py-2 rounded-lg hover:bg-red-700 transition font-semibold">
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\thriftmotors\resources\views/user/settings.blade.php ENDPATH**/ ?>