<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Task;
use App\Models\TaskView;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $tasks = TaskView::latest();

        $data = [
            'user' => $user,
            'attendances' => $user->attendances()->latest()->take(10)->get(),
            'tasks' => $tasks->where('status', 1)->take(5)->get(),
            'leaves' => $user->leaves()->latest()->take(5)->get(),
        ];

        $staff = User::where('type', 0)->withCount(['tasks', 'attendances'])->latest()->get();
        $leaves = Leave::latest();
        $chart_labels = $staff->pluck('name');
        $task_chart_data = $staff->pluck('tasks_count');
        $attendance_chart_data = $staff->pluck('attendances_count');

        $admin_data = [
            'users' => $staff,
            'tasks' => $tasks,
            'pending_leaves' => $leaves->where('status', 0)->get(),
            'leaves' => $leaves->get(),
            'chart_labels' => $chart_labels,
            'task_chart_data' => $task_chart_data,
            'attendance_chart_data' => $attendance_chart_data,
        ];

        return $user->is_admin ? view('admin.home')->with($admin_data) : view('app.home')->with($data);
    }
}
