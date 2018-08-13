<?php

namespace App\Http\Controllers\Employee;

use App\User;
use Converter;
use App\Message;
use App\Employee;
use App\UserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\MessagesNotification;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function messageToUser(Request $request) 
    {
        $message = new Message;
        $message->from = auth()->user()->id;
        $message->to = $request->name;
        $message->title = $request->title;
        $message->body = $request->message;
        $message->save();
        if(!$message) {
            return redirect()->back()->with('error', 'There is an error with your message');
        }
        
        if($user = User::find($message->to)){
            $user->notify(new MessagesNotification(Message::latest('id')->first()));
        } 

        if($emp = Employee::where('username', $message->to)->first()){
            $emp->notify(new MessagesNotification(Message::latest('id')->first()));
        }
        return redirect()->back()->with('success', 'Message Sent!');
    }
    
    public function requestToUser(Request $request)
    {
        $req = new UserRequest;
        $req->request = $request->name;
        $req->start_date = Converter::toDate($request->start_date);
        $req->end_date = Converter::toDate($request->end_date);
        $req->message = $request->message;
        $req->user = auth()->user()->id;
        $req->save();

        if(!$req) {
            return redirect()->back()->with('error', 'There is an error with your request');
        }

        return redirect()->back()->with('success', 'Request Sent!');
    }
}
