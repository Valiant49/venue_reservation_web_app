<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'first_name' => 'System',
            'last_name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'account_status' => 'Active',
        ]);

        User::create([
            'first_name' => 'Demo',
            'last_name' => 'Resident',
            'email' => 'resident@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'resident',
            'account_status' => 'Active',
            'block_num' => 1,
            'lot_num' => 1,
            'street_num' => 1,
            'contact_num' => '09123456789',
        ]);
        $password = Hash::make('12345678');

        /*
        |--------------------------------------------------------------------------
        | Name Pools
        |--------------------------------------------------------------------------
        */

        $firstNames = [
            'Juan','Maria','Jose','Ana','Carlo','Mark','Paolo','John','Joshua',
            'Daniel','Patrick','Christian','Michael','Gabriel','Rafael','Miguel',
            'Francis','Vincent','Anthony','Kevin','Louie','Bryan','Jessa','Camille',
            'Angela','Andrea','Patricia','Nicole','Katrina','Bianca','Joy','Grace',
            'Princess','Rose','Sheena','Jasmine','Karen','Louise','Angela','Marian',
            'Jerome','Kenneth','Nathan','Kyle','Sean','Adrian','Julius','Noel',
            'Lea','Ella','Sophia','Isabel','Claire','Faith','Trisha','Alyssa'
        ];

        $middleNames = [
            'Santos','Reyes','Cruz','Garcia','Torres','Mendoza','Flores',
            'Aquino','Bautista','Ramos','Villanueva','Navarro','Domingo',
            'Mercado','Castillo', null
        ];

        $lastNames = [
            'Santos','Reyes','Dela Cruz','Garcia','Torres','Mendoza','Flores',
            'Aquino','Ramos','Villanueva','Navarro','Domingo','Mercado',
            'Castillo','Fernandez','Lopez','Gonzales','Rivera','Morales',
            'Tan','Uy','Go','Lim','Chua','Co','Sy','Yu','Ong'
        ];

        /*
        |--------------------------------------------------------------------------
        | Status Generator
        |--------------------------------------------------------------------------
        */

        $randomStatus = function () {

            $rand = mt_rand(1,100);

            return match (true) {
                $rand <= 85 => 'Active',
                $rand <= 95 => 'Archived',
                default => 'Blacklisted',
            };
        };

        /*
        |--------------------------------------------------------------------------
        | Admins
        |--------------------------------------------------------------------------
        */

        User::create([
            'first_name' => 'Michael',
            'middle_name' => 'William',
            'last_name' => 'Afton',
            'role' => 'admin',
            'account_status' => 'Active',
            'email' => 'admin@email.com',
            'password' => $password,
        ]);

        for ($i = 2; $i <= 5; $i++) {

            User::create([
                'first_name' => $firstNames[array_rand($firstNames)],
                'middle_name' => $middleNames[array_rand($middleNames)],
                'last_name' => $lastNames[array_rand($lastNames)],
                'role' => 'admin',
                'account_status' => $randomStatus(),
                'email' => "admin{$i}@sunshinehoa.test",
                'password' => $password,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Staff
        |--------------------------------------------------------------------------
        */

        for ($i = 1; $i <= 5; $i++) {

            User::create([
                'first_name' => $firstNames[array_rand($firstNames)],
                'middle_name' => $middleNames[array_rand($middleNames)],
                'last_name' => $lastNames[array_rand($lastNames)],
                'role' => 'staff',
                'account_status' => $randomStatus(),
                'email' => "staff{$i}@sunshinehoa.test",
                'password' => $password,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Residents
        |--------------------------------------------------------------------------
        */

        for ($i = 1; $i <= 45; $i++) {

            $first = $firstNames[array_rand($firstNames)];
            $middle = $middleNames[array_rand($middleNames)];
            $last = $lastNames[array_rand($lastNames)];

            User::create([
                'first_name' => $first,
                'middle_name' => $middle,
                'last_name' => $last,

                'role' => 'resident',
                'account_status' => $randomStatus(),

                'block_num' => rand(1,12),
                'lot_num' => rand(1,30),
                'street_num' => rand(1,8),

                'contact_num' => '09' . rand(100000000,999999999),

                'email' => strtolower(
                    str_replace(' ', '', $first) .
                    '.' .
                    str_replace(' ', '', $last) .
                    $i .
                    '@gmail.com'
                ),

                'password' => $password,
            ]);
        }
    }
}
