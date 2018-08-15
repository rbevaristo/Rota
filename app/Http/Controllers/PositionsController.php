<?php

namespace App\Http\Controllers;

use App\User;
use App\Position;
use Illuminate\Http\Request;

class PositionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {

    }

    public function store(Request $request)
    {
        $position = new Position;
        $position->name = ucfirst($request->position);
        $position->user_id = auth()->user()->id;
        $position->save();

        if($position){
            return redirect()->back()->with('success', 'Position Added');
        }
        return redirect()->back()->with('error', 'Error');
    }

    public function update_position(Request $request)
    {
        $employee = auth()->user()->employees->where('id', $request->id)->first();
        $employee->update(['position_id' => $request->position]);

        if($employee){
            return response()->json(['success' => true, 'data' => $employee]);
        }
        return response()->json(['success' => false, 'data' => $employee]);
    }

}
