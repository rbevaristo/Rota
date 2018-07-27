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
                <li class="nav-item {{ Request::is('employee/dashboard') ? 'active' : ''}}">
                    <a href="{{ route('employee.dashboard') }}" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item {{ Request::is('employee/dashboard/messages') ? 'active' : ''}}">
                    <a href="{{ route('employee.messages') }}" class="nav-link">Messages</a>
                </li>
                <li class="nav-item {{ Request::is('employee/dashboard/schedule') ? 'active' : ''}}">
                    <a href="{{ route('employee.schedule') }}" class="nav-link">Schedule</a>
                </li>
                <li class="nav-item {{ Request::is('employee/dashboard/evaluation') ? 'active' : ''}}">
                    <a href="{{ route('employee.evaluation') }}" class="nav-link">Evaluation</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fa fa-bell"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('employee.profile') }}">
                            <span class="fa fa-user"></span> {{ __('My Profile') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('employee.logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <span class="fa fa-sign-out"></span>{{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('employee.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
