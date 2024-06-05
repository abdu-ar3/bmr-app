<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Room::create(['name' => 'Room A', 'location' => 'First Floor', 'capacity' => 10]);
        Room::create(['name' => 'Room B', 'location' => 'Second Floor', 'capacity' => 20]);
        Room::create(['name' => 'Room C', 'location' => 'Third Floor', 'capacity' => 15]);
        Room::create(['name' => 'Room D', 'location' => 'Fourth Floor', 'capacity' => 30]);
    }
}
