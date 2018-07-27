@extends('layouts.user')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ route('dashboard')}}"><span class="fa fa-home"></span><span class="breadcrumb-text"> Home</span></a>
    </li>
    <li class="breadcrumb-item {{ Request::is('dashboard/employee') ? 'active' : '' }}" aria-current="page">
        <a href="{{ route('user.employee')}}"><span class="fa fa-users"></span><span class="breadcrumb-text"> Employee</span></a>
    </li>
@endsection

@section('content')
<div class="row">
    <div class="card">
        <div class="card-header">
            <nav class="navbar navbar-expand-lg bg-white">
                <a class="navbar-brand" href="{{ url('/dashboard/employee') }}">
                    Employees
                </a>
                <ul class="nav ml-auto">
                    <li class="nav-item">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-user-plus" data-toggle="tooltip" data-placement="top" title="Add Employee"></i> 
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-primary btn-sm">
                            <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Remove Employee"></i> 
                        </button>
                    </li>
                    <li class="nav-item">
                        <form>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="search" class="form-control" placeholder="Search...">
                            </div>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($user->employees as $employee)
                <div class="col-md-2 col-sm-2 text-center employee-lists">
                    <p><strong>{{ $employee->name }}</strong></p>
                    <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                    <p>{{ $employee->position->name }}</p>
                    <span><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                    <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                    <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                    <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal Core -->
<div class="modal fade text-black" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user-plus"></i> Employee</h4>
        </div>
        <div class="modal-body">
          <form action="{{ url('/dashboard/employee/create') }}" method="POST">
          @csrf
            <div class="form-group">
                <label for="employee_id">Employee ID <span>*</span></label>
                <input type="text" class="form-control" id="employee_id" name="employee_id" required placeholder="Employee ID...">
            </div>
            <div class="form-group">
                <label for="name">Name <span>*</span></label>
                <input type="text" class="form-control" id="name" name="name" required placeholder="Employee Name...">
            </div>
            <div class="form-group">
                <label for="email">Email <small>(optional)</small></label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Employee Email...">
            </div>
            <div class="form-group">
                <label for="emp_position"></label>
                <select name="position_id" id="position_id" class="form-control" required>
                    <option value="">Select Position</option>
                    @foreach($user->positions as $position)
                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
            </form>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>
@endsection