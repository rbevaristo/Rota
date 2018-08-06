@extends('layouts.user')

@section('styles')

@endsection

@section('content')
<section id="user-dashboard">
    <div class="container-fluid">
        <div class="row" id="employee-list">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Employees
                    </div>
                    <div class="card-body" style="background-color: gray">
                        <div class="container-fluid">
                            <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="0">
                                <div class="carousel-inner row w-100 mx-auto" role="listbox">
                                    @if(count(auth()->user()->employees) > 0)
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach(auth()->user()->employees as $employee)
                                        
                                        <div class="carousel-item col-md-2 {{ $count == 0 ? 'active' : '' }}">
                                            <div class="card" style="padding:10px">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img class="img-fluid mx-auto d-block" src="{{ asset('storage/avatar/') }}/{{ $employee->profile->avatar }}" alt="avatar">
                                                    </div>
                                                    <div class="col-8">
                                                        <strong>{{ Helper::employee_name($employee->firstname, $employee->lastname) }}</strong>
                                                        <p>{{ $employee->position->name }}</p>
                                                        <p>
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
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $count++;
                                        @endphp
                                        @endforeach
                                    @else
                                    No Data
                                    @endif

                                </div>
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="#carouselExample" data-slide="prev" style="padding:5px">
                                        <span class="fa fa-arrow-left text-white"></span>
                                    </a>
                                    <a href="#carouselExample" data-slide="next" style="padding:5px">
                                        <span class="fa fa-arrow-right text-white"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="schedule">
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
