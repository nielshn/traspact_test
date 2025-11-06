<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Pegawai</title>
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .header p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f1f1f1;
            text-align: center;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
        }

        .signature {
            margin-top: 60px;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ public_path('logo.png') }}" alt="Logo" style="height:60px">
        <h2>DAFTAR PEGAWAI</h2>
        <p><strong>PT. TRASPAC MAKMUR SEJAHTERA</strong></p>
        <p>Office Park Thamrin City Blok AA-02, Jl. Kebon Kacang Raya, Tanah Abang – Jakarta Pusat</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Gol</th>
                <th>Eselon</th>
                <th>Jabatan</th>
                <th>Unit Kerja</th>
                <th>Agama</th>
                <th>No. HP</th>
                <th>NPWP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $i => $e)
                <tr>
                    <td align="center">{{ $i + 1 }}</td>
                    <td>{{ $e->nip ?? '-' }}</td>
                    <td>{{ $e->first_name }} {{ $e->last_name }}</td>
                    <td>{{ $e->birth_place ?? '-' }},
                        {{ $e->birth_date ? date('d-m-Y', strtotime($e->birth_date)) : '-' }}</td>
                    <td align="center">{{ $e->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td align="center">{{ $e->rank?->code ?? '-' }}</td>
                    <td align="center">{{ $e->position?->eselon ?? '-' }}</td>
                    <td>{{ $e->position?->name ?? '-' }}</td>
                    <td>{{ $e->unit?->name ?? '-' }}</td>
                    <td align="center">{{ $e->religion?->name ?? '-' }}</td>
                    <td>{{ $e->phone ?? '-' }}</td>
                    <td>{{ $e->npwp ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ $printedAt }}</p>
    </div>

    <div class="signature">
        <p>Mengetahui,</p>
        <p><strong>Kepala Kepegawaian</strong></p>
        <br><br><br>
        <p><u>________________________</u></p>
    </div>

</body>

</html>
