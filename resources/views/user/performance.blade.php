@extends('layouts.user')

@section('content')
<section id="evaluation">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="list-group">
                    <div class="list-group-item list-group-item-action bg-primary text-white">Employees
                        <span class="float-right dropdown">
                            <a href="#" class="text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-gear"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('user.manage') }}">Manage</a>
                            </div>
                        </span>
                    </div>
                    @if(count(auth()->user()->employees) > 0)
                        @foreach(auth()->user()->employees as $employee)
                            <a href="#" class="list-group-item list-group-item-action">
                                <img src="{{ asset('img/default.png') }}" alt="avatar">
                                <strong>{{ Helper::employee($employee->firstname, $employee->lastname) }}</strong>    
                            </a>
                        @endforeach
                    @else
                    <p class="list-group-item list-group-item-action"> No Data</p>
                    @endif
                </div>
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-primary text-white">Performance Evaluation Form</div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row table-responsive-sm">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Factor</th>
                                            <th>Description</th>
                                            <th>Above Average</th>
                                            <th>Average</th>
                                            <th>Below Average</th>
                                            <th>Unsatisfactory</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(\App\Evaluation::all() as $eval)
                                            <tr>
                                                <td>{{  $eval->factor }}</td>
                                                <td>{{  $eval->description }}</td>
                                                <td><input type="checkbox" name="above_average" id="above_average"></td>
                                                <td><input type="checkbox" name="average" id="average"></td>
                                                <td><input type="checkbox" name="below_average" id="below_average"></td>
                                                <td><input type="checkbox" name="unsatisfactory" id="unsatisfactory"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- <div class="container-fluid">
                            <div class="row">
                                <div class="col-2">
                                   <strong>FACTOR</strong> 
                                </div>
                                <div class="col-6">
                                    <strong>DESCRIPTION</strong> 
                                </div>
                                <div class="col-1">
                                    <small>ABOVE AVERAGE</small> 
                                </div>
                                <div class="col-1">
                                    <small>AVERAGE</small> 
                                </div>
                                <div class="col-1">
                                    <small>BELOW AVERAGE</small> 
                                </div>
                                <div class="col-1">
                                    <small>UNSATISFACTORY</small> 
                                </div>
                            </div>
                            @foreach(\App\Evaluation::all() as $eval)
                            <div class="row">
                                <div class="col-2">
                                    {{ $eval->factor }}
                                </div>
                                <div class="col-6">
                                    {{ $eval->description }} 
                                </div>
                                <div class="col-1 text-center">
                                    <input type="checkbox" name="above_average" id="above_average">
                                </div>
                                <div class="col-1 text-center">
                                    <input type="checkbox" name="average" id="average">
                                </div>
                                <div class="col-1 text-center">
                                    <input type="checkbox" name="below_average" id="below_average">
                                </div>
                                <div class="col-1 text-center">
                                    <input type="checkbox" name="unsatisfactory" id="unsatisfactory">
                                </div>
                            </div>
                            @endforeach
                        </div> --}}
                        <div class="container">
                            <div class="row">
                                <div class="col-12"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
