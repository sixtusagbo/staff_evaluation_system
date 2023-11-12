<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $data = [
            'user' => $user,
            'tasks' => $user->tasks,
            'pending_tasks' => $user->tasks()->where('deadline', '<', now()),
            'upcoming_tasks' => $user->tasks()->where('started_on', '>', now()),
        ];

        $admin_data = [
            'user' => $user,
            'tasks' => Task::latest()->get(),
        ];

        return $user->is_admin ? view('admin.tasks', $admin_data) : view('app.tasks', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $data = request()->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'starts_on' => 'required|date|before:deadline',
            'deadline' => 'required|date|after:starts_on',
            'points' => 'required|numeric',
        ]);

        $task = new Task();
        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->started_on = $data['starts_on'];
        $task->deadline = $data['deadline'];
        $task->points = $data['points'];
        $task->save();

        return redirect()->back()->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
