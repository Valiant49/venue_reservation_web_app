<?php

namespace Database\Seeders;

use App\Models\User;
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
        ],
        [
            'first_name'    => 'Mari',
            'middle_name'   => 'Illustrious',
            'last_name'     => 'Makinami',
            'email'         => 'mari@evang.com',
            'password'      => Hash::make('marimari'),
            'role'          => 'resident',
        ]);

    }
}
