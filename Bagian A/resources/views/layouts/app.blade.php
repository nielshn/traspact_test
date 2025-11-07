<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Traspac Employee System') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('scripts')
    @livewireStyles
</head>

<body class="font-sans bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    {{-- Navbar --}}
    @include('layouts.navigation')

    {{-- Page Heading --}}
    @isset($header)
        <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto py-4 px-6">
                {{ $header }}
            </div>
        </header>
    @endisset
    {{-- <div class="max-w-7xl mx-auto mt-4 px-4">
        <x-flash-message />
    </div> --}}
    <x-toast />


    {{-- Main Content --}}
    <main class="py-8 px-6">
        {{-- Livewire components use {{ $slot }} --}}
        {{-- Blade pages use @yield('content') --}}
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    @livewireScripts

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // SweetAlert konfirmasi hapus
            document.querySelectorAll('.btn-delete').forEach(form => {
                form.addEventListener('submit', e => {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin hapus data ini?',
                        text: 'Data pegawai akan dihapus permanen.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e3342f',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>
