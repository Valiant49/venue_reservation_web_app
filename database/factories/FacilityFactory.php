<?php

namespace Database\Factories;

use App\Models\Facility;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Facility>
 */
class FacilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['clubhouse','pool','basketball','volleyball','badminton'];

        return [
            'facility_code' => 'FAC-' . strtoupper($this->faker->unique()->bothify('????')),
            'facility_name' => $this->faker->words(2, true) . ' ' . $this->faker->randomElement($types),
            'facility_type' => $this->faker->randomElement($types),
            'base_fee'      => $this->faker->randomFloat(2, 100, 5000),
            'capacity'      => $this->faker->numberBetween(10, 200),
            'description'   => $this->faker->sentence(),
        ];
    }
}
