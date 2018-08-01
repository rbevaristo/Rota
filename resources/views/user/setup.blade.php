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
        strong {
            color: orange;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-primary box-shadow">
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
                  
        <main>
            <div class="container d-flex justify-content-center h-100 align-items-center">
                
                <div class="col-md-6">
                    <h6><strong>Almost Done! </strong> Please fill up the form to complete your registration</h6>
                    <div class="card">
                        <div class="card-header">
                                <h2>Company</h2>
                        </div>
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('user.company.create') }}" class="form-signin">
                                @csrf
                                
                                <div class="form-label-group">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                                    <label for="name"><i class="fa fa-building-o"></i> Name</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                                    <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="location" name="location" class="form-control" placeholder="Location" required>
                                    <label for="location"><i class="fa fa-map-marker"></i> Location</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="contact" name="contact" class="form-control" placeholder="Contact" required>
                                    <label for="contact"><i class="fa fa-phone"></i> Contact</label>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-round btn-md form-control">
                                            {{ __('Next') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/offcanvas.js')}}"></script>
</body>
</html>
