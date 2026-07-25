<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'first_name'    => 'Michael',
            'last_name'     => 'Afton',
            'email'         => 'admin@email.com',
            'password'      => Hash::make('12345678'),
            'role'          => 'admin',
        ]);
        User::create([
            'block_num'     => '8',
            'lot_num'       => '8',
            'street_num'    => '8',
            'first_name'    => 'Mari',
            'middle_name'   => 'Illustrious',
            'last_name'     => 'Makinami',
            'email'         => 'mari@evang.com',
            'password'      => Hash::make('marimari'),
            'role'          => 'resident',
        ]);

        Facility::create([
            'name'                      => 'Badminton Court 1',
            'category'                  => 'court',
            'description'               => 'Play badminton with your friends.',
            'starting_hours'            => '08:00:00',
            'closing_hours'             => '20:00:00',
            'max_capacity'              => '12',
            'base_fee'                  => '100.00',
            'reservation_type'          => 'hourly',
            'max_reservation_duration'  => '4',
            'facility_status'           => 'Open',
        ]);
        Facility::create([
            'name'                      => 'The Clubhouse',
            'category'                  => 'clubhouse',
            'description'               => 'Hold community events in The Clubhouse to strengthen social ties',
            'starting_hours'            => '08:00:00',
            'closing_hours'             => '16:00:00',
            'max_capacity'              => '80',
            'base_fee'                  => '250',
            'reservation_type'          => 'block',
            'max_reservation_duration'  => '8',
            'facility_status'           => 'Open',
        ]);
        Facility::create([
            'name'                      => 'Function Hall',
            'category'                  => 'hall',
            'description'               => 'Celebrate life\'s milestones with style.',
            'starting_hours'            => '08:00:00',
            'closing_hours'             => '16:00:00',
            'max_capacity'              => '150',
            'base_fee'                  => '250',
            'reservation_type'          => 'block',
            'max_reservation_duration'  => '5',
            'facility_status'           => 'Open',
        ]);
        Facility::create([
            'name'                      => 'The Pool',
            'category'                  => 'pool',
            'description'               => 'Drench yourself during the summer heat.',
            'starting_hours'            => '10:00:00',
            'closing_hours'             => '10:00:00',
            'max_capacity'              => '50',
            'base_fee'                  => '150',
            'reservation_type'          => 'hourly',
            'max_reservation_duration'  => '2',
            'facility_status'           => 'Open',
        ]);

    }
}
