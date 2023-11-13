<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskUser;
use App\Models\TaskView;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role.admin')->except(['index', 'done']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $data = [
            'user' => $user,
            'your_tasks' => $user->tasks,
            'ongoing_tasks' => Task::whereDate('started_on', '<=', now())
                ->whereDate('deadline', '>=', now())
                ->whereDoesntHave('users', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->get(),
            'upcoming_tasks' => Task::whereDate('started_on', '>', now())->get(),
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
     * Update the specified resource in storage.
     */
    public function update(Task $task)
    {
        $data = request()->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'starts_on' => 'required|date|before:deadline',
            'deadline' => 'required|date|after:starts_on',
            'points' => 'required|numeric',
        ]);

        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->started_on = $data['starts_on'];
        $task->deadline = $data['deadline'];
        $task->points = $data['points'];
        $task->update();

        return redirect()->back()->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully');
    }

    /**
     * Create a task_user to depict that a user has completed a task.
     */
    public function done(Task $task)
    {
        $user = auth()->user();

        $task_user = new TaskUser();
        $task_user->task_id = $task->id;
        $task_user->user_id = $user->id;
        $task_user->save();

        return redirect()->back()->with('success', 'Task completed successfully');
    }
}
