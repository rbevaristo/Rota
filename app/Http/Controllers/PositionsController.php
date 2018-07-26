<?php

namespace App\Http\Controllers;

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

    public function update($id, $value)
    {
        $position = Position::where('user_id', $id)->get();
        foreach(explode(',', $value) as $pos){
            
            if(!in_array($pos , $position)){
                Position::create([
                    'name' => $pos,
                    'user_id' => auth()->user()->id
                ]);
            }
        }

        foreach($position as $pos) {
            if(!in_array($pos->name, $value)){
                $pos->delete();
            }
        }

        if(!$position){
            return response()->json(['success' => false, 'message' => 'Error']);
        }
        return response()->json(['success' => true, 'message' => 'Updated']);
    }
}
