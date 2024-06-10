<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateRoomsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::first(); // Mengambil kategori pertama atau buat satu jika tidak ada
        if (!$category) {
            $category = Category::create(['name' => 'Default Category']);
        }

        Room::whereNull('category_id')->update(['category_id' => $category->id]);
    }
}
