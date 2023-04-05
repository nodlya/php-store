<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder {
    public function run() {
        // создать 4 категории
        Category::factory()->count(4)->create();
    }
}
