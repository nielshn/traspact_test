<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4 max-w-7xl mx-auto">
        @livewire('employee-table')
    </div>
</x-app-layout>
