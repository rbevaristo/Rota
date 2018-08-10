<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-primary shadow-lg p-3 mb-5">
    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse bg-primary" id="navbarsExampleDefault">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ Request::is('dashboard') ? 'active' : ''}}">
                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
            </li>
            {{-- <li class="nav-item {{ Request::is('dashboard/employee') ? 'active' : ''}}">
                <a href="{{ route('user.employee') }}" class="nav-link">Employees</a>
            </li> --}}
            <li class="nav-item {{ Request::is('dashboard/attendance') ? 'active' : ''}}">
                <a href="{{ route('user.attendance') }}" class="nav-link">Attendance</a>
            </li>
            <li class="nav-item {{ Request::is('dashboard/performance-evaluation') ? 'active' : ''}}">
                <a href="{{ route('user.performance') }}" class="nav-link">Performance Evaluation</a>
            </li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <notification v-bind:messages="messages"></notification>
            @if(Auth::check())
                <li class="nav-item dropdown">
                    <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-globe"></i> Notification <span class="badge badge-danger" id="count-notification">
                            @if(auth()->user()->unreadNotifications->count())
                            {{auth()->user()->unreadNotifications->count()}}
                            @endif
                        </span>
                        <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a href="{{ route('markRead') }}">Mark all as read</a>
                        @if(auth()->user()->notifications->count())
                            @foreach(auth()->user()->unreadNotifications as $notification)
                                
                                <a class="dropdown-item bg-secondary" href="#">
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="{{ asset('storage/avatar/') }}/{{ auth()->user()->profile->avatar }}" class="media-object rounded" style="width:60px">
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{ $notification->data['messages']['title'] }} </h4>
                                        <p><small>{{$notification->data['messages']['body']}}</small> </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            @foreach(auth()->user()->readNotifications as $notification)
                                <a class="dropdown-item" href="#">
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="{{ asset('storage/avatar/') }}/{{ auth()->user()->profile->avatar }}" class="media-object rounded" style="width:60px">
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{ $notification->data['messages']['title'] }} </h4>
                                        <p><small>{{$notification->data['messages']['body']}}</small> </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                        <a class="dropdown-item" href="#">
                            No Notification
                        </a>
                        @endif
                    </div>
                </li>
            @endif
            {{-- <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <span class="fa fa-bell text-white"></span> <span class="d-sm-block d-md-none"> Notifications</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right notifications" aria-labelledby="navbarDropdown">
                    <div class="notification-heading">
                        <small class="menu-title">Notifications</small>
                    </div>
                    <li class="divider"></li>
                    <div class="notifications-wrapper">

                        <a class="content" href="#">
                            
                            <div class="notification-item">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="{{ asset('storage/avatar/') }}/{{ auth()->user()->profile->avatar }}" class="media-object rounded" style="width:60px">
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">Left-aligned </h4>
                                        <p><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small> </p>
                                    </div>
                                </div>
                            </div>
                            
                        </a>

                    </div>
                    <li class="divider"></li>
                    <a href="">
                        <div class="notification-footer text-center">
                            <small class="menu-title">View all</small>
                        </div>
                    </a>
                </ul>
            </li> --}}
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <img src="{{ asset('storage/avatar/') }}/{{ auth()->user()->profile->avatar }}" alt="" width="20" height="20">
                    {{ Helper::name() }} <span class="caret"></span>
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
                        <span class="fa fa-sign-out"></span> {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>