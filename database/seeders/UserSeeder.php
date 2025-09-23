<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfiles;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'password' => 'admin123',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'user',
            'password' => 'user123',
            'role' => 'user',
        ]);

        UserProfiles::create([
            'user_id' => 2,
            'email' => 'user@gmail.com',
            'date_of_birth' => Carbon::parse('2003-09-03'),
            'gender' => 'male',
            'address' => 'Jl. Angkasa Bumi',
            'province_id' => '35',
            'city_id' => '35.78',
            'contact' => '0857550234',
            'paypal_id' => 'H238NC83',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
