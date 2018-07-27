@extends('layouts.employee')

@section('content')
<div class="row text-black" id="user-profile">
    <div class="col-md-4">
        <div class="card card-user">
            <div class="card-body">
                <div class="author text-center">
                    <a href="#">
                        <img class="avatar border-gray" src="{{ asset('img/default.png') }}" alt="Avatar">
                    <h5 class="title">{{Auth::user()->name }}</h5>
                    </a>
                    <p class="text-black">{{ Auth::user()->email }}</p>
                    <p class="text-black">{{ Auth::user()->role->name}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Schedule</div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div>
<div class="row text-black">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Messages</div>
            <div class="card-body">
            
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Evaluations</div>
            <div class="card-body">
            
            </div>
        </div>
    </div>
</div>
@endsection
