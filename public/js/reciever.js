var playButton;
var mediaConstraints = {
    audio: false, // We don't want an audio track
    video: false // ...and we don't want a video track
};

user = "reciever";

$( document ).ready(function() {
  playButton = document.getElementById('play_button');
  url = playButton.getAttribute('data-href');
});