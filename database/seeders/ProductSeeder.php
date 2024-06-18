<?php

namespace Database\Seeders;

use App\Models\Product\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = \Faker\Factory::create();

    foreach (range(1, 50) as $index) {
      Product::create([
        'title' => $faker->word(),
        'slug' => $faker->slug(),
        'sku' => $faker->unique()->numberBetween(1000, 9999),
        'price_pen' => $faker->randomFloat(2, 10, 100),
        'price_usd' => $faker->randomFloat(2, 5, 50),
        'description' => $faker->paragraph(),
        'resumen' => $faker->sentence(),
        'imagen' => $faker->imageUrl(640, 480, 'products'),
        'state' => 1,
        'tags' => implode(',', $faker->words(5)),
        'brand_id' => null,
        'categorie_first_id' => null,
        'categorie_second_id' => null,
        'categorie_third_id' => null,
        'stock' => $faker->numberBetween(1, 100),
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
  }
}
