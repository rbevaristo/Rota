<?php

namespace App\Http\Controllers\Api;
use PDF;
use App\Employee;
use App\Evaluation;
use App\EvaluationResult;
use App\EvaluationComments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EvaluationFilesCollection;

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

    public function form()
    {
        return response()->json([
            'data' => Evaluation::all()
        ]);
    }

    public function evaluate(Request $request)
    {

        $eval = EvaluationResult::create([
            'Quality_of_Work' => $request->quality,
            'Efficiency_of_Work' => $request->efficiency,
            'Dependability' => $request->dependability,
            'Job_Knowledge' => $request->job,
            'Attitude' => $request->attitude,
            'Housekeeping' => $request->housekeeping,
            'Reliability' => $request->reliability,
            'Personal_Care' => $request->personal,
            'Judgement' =>$request->judgement,
            'emp_id' => $request->employee,
            'user_id' => auth()->user()->id
        ]);

        if($eval){
            $comment = EvaluationComments::create([
                'qualities' => $request->q,
                'improvements' => $request->i,
                'comments' => $request->c,
                'eval_id' => $eval->id
            ]);

            $data = [
                'user' => auth()->user(),
                'company' => auth()->user()->company,
                'employee' => Employee::find($request->employee),
                'results' => $eval,
                // [
                //     'Quality of Work' => $eval->Quality_of_Work,
                //     'Efficiency of Work' => $eval->Efficiency_of_Work,
                //     'Dependability' => $eval->Dependability,
                //     'Job Knowledge' => $eval->Job_Knowledge,
                //     'Attitude' => $eval->Attitude,
                //     'Housekeeping' => $eval->Housekeeping,
                //     'Reliability' => $eval->Reliability,
                //     'Personal Care' => $eval->Personal_Care,
                //     'Judgement' => $eval->Judgement,
                // ],
                'comments' => $comment
            ];

            $employee = auth()->user()->employees->where('id', $request->employee)->first();
            $name = $employee->firstname.'_'.$employee->lastname.'_'.date('mdy').time().'.pdf';
            $pdf = PDF::loadView('pdf.evaluation', compact('data'));
            Storage::put('public/pdf/'.$name, $pdf->output());

            if($comment){
                return response()->json([
                    'success' => true,
                    'data' => new EmployeeResource(auth()->user()->employees->where('id', $request->employee)->first())
                ]);
            }
        }
        return response()->json([
            'success' => false,
            'data' => "Error"
        ]);
    }
}
