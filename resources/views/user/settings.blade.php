@extends('layouts.user')

@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ route('dashboard')}}"><span class="fa fa-home"></span><span class="breadcrumb-text"> Home</span></a>
    </li>
    <li class="breadcrumb-item {{ Request::is('dashboard/settings') ? 'active' : '' }}" aria-current="page">
        <a href="{{ route('user.settings')}}"><span class="fa fa-gearr"></span><span class="breadcrumb-text"> Settings</span></a>
    </li>
@endsection

@section('content')
<div class="row">
    <h1>Settings</h1>
</div>
@endsection
