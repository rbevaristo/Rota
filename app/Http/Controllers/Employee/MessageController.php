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
use App\Notifications\RequestsNotification;

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
        $req->emp_id = auth()->user()->id;
        $req->user_id = auth()->user()->user->id;
        $req->from = Converter::toDate($request->start_date);
        $req->upto = Converter::toDate($request->end_date);
        $req->title = $request->title;
        $req->message = $request->message;
        $req->save();

        if(!$req) {
            return redirect()->back()->with('error', 'There is an error with your request');
        }

        if($user = User::find($req->user_id)){
            $user->notify(new RequestsNotification(UserRequest::latest('id')->first()));
        }

        return redirect()->back()->with('success', 'Request Sent!');
    }

    public function read(Request $request)
    {
        $notification = auth()->user()->unreadNotifications->where('id',$request->notification_id);
        $notification->markAsRead();
        $message = UserRequest::where('id', $request->message_id)->first();
        return view('employee.message', compact('message'));
    }

    public function view(Request $request)
    {
        $message = UserRequest::where('id', $request->id)->first();
        return view('employee.message', compact('message'));
    }
}
