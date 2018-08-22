<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EvaluationController extends Controller
{
      /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api-2');
    }

    public function evaluation()
    {
        return response()->json(['data' => EvaluationCollection::collection(auth()->user()->evaluation_files->where('active', 1))]);
    }
}
