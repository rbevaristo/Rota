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
        return view('user.performance');
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
}
