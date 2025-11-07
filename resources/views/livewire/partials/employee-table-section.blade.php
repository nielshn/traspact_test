<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-100 dark:border-gray-700">
    <div wire:loading.delay class="mb-3 text-sm text-gray-500 dark:text-gray-400">Mencari...</div>

    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase text-xs">
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
            <tbody class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200">
                @forelse($employees as $i => $emp)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="border px-3 py-2 text-center">{{ $employees->firstItem() + $i }}</td>
                        <td class="border px-3 py-2 text-center">
                            <div
                                class="w-14 h-14 mx-auto rounded-full overflow-hidden border border-gray-300 dark:border-gray-600 shadow-sm">
                                <img src="{{ $emp->photo_url ?? asset('images/no-photo.png') }}" alt="Foto Pegawai"
                                    class="w-20 h-20 object-cover" />
                            </div>
                        </td>

                        <td class="border px-3 py-2">{{ $emp->nip ?? '-' }}</td>
                        <td class="border px-3 py-2 font-medium">{{ $emp->first_name }} {{ $emp->last_name }}</td>
                        <td class="border px-3 py-2">{{ $emp->unit?->name ?? '-' }}</td>
                        <td class="border px-3 py-2">{{ $emp->position?->name ?? '-' }}</td>
                        <td class="border px-3 py-2 text-center">{{ $emp->rank?->code ?? '-' }}</td>
                        <td class="border px-3 py-2 text-center">
                            <div class="flex justify-center gap-3">
                                {{-- Detail --}}
                                @php
                                    $detailPayload = json_encode([
                                        'id' => $emp->id,
                                        'name' => trim($emp->first_name . ' ' . $emp->last_name),
                                        'nip' => $emp->nip ?? '-',
                                        'unit' => $emp->unit?->name ?? '-',
                                        'position' => $emp->position?->name ?? '-',
                                        'rank' => $emp->rank?->code ?? '-',
                                        'phone' => $emp->phone ?? '-',
                                        'address' => $emp->address ?? '-',
                                        'photo' => $emp->photo_url ?? asset('images/no-photo.png'),
                                    ]);
                                @endphp

                                <button x-data @click='$dispatch("open-detail", {!! $detailPayload !!})'
                                    class="text-blue-500 hover:text-blue-700 transition" title="Lihat Detail">
                                    <x-heroicon-o-eye class="w-5 h-5" />
                                </button>

                                {{-- Edit --}}
                                <a href="{{ route('employees.edit', $emp) }}"
                                    class="text-indigo-500 hover:text-indigo-700 transition" title="Edit">
                                    <x-heroicon-o-pencil-square class="w-5 h-5" />
                                </a>

                                {{-- Hapus --}}
                                <form action="{{ route('employees.destroy', $emp) }}" method="POST"
                                    class="btn-delete inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition"
                                        title="Hapus">
                                        <x-heroicon-o-trash class="w-5 h-5" />
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-6 text-gray-500 dark:text-gray-400">
                            Tidak ada data pegawai
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-5">{{ $employees->links() }}</div>
</div>
