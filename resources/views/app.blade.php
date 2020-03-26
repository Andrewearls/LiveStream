<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>LiveStream</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/c6eca12015.js" crossorigin="anonymous"></script>
        <script src="https://js.pusher.com/5.1/pusher.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


        <!-- <script>

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('45f7e2d005912d917ae1', {
              cluster: 'us3',
              forceTLS: true
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
              alert(JSON.stringify(data));
            });
        </script> -->

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/main.css') }}"></link>
    </head>
    <body>
        <div id="errorMsg">
            <p>Error Messages go here</p>
        </div>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content" id="video-container">
                @yield('content')
            </div>
            @yield('buttons')
        </div>
    </body>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    @yield('scripts')
    <!-- <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script> -->
    <!-- <script type="text/javascript" src="{{ asset('js/connectRemote.js') }}"></script> -->
    <!-- <script type="text/javascript" src="{{ asset('js/streamingConnection.js') }}"></script> -->
</html>