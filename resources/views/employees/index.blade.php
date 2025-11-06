@extends('layouts.app')

@section('content')
    <div class="container flex gap-4">
        <aside style="width:260px;">
            <h4>Unit Kerja</h4>
            @include('employees.partials.unit-tree', ['units' => $units])
        </aside>

        <main style="flex:1">
            <div class="mb-3">
                <form method="GET" action="{{ route('employees.index') }}" class="flex gap-2">
                    <input type="text" name="search" placeholder="Cari nama / NIP / HP" value="{{ request('search') }}">
                    <select name="unit_id">
                        <option value="">-- Semua Unit --</option>
                        @foreach (\App\Models\Unit::all() as $u)
                            <option value="{{ $u->id }}" {{ request('unit_id') == $u->id ? 'selected' : '' }}>
                                {{ $u->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit">Cari</button>
                    <a href="{{ route('employees.create') }}">Tambah</a>
                    <a href="{{ route('employees.print', request()->query()) }}" target="_blank">Cetak PDF</a>
                </form>
            </div>

            @if (session('success'))
                <div>{{ session('success') }}</div>
            @endif

            <table border="1" cellpadding="6" style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Unit</th>
                        <th>Jabatan</th>
                        <th>Gol</th>
                        <th>HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $i => $emp)
                        <tr>
                            <td>{{ $employees->firstItem() + $i }}</td>
                            <td><img src="{{ $emp->photo_url }}" alt=""
                                    style="width:60px;height:60px;object-fit:cover"></td>
                            <td>{{ $emp->nip }}</td>
                            <td>{{ $emp->first_name }} {{ $emp->last_name }}</td>
                            <td>{{ $emp->unit?->name }}</td>
                            <td>{{ $emp->position?->name }}</td>
                            <td>{{ $emp->rank?->code }}</td>
                            <td>{{ $emp->phone }}</td>
                            <td>
                                <a href="{{ route('employees.edit', $emp) }}">Edit</a>
                                <form action="{{ route('employees.destroy', $emp) }}" method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top:10px;">
                {{ $employees->links() }} <!-- paging -->
            </div>
        </main>
    </div>
@endsection
