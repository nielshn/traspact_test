<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitsSeeder extends Seeder
{
    public function run()
    {
        $units = [
            ['name' => 'Jakarta'],
            ['name' => 'Bakosurtanal'],
            ['name' => 'DKP'],
            ['name' => 'Hukum'],
            ['name' => 'Trengalek'],
            ['name' => 'General'],
        ];

        foreach ($units as $u) {
            Unit::firstOrCreate(['name' => $u['name']]);
        }
    }
}
