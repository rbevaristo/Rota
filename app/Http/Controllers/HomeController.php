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
        $employs = EmployeesCollection::collection(auth()->user()->employees->where('status', 1));
        $shifts = auth()->user()->shifts;
        $required_shifts = auth()->user()->required_shifts;
        $settings = [
            'sharing' => auth()->user()->setting->sharing, // boolean | default is 0 meaning it is off
            'dayoff' => auth()->user()->setting->dayoff, // boolean | default is 0 meaning it is off
            'shift' => auth()->user()->setting->shift, // boolean | default is 0 meaning it is off
            'days' => auth()->user()->setting->num_days, // integer | default is 7 for 1 week
            'dayoffs' => auth()->user()->setting->num_dayoff // integer | default is 1 it is base from the ratio 7days:1dayoff
        ];

        $criteria = [
            'age' => auth()->user()->criteria->age, // boolean | default is 0 meaning it is off
            'age_value' => auth()->user()->criteria->age_value, // integer the condition will be greater than the value
            'gender' => auth()->user()->criteria->gender, // boolean | default is 0 meaning it is off
            'gender_value' => auth()->user()->criteria->gender, // boolean for male is 1 for female 0
            'name' => auth()->user()->criteria->name, // boolean | default is 0 meaning it is off
            'name_value' => auth()->user()->criteria->name_value, // boolean sort by firstname is 0 sortb by lastname is 1
        ];

       
        return view('dashboard', [
            'employs' => json_encode($employs),
            'shifts' => $shifts,
            'required_shifts' => $required_shifts,
            'settings' => json_encode($settings),
            'criteria' => json_encode($criteria)
        ]);
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
