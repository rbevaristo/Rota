<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EvaluationResult;
use Illuminate\Http\Request;
use App\Charts\PerformanceChart;
use App\Http\Resources\EmployeeResource;


class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::where('id', $id)->first();
        $evaluation = EvaluationResult::all()->where('emp_id', $id);   
        if($employee) {
            return response()->json([
                'success' => true,
                'data' => new EmployeeResource($employee),
                'evaluation' => $evaluation
            ]);
        }
         return response()->json([
            'success' => false,
            'data' => "Cant retrieve information try again."
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function update_status(Request $request)
    {
        $update = Employee::where('id', $request->id)->first();
        $update->status = $request->status;
        $update->save();

        if(!$update){
            return response()->json(['success' => false, 'message' => $update]);
        }
        return response()->json(['success' => true, 'message' => $update]);
    }
}
