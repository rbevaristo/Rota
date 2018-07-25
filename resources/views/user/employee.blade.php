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
                        <button class="btn btn-primary btn-sm">
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
@endsection

@section('js')
    <script>

    </script>
@endsection