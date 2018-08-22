<?php

namespace App\Http\Controllers;


use App\Shift;
use App\Criteria;
use App\UserSetting;
use App\RequiredShift;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request)
    {
        $set = UserSetting::where('id', $request->id)->first();
        if($request->column == 'num_days'){
            $set->num_days = $request->value;
            $set->save();
        } else if($request->column == 'num_dayoff'){
            $set->num_dayoff = $request->value;
            $set->save();
        } else {
            $set->update([
                $request->column => $request->value
            ]);
        }
        
        if(!$set){
            return response()->json(['success' => false, 'message' => 'Error']);
        }
        return response()->json(['success' => true, 'message' => 'Updated']);
    }

    public function create_shift(Request $request)
    {
        if(isset($request->start_shift1) && isset($request->end_shift1) && $this->isShiftExist($request->start_shift1, $request->end_shift1)){
            $shift = Shift::create(['start' => $request->start_shift1, 'end' => $request->end_shift1, 'user_id' => auth()->user()->id]);
        }

        if(isset($request->start_shift2) && isset($request->end_shift2) && $this->isShiftExist($request->start_shift2, $request->end_shift2)){
            $shift = Shift::create(['start' => $request->start_shift2, 'end' => $request->end_shift2, 'user_id' => auth()->user()->id]);
        }

        if(isset($request->start_shift3) && isset($request->end_shift3) && $this->isShiftExist($request->start_shift3, $request->end_shift3)){
            $shift = Shift::create(['start' => $request->start_shift3, 'end' => $request->end_shift3, 'user_id' => auth()->user()->id]);
        }

        if(isset($request->start_shift4) && isset($request->end_shift4) && $this->isShiftExist($request->start_shift4, $request->end_shift1)){
            $shift = Shift::create(['start' => $request->start_shift4, 'end' => $request->end_shift4, 'user_id' => auth()->user()->id]);
        }

        if(isset($request->start_shift5) && isset($request->end_shift5) && $this->isShiftExist($request->start_shift5, $request->end_shift2)){
            $shift = Shift::create(['start' => $request->start_shift5, 'end' => $request->end_shift5, 'user_id' => auth()->user()->id]);
        }

        if(isset($request->start_shift6) && isset($request->end_shift6) && $this->isShiftExist($request->start_shift6, $request->end_shift3)){
            $shift = Shift::create(['start' => $request->start_shift6, 'end' => $request->end_shift6, 'user_id' => auth()->user()->id]);
        }

        return redirect()->back()->with('success', 'Shifts Created!');
    }

    public function isShiftExist($start, $end){
        $shift = Shift::where('start', $start)->where('end', $end)->first();
        if(!$shift)
            return true;
        return false;
    }

    public function update_shift(Request $request)
    {
        $shift = auth()->user()->shifts->where('id', $request->id)->first();
        if($request->column == 'start')
            $shift->start = $request->value;
        else
            $shift->end = $request->value;
        $shift->save();

        if($shift){
            return response()->json([
                'success' => true,
                'data' => $shift 
            ]);
        }

        return response()->json([
            'success' => false,
            'data' => $shift 
        ]);
    }

    public function activate_shift(Request $request)
    { 
        $shift = Shift::where('id', $request->id)->first();
        $shift->update([
            'status' => $request->value
        ]);

        if(!$shift){
            return response()->json(['success' => false, 'data' => $shift]);
        }
        return response()->json(['success' => true, 'data' => $shift]);
    }

    public function delete_shift(Request $request)
    {
        $shift = Shift::where('id', $request->id)->first();
        foreach(auth()->user()->required_shifts->where('shift_id', $request->id) as $s){
            $s->delete();
        }
        $shift->delete();
        return response()->json(['success' => true]);
    }

    public function update_criteria(Request $request)
    {
        $criteria = Criteria::where('id', $request->id)->first();
        $criteria->update([
            $request->column => $request->value
        ]);

        if(!$criteria){
            return response()->json(['success' => false, 'message' => $criteria]);
        }
        return response()->json(['success' => true, 'message' => $criteria]);
    }

    public function create_required_shift(Request $request)
    {
        $shift = auth()->user()->required_shifts->where('position_id', $request->position)->where('shift_id', $request->shift)->first();
        if(!$shift){
            $req = new RequiredShift;
            $req->position_id = $request->position;
            $req->min = $request->min;
            $req->max = $request->max;
            $req->shift_id = $request->shift;
            $req->user_id = auth()->user()->id;
            $req->save();

            if($req){
                return response()->json([
                    'success' => true,
                    'data' => $req
                ]);
            }

            return response()->json([
                'success' => false,
                'data' => $req
            ]);
        } else {
            $shift->position_id = $request->position;
            $shift->min = $request->min;
            $shift->max = $request->max;
            $shift->shift_id = $request->shift;
            $shift->user_id = auth()->user()->id;
            $shift->save();

            if($shift){
                if($shift->min == 0 && $shift->max == 0){
                    $shift->delete();
                }
                return response()->json([
                    'success' => true,
                    'data' => $shift
                ]);
            }

            return response()->json([
                'success' => false,
                'data' => $shift
            ]);
        }
    }
}
