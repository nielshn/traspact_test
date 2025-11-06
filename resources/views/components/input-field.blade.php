@props(['label', 'model', 'type' => 'text', 'required' => false])

<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">
        {{ $label }} @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <input wire:model="{{ $model }}" type="{{ $type }}"
        class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500" />
    @error($model)
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>
