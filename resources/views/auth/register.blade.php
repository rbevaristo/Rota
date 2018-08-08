@extends('layouts.app')

@section('content')
{{-- <section id="register">
    <div class="container d-flex justify-content-center h-100 align-items-center">
        <div class="col-md-6">
            <h2 class="title text-center">Register</h2>
            <div class="card">
                <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" class="form-signin">
                    @csrf
                    <div class="card-header"><strong>Register as <span>Administrator</span></strong></div>
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <div class="container">
                                <div class="alert-icon">
                                    <i class="fa fa-exclamation-triangle"></i>
                                </div>
                                <strong class="text-primary">
                                    @foreach($errors->all() as $error)
                                        {{$error}}
                                    @endforeach
                                </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">
                                        <i class="fa fa-window-close"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                        @endif
                        <div class="form-label-group">
                            <input type="text" id="firstname" name="firstname" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" value="{{ old('firstname') }}" required placeholder="First Name...">
                            <label for="firstname" class="text-primary"><i class="fa fa-user"></i> First Name</label>
                        </div>
                        <div class="form-label-group">
                            <input type="text" id="lastname" name="lastname" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" value="{{ old('lastname') }}" required placeholder="Last Name...">
                            <label for="lastname" class="text-primary"><i class="fa fa-user"></i> Last Name</label>
                        </div>
                        <div class="form-label-group">
                            <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required placeholder="Email">
                            <label for="email" class="text-primary"><i class="fa fa-envelope"></i> Email</label>
                        </div>
                        <div class="form-label-group">
                            <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" required placeholder="Password">
                            <label for="password" class="text-primary"><i class="fa fa-user-secret"></i> Password</label>
                        </div>
                        <div class="form-label-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password...">
                            <label for="password-confirm" class="text-primary"><i class="fa fa-user-secret"></i> Confirm Password</label>
                        </div>
                        
                        <div class="form-group row">
                            <button type="submit" class="btn btn-primary btn-round btn-block btn-lg">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section> --}}
<section id="register">
    <div class="container d-flex justify-content-center h-100 align-items-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-primary text-white"><strong>Register as <span>Administrator</span></strong></div>
                <div class="card-body">
                    @include('components.sessions')
                    @include('components.messages')
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" class="form-signin">
                        @csrf
                        <div class="form-label-group">
                            <input type="text" id="firstname" name="firstname" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" value="{{ old('firstname') }}" required placeholder="First Name...">
                            <label for="firstname" class="text-primary"><i class="fa fa-user"></i> First Name</label>
                        </div>
                        <div class="form-label-group">
                            <input type="text" id="lastname" name="lastname" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" value="{{ old('lastname') }}" required placeholder="Last Name...">
                            <label for="lastname" class="text-primary"><i class="fa fa-user"></i> Last Name</label>
                        </div>
                        <div class="form-label-group">
                            <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required placeholder="Email">
                            <label for="email" class="text-primary"><i class="fa fa-envelope"></i> Email</label>
                        </div>
                        <div class="form-label-group">
                            <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" required placeholder="Password">
                            <label for="password" class="text-primary"><i class="fa fa-user-secret"></i> Password</label>
                        </div>
                        <div class="form-label-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password...">
                            <label for="password-confirm" class="text-primary"><i class="fa fa-user-secret"></i> Confirm Password</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-round btn-md form-control">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
