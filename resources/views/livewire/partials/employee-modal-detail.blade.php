<div x-data="{ open: false, detail: {} }" @open-detail.window="detail = $event.detail; open = true" x-show="open"
    x-transition.opacity.duration.200ms
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm" style="display:none">
    <div class="absolute inset-0" @click="open = false"></div>

    <div x-transition.scale.origin.center.duration.250ms
        class="relative bg-white dark:bg-gray-900 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700 w-full max-w-lg mx-4 p-6 sm:p-8">
        <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 pb-3 mb-4">
            <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-gray-100 flex items-center gap-2">
                <x-heroicon-o-user-circle class="w-5 h-5 text-indigo-500" />
                Detail Pegawai
            </h3>
            <button @click="open = false"
                class="p-1.5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:gap-6 text-center sm:text-left">
            <!-- gunakan x-bind:src agar Blade tidak mengira ini binding PHP -->
            <img x-bind:src="detail.photo" alt="Foto Pegawai"
                class="w-28 h-28 sm:w-32 sm:h-32 rounded-xl object-cover border border-gray-300 dark:border-gray-700 shadow-md mx-auto sm:mx-0">
            <div class="mt-4 sm:mt-0">
                <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100" x-text="detail.name"></h4>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1" x-text="'NIP: ' + detail.nip"></p>
                <span
                    class="inline-block mt-2 px-3 py-1 text-xs font-medium bg-indigo-100 dark:bg-indigo-800 text-indigo-700 dark:text-indigo-200 rounded-full"
                    x-text="detail.position || 'Belum ada jabatan'"></span>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-y-3 text-sm">
            <div>
                <p class="text-gray-500 dark:text-gray-400">Unit Kerja</p>
                <p class="font-medium text-gray-800 dark:text-gray-200" x-text="detail.unit"></p>
            </div>
            <div>
                <p class="text-gray-500 dark:text-gray-400">Golongan</p>
                <p class="font-medium text-gray-800 dark:text-gray-200" x-text="detail.rank"></p>
            </div>
            <div>
                <p class="text-gray-500 dark:text-gray-400">No. HP</p>
                <p class="font-medium text-gray-800 dark:text-gray-200" x-text="detail.phone"></p>
            </div>
            <div class="sm:col-span-2">
                <p class="text-gray-500 dark:text-gray-400">Alamat</p>
                <p class="font-medium text-gray-800 dark:text-gray-200" x-text="detail.address"></p>
            </div>
        </div>

        <div class="mt-8 flex justify-end border-t border-gray-200 dark:border-gray-700 pt-4">
            <button @click="open = false"
                class="px-5 py-2 text-sm font-medium bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg shadow transition">
                Tutup
            </button>
        </div>
    </div>
</div>
