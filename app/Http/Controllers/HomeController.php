<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Task;
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

        $data = [
            'user' => $user,
            'attendances' => $user->attendances()->latest()->take(10)->get(),
        ];

        $admin_data = [
            'users' => User::where('type', 0)->latest(),
            'tasks' => Task::latest(),
            'pending_leaves' => Leave::latest(),
        ];

        if ($user->type == 1) {
            return view('admin.home')->with($admin_data);
        }

        return view('app.home')->with($data);
    }
}
