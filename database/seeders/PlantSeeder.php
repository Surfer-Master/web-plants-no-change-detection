<?php

namespace Database\Seeders;

use App\Models\Plant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plant::create([
            'node_id' => 2,
            'name' => 'Anggur',
            'location' => 'Pot 1',
            'soil_moisture_order' => 1,
        ]);
        Plant::create([
            'node_id' => 2,
            'name' => 'Anggur',
            'location' => 'Pot 2',
            'soil_moisture_order' => 2,
        ]);
        Plant::create([
            'node_id' => 2,
            'name' => 'Anggur',
            'location' => 'Pot 3',
            'soil_moisture_order' => 3,
        ]);
        Plant::create([
            'node_id' => 2,
            'name' => 'Anggur',
            'location' => 'Pot 4',
            'soil_moisture_order' => 4,
        ]);

        Plant::create([
            'node_id' => 3,
            'name' => 'Anggur',
            'location' => 'Pot 5',
            'soil_moisture_order' => 1,
        ]);
        Plant::create([
            'node_id' => 3,
            'name' => 'Anggur',
            'location' => 'Pot 6',
            'soil_moisture_order' => 2,
        ]);
        Plant::create([
            'node_id' => 3,
            'name' => 'Anggur',
            'location' => 'Pot 7',
            'soil_moisture_order' => 3,
        ]);
        Plant::create([
            'node_id' => 3,
            'name' => 'Anggur',
            'location' => 'Pot 8',
            'soil_moisture_order' => 4,
        ]);

        Plant::create([
            'node_id' => 4,
            'name' => 'Anggur',
            'location' => 'Pot 9',
            'soil_moisture_order' => 1,
        ]);
        Plant::create([
            'node_id' => 4,
            'name' => 'Anggur',
            'location' => 'Pot 10',
            'soil_moisture_order' => 2,
        ]);
        Plant::create([
            'node_id' => 4,
            'name' => 'Anggur',
            'location' => 'Pot 11',
            'soil_moisture_order' => 3,
        ]);
        Plant::create([
            'node_id' => 4,
            'name' => 'Anggur',
            'location' => 'Pot 12',
            'soil_moisture_order' => 4,
        ]);

        Plant::create([
            'node_id' => 5,
            'name' => 'Anggur',
            'location' => 'Pot 13',
            'soil_moisture_order' => 1,
        ]);
        Plant::create([
            'node_id' => 5,
            'name' => 'Anggur',
            'location' => 'Pot 14',
            'soil_moisture_order' => 2,
        ]);
        Plant::create([
            'node_id' => 5,
            'name' => 'Anggur',
            'location' => 'Pot 15',
            'soil_moisture_order' => 3,
        ]);
        Plant::create([
            'node_id' => 5,
            'name' => 'Anggur',
            'location' => 'Pot 16',
            'soil_moisture_order' => 4,
        ]);
    }
}
