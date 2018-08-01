<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Employee;
use PasswordMaker;
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

    /**
     * Method that handles request for storing Employee.
     * @param \Http\Requests\EmployeeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request) {
        
        $employee = new Employee;
        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->employee_id = $request->employee_id;
        $employee->email = $request->email;
        $pwrd = new PasswordMaker($request->firstname, $request->lastname, $request->employee_id);
        $employee->password = $pwrd->makePassword();
        $employee->position_id = $request->position_id;
        $employee->user_id = auth()->user()->id;
        $employee->save();
        
        if(!$employee) {
            return redirect()->back()->with('error', 'Error Adding');
        }

        return redirect()->back()->with('success', 'Employee Added');
    }

}
