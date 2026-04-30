@props(['name', 'label', 'options', 'multiple' => false])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">
        {{ $label }}
        @if($attributes->has('required'))
            <span class="text-red-600">*</span>
        @endif
    </label>
    
    <select 
        id="{{ $name }}"
        name="{{ $name }}{{ $multiple ? '[]' : '' }}"
        {{ $multiple ? 'multiple' : '' }}
        {{ $attributes->merge(['class' => 'w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent dark:text-white']) }}
    >
        <option value="">-- Select an option --</option>
        @foreach($options as $value => $label)
            <option value="{{ $value }}" {{ old($name) == $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
