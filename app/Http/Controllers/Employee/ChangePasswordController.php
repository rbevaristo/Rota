<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function check($password) {
        if(!Hash::check($password, auth()->user()->password, [])){
            return response()->json([
                'success' => false
            ]);
        }
        return response()->json([
            'success' => true
        ]);
        // if(Hash::make($password) != auth()->user()->password)
        //     return "false";
        // return "true";
    }

    public function update(ChangePasswordRequest $request)
    {
         
        $user = auth()->user();
        $user->password = bcrypt($request->password);
        $user->is_reset = true;
        $user->save();

        return redirect()->back()->with('success', 'Password Change Success!!');
    }
}
