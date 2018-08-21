<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function eval($id)
    {
        return response()->json([
            'data' => [
                'employee' => auth()->user()->employees->where('id', $id)->first(),
                'files' => EvaluationFilesCollection::collection(auth()->user()->evaluation_files->where('emp_id', $id))
            ]
        ]);
    }

    public function evaluate(Request $request)
    {

    }
}
