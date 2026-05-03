<?php $__env->startSection('title', 'Manage About Us - Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold dark:text-white">Manage About Us</h1>
    </div>

    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 overflow-hidden">
        <div class="p-6 border-b dark:border-gray-700">
            <h2 class="text-lg font-bold dark:text-white">General Content</h2>
        </div>
        <form action="<?php echo e(route('admin.about.update-content')); ?>" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="space-y-4">
                    <h3 class="font-semibold dark:text-gray-200 border-b pb-2">Hero Section</h3>
                    <div>
                        <label class="block text-sm font-medium mb-1 dark:text-gray-300">Hero Title</label>
                        <input type="text" name="hero_title" value="<?php echo e($content->hero_title); ?>" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1 dark:text-gray-300">Hero Description</label>
                        <textarea name="hero_description" rows="4" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white"><?php echo e($content->hero_description); ?></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1 dark:text-gray-300">Hero Background Image</label>
                        <?php if($content->hero_bg_image): ?>
                            <img src="<?php echo e(asset('storage/'.$content->hero_bg_image)); ?>" class="w-full h-32 object-cover rounded mb-2">
                        <?php endif; ?>
                        <input type="file" name="hero_bg_image" class="w-full text-sm text-gray-500">
                    </div>
                </div>

                
                <div class="space-y-4">
                    <h3 class="font-semibold dark:text-gray-200 border-b pb-2">Mission & Vision</h3>
                    <div>
                        <label class="block text-sm font-medium mb-1 dark:text-gray-300">Mission Description</label>
                        <textarea name="mission_description" rows="3" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white"><?php echo e($content->mission_description); ?></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1 dark:text-gray-300">Mission Image</label>
                        <?php if($content->mission_image): ?>
                            <img src="<?php echo e(asset('storage/'.$content->mission_image)); ?>" class="w-full h-32 object-cover rounded mb-2">
                        <?php endif; ?>
                        <input type="file" name="mission_image" class="w-full text-sm text-gray-500">
                    </div>
                    <div class="border-t pt-4">
                        <label class="block text-sm font-medium mb-1 dark:text-gray-300">Vision Description</label>
                        <textarea name="vision_description" rows="3" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white"><?php echo e($content->vision_description); ?></textarea>
                    </div>
                </div>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 pt-6 border-t dark:border-gray-700">
                <div>
                    <label class="block text-sm font-medium mb-1 dark:text-gray-300">Years Experience</label>
                    <input type="number" name="experience_years" value="<?php echo e($content->experience_years); ?>" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 dark:text-gray-300">Stat: Cars Sold</label>
                    <input type="text" name="stat_cars_sold" value="<?php echo e($content->stat_cars_sold); ?>" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 dark:text-gray-300">Stat: Happy Clients</label>
                    <input type="text" name="stat_happy_clients" value="<?php echo e($content->stat_happy_clients); ?>" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 dark:text-gray-300">Stat: Dealers</label>
                    <input type="text" name="stat_partner_dealers" value="<?php echo e($content->stat_partner_dealers); ?>" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-red-700 transition">Save Content</button>
            </div>
        </form>
    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 overflow-hidden">
            <div class="p-6 border-b dark:border-gray-700">
                <h2 class="text-lg font-bold dark:text-white">Slideshow Images</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="relative group border dark:border-gray-700 rounded-xl overflow-hidden">
                            <img src="<?php echo e(asset('storage/'.$slide->image_path)); ?>" class="w-full h-40 object-cover">
                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-4">
                                <form action="<?php echo e(route('admin.about.slides.destroy', $slide)); ?>" method="POST" onsubmit="return confirm('Remove this slide?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="bg-red-600 text-white p-2 rounded-full hover:bg-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="p-3 bg-gray-50 dark:bg-gray-900 flex items-center justify-between">
                                <form action="<?php echo e(route('admin.about.slides.update', $slide)); ?>" method="POST" class="flex items-center gap-2">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <input type="number" name="order" value="<?php echo e($slide->order); ?>" class="w-16 px-2 py-1 text-sm border rounded dark:bg-gray-700 dark:text-white">
                                    <button class="text-blue-600 hover:underline text-xs">Update</button>
                                </form>
                                <span class="text-xs <?php echo e($slide->is_active ? 'text-green-600' : 'text-gray-500'); ?>">
                                    <?php echo e($slide->is_active ? 'Active' : 'Inactive'); ?>

                                </span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 overflow-hidden h-fit">
            <div class="p-6 border-b dark:border-gray-700">
                <h2 class="text-lg font-bold dark:text-white">Add New Slide</h2>
            </div>
            <form action="<?php echo e(route('admin.about.slides.store')); ?>" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-sm font-medium mb-1 dark:text-gray-300">Select Image</label>
                    <input type="file" name="image" required class="w-full text-sm text-gray-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 dark:text-gray-300">Display Order</label>
                    <input type="number" name="order" value="0" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg font-bold hover:bg-green-700 transition">Add Slide</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\thriftmotors\resources\views/admin/about/index.blade.php ENDPATH**/ ?>