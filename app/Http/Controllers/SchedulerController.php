<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchedulerController extends Controller
{
    public $days;
    public $dayoff;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function schedule()
    {

        $this->days = auth()->user()->setting->num_days;
        $this->dayoff = auth()->user()->setting->num_dayoff;

        $employees = auth()->user()->employees->where('status', 1);

        if(auth()->user()->setting->sharing){

        }

        if(auth()->user()->setting->dayoff){

        }

        if(auth()->user()->setting->shift){

        }

        if(auth()->user()->setting->shuffle){

        }

        if(auth()->user()->criteria->age){

        }

        if(auth()->user()->criteria->gender){

        }

        if(auth()->user()->criteria->name){

        }

        return $this->generate($employees);

    }

    public function generate($employees)
    {
        dd($employees);
        // Assign Shift by Position Required Per Day
        $required = auth()->user()->required_shifts;

        
        
    }
}
