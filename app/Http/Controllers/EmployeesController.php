<?php

namespace App\Http\Controllers;

use App\Address;
use App\Profile;
use App\Employee;
use App\Position;
use PasswordMaker;
use App\Preference;
use App\EvaluationFile;
use App\EvaluationResult;
use Illuminate\Http\Request;
use App\Charts\PerformanceChart;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\ScheduleResource;
use App\Http\Resources\EvaluationCollection;


class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * Method that handles request for storing Employee.
     * @param \Http\Requests\EmployeeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request) {

        $employee = new Employee;
        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->username = auth()->user()->company->code.$request->username;
        $employee->email = $request->email;
        $pwd = new PasswordMaker;
        $employee->password = $pwd->makePassword($request->firstname, $request->lastname, $request->username);
        $employee->position_id = $request->position_id;
        $employee->user_id = auth()->user()->id;
        $employee->save();
        
        if($employee) {
            $profile = Profile::create(['emp_id' => $employee->id]);
            $address = Address::create(['profile_id' => $profile->id]);
            $preference = Preference::create(['emp_id' => $employee->id]);
            return redirect()->back()->with('success', 'Employee Added');
        }

        return redirect()->back()->with('error', 'Error Adding');
        
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
                'evaluation' => new EvaluationCollection($evaluation),
                'schedule' => new ScheduleResource($employee->schedule)
            ]);
        }
         return response()->json([
            'success' => false,
            'data' => "Cant retrieve information try again."
        ]);
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
        $err = [];
        while($datas = fgetcsv($file))
        {
            if($datas[0]=="")
                continue;

            $data = array_combine($columns, $datas);

            $id=$data['id'];
            $firstname=$data['firstname'];
            $lastname=$data['lastname'];
            $position=$data['position'];
            $email=(isset($data['email']) == '') ? null : $data['email'];

            $d = Employee::where('username', $id)->first();
            
            if(!$d && strlen($id) >= 5 && $this->checkEmail($email)){
                $d = new Employee;
                $d->username = auth()->user()->company->code.$id;
                $d->firstname = $firstname;
                $d->lastname = $lastname;
                $d->email = $email;
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
                    $preference = \App\Preference::create(['emp_id' => $d->id]);
                }
            } elseif($d && strlen($id) >= 5) {
                $err[] = 'Employee ID: ' . $d->username . ' already exist in storage.';
            } elseif(!$this->checkEmail($email)) {
                $err[] = 'Invalid Email';
            } else {
                $err[] = 'Employee ID:'. $id .' is less than 5 characters';
            }
            
        }
        if(sizeof($err) > 0){
            return redirect()->back()->with('error', 'Error adding employees either Employee ID is less than 5 characters or the ID is existing or Email is invalid');
        }

        return redirect()->back()->with('success', 'Employees Added');
    }

    public function get_job(Request $request)
    {
        return response()->json([
            'data' => Position::where('id', $request->id)->first()->name
        ]);
    }

    public function update_all(Request $request)
    {
        $update = DB::table('employees')->where('user_id', auth()->user()->id)->update(['status' => $request->val]);
        if($update){
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function checkEmail($email)
    {  
        if($email == null){
            return true;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false; 
        }

        return true;
    }

}
