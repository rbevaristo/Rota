@extends('layouts.user')
@section('styles')
 
@endsection

@section('content')
<section id="employees">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Employees 
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
                        <div class="row">
                        @if(count(auth()->user()->employees) > 0)
                            @foreach(auth()->user()->employees as $employee)
                                <div class="col-md-2 col-sm-2 text-center employee-lists">
                                    <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                                    <strong>{{ Helper::employee_name($employee->firstname, $employee->lastname) }}</strong>
                                    <p><small>{{ $employee->position->name }}</small></p>
                                    <span class="float-right"><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                                    <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                                    <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                                    <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                                </div>
                            @endforeach
                        @else
                            <div>
                                No Data
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')

@endsection