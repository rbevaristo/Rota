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
        if(!auth()->user()->company){
            return view('user.setup')->with('error', 'Please fill up the form.');
        }
        return view('user.profile');
    }

    public function performance() {
        if(!auth()->user()->company){
            return view('user.setup')->with('error', 'Please fill up the form.');
        }
        $chartjs = app()->chartjs
        ->name('chart')
        ->type('bar')
        ->size(['width' => 100, 'height' => 100])
        ->labels([
            'Quality ofWork',
            'Efficiency of Work',
            'Dependability',
            'Job Knowledge',
            'Attitude',
            'Housekeeping',
            'Reliability',
            'Personal Care',
            'Judgement',
            ])
        ->datasets([
            [
                "label" => "My First dataset",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [4,2,3,4,1,2,3,4,4],
            ],
        ])
        ->options([]);
        return view('user.performance', compact('chartjs'));
    }

    public function attendance() {
        if(!auth()->user()->company){
            return view('user.setup')->with('error', 'Please fill up the form.');
        }
        return view('user.attendance');
    }

    public function messages() {
        if(!auth()->user()->company){
            return view('user.setup')->with('error', 'Please fill up the form.');
        }
        return view('user.messages');
    }

    public function settings() {
        if(!auth()->user()->company){
            return view('user.setup')->with('error', 'Please fill up the form.');
        }
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
