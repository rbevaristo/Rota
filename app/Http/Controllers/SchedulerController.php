<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeesCollection;

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
        $keys = [];
        $arr = [];
        $data = [];
        $this->days = auth()->user()->setting->num_days;
        $this->dayoff = auth()->user()->setting->num_dayoff;

        $employees = auth()->user()->employees->where('status', 1)->sortBy('position_id');

        // foreach($employees as $employee){

        //     for($i = 0; $i < $this->days - $this->dayoff; $i++){

        //         if(auth()->user()->required_shifts->where('position_id', $employee->position_id)->count() == 1){
        //             $arr[] = [
        //                 'id' => $employee->username,
        //                 'shift' => auth()->user()->shifts->where('id', auth()->user()->required_shifts->where('position_id', $employee->position_id)->first()->shift_id)
        //               ];
        //         } else {
        //             $arr[] = [
        //                 'id' => $employee->username,
        //                 'shift' => auth()->user()->shifts->where('id', auth()->user()->required_shifts->where('position_id', $employee->position_id)->first()->shift_id)
        //               ];
        //         }
        //     }
        // }
        // return view('user.schedule', compact('arr'));

        // for($i = 0; $i < $this->days; $i++){
        //     if(auth()->user()->required_shifts->where('position_id', $employees->position_id)->count() == 1){
        //         $data[$i] = [
        //             'day' => $i + 1,
        //             'employee' => $employees->username,
        //             'shift' => auth()->user()->shifts->where('id', auth()->user()->required_shifts->where('position_id', $employees->position_id)->first()->shift_id)
        //         ];
        //     }
            
        // }
        

        foreach($employees as $employee){
            $data[] = new EmployeesCollection($employee);
        }

        return $data;
        return view('user.schedule', compact('data'));

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
        // Assign Shift by Position Required Per Day
        
        $required = auth()->user()->required_shifts;

        
        
    }
}
