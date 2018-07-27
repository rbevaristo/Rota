<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EmployeeRequest;

class UserController extends Controller
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

    public function profile() {
        return view('user.profile');
    }

    public function schedule() {
        return view('user.schedule');
    }

    public function employee() {
        $user = auth()->user();
        return view('user.employee', compact('user'));
    }

    public function performance() {
        return view('user.performance');
    }

    public function attendance() {
        return view('user.attendance');
    }

    public function settings() {
        $user = auth()->user();
        return view('user.settings', compact('user'));
    }

    public function store(EmployeeRequest $request) {
        $employee = Employee::create([
            'name' => $request->name,
            'employee_id' => $request->employee_id,
            'email' => $request->email,
            'password' => Hash::make('123456'),
            'position_id' => $request->position_id,
            'user_id' => auth()->user()->id
        ]);
        
        if(!$employee) {
            return redirect()->back()->with('error', 'Error Adding');
        }

        return redirect()->back()->with('success', 'Employee Added');
    }
}
