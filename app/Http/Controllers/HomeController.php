<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeesCollection;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->company){
            return view('user.setup')->with('error', 'Please fill up the form.');
        }
        $employs = EmployeesCollection::collection(auth()->user()->employees);
        $employs = json_encode($employs);
        return view('dashboard', compact('employs'));
    }

    public function setup() {
        if(auth()->user()->company){
            return view('user.manage');
        }
        return view('user.setup');
    }

    public function manage(){
        if(!auth()->user()->company){
            return view('user.setup')->with('error', 'Please fill up the form.');
        } 
        return view('user.manage');
    }

    
}
