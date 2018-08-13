<?php

namespace App\Http\Controllers;

use App\User;
use Converter;
use App\Message;
use App\Employee;
use Illuminate\Http\Request;
use App\Notifications\NotifyUsers;
use App\Notifications\MessagesNotification;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read(Request $request) {
        $notification = auth()->user()->unreadNotifications->where('id',$request->notification_id);
        $notification->markAsRead();
        $message = Message::where('id', $request->message_id)->first();
        return view('user.message', compact('message'));
    }

    public function markRead(){
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
