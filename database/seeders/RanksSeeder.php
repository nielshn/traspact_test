<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rank;

class RanksSeeder extends Seeder
{
    public function run()
    {
        $ranks = [
            ['code' => 'IV/e', 'description' => 'Eselon IV/e'],
            ['code' => 'IV/a', 'description' => 'IV/a'],
            ['code' => 'III/c', 'description' => 'III/c'],
            ['code' => 'III/b', 'description' => 'III/b'],
            ['code' => 'III/a', 'description' => 'III/a'],
            ['code' => 'IV/c', 'description' => 'IV/c'],
            ['code' => 'IV/d', 'description' => 'IV/d'],
            ['code' => 'IV/b', 'description' => 'IV/b'],
            ['code' => 'III/d', 'description' => 'III/d'],
            ['code' => 'P III/c', 'description' => 'P III/c'],
        ];

        foreach ($ranks as $r) {
            Rank::firstOrCreate(['code' => $r['code']], $r);
        }
    }
}
