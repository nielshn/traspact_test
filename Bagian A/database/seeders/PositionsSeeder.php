<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionsSeeder extends Seeder
{
    public function run()
    {
        $positions = [
            ['name' => 'Kepala Sekretariat Utama', 'eselon' => 'IV/e'],
            ['name' => 'Penyusun Laporan Keuangan', 'eselon' => 'IV/a'],
            ['name' => 'Surveyor Pemetaan Pertama', 'eselon' => 'III/c'],
            ['name' => 'Analis Data Survei dan Pemetaan', 'eselon' => 'III/b'],
            ['name' => 'Perancang Per-UU an Utama', 'eselon' => 'III/a'],
            ['name' => 'Kepala Biro Perencanaan, Kepegawaian', 'eselon' => 'IV/c'],
            ['name' => 'Widyaiswara Utama', 'eselon' => 'IV/e'],
            ['name' => 'Analis Kepegawaian Madya', 'eselon' => 'IV/c'],
            ['name' => 'Kepala Sub Bidang Kerjasama dan Pelayanan Riset', 'eselon' => 'IV/a'],
            ['name' => 'Analis Hukum', 'eselon' => 'III/d'],
            ['name' => 'Peneliti Pertama', 'eselon' => 'III/c'],
            ['name' => 'Surveyor Pemetaan Muda', 'eselon' => 'III/c'],
            ['name' => 'Analis Jabatan', 'eselon' => 'III/c'],
            ['name' => 'Kepala Subbag Kepegawaian', 'eselon' => 'III/c'],
        ];

        foreach ($positions as $p) {
            Position::firstOrCreate(['name' => $p['name']], $p);
        }
    }
}
