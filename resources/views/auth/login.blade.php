@extends('layouts.app')

@section('custom_styles')
    
@endsection

@section('content')
<section id="login">
    <div class="container d-flex justify-content-center h-100 align-items-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-primary text-white"><strong>Login as <span>Employee</span></strong></div>
                <div class="card-body">
                    @include('components.sessions')
                    @include('components.messages')
                    <form method="POST" action="{{ route('employee.login') }}" aria-label="{{ __('Login') }}" class="form-signin">
                        @csrf
                        <div class="form-label-group">
                            <input type="text" id="username" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username') }}" required placeholder="Employee ID">
                            <label for="username" class="text-primary"><i class="fa fa-user"></i> Employee ID</label>
                        </div>
                        <div class="form-label-group">
                            <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" required placeholder="Password">
                            <label for="password" class="text-primary"><i class="fa fa-user-secret"></i> Password</label>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember1" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label text-primary" for="remember1">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-round btn-md">
                                    {{ __('Login') }}
                                </button>
                                <a class="btn btn-link text-primary" href="{{ route('employee.password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                        <div class="or-seperator"><i>or</i></div>
                        <div class="form-group row text-center">
                            <div class="col-md-12">
                                <a class="btn btn-primary text-white" href="{{ route('auth.admin') }}">
                                    {{ __('Login as Administrator') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
