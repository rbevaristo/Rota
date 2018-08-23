<?php

namespace App\Http\Controllers\Employee;

use App\User;
use App\UserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\RequestNotification;

class UserRequestController extends Controller
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

    public function send(Request $request)
    {

        $req = new UserRequest;
        $req->emp_id = auth()->user()->id;
        $req->user_id = auth()->user()->user->id;
        $req->from = $request->from;
        $req->upto = $request->to;
        $req->title = $request->title;
        $req->message = $request->message;
        $req->save();

        if(!$req) {
            return redirect()->back()->with('error', 'There is an error with your request');
        }

        if($user = User::find($req->user_id)){
            $user->notify(new RequestNotification(UserRequest::latest('id')->first()));
        }

        return response()->json(['data' => 'Success!']);
    }
}
