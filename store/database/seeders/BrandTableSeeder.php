<?php
namespace Database\Seeders;
use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder {
    public function run() {
        // создать 4 бренда
        Brand::factory()->count(4)->create();
    }
}
