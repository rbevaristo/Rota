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
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/offcanvas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/floating-labels.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        #setup {
            padding-top:30px;
        }
        #setup .dropdown-item {
            width: 400px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md fixed-top navbar-light bg-light box-shadow">
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
            <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
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
                                {{ Helper::name() }} <span class="caret"></span>
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
        </nav>

        <main id="setup">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h2>
                            Employees Settings
                        </h2>
                        <div class="alert alert-warning">
                            Manage your employees or you can <a href="#" class="btn btn-sm btn-link">Skip</a> this and manage them later on your dashboard.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="card box-shadow">
                            <div class="card-header">
                                Employees
                                <a href="#add_employee"><span class="float-right d-md-none d-sm-block"><i class="fa fa-user-plus"></i>Add Employee</span></a>
                            </div>
                            @if(count(auth()->user()->employees) > 0)
                            <div class="card-body">
                                <div class="row">
                                    @foreach(auth()->user()->employees as $employee)
                                    <div class="col-md-2 col-sm-2 text-center employee-lists">
                                        <p><strong>{{ $employee->name }}</strong></p>
                                        <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                                        <p>{{ $employee->position->name }}</p>
                                        <span><a href="#"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
                                        <a href="#"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i></a>
                                        <a href="#"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i></a>
                                        <a href="#"><i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i></a></span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @else
                            <div class="card-body">
                                No Employee
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3" id="add_employee">
                        <div class="card">
                            <div class="card-header">Add Employee</div>
                            <div class="card-body">
                                <form action="{{ url('/dashboard/employee/create') }}" method="POST" class="form-signin">
                                    @csrf
                                    <div class="form-label-group">
                                        <input type="text" id="employee_id" name="employee_id" class="form-control" placeholder="Employee ID" required>
                                        <label for="employee_id">Employee ID</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Employee ID" required>
                                        <label for="firstname">Firstname</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Employee ID" required>
                                        <label for="lastname">Lastname</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="text" id="email" name="email" class="form-control" placeholder="Employee ID" required>
                                        <label for="email">Email</label>
                                    </div>
                                        <div class="form-group">
                                            <label for="emp_position"></label>
                                            <select name="position_id" id="position_id" class="form-control" required>
                                                <option value="">Select Position</option>
                                                @foreach(\App\Position::all() as $position)
                                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/offcanvas.js')}}"></script>
</body>
</html>
