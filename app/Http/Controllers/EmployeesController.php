<?php

namespace App\Http\Controllers;

use App\Employee;
use PasswordMaker;
use App\EvaluationFile;
use App\EvaluationResult;
use Illuminate\Http\Request;
use App\Charts\PerformanceChart;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EvaluationCollection;


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
        $evaluation = EvaluationFile::all()->where('emp_id', $id)->sortByDesc('id');   
        if($employee) {
            return response()->json([
                'success' => true,
                'data' => new EmployeeResource($employee),
                'evaluation' => new EvaluationCollection($evaluation)
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

    public function upload(Request $request)
    {
        $upload = $request->file('excelfile');
        $filePath = $upload->getRealPath();
        $file = fopen($filePath, 'r');

        $header = fgetcsv($file);

        $columns = [];
        //dd($header);
        foreach($header as $key => $value){
            $column = strtolower($value);
            $items = preg_replace('/[^a-z]/', '', $column);
            if($column == 'id' || $column == 'firstname' || $column == 'lastname' || $column == 'position' || $column == 'email')
                array_push($columns, $items);
            else
                 return redirect()->back()->with('error', 'Column '.$value.' does not exist on storage');
        }

        while($datas = fgetcsv($file))
        {
            if($datas[0]=="")
                continue;

            $data = array_combine($columns, $datas);

            $id=$data['id'];
            $firstname=$data['firstname'];
            $lastname=$data['lastname'];
            $position=$data['position'];
            $email=($data['email'] == '') ? null : $data['email'];

            $d = Employee::firstOrNew(['username'=>$id]);
            $d->username = $id;
            $d->firstname =$firstname;
            $d->lastname=$lastname;
            $d->email =$email;
            $pwd = new PasswordMaker;
            $d->password = $pwd->makePassword($firstname, $lastname, $id);
            $d->user_id = auth()->user()->id;
            if($p = \App\Position::where('name', $position)->first()){
                $d->position_id = $p->id;
            } else {
                $p = \App\Position::create(['name' => $position, 'user_id' => auth()->user()->id]);
                $d->position_id = $p->id;
            }
            
            $d->save();
            if($d) {
                $profile = \App\Profile::create(['emp_id' => $d->id]);
                $address = \App\Address::create(['profile_id' => $profile->id]);
            }
        }

        return redirect()->back()->with('success', 'Employees Added');
    }
}
