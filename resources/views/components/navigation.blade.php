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
                    <li class="nav-item {{ Request::is('/#about') ? 'active' : ''}}">
                        <a href="{{ url('/#about')}}" class="nav-link">About</a>
                    </li>
                    <li class="nav-item {{ Request::is('/#services') ? 'active' : ''}}">
                        <a href="{{ url('/#services') }}" class="nav-link">Services</a>
                    </li>
                    <li class="nav-item {{ Request::is('/#team') ? 'active' : ''}}">
                        <a href="{{ url('/#team') }}" class="nav-link">Team</a>
                    </li>
                    <li class="nav-item {{ Request::is('/#contact') ? 'active' : ''}}">
                        <a href="{{ url('/#contact') }}" class="nav-link">Contact</a>
                    </li>
                <!-- Authentication Links -->
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
                            @if(Auth::guard()->user()->role_id == 1)
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                Dashboard
                            </a>
                            @elseif(Auth::guard()->user()->role_id == 3)
                            <a class="dropdown-item" href="{{ route('employee.dashboard') }}">
                                Dashboard
                            </a>
                            @else
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    Dashboard
                                </a>
                            @endif

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
