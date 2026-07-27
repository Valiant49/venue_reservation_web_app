<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facility;
use App\Models\AddOn;

class FacilityAddOnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Badminton Court 1
        |--------------------------------------------------------------------------
        */
        $badminton = Facility::where('name', 'Badminton Court 1')->first();

        $badminton->addOns()->sync([
            AddOn::where('name', 'Plastic Chairs')->first()->id,
            AddOn::where('name', 'Badminton Racket Set')->first()->id,
            AddOn::where('name', 'Shuttlecock Pack')->first()->id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | The Clubhouse
        |--------------------------------------------------------------------------
        */
        $clubhouse = Facility::where('name', 'The Clubhouse')->first();

        $clubhouse->addOns()->sync([
            AddOn::where('name', 'Plastic Chairs')->first()->id,
            AddOn::where('name', 'Round Tables')->first()->id,
            AddOn::where('name', 'Sound System')->first()->id,
            AddOn::where('name', 'Projector')->first()->id,
            AddOn::where('name', 'Stage Lighting')->first()->id,
            AddOn::where('name', 'Cleaning Service')->first()->id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Function Hall
        |--------------------------------------------------------------------------
        */
        $functionHall = Facility::where('name', 'Function Hall')->first();

        $functionHall->addOns()->sync([
            AddOn::where('name', 'Plastic Chairs')->first()->id,
            AddOn::where('name', 'Round Tables')->first()->id,
            AddOn::where('name', 'Sound System')->first()->id,
            AddOn::where('name', 'Projector')->first()->id,
            AddOn::where('name', 'Stage Lighting')->first()->id,
            AddOn::where('name', 'Tent Canopy')->first()->id,
            AddOn::where('name', 'Cleaning Service')->first()->id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | The Pool
        |--------------------------------------------------------------------------
        */
        $pool = Facility::where('name', 'The Pool')->first();

        $pool->addOns()->sync([
            AddOn::where('name', 'Plastic Chairs')->first()->id,
            AddOn::where('name', 'Tent Canopy')->first()->id,
            AddOn::where('name', 'Life Jacket Rental')->first()->id,
            AddOn::where('name', 'Cleaning Service')->first()->id,
        ]);
    }
}
