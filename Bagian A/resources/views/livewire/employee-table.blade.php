<div class="max-w-7xl mx-auto mt-4 grid grid-cols-1 lg:grid-cols-4 gap-6">

    {{-- Include: Unit Grid / Sidebar (partial) --}}
    @include('livewire.partials.unit-tree', ['allUnits' => $allUnits])

    {{-- 📊 Konten Utama --}}
    <div class="lg:col-span-3 space-y-6">

        {{-- 🔍 Filter Bar --}}
        <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border border-gray-100 dark:border-gray-700 flex flex-wrap items-center gap-3">
            {{-- Search --}}
            <input type="text" wire:model.defer="tempSearch" placeholder="Cari nama, NIP, atau HP..."
                class="flex-1 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">

            {{-- Dropdown filter --}}
            <select wire:model.defer="tempUnitId"
                class="border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 rounded-md text-sm px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                <option value="">Semua Unit</option>
                @foreach ($allUnits as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>

            {{-- Tombol Cari --}}
            <button wire:click="applyFilters"
                class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 text-sm font-medium rounded-md shadow-sm transition flex items-center gap-1 dark:bg-indigo-400 dark:hover:bg-indigo-500">
                <x-heroicon-o-magnifying-glass class="w-4 h-4" /> Cari
            </button>

            {{-- Indikator belum diterapkan --}}
            @if ($this->hasPendingFilters)
                <span
                    class="text-xs bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-200 px-2 py-1 rounded-md">
                    Belum diterapkan
                </span>
            @endif

            {{-- Tombol Tambah --}}
            <a href="{{ route('employees.create') }}"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 text-sm font-medium rounded-md shadow-sm transition flex items-center gap-1">
                <x-heroicon-o-plus class="w-4 h-4" /> Tambah
            </a>

            {{-- Cetak --}}
            <a href="{{ route('employees.print', ['search' => $search, 'unit_id' => $unit_id]) }}" target="_blank"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 text-sm font-medium rounded-md shadow-sm transition flex items-center gap-1">
                <x-heroicon-o-printer class="w-4 h-4" /> Cetak
            </a>

            {{-- Clear --}}
            <button wire:click="clearFilters" class="ml-auto text-sm text-gray-600 dark:text-gray-300 hover:underline">
                Clear filters
            </button>
        </div>

        {{-- Include: table section (partial) --}}
        @include('livewire.partials.employee-table-section', [
            'employees' => $employees,
            'allUnits' => $allUnits,
        ])
    </div>

    {{-- Include: modal detail (partial) --}}
    @include('livewire.partials.employee-modal-detail')

</div>

{{-- SweetAlert for Delete Confirmation --}}
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-delete').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin hapus pegawai ini?',
                        text: 'Data tidak bisa dikembalikan setelah dihapus!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) form.submit();
                    });
                });
            });
        });
    </script>
@endpush
