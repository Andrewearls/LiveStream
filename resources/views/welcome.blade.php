<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LiveStream</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/c6eca12015.js" crossorigin="anonymous"></script>

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
                <div class="title m-b-md hide" id="pause-screen">
                    <p>LiveStream</p>
                    <i class="far fa-play-circle"></i>
                    
                </div>
                <video id="localVideo" class=""></video>
                <video id="remoteVideo" class=""></video>
                <textarea id="localChat" disabled></textarea>
                <textarea id="remoteChat" disabled></textarea>
            </div>
            <button id="startButton">Start</button>
            <button id="sendButton">Send</button>
            <button id="hangupButton">Hang up</button>
        </div>
    </body>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    <!-- <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script> -->
    <!-- <script type="text/javascript" src="{{ asset('js/connectRemote.js') }}"></script> -->
    <!-- <script type="text/javascript" src="{{ asset('js/streamingConnection.js') }}"></script> -->
</html>
