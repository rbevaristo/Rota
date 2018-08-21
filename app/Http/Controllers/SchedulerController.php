<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeesCollection;

class SchedulerController extends Controller
{
    public $data = array();
    public $holder = array();
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function schedule()
    {
        
    }

   
}
