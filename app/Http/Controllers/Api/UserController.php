<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeesCollection;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function employees()
    {
        return response()->json([
            'data' => EmployeesCollection::collection(auth()->user()->employees)
        ]);
    }
}
