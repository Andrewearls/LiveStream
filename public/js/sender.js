var startButton = document.getElementById("startButton");
var sendButton = document.getElementById("sendButton");
var localVideo = document.getElementById('localVideo');

var user = "sender";
var mediaConstraints = {
  	audio: true, // We want an audio track
  	video: true // ...and we want a video track
};
url = sendButton.getAttribute('data-href');

sendButton.addEventListener("click", function () {
	// Create and offer a connection to peer
	createPeerConnection();
	// Start local video recording
	navigator.mediaDevices.getUserMedia(mediaConstraints)
	// Add local video to the stream
    .then(function(localStream) {
      	localVideo.srcObject = localStream;
      	localStream.getTracks().forEach(track => myPeerConnection.addTrack(track, localStream));
      	// Play the local video locally
      	localVideo.play();
    })
    .catch(handleGetUserMediaError);
});
