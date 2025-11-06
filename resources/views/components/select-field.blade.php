@props(['label', 'model', 'options', 'display' => 'name'])

<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}</label>
    <select wire:model="{{ $model }}"
        class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
        <option value="">-- Pilih {{ $label }} --</option>
        @foreach ($options as $option)
            <option value="{{ $option->id }}">{{ $option->$display }}</option>
        @endforeach
    </select>
</div>
