<nav class="navbar navbar-expand-lg bg-primary">
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

            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::is('dashboard') ? 'active' : ''}}">
                    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item {{ Request::is('dashboard/schedule') ? 'active' : ''}}">
                    <a href="{{ route('user.schedule') }}" class="nav-link">Schedule</a>
                </li>
                <li class="nav-item {{ Request::is('dashboard/employee') ? 'active' : ''}}">
                    <a href="{{ route('user.employee') }}" class="nav-link">Employees</a>
                </li>
                <li class="nav-item {{ Request::is('dashboard/attendance') ? 'active' : ''}}">
                    <a href="{{ route('user.attendance') }}" class="nav-link">Attendance</a>
                </li>
                <li class="nav-item {{ Request::is('dashboard/performance-evaluation') ? 'active' : ''}}">
                    <a href="{{ route('user.performance') }}" class="nav-link">Performance Evaluation</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                {{-- <notification></notification> --}}
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.profile') }}">
                            <span class="fa fa-user"></span> {{ __('My Profile') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('user.settings') }}">
                            <span class="fa fa-gear"></span> {{ __('Settings') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <span class="fa fa-sign-out"></span>{{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
