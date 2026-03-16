<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name'        => 'Crème Hydratante Bio',
                'slug'        => 'creme-hydratante-bio',
                'description' => 'Crème hydratante 100% naturelle',
                'price'       => 29.99,
                'stock'       => 50,
                'category_id' => 1,
            ],
            [
                'name'        => 'Huile Argan Pure',
                'slug'        => 'huile-argan-pure',
                'description' => 'Huile d\'argan pure du Maroc',
                'price'       => 24.99,
                'stock'       => 40,
                'category_id' => 2,
            ],
            [
                'name'        => 'Sérum Vitamine C',
                'slug'        => 'serum-vitamine-c',
                'description' => 'Sérum éclat à la vitamine C',
                'price'       => 34.99,
                'stock'       => 30,
                'category_id' => 3,
            ],
            [
                'name'        => 'Crème Anti-Âge',
                'slug'        => 'creme-anti-age',
                'description' => 'Crème anti-âge aux huiles essentielles',
                'price'       => 44.99,
                'stock'       => 20,
                'category_id' => 1,
            ],
            [
                'name'        => 'Huile Rose Musquée',
                'slug'        => 'huile-rose-musquee',
                'description' => 'Huile de rose musquée régénérante',
                'price'       => 19.99,
                'stock'       => 60,
                'category_id' => 2,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}