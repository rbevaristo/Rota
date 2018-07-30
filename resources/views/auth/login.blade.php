@extends('layouts.app')

@section('custom_styles')
    
@endsection

@section('content')
<section>
    <div class="page-header" filter-color="orange">
        <div class="container">
            <div class="col-md-6 content-center">
                <div class="card card-login card-plain">
                    <div class="card-header"><strong class="text-white">Login as Employee</strong></div>
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <div class="container">
                                <div class="alert-icon">
                                    <i class="fa fa-exclamation-triangle"></i>
                                </div>
                                <strong class="text-white">
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
                        <form method="POST" action="{{ route('employee.login') }}" aria-label="{{ __('Login') }}">
                            @csrf
                            <div class="content">
                                <div class="input-group form-group-no-border input-lg">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input id="employee_id" type="text" class="form-control{{ $errors->has('employee_id') ? ' is-invalid' : '' }}" name="employee_id" value="{{ old('employee_id') }}" required placeholder="Employee ID...">
                                </div>
                                <div class="input-group form-group-no-border input-lg">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user-secret"></i>
                                    </span>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password...">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember1" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember1">
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
                                    <a class="btn btn-link text-white" href="{{ route('employee.password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            </div>
                            <div class="separator separator-primary"></div>
                            <div class="form-group row">
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
    </div>
</section>
@endsection
