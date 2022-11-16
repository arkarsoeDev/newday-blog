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
            'name' => 'Test admin',
            'email' => 'admin@admin.com',
            'role' => '0',
            'password' => Hash::make('password'),
        ]);


        \App\Models\User::factory()->create([
            'name' => 'Test Editor',
            'email' => 'editor@editor.com',
            'role' => '1',
            'password' => Hash::make('password'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Author',
            'email' => 'author@author.com',
            'role' => '2',
            'password' => Hash::make('password'),
        ]);
    }
}