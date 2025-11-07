<div x-data="{ show: false, message: '', type: 'success' }" x-init="@if (session('success')) show = true; message = '{{ session('success') }}'; type = 'success';
        @elseif (session('error'))
            show = true; message = '{{ session('error') }}'; type = 'error'; @endif
if (show) setTimeout(() => show = false, 4000);" x-show="show" x-transition
    x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="translate-x-10 opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition ease-in duration-200 transform"
    x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-10 opacity-0"
    class="fixed top-5 right-5 z-50 w-80 sm:w-96" style="display: none;">
    <template x-if="type === 'success'">
        <div
            class="flex items-center gap-3 px-4 py-3 bg-green-50 dark:bg-green-600/20 text-green-800 dark:text-green-100 border border-green-300 dark:border-green-500/60 rounded-lg shadow-lg shadow-green-200/30 dark:shadow-green-400/20 backdrop-blur-sm">
            <x-heroicon-o-check-circle class="w-5 h-5 text-green-600 dark:text-green-400" />
            <span x-text="message" class="text-sm font-medium"></span>
        </div>
    </template>

    <template x-if="type === 'error'">
        <div
            class="flex items-center gap-3 px-4 py-3 bg-red-50 dark:bg-red-600/20 text-red-800 dark:text-red-100 border border-red-300 dark:border-red-500/60 rounded-lg shadow-lg shadow-red-200/30 dark:shadow-red-400/20 backdrop-blur-sm">
            <x-heroicon-o-x-circle class="w-5 h-5 text-red-600 dark:text-red-400" />
            <span x-text="message" class="text-sm font-medium"></span>
        </div>
    </template>
</div>
