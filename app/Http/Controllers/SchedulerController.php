<?php

namespace App\Http\Controllers;

use App\Scheduler;
use Illuminate\Http\Request;

class SchedulerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request){
        $scheduler = auth()->user()->scheduler;
        $scheduler = $scheduler?$scheduler->first():null;

        //check if existing
        if($scheduler){
            // update data
            $scheduler->schedule = $request->schedule;
            // save data
            $scheduler->save();
        } else {
            //is not existing create a scheduler
            $scheduler = Scheduler::create([
                //Column => Data
                'schedule' => $request->schedule,
                'user_id' => auth()->user()->id
            ]);
        }
    
        //return a response

        //check if creating is success
        if($scheduler){
            return response()->json([
                'message' => 'Success'
            ]);
        }

        return response()->json([
            'message' => 'Error'
        ]);
    }

    public function schedule()
    {
        
    }

   
}
