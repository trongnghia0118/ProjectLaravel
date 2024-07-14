<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'title' => $this->faker->sentence(4), // Generate a random sentence for the title
            'image' => $this->faker->imageUrl(), // Generate a random image URL
            'price' => $this->faker->randomFloat(2, 10, 1000), // Generate a random price between 10 and 1000
            'sale' => $this->faker->numberBetween(0, 50), // Generate a random sale percentage between 0 and 50
            'description' => $this->faker->paragraph, // Generate a random paragraph for the description
            'detail' => $this->faker->text(200), // Generate a random text with 200 characters for the detail
            'status' => $this->faker->randomElement([0, 1]), // Generate a random status (0 or 1)
            'category_id' => function () {
                return \App\Models\Category::factory()->create()->id; // Create a new category and get its id
            },
        ];
    }
}
