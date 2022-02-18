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

        DB::table('categories')->insert([
            [
                'nama_kategori' => 'Uncategorized'
            ],
            [
                'nama_kategori' => 'Kamera'
            ],
            [
                'nama_kategori' => 'Lensa'
            ],
            [
                'nama_kategori' => 'Lighting'
            ]
        ]);

        DB::table('alats')->insert([
            [
                'nama_alat' => 'Sony a7ii',
                'kategori_id' => '2'
            ],
            [
                'nama_alat' => 'Sony a6000',
                'kategori_id' => '2'
            ],
            [
                'nama_alat' => 'Sigma 30mm 1.4',
                'kategori_id' => '3'
            ],
            [
                'nama_alat' => 'Canon EF 24-70mm 2.8',
                'kategori_id' => '3'
            ]
        ]);
    }
}
