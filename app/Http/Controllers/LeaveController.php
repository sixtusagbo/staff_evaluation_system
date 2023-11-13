<?php

namespace App\Http\Controllers;

use App\Models\Leave;

class LeaveController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role.admin')->only(['update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $data = [
            'leaves' => $user->leaves,
        ];

        $admin_data = [
            'leaves' => Leave::latest()->get(),
        ];

        return $user->is_admin ? view('admin.leaves', $admin_data) : view('app.leaves', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.create_leave');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $data = request()->validate([
            'title' => 'required|string',
            'reason' => 'required|string',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $leave = new Leave();
        $leave->title = $data['title'];
        $leave->reason = $data['reason'];
        $leave->start_date = $data['start_date'];
        $leave->end_date = $data['end_date'];
        $leave->user_id = auth()->user()->id;
        $leave->save();

        return redirect()->route('leaves.index')->with('success', 'Applied for leave successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Leave $leave)
    {
        $data = request()->validate([
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|numeric',
        ]);

        $leave->start_date = $data['start_date'];
        $leave->end_date = $data['end_date'];
        $leave->status = $data['status'];
        $leave->update();

        return redirect()->back()->with('success', 'Leave updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();

        return redirect()->back()->with('success', 'Leave deleted successfully');
    }
}
