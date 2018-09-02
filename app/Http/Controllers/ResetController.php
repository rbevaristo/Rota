<?php

namespace App\Http\Controllers;

use App\Employee;
use PasswordMaker;
use Illuminate\Http\Request;
use App\EmployeePasswordReset;

class ResetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'reset']]);
    }

    public function index()
    {
        return view('employee.index');
    }

    public function reset(Request $request)
    {
        $reset = EmployeePasswordReset::where('username', $request->username)->first();

        if($reset){
            return redirect()->back()->with('error', 'You already request a password reset please contact your administrator');
        }

        $employee = Employee::where('username', $request->username)->first();

        if(!$employee){
            return redirect()->back()->with('error', 'Employee ID does not exist!');            
        }

        $reset = new EmployeePasswordReset;
        $reset->username = $request->username;
        $reset->user_id = $employee->user->id;
        $reset->save();

        if($reset){
            return redirect('/login')->with('success', 'Request Sent! Please contact your administrator');
        }
        return redirect()->back()->with('error', 'Error Processing Request');
    }

    public function password_reset(Request $request)
    {
        $employee = auth()->user()->employees->where('username', $request->id)->first();

        if($employee){
            $pwd = new PasswordMaker;
            $employee->password = $pwd->makePassword($employee->firstname, $employee->lastname, $employee->username);
            $employee->is_reset = 0;
            $employee->save();

            $reset = auth()->user()->resets->where('username', $employee->username)->first();
            $reset->delete();

            return response()->json(['data' => 'Password reset success!']);
        }
        

        return response()->json(['data' => 'Error processing request!']);        
    }
}
