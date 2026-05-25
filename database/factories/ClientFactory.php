<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'block_num'   => $this->faker->numberBetween(1, 50),
            'lot_num'     => $this->faker->numberBetween(1, 30),
            'street_num'  => $this->faker->numberBetween(1, 99),
            'first_name'  => $this->faker->firstName(),
            'middle_name' => $this->faker->firstName(),
            'last_name'   => $this->faker->lastName(),
            'contact_num' => $this->faker->numerify('09#########'),
            'email'       => $this->faker->unique()->safeEmail(),
        ];
    }
}
