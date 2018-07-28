<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeRoutesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function profile() {
        return view('employee.profile');
    }

    public function messages() {
        $user = Auth::user()->user;
        return view('employee.messages', compact('user'));
    }

    public function schedule() {
        return view('employee.schedule');
    }

    public function evaluation() {
        return view('employee.evaluation');
    }
}
