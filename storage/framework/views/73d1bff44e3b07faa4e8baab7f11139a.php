<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['car']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['car']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="bg-white dark:bg-gray-800 rounded-lg border border-transparent dark:border-gray-700 shadow-md overflow-hidden hover:shadow-lg dark:hover:shadow-red-900/20 transition group cursor-pointer">
    <!-- Image -->
    <div class="relative overflow-hidden bg-gray-200 dark:bg-gray-700 h-48">
        <?php if($car->images->count() > 0): ?>
            <img src="<?php echo e($car->images->first()->image_url); ?>" alt="<?php echo e($car->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
        <?php else: ?>
            <div class="w-full h-full flex items-center justify-center">
                <i class="fas fa-image text-gray-400 dark:text-gray-500 text-4xl"></i>
            </div>
        <?php endif; ?>

        <!-- Badge -->
        <?php if($car->is_hot_deal): ?>
            <span class="absolute top-3 right-3 bg-red-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-sm">
                🔥 Hot Deal
            </span>
        <?php elseif($car->is_featured): ?>
            <span class="absolute top-3 right-3 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-sm">
                ⭐ Featured
            </span>
        <?php endif; ?>
    </div>

    <!-- Content -->
    <div class="p-4">
        <h3 class="text-lg font-semibold mb-2 line-clamp-1 dark:text-white"><?php echo e($car->title); ?></h3>
        
        <div class="flex justify-between items-start mb-3">
            <div>
                <div class="text-xl font-bold text-red-600 dark:text-red-500 mb-1">
                    KES <?php echo e(number_format($car->price, 0)); ?>

                </div>
                <?php if($car->is_negotiable): ?>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Negotiable</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Specs -->
        <div class="grid grid-cols-3 gap-2 mb-4 text-sm border-t border-b border-gray-100 dark:border-gray-700 py-3">
            <div class="text-center">
                <p class="text-gray-500 dark:text-gray-400 mb-1"><i class="fas fa-calendar"></i></p>
                <p class="font-semibold dark:text-gray-200"><?php echo e($car->year); ?></p>
            </div>
            <div class="text-center border-l border-r border-gray-100 dark:border-gray-700">
                <p class="text-gray-500 dark:text-gray-400 mb-1"><i class="fas fa-tachometer-alt"></i></p>
                <p class="font-semibold dark:text-gray-200"><?php echo e($car->mileage); ?>km</p>
            </div>
            <div class="text-center">
                <p class="text-gray-500 dark:text-gray-400 mb-1"><i class="fas fa-gas-pump"></i></p>
                <p class="font-semibold dark:text-gray-200"><?php echo e($car->fuelType->name); ?></p>
            </div>
        </div>

        <!-- Info -->
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
            <i class="fas fa-sitemap mr-1"></i> <?php echo e($car->transmission->name); ?>

        </p>

        <!-- CTA -->
        <div class="flex gap-2">
            <a href="<?php echo e(route('cars.show', $car->slug)); ?>" class="flex-1 bg-red-600 dark:bg-red-600 text-white py-2.5 rounded-lg hover:bg-red-700 dark:hover:bg-red-700 transition text-center text-sm font-semibold shadow-sm">
                View Details
            </a>
        </div>
    </div>
</div>
<?php /**PATH F:\thriftmotors\resources\views/components/car-card.blade.php ENDPATH**/ ?>