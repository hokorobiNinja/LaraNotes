<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'PHP',
            'JavaScript',
            'データベース',
            'その他',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
