<?php

namespace Database\Seeders;

use App\Models\Key;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $room = Room::first(); // Ambil satu room untuk contoh

        Key::create([
            'room_id' => $room->id,
            'status' => 'available',
            'taken_at' => null,
            'returned_at' => null,
        ]);
    }
}
