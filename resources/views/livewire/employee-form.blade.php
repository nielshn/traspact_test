<div
    class="max-w-5xl mx-auto bg-white dark:bg-gray-800 p-8 md:p-10 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700 mt-6">

    <h2
        class="text-2xl font-semibold mb-8 text-gray-700 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-3 flex items-center gap-2">
        @if ($employee)
            <x-heroicon-o-pencil-square class="w-6 h-6 text-indigo-500" /> Edit Data Pegawai
        @else
            <x-heroicon-o-plus class="w-6 h-6 text-indigo-500" /> Tambah Pegawai Baru
        @endif
    </h2>

    <form wire:submit.prevent="save" class="space-y-8">
        {{-- Identitas --}}
        <div class="grid md:grid-cols-2 gap-6">
            <x-input-field label="NIP" model="form.nip" />
            <x-input-field label="Nama Depan" model="form.first_name" required />
            <x-input-field label="Nama Belakang" model="form.last_name" />
            <x-input-field label="Tempat Lahir" model="form.birth_place" />
            <x-input-field label="Tanggal Lahir" model="form.birth_date" type="date" />
        </div>

        {{-- Gender + Golongan --}}
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Jenis Kelamin</label>
                <div class="flex gap-6 text-gray-700 dark:text-gray-300">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" wire:model="form.gender" value="L"
                            class="text-indigo-600 focus:ring-indigo-500 dark:bg-gray-900">
                        <span>Laki-laki</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" wire:model="form.gender" value="P"
                            class="text-indigo-600 focus:ring-indigo-500 dark:bg-gray-900">
                        <span>Perempuan</span>
                    </label>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Golongan</label>
                <select wire:model="form.rank_id"
                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">-- Pilih Golongan --</option>
                    @foreach ($ranks as $rank)
                        <option value="{{ $rank->id }}">{{ $rank->code }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Jabatan, Unit, Agama --}}
        <div class="grid md:grid-cols-3 gap-6">
            <x-select-field label="Jabatan" model="form.position_id" :options="$positions" display="name" />
            <x-select-field label="Unit Kerja" model="form.unit_id" :options="$units" display="name" />
            <x-select-field label="Agama" model="form.religion_id" :options="$religions" display="name" />
        </div>

        {{-- Alamat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Alamat</label>
            <textarea wire:model="form.address" rows="3"
                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
        </div>

        {{-- Kontak --}}
        <div class="grid md:grid-cols-2 gap-6">
            <x-input-field label="No. HP" model="form.phone" />
            <x-input-field label="NPWP" model="form.npwp" />
        </div>

        {{-- Foto --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Foto Pegawai</label>
            <input wire:model="photo" type="file"
                class="block w-full text-sm text-gray-700 dark:text-gray-200 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg
        file:rounded-md file:border-none file:bg-indigo-50 dark:file:bg-indigo-900 file:text-indigo-600 dark:file:text-indigo-200 file:px-4 file:py-2
        hover:file:bg-indigo-100 dark:hover:file:bg-indigo-800" />

            {{-- Preview Foto --}}
            <div class="mt-4 flex items-center gap-4">
                @if ($photo)
                    <img src="{{ $photo->temporaryUrl() }}" alt="Preview Foto"
                        class="w-20 h-20 sm:w-40 sm:h-40 md:w-48 md:h-48 object-cover rounded-xl border border-gray-300 dark:border-gray-700 shadow-sm">
                @elseif($employee && $employee->photo_path)
                    <img src="{{ $employee->photo_url }}" alt="Foto Pegawai"
                        class="w-20 h-20 sm:w-40 sm:h-40 md:w-48 md:h-48 object-cover rounded-xl border border-gray-300 dark:border-gray-700 shadow-sm">
                @endif
            </div>

            {{-- Tips upload --}}
            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Format foto: JPG, PNG, maks. 2MB</p>
        </div>


        {{-- Tombol --}}
        <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
            <a href="{{ route('employees.index') }}"
                class="px-6 py-2.5 text-sm font-medium rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                Batal
            </a>
            <button type="submit"
                class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md transition-all">
                💾 Simpan Data
            </button>
        </div>
    </form>
</div>
