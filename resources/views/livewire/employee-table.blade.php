<div class="flex gap-8 max-w-7xl mx-auto">
    <!-- Sidebar Tree -->
    <aside class="w-1/4 bg-white rounded-lg shadow p-5 border border-gray-100">
        <h2 class="font-semibold mb-3 text-gray-700 text-lg flex items-center gap-2">
            <x-heroicon-o-building-office class="w-5 h-5 text-indigo-600" /> Unit Kerja
        </h2>
        <div class="max-h-[70vh] overflow-y-auto pr-2">
            @include('employees.partials.unit-tree', ['units' => $units])
        </div>
    </aside>

    <!-- Table Section -->
    <div class="flex-1 bg-white rounded-lg shadow p-6 border border-gray-100">
        <!-- Top Bar -->
        <div class="flex flex-wrap items-center gap-3 mb-5">
            <input type="text" wire:model.debounce.400ms="search" placeholder="Cari nama, NIP, atau HP..."
                class="flex-1 border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />

            <select wire:model="unit_id"
                class="border border-gray-300 rounded-md text-sm px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                <option value="">Semua Unit</option>
                @foreach (\App\Models\Unit::all() as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>

            <a href="{{ route('employees.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 text-sm font-medium rounded-md shadow-sm transition">+
                Tambah</a>

            <a href="{{ route('employees.print', ['search' => $search, 'unit_id' => $unit_id]) }}" target="_blank"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 text-sm font-medium rounded-md shadow-sm transition">🖨
                Cetak</a>
        </div>

        <!-- Data Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-3 py-2 border">No</th>
                        <th class="px-3 py-2 border">Foto</th>
                        <th class="px-3 py-2 border">NIP</th>
                        <th class="px-3 py-2 border">Nama</th>
                        <th class="px-3 py-2 border">Unit</th>
                        <th class="px-3 py-2 border">Jabatan</th>
                        <th class="px-3 py-2 border">Gol</th>
                        <th class="px-3 py-2 border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $i => $emp)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border px-3 py-2 text-center">{{ $employees->firstItem() + $i }}</td>
                            <td class="border px-3 py-2 text-center">
                                <img src="{{ $emp->photo_url ?? asset('default-avatar.png') }}" alt="Foto Pegawai"
                                    class="w-8 h-8 md:w-10 md:h-10 object-cover rounded-full mx-auto border border-gray-200 shadow-sm">

                            </td>

                            <td class="border px-3 py-2">{{ $emp->nip }}</td>
                            <td class="border px-3 py-2 font-medium">{{ $emp->first_name }} {{ $emp->last_name }}</td>
                            <td class="border px-3 py-2">{{ $emp->unit?->name }}</td>
                            <td class="border px-3 py-2">{{ $emp->position?->name }}</td>
                            <td class="border px-3 py-2">{{ $emp->rank?->code }}</td>
                            <td class="border px-3 py-2 text-center flex items-center justify-center gap-3">
                                <a href="{{ route('employees.edit', $emp) }}"
                                    class="text-indigo-600 hover:text-indigo-800">Edit</a>
                                <form action="{{ route('employees.destroy', $emp) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus pegawai ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-gray-500">Tidak ada data pegawai</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            {{ $employees->links() }}
        </div>
    </div>
</div>
