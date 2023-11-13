<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leave)
    {
        //
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
