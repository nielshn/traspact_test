@props(['label', 'model', 'type' => 'text', 'required' => false])

<div>
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <input
        type="{{ $type }}"
        wire:model="{{ $model }}"
        {{ $attributes->merge([
            'class' => 'w-full border border-gray-300 dark:border-gray-700
                        rounded-lg px-3 py-2
                        text-gray-700 dark:text-gray-100
                        bg-white dark:bg-gray-900
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                        transition'
        ]) }}
    >
</div>
