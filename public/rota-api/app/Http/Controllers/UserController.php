<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
