<?php

namespace App\Http\Controllers;

use PDF;
use App\Employee;
use App\EvaluationResult;
use App\EvaluationComments;
use Illuminate\Http\Request;
use App\Http\Resources\DataSource;
use Illuminate\Support\Facades\App;

class EvaluationResultsController extends Controller
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
    public function store($id, Request $request)
    {
        $request['emp_id'] = $id;
        $request['user_id'] = auth()->user()->id;
        $eval = EvaluationResult::create($request->all());
        
        $comment = EvaluationComments::create([
            'best_qualities_demonstrated' => $request->qualities,
            'how_improvements_can_be_made' => $request->improvements,
            'comments' => $request->comments,
            'eval_id' => $eval->id
        ]);
        
        // $data = new DataSource(auth()->user());
        // $employee = Employee::find($id);
        // $name = $employee->firstname.'_'.$employee->lastname.'_'.date('mdy').time().'.pdf';
        // $pdf = PDF::loadView('pdf.evaluation', compact('data'));
        // return $pdf->download($name);
        return redirect()->back()->with('success', "Evaluation Success");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
