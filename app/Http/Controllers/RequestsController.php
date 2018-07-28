<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RequestsController extends Controller
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
        foreach(explode(',', $value) as $req){
            $p = \App\Request::where('user_id', $id)->where('name', $req)->first();
            if(!$p){
                \App\Request::create([
                    'name' => $req,
                    'user_id' => auth()->user()->id
                ]);
            } 
        }

        $reqs = \App\Request::where('user_id', $id)->get();
        $items = []; $array = []; $array2 = [];
        if(count($reqs) != count(explode(',', $value))){
            foreach($reqs as $req){
                $array[] = $req->name;
            }
            foreach(explode(',', $value) as $req){
                $array2[] = $req;
            }
            $items = array_diff($array, $array2);
            foreach($items as $value){
                \App\Request::where('user_id', auth()->user()->id)->where('name', $value)->delete();
            }
        } 
        

        if(!$reqs){
            return response()->json(['success' => false, 'message' => 'Error']);
        }
        return response()->json(['success' => true, 'message' => $items]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        foreach($user->requests as $request)
            $request->delete();

        if(!$user){
            return response()->json(['success' => false, 'message' => 'Error']);
        }
        return response()->json(['success' => true, 'message' => 'Updated']);
    }
}
