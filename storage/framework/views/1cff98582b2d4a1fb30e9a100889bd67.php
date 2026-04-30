<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['type' => 'text', 'name', 'label', 'placeholder' => '']));

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

foreach (array_filter((['type' => 'text', 'name', 'label', 'placeholder' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="mb-4">
    <label for="<?php echo e($name); ?>" class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">
        <?php echo e($label); ?>

        <?php if($attributes->has('required')): ?>
            <span class="text-red-600">*</span>
        <?php endif; ?>
    </label>
    
    <?php if($type === 'textarea'): ?>
        <textarea 
            id="<?php echo e($name); ?>"
            name="<?php echo e($name); ?>"
            placeholder="<?php echo e($placeholder); ?>"
            <?php echo e($attributes->merge(['class' => 'w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent dark:text-white dark:placeholder-gray-400'])); ?>

        ><?php echo e(old($name)); ?></textarea>
    <?php else: ?>
        <input 
            type="<?php echo e($type); ?>"
            id="<?php echo e($name); ?>"
            name="<?php echo e($name); ?>"
            placeholder="<?php echo e($placeholder); ?>"
            value="<?php echo e(old($name)); ?>"
            <?php echo e($attributes->merge(['class' => 'w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent dark:text-white dark:placeholder-gray-400'])); ?>

        >
    <?php endif; ?>

    <?php $__errorArgs = [$name];
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
<?php /**PATH F:\thriftmotors\resources\views/components/form-input.blade.php ENDPATH**/ ?>