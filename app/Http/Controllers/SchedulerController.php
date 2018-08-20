<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeesCollection;

class SchedulerController extends Controller
{
    public $temp = 0;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function schedule()
    {
        // $data = [];
        // $date = '2018-09-03';
        // $dayoff = 0; $dayoff_counter = 0;
        // // ALl Employees
        // $employees = auth()->user()->employees->where('status', 1)->sortBy('position_id')->sortBy('lastname');
        
        // foreach($employees as $employee)
        // {
        //     $data[] = [
        //         'date' => $date,
        //         'dayoff' => $this->getDayOff(auth()->user()->setting->num_dayoff, auth()->user()->setting->num_days),
        //         'schedule' => [
        //             'id' => $employee->id,
        //             'name' => $employee->firstname . ' ' . $employee->lastname,
        //             'position' => $employee->position->name,
        //             'date' => $date,
        //             'shifts' => $this->getShift(auth()->user()->setting->num_days),
        //         ],
                
        //     ];
        // }
        // // return $data;
        // return view('user.schedule', [
        //     'date' => $date,
        //     'data' => $data,
        //     'employees' => $employees
        // ]);

        $data = [];
        
        $employees = auth()->user()->employees->where('status', 1)->sortBy('position_id')->groupBy('position_id');
        $temp = 0;
        for ($i=0; $i < auth()->user()->setting->num_days; $i++) { 
            foreach ($employees as $employee) {
                $data[] = [
                    'day'.($i+1) => $this->assignShifts($employee)
                ];
            }
        }
        //$this->assignShifts($data);
        return $data;
    }

    public function assignShifts($employee)
    {

    }

    // public function getShift($days){
    //     $data = [];
    //     $shift = auth()->user()->shifts->random();
    //     $temp = '';
    //     for($i = 1; $i <= $days; $i++){

    //         if($i%7 == $days%7){
    //             $shift = auth()->user()->shifts->random();
    //         }



    //         $data[] = [
    //             'day'.$i => $shift->start .'-'.$shift->end
    //         ];
    //     }
    //     return $data;
    // }

    // public function getDayOff($dayoff, $days){
    //     $data = [];
    //     $val = 1;
    //     $limit = $days/2;
    //     for($i = 1; $i <= $dayoff; $i++){
    //         $off = rand($val, $limit);
    //         $data[] = [
    //             'dayoff'.$i => $this->checkDayOff($off)
    //         ];
    //     }
    //     return $this->validateDayOff($data);
    // }

    // public function checkDayOff($off)
    // {
    //     if($off > $this->temp){
    //         $this->temp = 8;
    //         return $off;
    //     } else {
    //         $this->temp = 0;
    //         return $off + 7;
    //     }
        
    // }

    // public function validateDayOff($data)
    // {

    //     $temp = 0;
    //     for($i = 0; $i < sizeof($data); $i++){
    //         $temp = $data[$i]['dayoff'.($i+1)];
    //         if(($temp - $data[$i]['dayoff'.($i+1)]) > 0 && ($temp - $data[$i]['dayoff'.($i+1)]) < 2){
    //             $data[$i-1]['dayoff'.($i-1)] = $data[$i]['dayoff'.($i+1)] - 1; 
    //         }
    //     }
    //     return $data;
    // }

}
