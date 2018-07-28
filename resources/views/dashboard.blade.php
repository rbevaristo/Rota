@extends('layouts.user')

@section('styles')
    <style>
        #slides {

        }
    </style>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page">
        <a href="#"><span class="fa fa-home"></span><span class="breadcrumb-text">Home</span></a>
    </li>
@endsection

@section('content')
<div class="row" >
    <div class="col-md-2">
        <div id="employee-list">
            <ul class="list-group">
                <li class="list-group-item">
                    <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                    <strong>Richard Evaristo</strong>
                    <p><small>Supervisor</small></p>
                    <span class="float-right"><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                    <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                    <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                    <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                </li>
                <li class="list-group-item">
                    <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                    <strong>Jaspher Dingal</strong>
                    <p><small>Cashier</small></p>
                    <span class="float-right"><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                    <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                    <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                    <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                </li>
                <li class="list-group-item">
                    <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                    <strong>Kennet Mallari</strong>
                    <p><small>Cashier</small></p>
                    <span class="float-right"><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                    <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                    <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                    <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                </li>
                <li class="list-group-item">
                    <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                    <strong>Luc Racca</strong>
                    <p><small>Cashier</small></p>
                    <span class="float-right"><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                    <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                    <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                    <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                </li>
                <li class="list-group-item">
                    <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                    <strong>Renz Tolentino</strong>
                    <p><small>Cashier</small></p>
                    <span class="float-right"><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                    <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                    <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                    <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                </li>
                <li class="list-group-item">
                    <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                    <strong>Renz Tolentino</strong>
                    <p><small>Cashier</small></p>
                    <span class="float-right"><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                    <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                    <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                    <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                </li>
                <li class="list-group-item">
                    <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                    <strong>Renz Tolentino</strong>
                    <p><small>Cashier</small></p>
                    <span class="float-right"><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                    <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                    <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                    <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                </li>
                <li class="list-group-item">
                    <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                    <strong>Renz Tolentino</strong>
                    <p><small>Cashier</small></p>
                    <span class="float-right"><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                    <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                    <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                    <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-10" id="schedule">
        <div class="card">
            <div class="card-header text-black">
                Schedule
            </div>
            <div class="card-body">
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    @parent
    
@endsection