@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
        class="mb-4 flex items-center gap-3 px-4 py-3
            bg-green-50 dark:bg-green-600/20
            text-green-800 dark:text-green-100
            border border-green-300 dark:border-green-500/60
            rounded-lg shadow-sm">
        <x-heroicon-o-check-circle class="w-5 h-5 text-green-600 dark:text-green-400" />
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
@endif

@if (session('error'))
    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
        class="mb-4 flex items-center gap-3 px-4 py-3
            bg-red-50 dark:bg-red-600/20
            text-red-800 dark:text-red-100
            border border-red-300 dark:border-red-500/60
            rounded-lg shadow-sm">
        <x-heroicon-o-x-circle class="w-5 h-5 text-red-600 dark:text-red-400" />
        <span class="text-sm font-medium">{{ session('error') }}</span>
    </div>
@endif
