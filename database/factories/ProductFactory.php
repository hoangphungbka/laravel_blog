<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->numberBetween(100, 1000) * 1000,
            'discount' => $this->faker->numberBetween(0, 50),
            'image' => "/img/product/p{$this->faker->numberBetween(1, 8)}.jpg",
            'category_id' => $this->faker->numberBetween(1, 7),
            'brand_id' => $this->faker->numberBetween(1, 5),
            'color_id' => $this->faker->numberBetween(1, 5),
            'status' => 1
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            DB::table('product_size')->insert([
                'product_id' => $product->getAttribute('id'),
                'size_id' => $this->faker->numberBetween(1, 21),
                'quantity' => $this->faker->numberBetween(1, 100)
            ]);
        });
    }
}
