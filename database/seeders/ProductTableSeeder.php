<?php
namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder {
    public function run() {
        // создать 12 товаров
        Product::factory()->count(12)->create();
    }
}
