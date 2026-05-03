<?php $__env->startSection('title', 'My Profile - ThriftMotors'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="mb-8">
        <h1 class="text-3xl font-bold dark:text-white">Profile Information</h1>
        <p class="text-gray-600 dark:text-gray-400">Update your account's profile information and email address.</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-transparent dark:border-gray-700 overflow-hidden transition-colors duration-300">
        <form action="<?php echo e(route('user.profile.update')); ?>" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>

            <!-- Avatar Section -->
            <div class="flex items-center space-x-6 pb-6 border-b dark:border-gray-700">
                <div class="relative group">
                    <img id="avatar-preview" 
                         src="<?php echo e($user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&size=128&color=7F9CF5&background=EBF4FF'); ?>" 
                         alt="<?php echo e($user->name); ?>" 
                         class="w-32 h-32 rounded-full object-cover border-4 border-white dark:border-gray-700 shadow-lg">
                    <label for="avatar-input" class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-full opacity-0 group-hover:opacity-100 cursor-pointer transition">
                        <i class="fas fa-camera text-white text-2xl"></i>
                    </label>
                    <input type="file" name="avatar" id="avatar-input" class="hidden" accept="image/*" onchange="previewImage(this)">
                    <input type="hidden" name="cropped_avatar" id="cropped-data">
                </div>
                <div>
                    <h3 class="text-lg font-semibold dark:text-white">Profile Photo</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Click the image to upload a new one.</p>
                    <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-600 text-xs"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Name</label>
                    <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" required 
                           class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                    <?php $__errorArgs = ['name'];
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

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Email Address</label>
                    <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required 
                           class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                    <?php $__errorArgs = ['email'];
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
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="bg-red-600 text-white px-8 py-2 rounded-lg hover:bg-red-700 transition font-semibold">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
<style>
    .cropper-view-box, .cropper-face {
        border-radius: 50%;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
    let cropper;
    const avatarInput = document.getElementById('avatar-input');
    const avatarPreview = document.getElementById('avatar-preview');
    const cropModal = document.getElementById('crop-modal');
    const cropImage = document.getElementById('crop-image');
    const croppedDataInput = document.getElementById('cropped-data');

    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                cropImage.src = e.target.result;
                cropModal.classList.remove('hidden');
                
                if (cropper) {
                    cropper.destroy();
                }
                
                cropper = new Cropper(cropImage, {
                    aspectRatio: 1,
                    viewMode: 2,
                    guides: true,
                    autoCropArea: 1,
                    responsive: true,
                });
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function cancelCrop() {
        cropModal.classList.add('hidden');
        avatarInput.value = '';
        if (cropper) {
            cropper.destroy();
        }
    }

    function applyCrop() {
        const canvas = cropper.getCroppedCanvas({
            width: 400,
            height: 400,
        });
        
        avatarPreview.src = canvas.toDataURL();
        croppedDataInput.value = canvas.toDataURL(); // Send as base64
        cropModal.classList.add('hidden');
    }
</script>
<?php $__env->stopPush(); ?>


<div id="crop-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/60" onclick="cancelCrop()"></div>
    <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden z-10 border dark:border-gray-700">
        <div class="p-4 border-b dark:border-gray-700 flex justify-between items-center">
            <h3 class="text-lg font-bold dark:text-white">Crop & Center Photo</h3>
            <button onclick="cancelCrop()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-2xl leading-none">&times;</button>
        </div>
        <div class="p-6">
            <div class="max-h-[60vh] overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-900">
                <img id="crop-image" src="" class="max-w-full">
            </div>
            <p class="text-xs text-gray-500 mt-4 text-center">Drag to move and resize the circle to center your face.</p>
        </div>
        <div class="p-4 bg-gray-50 dark:bg-gray-700/50 flex gap-3">
            <button type="button" onclick="applyCrop()" class="flex-1 bg-red-600 text-white py-2 rounded-lg font-bold hover:bg-red-700 transition">
                Apply Crop
            </button>
            <button type="button" onclick="cancelCrop()" class="flex-1 bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-white py-2 rounded-lg font-bold hover:bg-gray-300 dark:hover:bg-gray-500 transition">
                Cancel
            </button>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\thriftmotors\resources\views/user/profile.blade.php ENDPATH**/ ?>