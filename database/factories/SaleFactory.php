<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantity' => $this->faker->numberBetween(10, 100),
            'route_id' => $this->faker->numberBetween(1,5),
            'created_at' => $this->faker->dateTimeBetween('-1 years', 'now')
        ];
    }
}
