<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-primary shadow-lg p-3 mb-5">
    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse bg-primary" id="navbarsExampleDefault">

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
            {{-- <notification v-bind:messages="messages"></notification> --}}
            @if(Auth::check())
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <span class="fa fa-bell text-white"></span> 
                    <span class="badge badge-danger">
                            @if(auth()->user()->unreadNotifications->count())
                                {{auth()->user()->unreadNotifications->count()}}
                            @endif
                    </span>
                    <span class="d-sm-block d-md-none"> Notifications</span>
                    
                </a>
                <ul class="dropdown-menu dropdown-menu-right notifications" aria-labelledby="navbarDropdown">
                    <div class="notification-heading">
                        <small class="menu-title">Notifications</small>
                    </div>
                    <li class="divider"></li>
                    <div class="notifications-wrapper">
                        @if(auth()->user()->notifications->count())
                        @foreach(auth()->user()->unreadNotifications as $notification)
                        <a class="content" href="#">
                            
                            <div class="notification-item">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="{{ asset('storage/avatar/') }}/{{ auth()->user()->profile->avatar }}" class="media-object rounded" style="width:60px">
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading"> 
                                            {{ $notification->data["messages"]["title"] }} 
                                            <span class="float-right">
                                                <small>{{ date('F, d, Y', strtotime($notification->created_at))}}</small> 
                                            </span>
                                        </p>
                                        <p>
                                            <small>{{ Helper::limit_message($notification->data["messages"]["body"], 5) }}</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                                
                        </a>
                        @endforeach
                        <li class="divider"></li>
                        @foreach(auth()->user()->readNotifications as $notification)
                        <a class="content" href="#">
                            
                            <div class="notification-item">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="{{ asset('storage/avatar/') }}/{{ auth()->user()->profile->avatar }}" class="media-object rounded" style="width:60px">
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading"> 
                                            {{ $notification->data["messages"]["title"] }} 
                                            <span class="float-right">
                                                <small>{{ date('F, d, Y', strtotime($notification->created_at))}}</small> 
                                            </span>
                                        </p>
                                        <p>
                                            <small>{{ Helper::limit_message($notification->data["messages"]["body"], 5) }}</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                        </a>
                        @endforeach

                        @else
                        <a class="content" href="#">
                            
                            <div class="notification-item">
                                No Message
                            </div>
                                
                        </a>
                        @endif
                    </div>
                    <li class="divider"></li>
                    <a href="">
                        <div class="notification-footer text-center">
                            <small class="menu-title">View all</small>
                        </div>
                    </a>
                </ul>
            </li>
            @endif
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <img src="{{ asset('img/default.png') }}" alt="" width="20" height="20">
                    {{ Helper::name() }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('employee.profile') }}">
                        <span class="fa fa-user"></span> {{ __('My Profile') }}
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