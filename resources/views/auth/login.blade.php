@extends('layouts.app')

@section('content')
<section>
    <div class="page-header" filter-color="orange">
        <div class="container">
            <div class="col-md-6 content-center">
                @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    <div class="container">
                        <div class="alert-icon">
                            <i class="now-ui-icons objects_support-17"></i>
                        </div>
                        <strong>{{session('error')}}</strong>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="now-ui-icons ui-1_simple-remove"></i>
                            </span>
                        </button>
                    </div>
                </div>
                @endif
                <div class="card card-login card-plain">
                        <div class="header header-primary text-center">
                            <div class="logo-container">
                                Login
                            </div>
                        </div>
                        <ul class="nav nav-tabs nav-tabs-neutral justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#login-employers" role="tab">
                                    <i class="fa fa-user"></i> Employers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#login-employees" role="tab">
                                    <i class="fa fa-users"></i> Employees
                                </a>
                            </li>
                        </ul>
                        <div class="card-body">
                            <!-- Tab panes -->
                            <div class="tab-content text-center">
                                <div class="tab-pane active" id="login-employers" role="tabpanel">
                                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                        @csrf
                                        <div class="content">
                                            <div class="input-group form-group-no-border input-lg">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email...">
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
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                
                                                    <label class="form-check-label" for="remember">
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
                                    </form>
                                </div>
                                <div class="tab-pane" id="login-employees" role="tabpanel">
                                    <form method="POST" action="{{ route('employee.login') }}" aria-label="{{ __('Login') }}">
                                        @csrf
                                        <div class="content">
                                            <div class="input-group form-group-no-border input-lg">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                                <input id="employee_id" type="text" class="form-control{{ $errors->has('employee_id') ? ' is-invalid' : '' }}" name="employee_id" value="{{ old('employee_id') }}" required placeholder="Employee ID...">
                                                @if ($errors->has('employee_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('employee_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="input-group form-group-no-border input-lg">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-user-secret"></i>
                                                </span>
                                                <input id="password1" type="password" class="form-control{{ $errors->has('password1') ? ' is-invalid' : '' }}" name="password" required placeholder="Password...">
                                                @if ($errors->has('password1'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password1') }}</strong>
                                                    </span>
                                                @endif
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
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
