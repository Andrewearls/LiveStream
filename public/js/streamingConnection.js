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