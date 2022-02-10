<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Yoga Indra',
                'email' => 'yogaiw@test.com',
                'password' => Hash::make('yogaiw'),
                'isAdmin' => true
            ],
            [
                'name' => 'Hanna Hunafa',
                'email' => 'hannan@test.com',
                'password' => Hash::make('hhphoto'),
                'isAdmin' => false
            ]
        ]);
    }
}
