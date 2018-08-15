<?php

namespace App\Http\Controllers;

use PDF;
use App\Employee;
use App\EvaluationFile;
use App\EvaluationResult;
use App\EvaluationComments;
use Illuminate\Http\Request;
use App\Http\Resources\DataSource;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
            'qualities' => $request->qualities,
            'improvements' => $request->improvements,
            'comments' => $request->comments,
            'eval_id' => $eval->id
        ]);
        
        $data = [
            'user' => auth()->user(),
            'company' => auth()->user()->company,
            'employee' => Employee::find($id),
            'results' => [
                'Quality of Work' => $eval->Quality_of_Work,
                'Efficiency of Work' => $eval->Efficiency_of_Work,
                'Dependability' => $eval->Dependability,
                'Job Knowledge' => $eval->Job_Knowledge,
                'Attitude' => $eval->Attitude,
                'Housekeeping' => $eval->Housekeeping,
                'Reliability' => $eval->Reliability,
                'Personal Care' => $eval->Personal_Care,
                'Judgement' => $eval->Judgement,
            ],
            'comments' => $comment
        ];
        $employee = Employee::find($id);
        $name = $employee->firstname.'_'.$employee->lastname.'_'.date('mdy').time().'.pdf';
        $pdf = PDF::loadView('pdf.evaluation', compact('data'));
        Storage::put('public/pdf/'.$name, $pdf->output());
        //return $pdf->download($name); 
        EvaluationFile::create([
            'filename' => $name,
            'emp_id' => $id,
            'user_id' => auth()->user()->id
        ]);
        Session::flash('download', $name);
        return redirect()->back()->with('success', "Evaluation success ");
        
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
        $update = EvaluationFile::where('id', $request->id)->first();
        $update->active = $request->status;
        $update->save();

        if(!$update){
            return response()->json(['success' => false, 'message' => $update]);
        }
        return response()->json(['success' => true, 'message' => $update]);
    }
}
