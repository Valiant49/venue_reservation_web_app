<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Facility;
use App\Models\Reservation;
use App\Models\AddOn;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $facilities = Facility::where('facility_status', 'Open')->get();

        $residents = User::where('role', 'resident')->get();

        $staff = User::whereIn('role', ['admin','staff'])->get();

        $created = 0;

        $events = [
            'Graduation Ceremony',
            'Moving Up Ceremony',
            'Graduation Photo Session',
            'Recognition Dinner',
            'Family Celebration',
            'Class Reunion',
            'Award Ceremony',
        ];

        $statuses = [
            'Confirmed',
            'Confirmed',
            'Confirmed',
            'Pending',
            'Under Review',
            'Completed',
            'Cancelled',
            'Rejected',
        ];


        while ($created < 75) {

            $facility = $facilities->random();

            $resident = $residents->random();

            $date = Carbon::create(
                2026,
                8,
                rand(1,31)
            );


            /*
            |--------------------------------------------------------------------------
            | Generate valid time slot
            |--------------------------------------------------------------------------
            */

            $opening = Carbon::parse($facility->starting_hours);

            $closing = Carbon::parse($facility->closing_hours);


            if ($opening->equalTo($closing)) {
                continue;
            }


            $availableHours = $opening->diffInHours($closing);


            if ($availableHours < 1) {
                continue;
            }


            $duration = rand(
                1,
                min(
                    $facility->max_reservation_duration,
                    $availableHours
                )
            );


            $startHour = rand(
                $opening->hour,
                $closing->hour - $duration
            );


            $start = Carbon::create(
                2026,
                8,
                $date->day,
                $startHour,
                0
            );


            $end = $start->copy()->addHours($duration);



            /*
            |--------------------------------------------------------------------------
            | Conflict checking
            |--------------------------------------------------------------------------
            */

            $conflict = Reservation::where('facility_id', $facility->id)
                ->whereDate('date', $date)
                ->where(function ($query) use ($start, $end) {

                    $query->where('start_time', '<', $end->format('H:i'))
                        ->where('end_time', '>', $start->format('H:i'));

                })
                ->exists();


            if ($conflict) {
                continue;
            }



            /*
            |--------------------------------------------------------------------------
            | Guest count
            |--------------------------------------------------------------------------
            */

            $guestCount = rand(
                1,
                $facility->max_capacity
            );



            /*
            |--------------------------------------------------------------------------
            | Fee
            |--------------------------------------------------------------------------
            */

            $totalFee =
                $facility->base_fee * $duration;



            /*
            |--------------------------------------------------------------------------
            | Create reservation
            |--------------------------------------------------------------------------
            */

            $reservation = Reservation::create([

                'code' =>
                    'RES-' . strtoupper(Str::random(5)),

                'date' =>
                    $date->format('Y-m-d'),

                'start_time' =>
                    $start->format('H:i'),

                'end_time' =>
                    $end->format('H:i'),

                'total_fee' =>
                    $totalFee,

                'guest_count' =>
                    $guestCount,

                'event_type' =>
                    fake()->randomElement($events),

                'status' =>
                    fake()->randomElement($statuses),

                'notes' =>
                    fake()->optional()->sentence(),

                'facility_id' =>
                    $facility->id,

                'reserved_by' =>
                    $resident->id,

                'facilitated_by' =>
                    rand(0,1)
                        ? $staff->random()->id
                        : null,
            ]);


            /*
            |--------------------------------------------------------------------------
            | Add-ons
            |--------------------------------------------------------------------------
            */

            $availableAddons = $facility->addOns;


            if ($availableAddons->count() > 0) {

                $selected =
                    $availableAddons
                    ->random(
                        rand(
                            0,
                            min(3,$availableAddons->count())
                        )
                    );


                $pivot = [];


                foreach ($selected as $addon) {

                    $pivot[$addon->id] = [

                        'quantity'=>1,

                        'unit_price'=>$addon->price,

                        'subtotal'=>$addon->price,

                    ];


                    $totalFee += $addon->price;
                }


                $reservation->addOns()->sync($pivot);


                $reservation->update([
                    'total_fee'=>$totalFee
                ]);
            }


            $created++;

        }
    }
}
