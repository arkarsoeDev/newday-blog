<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Arkar Soe',
            'email' => 'arkar@example.com',
            'role' => '0',
            'password' => Hash::make('11111111'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test admin',
            'email' => 'admin@example.com',
            'role' => '0',
            'password' => Hash::make('11111111'),
        ]);


        \App\Models\User::factory()->create([
            'name' => 'Test Editor',
            'email' => 'editor@example.com',
            'role' => '1',
            'password' => Hash::make('11111111'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Author',
            'email' => 'author@example.com',
            'role' => '2',
            'password' => Hash::make('11111111'),
        ]);
    }
}