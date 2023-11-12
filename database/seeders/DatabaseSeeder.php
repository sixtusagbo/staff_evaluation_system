<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Sixtus Agbo',
            'email' => 'sixtusagbo211@gmail.com',
            'type' => 1,
        ]);

        User::factory()->create([
            'name' => 'Xavi Joe',
            'email' => 'xavijoe200@gmail.com',
        ]);

        $this->call([
            TaskSeeder::class,
            LeaveSeeder::class,
            TaskUserSeeder::class,
        ]);
    }
}
