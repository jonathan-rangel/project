<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Smartphone>
 */
class SmartphoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->text(25);
        $description = $this->faker->text(200);
        $specs = $this->faker->text(200);
        $image_url = $this->faker->imageUrl($width = 140, $height = 200);
        $stock = $this->faker->numberBetween($min = 0, $max = 30);
        $price = $this->faker->numberBetween($min = 8999, $max = 22999);
        $brand = $this->faker->company();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'brand' => $brand,
            'description' => $description,
            'specs' => $specs,
            'stock' =>$stock,
            'image_name' => $image_url,
            'price' => $price,
            'sale_price' => $price - 100
        ];
    }
}
