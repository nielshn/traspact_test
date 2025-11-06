<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Religion;

class ReligionsSeeder extends Seeder
{
    public function run()
    {
        $list = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Kong Hu Cu'];
        foreach ($list as $name) {
            Religion::firstOrCreate(['name' => $name]);
        }
    }
}
