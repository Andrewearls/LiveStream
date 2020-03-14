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
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            p {
                margin-bottom: 0px;
            }

            video {
                width: 45%;
                border: 1px solid red;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                border: 5px solid gray;
                border-radius: 10px;
                width: 725px;
                height: 420px;
                overflow: hidden;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {    
                width: 50%;
                height: 50%;
                margin: auto;
                align-content: center;
            }

            .hide {
                display: none;
            }

            .show {
                display: block;
            }
        </style>
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
                <div class="title m-b-md" id="pause-screen">
                    <p>LiveStream</p>
                    <i class="far fa-play-circle"></i>
                    
                </div>
                <video id="localStream" class="hide"></video>
                <video id="remoteStream" class="hide"></video>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        'use strict';

        // Put variables in global scope to make them available to the browser console.
        var video = document.querySelector('#localStream');
        var remoteStream = document.querySelector('#remoteStream');
        var constraints = window.constraints = {
            audio: true,
            video: true
        };
        var errorElement = document.querySelector('#errorMsg');

        document.getElementById("pause-screen").addEventListener("click", function (){
            navigator.mediaDevices.getUserMedia(constraints)
            .then(function(stream) {
                var videoTracks = stream.getVideoTracks();
                console.log('Got stream with constraints:', constraints);
                console.log('Using video device: ' + videoTracks[0].label);
                stream.onremovetrack = function() {
                    console.log('Stream ended');
                };
                // window.stream = stream; // make variable available to browser console
                video.srcObject = stream;
                video.onloadedmetadata = function (e) {
                    video.play();
                    console.log("playing");
                }
            })
            .catch(function(error) {
                if (error.name === 'ConstraintNotSatisfiedError') {
                    errorMsg('The resolution ' + constraints.video.width.exact + 'x' +
                        constraints.video.width.exact + ' px is not supported by your device.');
                } else if (error.name === 'PermissionDeniedError') {
                    errorMsg('Permissions have not been granted to use your camera and ' +
                        'microphone, you need to allow the page access to your devices in ' +
                        'order for the demo to work.');
                }
                errorMsg('getUserMedia error: ' + error.name, error);
            });

            function errorMsg(msg, error) {
                errorElement.innerHTML += '<p>' + msg + '</p>';
                if (typeof error !== 'undefined') {
                    console.error(error);
                }
            }
            
            document.querySelector(".title").classList.add("hide");
            video.classList.remove("hide");
            video.classList.add("show");
            remoteStream.classList.remove("hide");
            remoteStream.classList.add("show");
            // document.getElementById("video-container").innerHTML = video;
        });
        
    </script>
</html>
