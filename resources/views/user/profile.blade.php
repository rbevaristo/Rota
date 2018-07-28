@extends('layouts.user')

@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ route('dashboard')}}"><span class="fa fa-home"></span><span class="breadcrumb-text"> Home</span></a>
    </li>
    <li class="breadcrumb-item {{ Request::is('dashboard/profile') ? 'active' : '' }}" aria-current="page">
        <a href="{{ route('user.profile')}}"><span class="fa fa-user"></span><span class="breadcrumb-text"> Profile</span></a>
    </li>
@endsection

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
            <div class="card-header">
                <h5 class="title">Edit Profile</h5>
            </div>
             <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="custom-file">
                                <input type="file" name="avatar" class="custom-file-input">
                                <span class="custom-file-control btn btn-outline-secondary">Change Profile Picture</span>
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 px-1">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name..." value="">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 px-1">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email...">
                        </div>
                    </div>
                    <div class="col-md-6 px-1">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                        </div>
                        <div class="radio">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="male" name="gender" class="custom-control-input">
                            <label class="custom-control-label" for="male">Male</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="female" name="gender" class="custom-control-input">
                            <label class="custom-control-label" for="female">Female</label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 px-1">
                        <div class="form-group">
                            <label for="birthdate">Birthdate</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Email...">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" placeholder="Home Address" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" placeholder="City" value="Mike">
                        </div>
                    </div>
                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control" placeholder="State / Province" value="Andrew">
                        </div>
                    </div>
                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>Postal Code</label>
                            <input type="number" class="form-control" placeholder="ZIP Code">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="btn btn-primary form-control">Save</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
