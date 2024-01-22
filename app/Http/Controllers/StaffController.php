<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role.admin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.staff', [
            'users' => User::where('type', 0)->latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->back()->with('success', 'User created successfully');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(User $user)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'type' => ['required', 'numeric', 'in:0,1'],
        ]);

        $user->update($data);

        return redirect()->back()->with('success', $data['type'] == 1 ? $user->name . ' promoted to admin successfully.' : 'Staff updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->attendances()->delete();
        $user->leaves()->delete();
        $user->tasks()->detach();
        $user->delete();

        return redirect()->back()->with('success', 'Staff deleted successfully');
    }

    public function grade(User $user)
    {
        $taskScore = $user->tasks->sum('weight') * 10;
        $attendanceScore = $user->attendances->count() * 10;

        $finalGrade = $taskScore + $attendanceScore;

        return view('grade', ['grade' => $finalGrade]);
    }
}
