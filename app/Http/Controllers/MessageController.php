<?php

namespace App\Http\Controllers;

use Converter;
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
        $message = new \App\Message;
        $message->title = $request->title;
        $message->message = $request->message;
        $message->user_id = auth()->user()->id;
        $message->save();

        if(!$message) {
            return redirect()->back()->with('error', 'There is an error with your message');
        }

        return redirect()->back()->with('success', 'Message Sent!');
    }
    
    public function requestToUser(Request $request)
    {
        $req = new \App\UserRequest;
        $req->request = $request->name;
        $req->start_date = Converter::toDate($request->start_date);
        $req->end_date = Converter::toDate($request->end_date);
        $req->message = $request->message;
        $req->user = auth()->user()->id;
        $req->save();

        // $req1 = \App\UserRequest::find($req->id);
        // $user = User::find($req1->user)->notify(new NotifyUsers($req1));
        if(!$req) {
            return redirect()->back()->with('error', 'There is an error with your request');
        }

        return redirect()->back()->with('success', 'Request Sent!');
    }
}
