

<?php $__env->startSection('title', 'Login - ThriftMotors'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-md mx-auto px-4 py-16">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-8 transition-colors duration-300">
        <h2 class="text-2xl font-bold mb-6 text-center dark:text-white">Admin Login</h2>

        <form action="<?php echo e(route('login')); ?>" method="POST" class="space-y-4">
            <?php echo csrf_field(); ?>

            <div>
                <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    required 
                    class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white dark:placeholder-gray-400"
                    placeholder="admin@thriftmotors.com"
                >
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <label class="block text-sm font-semibold dark:text-gray-300">Password</label>
                    <a href="<?php echo e(route('password.request')); ?>" class="text-sm text-red-600 dark:text-red-400 hover:underline">Forgot password?</a>
                </div>
                <input 
                    type="password" 
                    name="password" 
                    required 
                    class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white dark:placeholder-gray-400"
                    placeholder="••••••••"
                >
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <button 
                type="submit" 
                class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition font-semibold"
            >
                <i class="fas fa-sign-in-alt mr-2"></i> Login
            </button>
        </form>



        <p class="text-center text-gray-600 dark:text-gray-400 text-sm mt-6 pt-6 border-t border-gray-100 dark:border-gray-700">
            Don't have an account? 
            <a href="<?php echo e(route('register')); ?>" class="text-red-600 dark:text-red-400 font-semibold hover:underline">Create account</a>
        </p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\thriftmotors\resources\views/auth/login.blade.php ENDPATH**/ ?>