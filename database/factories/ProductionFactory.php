<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'quantity' => $this->faker->numberBetween(10,100),
            'created_at' => $this->faker->dateTimeBetween('-1 years', 'now')
        ];
    }
}
