<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EvaluationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function read(Request $request) {
        $notification = auth()->user()->unreadNotifications->where('id',$request->notification_id);
        $notification->markAsRead();
        return view('employee.evaluation');
    }

}
