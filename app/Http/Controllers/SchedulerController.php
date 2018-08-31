<?php

namespace App\Http\Controllers;

use PDF;
use App\Schedule;
use App\Scheduler;
use App\EmployeeSchedule;
use LZCompressor\LZString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ScheduleCollection;

class SchedulerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request){
        $scheduler = auth()->user()->scheduler;
        $scheduler = $scheduler?$scheduler:null;

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
    
        $decompressed = \LZCompressor\LZString::decompressFromBase64($request->schedule);
        $schedule = json_decode($decompressed);
        
       

        for ($i=0;$i<count($schedule->employees);$i++){
            $emp = $schedule->employees[$i];
            $emp_id = $emp->trueId;

            $assigns = array();
            foreach($emp->assignments as $ass){
                $roleId = $ass[0];
                $dayId = $ass[1];
                $shiftId = $ass[2];
                
                $role = null;
                foreach($schedule->roles as $v){
                    if ($v->id == $roleId){
                        $role = $v;
                        break;
                    }
                }

                $day = null;
                foreach($role->scheduledDays as $v){
                    if ($v->id == $dayId){
                        $day = $v;
                        break;
                    }
                }

                $shift = null;
                foreach($day->shifts as $v){
                    if ($v->id == $shiftId){
                        $shift = $v;
                        break;
                    }
                }

                $month = (string)$day->month + 1;
                $date = (string)$day->date;
                $year = (string)$day->year;
                if (strlen($month)<2){
                    $month = "0" . $month;
                }
                if (strlen($date)<2){
                    $date = "0" . $date;
                }
                if (strlen($year)<4){
                    $year = str_repeat("0",4-strlen($year)) . $year;
                }
                // $str = $month . "|" . $date . "|" . $year . "|" . $shift->start . "|" . $shift->end;
                $str = $year . "-" . $month . "-" . $date . "," . $shift->start . "-" . $shift->end;
                array_push($assigns,$str);
            }

            $val = json_encode($assigns);

            $sched = auth()->user()->employee_schedules->where('emp_id',$emp_id)->first();
            if($sched){
                $sched->schedule = $val;
                $sched->save();
            }
            else{
                $sched = EmployeeSchedule::create([
                    //Column => Data
                    'emp_id' => $emp_id,
                    'user_id' => auth()->user()->id,
                    'schedule' => $val
                ]);
            }
        }

        $data = [
            'user' => auth()->user(),
            'company' => auth()->user()->company,
        ];
        $schedules = ScheduleCollection::collection(auth()->user()->employee_schedules);
        //return $schedules;

        $name = auth()->user()->company->name . date('ymd') . time() . '.pdf';
        $pdf = PDF::loadView('pdf.schedule', compact('data'), compact('schedules'))->setPaper('a4', 'landscape');
        Storage::put('public/schedule/'.$name, $pdf->output());
        // return $pdf->download($name);
        $s = Schedule::create([
            'user_id' => auth()->user()->id,
            'filename' => $name
        ]);
        //return a response

        //check if creating is success
        if($scheduler){
            return response()->json([
                'message' => 'Success',
                'file' => $s->filename
            ]);
        }

        return response()->json([
            'message' => 'Error'
        ]);
    }
}
