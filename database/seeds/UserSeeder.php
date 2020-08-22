<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@makerindo.com',
            'password' => Hash::make('12341234'),
            'level' => 1
        ]);
        User::create([
            'name' => 'Admin',
            'email' => 'admin1@makerindo.com',
            'password' => Hash::make('12341234'),
            'level' => 2
        ]);
    }
}
