<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Crèmes',  'slug' => 'cremes'],
            ['name' => 'Huiles',  'slug' => 'huiles'],
            ['name' => 'Sérums',  'slug' => 'serums'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}