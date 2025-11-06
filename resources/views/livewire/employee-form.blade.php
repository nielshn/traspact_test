<div class="max-w-5xl mx-auto bg-white p-10 rounded-2xl shadow-md border border-gray-200 mt-6">
    <h2 class="text-2xl font-semibold mb-8 text-gray-700 border-b pb-3">
        {{ $employee ? '✏️ Edit Data Pegawai' : '➕ Tambah Pegawai Baru' }}
    </h2>

    <form wire:submit.prevent="save" class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6">
            <x-input-field label="NIP" model="form.nip" />
            <x-input-field label="Nama Depan" model="form.first_name" required />
            <x-input-field label="Nama Belakang" model="form.last_name" />
            <x-input-field label="Tempat Lahir" model="form.birth_place" />
            <x-input-field label="Tanggal Lahir" model="form.birth_date" type="date" />
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                <div class="flex gap-6">
                    <label class="flex items-center gap-2">
                        <input type="radio" wire:model="form.gender" value="L" class="text-indigo-600">
                        <span>Laki-laki</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" wire:model="form.gender" value="P" class="text-indigo-600">
                        <span>Perempuan</span>
                    </label>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Golongan</label>
                <select wire:model="form.rank_id"
                    class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">-- Pilih Golongan --</option>
                    @foreach ($ranks as $rank)
                        <option value="{{ $rank->id }}">{{ $rank->code }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <x-select-field label="Jabatan" model="form.position_id" :options="$positions" display="name" />
            <x-select-field label="Unit Kerja" model="form.unit_id" :options="$units" display="name" />
            <x-select-field label="Agama" model="form.religion_id" :options="$religions" display="name" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
            <textarea wire:model="form.address" rows="3"
                class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <x-input-field label="No. HP" model="form.phone" />
            <x-input-field label="NPWP" model="form.npwp" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Pegawai</label>
            <input wire:model="photo" type="file"
                class="block w-full text-sm text-gray-700 file:rounded-md file:border-none file:bg-indigo-50 file:text-indigo-600 file:px-4 file:py-2 hover:file:bg-indigo-100" />

            @if ($photo)
                <img src="{{ $photo->temporaryUrl() }}"
                    class="mt-3 w-32 h-32 rounded-xl object-cover border border-gray-200 shadow-sm">
            @elseif($employee && $employee->photo_path)
                <img src="{{ $employee->photo_url }}"
                    class="mt-3 w-32 h-32 rounded-xl object-cover border border-gray-200 shadow-sm">
            @endif
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="bg-indigo-400 hover:bg-indigo-500 text-gray-900 font-semibold px-6 py-2.5 rounded-lg shadow-md transition-all">
                💾 Simpan Data
            </button>

        </div>
    </form>
</div>
