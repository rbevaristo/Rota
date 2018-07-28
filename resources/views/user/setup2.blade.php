<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.tagsInput.css')}}" rel="stylesheet">
    <link href="{{ asset('css/now-ui-kit.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        strong {
            color: orange;
        }
    </style>
</head>
<body class="login-page">
    <nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent" color-on-scroll="400">
        <div class="container-fluid">
    
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent" >
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
    
                </ul>
    
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Page Links-->
                        <li class="nav-item {{ Request::is('/#home') ? 'active' : ''}}">
                            <a href="{{ url('/#home') }}" class="nav-link">Home</a>
                        </li>
                    @guest
                        <li class="nav-item {{ Request::is('login') ? 'active' : ''}}">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item {{ Request::is('register') ? 'active' : ''}}">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
    
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">   
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
    
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
         
    <div class="page-header" filter-color="orange">
        <div class="container">
            <div class="col-md-4 content-center">
                <div class="card card-login card-plain">
                        <div class="content">
                            <h6><strong>Almost Done! </strong> Please fill up the form to complete your registration</h6>
                            <div class="text-center">
                                <h2>Employee ....</h2>
                            </div>
                            <div class="card" style="background:transparent">
                                <div class="card-body">
                                    <div class="rounded box-shadow">
                                        <h6 class="border-bottom border-gray pb-2 mb-0">Employee</h6>
                                        <div class="text-muted pt-3">
                                            <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                                                <div class="d-flex justify-content-between align-items-center w-100">
                                                    <strong class="text-gray-dark">
                                                        Positions
                                                        <small>
                                                            <i class="fa fa-question-circle text-warning" data-toggle="tooltip" data-placement="top" title="info on sharing ...."></i>
                                                        </small>
                                                    </strong>
                                                    @php
                                                        $value = "";
                                                    @endphp
                                                    @foreach(auth()->user()->positions as $position)
                                                        @php
                                                            $value .= $position->name . ",";
                                                        @endphp
                                                    @endforeach
                                                <input type="text" value="{{ $value }}" class="form-control" data-role="tagsinput" placeholder="Add Positions" id="positions" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-muted pt-3">
                                            <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                                                <div class="d-flex justify-content-between align-items-center w-100">
                                                    <strong class="text-gray-dark">
                                                        Requests
                                                        <small>
                                                            <i class="fa fa-question-circle text-warning" data-toggle="tooltip" data-placement="top" title="info on sharing ...."></i>
                                                        </small>
                                                    </strong>
                                                    @php
                                                        $value = "";
                                                    @endphp
                                                    @foreach(auth()->user()->requests as $request)
                                                        @php
                                                            $value .= $request->name . ",";
                                                        @endphp
                                                    @endforeach
                                                    <input type="text" value="{{ $value}}" class="form-control" data-role="tagsinput" placeholder="Add Requests Options" id="requests" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-round btn-md" >
                                                    {{ __('Finish') }}
                                                </a>
                                        
                                                <a class="btn btn-link text-white" href="{{ route('dashboard') }}" data-toggle="tooltip" data-placement="top" title="This can be set later on Your Account > Settings">
                                                    {{ __('Skip') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.tagsInput.js') }}"></script>
    <script src="{{ asset('js/now-ui-kit.js') }}"></script>
    <script src="{{ asset('js/rota.js')}}"></script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#positions').on('change', function(){
                    if($(this).val() == ""){
                        var url = "{{ url('/dashboard/positions/delete-position/') }}"+"/" + '{{ auth()->user()->id }}';
                        console.log(url);
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            dataType: 'json',
                            contentType: 'application/json; charset=utf-8',
                            success: function (result) {},
                        });
                    } else {
                        var url = "{{ url('/dashboard/positions/update-position/') }}"+"/"+'{{ auth()->user()->id }}'+"/"+$(this).val();
                        console.log(url);
                        $.ajax({
                            url: url,
                            type: 'POST',
                            dataType: 'json',
                            contentType: 'application/json; charset=utf-8',
                            success: function (result) {},
                        });
                    }
                    
                });
                $('#requests').on('change', function(){
                    if($(this).val() == ""){
                        var url = "{{ url('/dashboard/requests/delete-request/') }}"+"/"+'{{ auth()->user()->id }}';
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            dataType: 'json',
                            contentType: 'application/json; charset=utf-8',
                            success: function (result) {},
                        });
                    } else {
                        var url = "{{ url('/dashboard/requests/update-request/') }}"+"/"+'{{ auth()->user()->id }}'+"/"+$(this).val();
                        $.ajax({
                            url: url,
                            type: 'POST',
                            dataType: 'json',
                            contentType: 'application/json; charset=utf-8',
                            success: function (result) {},
                        });
                    }
                    
                });
            });
    </script>
</body>
</html>
