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

    // public function update($id, $value)
    // {

    //     foreach(explode(',', $value) as $pos){
    //         $p = Position::where('user_id', $id)->where('name', $pos)->first();
    //         if(!$p){
    //             Position::create([
    //                 'name' => $pos,
    //                 'user_id' => auth()->user()->id
    //             ]);
    //         } 
    //     }

    //     $positions = Position::where('user_id', $id)->get();
    //     $items = []; $array = []; $array2 = [];
    //     if(count($positions) != count(explode(',', $value))){
    //         foreach($positions as $position){
    //             $array[] = $position->name;
    //         }
    //         foreach(explode(',', $value) as $position){
    //             $array2[] = $position;
    //         }
    //         $items = array_diff($array, $array2);
    //         foreach($items as $value){
    //             Position::where('user_id', auth()->user()->id)->where('name', $value)->delete();
    //         }
    //     } 
        

    //     if(!$positions){
    //         return response()->json(['success' => false, 'message' => 'Error']);
    //     }
    //     return response()->json(['success' => true, 'message' => $items]);
    // }

    // public function destroy($id)
    // {
    //     $user = User::find($id);
    //     foreach($user->positions as $position)
    //         $position->delete();

    //     if(!$user){
    //         return response()->json(['success' => false, 'message' => 'Error']);
    //     }
    //     return response()->json(['success' => true, 'message' => 'Updated']);
    // }
}
