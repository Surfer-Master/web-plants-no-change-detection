<?php

namespace Database\Seeders;

use App\Models\Bandwidth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BandwidthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1 Mbps = 1024 Kbps
        // 1 KB = 8 Kb
        // Dalam Kbps
        Bandwidth::create([
            'bandwidth' => 128,
            'active' => '0',
        ]);

        Bandwidth::create([
            'bandwidth' => 256,
            'active' => '0',
        ]);

        Bandwidth::create([
            'bandwidth' => 512,
            'active' => '0',
        ]);

        Bandwidth::create([
            'bandwidth' => 1024,
            'active' => '0',
        ]);

        Bandwidth::create([
            'bandwidth' => 2048,
            'active' => '0',
        ]);

        Bandwidth::create([
            'bandwidth' => 3072,
            'active' => '0',
        ]);

        Bandwidth::create([
            'bandwidth' => 4096,
            'active' => '0',
        ]);
    }
}
