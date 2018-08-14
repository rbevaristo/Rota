<?php

namespace App\Http\Controllers;

use App\Employee;
use App\UserRequest;
use Illuminate\Http\Request;
use App\Notifications\NotifyUsers;
use App\Notifications\MessagesNotification;
use App\Notifications\RequestsNotification;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read(Request $request) {
        $notification = auth()->user()->unreadNotifications->where('id',$request->notification_id);
        $notification->markAsRead();
        $message = UserRequest::where('id', $request->message_id)->first();
        return view('user.message', compact('message'));
    }

    public function approve(Request $request)
    {
        $req = UserRequest::where('id', $request->request_id)->first();
        $req->update([
            'approved' => true
        ]);


        if($user = Employee::find($req->emp_id)){
            $user->notify(new RequestsNotification(UserRequest::latest('id')->first()));
        }
        
        if($req) {
            return redirect()->back()->with('success', 'Request approved.');
        }

        return redirect()->back()->with('error', 'There is an error processing your requests. Please try again later.');
    }
}
