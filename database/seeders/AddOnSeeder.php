<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AddOn;

class AddOnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addOns = [
            [
                'name' => 'Plastic Chairs',
                'description' => 'Additional plastic chairs for guests.',
                'price' => 15.00,
                'is_active' => 'Active',
            ],
            [
                'name' => 'Round Tables',
                'description' => 'Extra tables for dining or registration.',
                'price' => 100.00,
                'is_active' => 'Active',
            ],
            [
                'name' => 'Sound System',
                'description' => 'Speaker and microphone package.',
                'price' => 500.00,
                'is_active' => 'Active',
            ],
            [
                'name' => 'Projector',
                'description' => 'LCD projector with HDMI cable.',
                'price' => 400.00,
                'is_active' => 'Active',
            ],
            [
                'name' => 'Stage Lighting',
                'description' => 'Basic lighting setup for programs.',
                'price' => 350.00,
                'is_active' => 'Active',
            ],
            [
                'name' => 'Tent Canopy',
                'description' => 'Outdoor canopy tent.',
                'price' => 600.00,
                'is_active' => 'Active',
            ],
            [
                'name' => 'Badminton Racket Set',
                'description' => 'Pair of badminton rackets.',
                'price' => 80.00,
                'is_active' => 'Active',
            ],
            [
                'name' => 'Shuttlecock Pack',
                'description' => 'One dozen shuttlecocks.',
                'price' => 120.00,
                'is_active' => 'Active',
            ],
            [
                'name' => 'Life Jacket Rental',
                'description' => 'Life jackets for swimming pool guests.',
                'price' => 75.00,
                'is_active' => 'Active',
            ],
            [
                'name' => 'Cleaning Service',
                'description' => 'Post-event cleaning service.',
                'price' => 300.00,
                'is_active' => 'Inactive',
            ],
        ];

        foreach ($addOns as $addOn) {
            AddOn::create($addOn);
        }
    }
}
