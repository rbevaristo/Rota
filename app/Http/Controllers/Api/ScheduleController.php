<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleFilesCollection;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function schedule()
    {
        return response()->json([
            'data' => ScheduleFilesCollection::collection(auth()->user()->schedule_files)
        ]);
    }
}
