@extends('layouts.user')

@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ route('dashboard')}}"><span class="fa fa-home"></span><span class="breadcrumb-text"> Home</span></a>
    </li>
    <li class="breadcrumb-item {{ Request::is('dashboard/schedule') ? 'active' : '' }}" aria-current="page">
        <a href="{{ route('user.schedule')}}"><span class="fa fa-calendar"></span><span class="breadcrumb-text"> Schedule</span></a>
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Schedule
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div>
@endsection
