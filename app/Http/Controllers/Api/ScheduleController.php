<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function schedule()
    {
        return response()->json([
            'data' => auth()->user()->schedule_files
        ]);
    }
}
