<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskUserSeeder extends Seeder
{
  public function run()
  {
    // Fetch all users and tasks
    $users = User::all();
    $tasks = Task::all();

    // For each user...
    $users->each(function ($user) use ($tasks) {
      // Assign 3 random tasks
      $user->tasks()->attach(
        $tasks->random(rand(1, 3))->pluck('id')->toArray()
      );
    });
  }
}
