<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Ambil user pertama untuk dijadikan user yang melakukan booking
        $user = User::first();

        // Ambil semua rooms
        $rooms = Room::all();

        // Untuk setiap room, buat dua booking
        foreach ($rooms as $room) {
            // Booking pertama
            Booking::create([
                'room_id' => $room->id,
                'user_id' => $user->id,
                'start_time' => Carbon::now(),
                'end_time' => Carbon::now()->addHour(),
                'status' => 'booked',
            ]);

            // Booking kedua
            Booking::create([
                'room_id' => $room->id,
                'user_id' => $user->id,
                'start_time' => Carbon::now()->addDays(1),
                'end_time' => Carbon::now()->addDays(1)->addHour(),
                'status' => 'booked',
            ]);
        }
    }
}
