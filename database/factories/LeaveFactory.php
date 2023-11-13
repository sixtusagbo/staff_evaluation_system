<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leave>
 */
class LeaveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start_date = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $end_date = $this->faker->dateTimeBetween($start_date, '+2 months');

        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence,
            'start_date' => $start_date->format('Y-m-d'),
            'end_date' => $end_date->format('Y-m-d'),
            'reason' => $this->faker->paragraph,
            'status' => $this->faker->randomElement([0, 1, 2]),
        ];
    }
}
