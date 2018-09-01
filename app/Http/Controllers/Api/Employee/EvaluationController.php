<?php

namespace App\Http\Controllers\Api\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EvalCollection;
use App\Http\Resources\EvaluationCollection;

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
        return response()->json(['data' => EvalCollection::collection(auth()->user()->evaluation_files->where('active', 1))]);
    }
}
