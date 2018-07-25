@extends('layouts.app')

@section('content')
<section>
    <div class="page-header" filter-color="orange">
        <div class="container">
            <div class="col-md-6 content-center">
                @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <div class="container">
                        <div class="alert-icon">
                            <i class="now-ui-icons objects_support-17"></i>
                        </div>
                        <strong>
                            @foreach($errors->all() as $error)
                                {{$error}}
                            @endforeach
                        </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="now-ui-icons ui-1_simple-remove"></i>
                            </span>
                        </button>
                    </div>
                </div>
                @endif
                <div class="card card-login card-plain">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                            @csrf
                        <div class="header header-primary text-center">
                            <div class="logo-container">
                                Register
                            </div>
                        </div>
                        <div class="content">
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required placeholder="Full Name...">
                            </div>
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email...">
                            </div>
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="fa fa-user-secret"></i>
                                </span>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password...">
                            </div>
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="fa fa-user-secret"></i>
                                </span>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password...">
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-round btn-block btn-lg">
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
