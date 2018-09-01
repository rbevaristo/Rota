<?php

namespace App\Http\Controllers\Api\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api-2');
    }

    public function schedule()
    {
        $sched = auth()->user()->schedule;

        if($sched){
            $s = json_decode($sched->schedule);
            rsort($s);
            return response()->json(['data' => $s]);
        }
        

        return response()->json(['data' => '']);
    }
}
