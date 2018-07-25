@extends('layouts.user')

@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ route('dashboard')}}"><span class="fa fa-home"></span><span class="breadcrumb-text"> Home</span></a>
    </li>
    <li class="breadcrumb-item {{ Request::is('dashboard/attendance') ? 'active' : '' }}" aria-current="page">
        <a href="{{ route('user.attendance')}}"><span class="fa fa-clock-o"></span><span class="breadcrumb-text"> Attendance</span></a>
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <table class="table" id="employee-attendance">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                        Richard Evaristo
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                        Jaspher Dingal
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')

@endsection