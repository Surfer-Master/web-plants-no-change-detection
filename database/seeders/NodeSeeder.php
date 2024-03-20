<?php

namespace Database\Seeders;

use App\Models\Node;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Node::create([
            'name' => 'NodeMCU ESP32 1',
            'connected_sensor' => 'dht',
        ]);

        Node::create([
            'name' => 'NodeMCU ESP32 2',
            'connected_sensor' => 'soil-moisture',
        ]);

        Node::create([
            'name' => 'NodeMCU ESP32 3',
            'connected_sensor' => 'soil-moisture',
        ]);

        Node::create([
            'name' => 'NodeMCU ESP32 4',
            'connected_sensor' => 'soil-moisture',
        ]);

        Node::create([
            'name' => 'NodeMCU ESP32 5',
            'connected_sensor' => 'soil-moisture',
        ]);
    }
}
