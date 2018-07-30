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
    <link href="{{ asset('css/now-ui-kit.css') }}" rel="stylesheet">
    @yield('styles')
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap-notification.min.css')}}"> --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="landing-page sidebar-collapse">
    @include('components.navbar')
    <main class="">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @yield('breadcrumb')
                </ol>
            </nav>
            @yield('content')
        </div>
    </main>
    
    <!-- Scripts -->
    <script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/now-ui-kit.js') }}"></script>
    {{-- <script src="//js.pusher.com/3.1/pusher.min.js"></script> --}}
    @yield('js')
    <script type="text/javascript">
        // var notificationsWrapper   = $('.dropdown-notifications');
        // var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
        // var notificationsCountElem = notificationsToggle.find('i[data-count]');
        // var notificationsCount     = parseInt(notificationsCountElem.data('count'));
        // var notifications          = notificationsWrapper.find('ul.dropdown-menu');
        // if (notificationsCount <= 0) {
        //   notificationsWrapper.hide();
        // }
        // // Enable pusher logging - don't include this in production
        // // Pusher.logToConsole = true;
        // var pusher = new Pusher('bfc4bf83682033a454f2', {
        //   encrypted: true
        // });
        // // Subscribe to the channel we specified in our Laravel Event
        // var channel = pusher.subscribe('status-liked');
        // // Bind a function to a Event (the full Laravel class)
        // channel.bind('App\\Events\\StatusLiked', function(data) {
        //   var existingNotifications = notifications.html();
        //   var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
        //   var newNotificationHtml = `
        //     <li class="notification active">
        //         <div class="media">
        //           <div class="media-left">
        //             <div class="media-object">
        //               <img src="https://api.adorable.io/avatars/71/`+avatar+`.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
        //             </div>
        //           </div>
        //           <div class="media-body">
        //             <strong class="notification-title">`+data.message+`</strong>
        //             <!--p class="notification-desc">Extra description can go here</p-->
        //             <div class="notification-meta">
        //               <small class="timestamp">about a minute ago</small>
        //             </div>
        //           </div>
        //         </div>
        //     </li>
        //   `;
        //   notifications.html(newNotificationHtml + existingNotifications);
        //   notificationsCount += 1;
        //   notificationsCountElem.attr('data-count', notificationsCount);
        //   notificationsWrapper.find('.notif-count').text(notificationsCount);
        //   notificationsWrapper.show();
        // });
      </script>
</body>
</html>