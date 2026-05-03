

<?php $__env->startSection('title', 'Browse Cars - ThriftMotors'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{ filtersOpen: false }">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold dark:text-white">Browse Cars</h1>
        <button @click="filtersOpen = !filtersOpen" class="lg:hidden bg-white dark:bg-gray-800 px-4 py-2 rounded-lg border dark:border-gray-700 shadow-sm text-sm font-semibold dark:text-white">
            <i class="fas fa-filter mr-2"></i> Filters
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Filters -->
        <aside class="lg:col-span-1" :class="filtersOpen ? 'block' : 'hidden lg:block'">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 sticky top-20 transition-colors duration-300">
                <h2 class="text-lg font-semibold mb-4 dark:text-white">Filter Results</h2>

                <form action="<?php echo e(route('cars.index')); ?>" method="GET" class="space-y-4">
                    <!-- Brand Filter -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Brand</label>
                        <select name="brand" class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                            <option value="">All Brands</option>
                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($brand->slug); ?>" <?php echo e(request('brand') === $brand->slug ? 'selected' : ''); ?>>
                                    <?php echo e($brand->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Fuel Type Filter -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Fuel Type</label>
                        <select name="fuel_type" class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                            <option value="">All Types</option>
                            <?php $__currentLoopData = $fuelTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fuel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($fuel->slug); ?>" <?php echo e(request('fuel_type') === $fuel->slug ? 'selected' : ''); ?>>
                                    <?php echo e($fuel->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Transmission Filter -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Transmission</label>
                        <select name="transmission" class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                            <option value="">All Types</option>
                            <?php $__currentLoopData = $transmissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trans): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($trans->slug); ?>" <?php echo e(request('transmission') === $trans->slug ? 'selected' : ''); ?>>
                                    <?php echo e($trans->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Price Range -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Min Price (KES)</label>
                        <input type="number" name="min_price" placeholder="Min" value="<?php echo e(request('min_price')); ?>" class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white dark:placeholder-gray-400">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Max Price (KES)</label>
                        <input type="number" name="max_price" placeholder="Max" value="<?php echo e(request('max_price')); ?>" class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white dark:placeholder-gray-400">
                    </div>

                    <!-- Year Range -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Min Year</label>
                        <input type="number" name="min_year" placeholder="Min Year" value="<?php echo e(request('min_year')); ?>" class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white dark:placeholder-gray-400">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Max Year</label>
                        <input type="number" name="max_year" placeholder="Max Year" value="<?php echo e(request('max_year')); ?>" class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white dark:placeholder-gray-400">
                    </div>

                    <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition font-semibold">
                        Apply Filters
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="lg:col-span-3">
            <!-- Sort Options -->
            <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <p class="text-gray-600 dark:text-gray-400">
                    Showing <strong><?php echo e($cars->count()); ?></strong> of <strong><?php echo e($cars->total()); ?></strong> cars
                </p>
                <select name="sort" onchange="location.href='<?php echo e(route('cars.index')); ?>?sort=' + this.value + '&' + new URLSearchParams(window.location.search.slice(1)).toString()" class="px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                    <option value="latest" <?php echo e(request('sort') === 'latest' ? 'selected' : ''); ?>>Latest First</option>
                    <option value="price_low" <?php echo e(request('sort') === 'price_low' ? 'selected' : ''); ?>>Price: Low to High</option>
                    <option value="price_high" <?php echo e(request('sort') === 'price_high' ? 'selected' : ''); ?>>Price: High to Low</option>
                    <option value="oldest" <?php echo e(request('sort') === 'oldest' ? 'selected' : ''); ?>>Oldest First</option>
                </select>
            </div>

            <!-- Cars Grid -->
            <?php if($cars->count() > 0): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginalddff77940a067fc12b4449e98aa924a9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalddff77940a067fc12b4449e98aa924a9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.car-card','data' => ['car' => $car]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('car-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['car' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($car)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalddff77940a067fc12b4449e98aa924a9)): ?>
<?php $attributes = $__attributesOriginalddff77940a067fc12b4449e98aa924a9; ?>
<?php unset($__attributesOriginalddff77940a067fc12b4449e98aa924a9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalddff77940a067fc12b4449e98aa924a9)): ?>
<?php $component = $__componentOriginalddff77940a067fc12b4449e98aa924a9; ?>
<?php unset($__componentOriginalddff77940a067fc12b4449e98aa924a9); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    <?php echo e($cars->links()); ?>

                </div>
            <?php else: ?>
                <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-12 text-center border border-transparent dark:border-gray-700">
                    <i class="fas fa-search text-5xl text-gray-400 dark:text-gray-500 mb-4 block"></i>
                    <p class="text-xl text-gray-600 dark:text-gray-300">No cars found matching your criteria.</p>
                    <a href="<?php echo e(route('cars.index')); ?>" class="inline-block mt-4 bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">
                        Clear Filters
                    </a>
                </div>
            <?php endif; ?>
        </main>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\thriftmotors\resources\views/pages/listings.blade.php ENDPATH**/ ?>