<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Product::class;

    public function definition()
    {
        return [
            'category_id' => rand(1, 4),
            'name' =>  $this->faker->name(),
            'content' => $this->faker->realText(rand(400, 500)),
            'slug' => Str::slug( $this->faker->name()),
            'price' => rand(1000, 2000),
        ];
    }
}
