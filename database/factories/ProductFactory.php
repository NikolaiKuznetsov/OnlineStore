<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'country' => $this->faker->country(),
            'year' => $this->faker->year(),
            'model' => $this->faker->word(),
            'quantity' => $this->faker->randomNumber(2),
        ];
    }
}
