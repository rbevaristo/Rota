<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
