@props(['label', 'model', 'options', 'display' => 'name'])

<div>
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
        {{ $label }}
    </label>
    <select wire:model="{{ $model }}"
        class="w-full border border-gray-300 dark:border-gray-700
               rounded-lg px-3 py-2
               text-gray-700 dark:text-gray-100
               bg-white dark:bg-gray-900
               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
               transition">
        <option value="">-- Pilih {{ $label }} --</option>
        @foreach ($options as $option)
            <option value="{{ $option->id }}">
                {{ $option->$display }}
            </option>
        @endforeach
    </select>
</div>
