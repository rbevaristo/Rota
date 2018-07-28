<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use Illuminate\Http\Request;
use App\Notifications\NotifyUsers;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:employee', 'auth']);
    }

    public function messageToUser(Request $request) 
    {
        $message = \App\Message::create([
            'title' => $request->title,
            'message' => $request->message,
            'user_id' => auth()->user()->id
        ]);
        if(!$message) {
            return redirect()->back()->with('error', 'There is an error with your message');
        }

        return redirect()->back()->with('success', 'Message Sent!');
    }
    
    public function requestToUser(Request $request)
    {
        $req = \App\UserRequest::create([
            'request' => $request->name,
            'start_date' => date('Y-m-d', strtotime($request->start_date)),
            'end_date' => date('Y-m-d', strtotime($request->end_date)),
            'message' => $request->message, 
            'user' => auth()->user()->id
        ]);

        // $req1 = \App\UserRequest::find($req->id);
        // $user = User::find($req1->user)->notify(new NotifyUsers($req1));
        if(!$req) {
            return redirect()->back()->with('error', 'There is an error with your request');
        }

        return redirect()->back()->with('success', 'Request Sent!');
    }
}
