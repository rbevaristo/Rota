@extends('layouts.user')

@section('custom_styles')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link href="{{ asset('css/bootstrap-toggle.min.css') }}" rel="stylesheet">
@endsection
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
                        @include('components.messages')
                        @include('components.sessions')
                        {{-- @if(count(auth()->user()->employees) > 0)
                        <div class="row">
                            @foreach(auth()->user()->employees as $employee)
                            <div class="col-md-2 col-sm-2 text-center employee-lists">
                                <p><strong>{{ Helper::employee_name($employee->firstname, $employee->lastname) }}</strong></p>
                                <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                                <p>{{ $employee->position->name }}</p>
                                <div>
                                    <input type="hidden" id="employee_id" value="{{ $employee->id }}">
                                    <a href="#myModal" class="profile" data-toggle="modal" role="button">
                                        <i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                            No Employee
                        @endif --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Activate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count(auth()->user()->employees) > 0)
                                @foreach(auth()->user()->employees->sortByDesc('username') as $employee)
                                <tr>
                                    <td>
                                        {{ $employee->username }}
                                    </td>
                                    <td>
                                        <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                                        <strong>{{ Helper::employee_name($employee->firstname, $employee->lastname) }}</strong>
                                    </td>
                                    <td>
                                        {{ $employee->position->name }}
                                    </td>
                                    <td>

                                        <input type="checkbox" data-toggle="toggle" id="status" value="{{ $employee->id }}" {{ $employee->status == false ? '' : 'checked' }}>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    No Employee
                                @endif 
                            </tbody>
                        </table>
                    </div>                 
                </div>
            </div>
            <div class="col-md-3" id="add_employee">
                <div id="accordion">
                    {{-- <div class="card">
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
                    </div> --}}
                    <div class="card">
                        <div class="card-header bg-primary" id="headingTwo">
                            <h5 class="mb-0">
                                <a class="btn-link collapsed text-white" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Add Employee
                                </a>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="alert alert-warning notice notice-warning">
                                <strong>Notice:</strong> view documentation for managing employees and giving access.
                            </div>
                            <form action="{{ url('/dashboard/employee/create') }}" method="POST" class="form-signin">
                                @csrf
                                <div class="form-label-group">
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Employee ID" required>
                                    <label for="username" class="text-primary">Employee ID</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Employee ID" required>
                                    <label for="firstname" class="text-primary">Firstname</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Employee ID" required>
                                    <label for="lastname" class="text-primary">Lastname</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Employee ID">
                                    <label for="email" class="text-primary">Email <small>optional</small></label>
                                </div>
                                    <div class="form-group">
                                        <label for="emp_position"></label>
                                        <select name="position_id" id="position_id" class="form-control text-primary" required>
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

@include('components.modal')
@endsection

@section('custom_scripts')
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/lib/bootstrap-toggle.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.table').DataTable({

        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('input[type="checkbox"]').on('change', function() {
            if ($(this).is(':checked')){ 
                var url = "{{ url('/dashboard/manage/status/update') }}";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        id : $(this).val(),
                        status: 1
                    },
                    success: function (result) {},
                });
            } 
            else { 
                var url = "{{ url('/dashboard/manage/status/update') }}";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        id : $(this).val(),
                        status: 0
                    },
                    success: function (result) {}
                });
            }
        });
    });
</script>
@endsection
