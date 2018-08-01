@extends('layouts.user')

@section('styles')

@endsection

@section('content')
<section id="user-dashboard">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div id="employee-list">
                    <ul class="list-group">
                        <li class="list-group-item bg-primary text-white">
                            <strong>List of Employees</strong>
                            <span class="float-right dropdown">
                                <a href="#" class="text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-gear"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('user.manage') }}">Manage</a>
                                </div>
                            </span>
                        </li>
                        @if(count(auth()->user()->employees) > 0)
                            @foreach(auth()->user()->employees as $employee)
                                <li class="list-group-item">
                                    <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                                    <strong>Helper::employee($employee->firstname, $employee->lastname)</strong>
                                    <p><small>$employee->position->name</small></p>
                                    <span class="float-right">
                                        <a href="#">
                                            <i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i>
                                        </a>
                                    </span>
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item">
                                No Data
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-10" id="schedule">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <strong>Schedule</strong>
                        <span class="float-right dropdown">
                            <a href="#" class="text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-gear"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('user.manage') }}">Manage</a>
                            </div>
                        </span>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
    @parent
    
@endsection