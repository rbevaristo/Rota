<?php

namespace App\Http\Controllers;

use App\User;
use Converter;
use App\Message;
use Illuminate\Http\Request;
use App\Notifications\NotifyUsers;
use App\Notifications\MessagesNotification;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function messageToUser(Request $request) 
    {
        $message = new \App\Message;
        $message->user_id = auth()->user()->id;
        $message->title = 'Sample Title';
        $message->body = 'This is a sample message body';
        $message->save();
        // $message->title = $request->title;
        // $message->message = $request->message;
        // $message->user_id = auth()->user()->id;
        // $message->save();
        $user = User::where('id', '!=', $message->user_id);
        if(!$message) {
            return redirect()->back()->with('error', 'There is an error with your message');
        }

        if(User::find(2)->notify(new MessagesNotification(Message::latest('id')->first()))){
            return redirect()->back()->with('success', 'Message Sent!');
        }
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

    public function notification()
    {
        return auth()->user()->notifications;
    }

    public function read(Request $request) {
        auth()->user()->unreadNotifications->where('id',$request->id)->markAsRead();
        return 'success';
    }

    public function markRead(){
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
