<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Facility;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Facility::create([
            'name'                      => 'Badminton Court 1',
            'description'               => 'Play badminton with your friends.',
            'starting_hours'            => '08:00:00',
            'closing_hours'             => '20:00:00',
            'max_capacity'              => '12',
            'base_fee'                  => '100.00',
            'max_reservation_duration'  => '4',
            'facility_status'           => 'Open',
        ]);
        Facility::create([
            'name'                      => 'The Clubhouse',
            'description'               => 'Hold community events in The Clubhouse to strengthen social ties',
            'starting_hours'            => '08:00:00',
            'closing_hours'             => '16:00:00',
            'max_capacity'              => '80',
            'base_fee'                  => '250',
            'max_reservation_duration'  => '8',
            'facility_status'           => 'Open',
        ]);
        Facility::create([
            'name'                      => 'Function Hall',
            'description'               => 'Celebrate life\'s milestones with style.',
            'starting_hours'            => '08:00:00',
            'closing_hours'             => '16:00:00',
            'max_capacity'              => '150',
            'base_fee'                  => '250',
            'max_reservation_duration'  => '5',
            'facility_status'           => 'Open',
        ]);
        Facility::create([
            'name'                      => 'The Pool',
            'description'               => 'Drench yourself during the summer heat.',
            'starting_hours'            => '10:00:00',
            'closing_hours'             => '18:00:00',
            'max_capacity'              => '50',
            'base_fee'                  => '150',
            'max_reservation_duration'  => '2',
            'facility_status'           => 'Open',
        ]);
    }
}
