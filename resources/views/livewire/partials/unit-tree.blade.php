<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 mb-5 border border-gray-100 dark:border-gray-700">
    <h2 class="font-semibold mb-3 text-gray-700 dark:text-gray-200 text-lg flex items-center gap-2">
        <x-heroicon-o-building-office class="w-5 h-5 text-indigo-600 dark:text-indigo-400" /> Unit Kerja
    </h2>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2">
        <button wire:click.prevent="$set('unit_id','')"
            class="px-3 py-2 rounded-md border text-sm text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-indigo-700/40">
            Semua Unit
        </button>

        @foreach ($allUnits as $u)
            <button wire:click.prevent="$set('unit_id', {{ $u->id }})"
                class="flex items-center gap-2 px-3 py-2 rounded-md border border-gray-200 dark:border-gray-700
                   hover:bg-indigo-50 dark:hover:bg-indigo-700/40 text-sm text-gray-700 dark:text-gray-200
                   hover:text-indigo-600 dark:hover:text-indigo-300 transition">
                <x-heroicon-o-folder class="w-4 h-4 text-indigo-500 dark:text-indigo-300" />
                <span class="truncate">{{ $u->name }}</span>
            </button>
        @endforeach
    </div>
</div>
