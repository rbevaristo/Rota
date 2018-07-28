<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            return view('user.setup');
        }
        return view('dashboard');
    }

    public function setup() {
        if(auth()->user()->company){
            return view('user.setup2');
        }
        return view('user.setup');
    }

    public function setup2(){
        if(!auth()->user()->company){
            return view('user.setup');
        } else if(!auth()->user()->positions || !auth()->user()->requests){
            return view('dashboard');
        }
        return view('user.setup2');
    }
}
