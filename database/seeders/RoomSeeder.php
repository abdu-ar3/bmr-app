<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $category = Category::first(); // Mengambil kategori pertama atau Anda bisa membuat yang baru
        Room::whereNull('category_id')->update(['category_id' => $category->id]);
    }
}
