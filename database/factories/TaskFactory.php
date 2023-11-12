<?php

namespace Database\Factories;

use Carbon\Carbon;
use DateInterval;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $started_on = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $deadline = (clone $started_on)->add(new DateInterval('PT' . $this->faker->numberBetween(1, 14) . 'H'));


        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'started_on' => $started_on,
            'deadline' => $deadline,
            'points' => $this->faker->numberBetween(1, 30),
        ];
    }
}
