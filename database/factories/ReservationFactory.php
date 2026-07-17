<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Resident;
use App\Models\Facility;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->numberBetween(7, 16); // 07:00 to 16:00
        $end   = $start + $this->faker->numberBetween(1, 3);

        return [
            'reservation_code' => 'RES-' . strtoupper($this->faker->unique()->bothify('?????')),
            'reservation_date' => $this->faker->dateTimeBetween('now', '+3 months')->format('Y-m-d'),
            'start_time'       => sprintf('%02d:00', $start),
            'end_time'         => sprintf('%02d:00', $end),
            'total_fee'        => $this->faker->randomFloat(2, 100, 9999),
            'guest_count'      => $this->faker->numberBetween(1, 30),
            'status'           => $this->faker->randomElement(['Pending', 'Confirmed', 'Cancelled']),
            'event_type'       => $this->faker->randomElement(['Party', 'Meeting', 'Debut', 'Wedding', 'Seminar']),
            'notes'            => $this->faker->optional()->sentence(),
            'facility_id'      => Facility::factory(),
            'reserved_by'      => Resident::factory(),
            'facilitated_by'   => User::factory(),
        ];
    }
}
