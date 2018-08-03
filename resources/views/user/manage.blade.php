@extends('layouts.user')

@section('content')
<section id="manage-employees">
    <div class="container-fluid align-items-center">
        <div class="row">
            <div class="col-md-9">
                <h2>
                    Manage Employees
                </h2>
                <div class="card box-shadow">
                    <div class="card-header bg-primary text-white">
                        Employees
                        <a href="#add_employee"><span class="float-right d-md-none d-sm-block"><i class="fa fa-user-plus"></i>Add Employee</span></a>
                    </div>
                    
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <div class="container">
                                <i class="fa fa-exclamation-triangle"></i>
                                <strong class="text-primary">
                                    @foreach($errors->all() as $error)
                                        {{$error}}
                                    @endforeach
                                </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">
                                        <i class="fa fa-window-close"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                        @endif
                        @if(count(auth()->user()->employees) > 0)
                        <div class="row">
                            @foreach(auth()->user()->employees as $employee)
                            <div class="col-md-2 col-sm-2 text-center employee-lists">
                                <p><strong>{{ Helper::employee_name($employee->firstname, $employee->lastname) }}</strong></p>
                                <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                                <p>{{ $employee->position->name }}</p>
                                <span><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                                <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                                <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                                <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                            </div>
                            @endforeach
                        </div>
                        @else
                            No Employee
                        @endif
                    </div>                 
                </div>
            </div>
            <div class="col-md-3" id="add_employee">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header bg-primary" id="headingOne">
                            <h5 class="mb-0">
                                <a class="btn-link text-white" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Upload a file
                                </a>
                            </h5>
                        </div>
                    
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                        <label class="custom-file-label" for="customFile">Choose Excel file</label>
                                    </div>
                                    <div class="bs-example">
                                        <div class="alert alert-warning">
                                            {{-- <a href="#" class="close" data-dismiss="alert">&times;</a> --}}
                                            <strong>Note:</strong> To be able to successfully upload the file here are the columns needed.
                                            <ul>
                                                <li>ID</li>
                                                <li>Firstname</li>
                                                <li>Lastname</li>
                                                <li>Email</li>
                                                <li>Position</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-primary" id="headingTwo">
                            <h5 class="mb-0">
                                <a class="btn-link collapsed text-white" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Manually
                                </a>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <form action="{{ url('/dashboard/employee/create') }}" method="POST" class="form-signin">
                                @csrf
                                <div class="form-label-group">
                                    <input type="text" id="employee_id" name="employee_id" class="form-control" placeholder="Employee ID" required>
                                    <label for="employee_id">Employee ID</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Employee ID" required>
                                    <label for="firstname">Firstname</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Employee ID" required>
                                    <label for="lastname">Lastname</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Employee ID">
                                    <label for="email">Email <small>optional</small></label>
                                </div>
                                    <div class="form-group">
                                        <label for="emp_position"></label>
                                        <select name="position_id" id="position_id" class="form-control" required>
                                            <option value="">Select Position</option>
                                            @foreach(\App\Position::all() as $position)
                                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary form-control">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
@endsection

@section('custom_scripts')

@endsection
