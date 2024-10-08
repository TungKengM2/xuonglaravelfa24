<?php

namespace Database\Seeders;

use App\Models\CategoryPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['id' => 1, 'name' => 'Kinh Tế'],
            ['id' => 2, 'name' => 'Giáo Dục'],
            ['id' => 3, 'name' => 'Thị Trường'],
            ['id' => 4, 'name' => 'Xã Hội'],
            ['id' => 5, 'name' => 'Tin Nóng 24H'],
        ];

        foreach ($categories as $category) {
            CategoryPost::create($category);
        }
    }
}
