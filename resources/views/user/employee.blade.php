@extends('layouts.user')

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
                <div class="col-md-2 col-sm-2 text-center employee-lists">
                    <p><strong>Richard Evaristo</strong></p>
                    <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                    <p>Supervisor</p>
                    <span><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                    <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                    <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                    <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                </div>
                <div class="col-md-2 col-sm-3 text-center employee-lists">
                    <p><strong>Richard Evaristo</strong></p>
                    <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                    <p>Supervisor</p>
                    <span><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                    <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                    <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                    <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                </div>
                <div class="col-md-2 col-sm-3 text-center employee-lists">
                    <p><strong>Richard Evaristo</strong></p>
                    <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                    <p>Supervisor</p>
                    <span><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                    <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                    <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                    <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                </div>
                <div class="col-md-2 col-sm-3 text-center employee-lists">
                    <p><strong>Richard Evaristo</strong></p>
                    <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                    <p>Supervisor</p>
                    <span><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                    <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                    <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                    <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                </div>
                <div class="col-md-2 col-sm-3 text-center employee-lists">
                    <p><strong>Richard Evaristo</strong></p>
                    <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                    <p>Supervisor</p>
                    <span><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                    <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                    <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                    <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                </div>
                <div class="col-md-2 col-sm-3 text-center employee-lists">
                    <p><strong>Richard Evaristo</strong></p>
                    <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                    <p>Supervisor</p>
                    <span><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                    <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                    <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                    <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                </div>
                <div class="col-md-2 col-sm-3 text-center employee-lists">
                    <p><strong>Richard Evaristo</strong></p>
                    <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                    <p>Supervisor</p>
                    <span><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                    <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                    <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                    <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                </div>
                <div class="col-md-2 col-sm-3 text-center employee-lists">
                    <p><strong>Richard Evaristo</strong></p>
                    <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                    <p>Supervisor</p>
                    <span><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                    <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                    <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                    <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                </div>
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
          <h4 class="modal-title" id="myModalLabel">Add Employee</h4>
        </div>
        <div class="modal-body">
          <form action="">
                <div class="form-group">
                    <label for="emp_id">Employee ID <span>*</span></label>
                    <input type="text" class="form-control" id="emp_id" name="emp_id" required placeholder="Employee ID...">
                </div>
                <div class="form-group">
                    <label for="emp_name">Name <span>*</span></label>
                    <input type="text" class="form-control" id="emp_name" name="emp_name" required placeholder="Employee Name...">
                </div>
                <div class="form-group">
                    <label for="emp_email">Email <small>(optional)</small></label>
                    <input type="text" class="form-control" id="emp_email" name="emp_email" placeholder="Employee Email...">
                </div>
                <div class="form-group">
                    <label for="emp_position"></label>
                    <select name="emp_position" id="emp_position" data-live-search="true" required class="form-control">
                        <option value=""></option>
                    </select>
                </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-info btn-simple">Save</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
    <script>

    </script>
@endsection