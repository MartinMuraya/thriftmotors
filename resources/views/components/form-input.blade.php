@props(['type' => 'text', 'name', 'label', 'placeholder' => ''])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">
        {{ $label }}
        @if($attributes->has('required'))
            <span class="text-red-600">*</span>
        @endif
    </label>
    
    @if($type === 'textarea')
        <textarea 
            id="{{ $name }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            {{ $attributes->merge(['class' => 'w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent dark:text-white dark:placeholder-gray-400']) }}
        >{{ old($name) }}</textarea>
    @else
        <input 
            type="{{ $type }}"
            id="{{ $name }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            value="{{ old($name) }}"
            {{ $attributes->merge(['class' => 'w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent dark:text-white dark:placeholder-gray-400']) }}
        >
    @endif

    @error($name)
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
