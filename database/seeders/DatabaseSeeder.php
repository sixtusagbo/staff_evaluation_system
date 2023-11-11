<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Sixtus Agbo',
            'email' => 'sixtusagbo211@gmail.com',
            'type' => 1,
        ]);

        \App\Models\User::factory(5)->create();
    }
}
