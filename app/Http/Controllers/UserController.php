<?php

namespace App\Http\Controllers;

use App\Address;
use App\Profile;
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
        return view('user.employee');
    }

    public function performance() {
        return view('user.performance');
    }

    public function attendance() {
        return view('user.attendance');
    }

    public function settings() {
        return view('user.settings');
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
        $employee->username = $request->username;
        $employee->email = $request->email;
        $pwd = new PasswordMaker;
        $employee->password = $pwd->makePassword($request->firstname, $request->lastname, $request->username);
        $employee->position_id = $request->position_id;
        $employee->user_id = auth()->user()->id;
        $employee->save();
        
        if($employee) {
            $profile = Profile::create(['emp_id' => $employee->id]);
            $address = Address::create(['profile_id' => $profile->id]);
            
            return redirect()->back()->with('success', 'Employee Added');
        }

        return redirect()->back()->with('error', 'Error Adding');
        

    }

}
