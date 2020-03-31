var startButton = document.getElementById("startButton");
var sendButton = document.getElementById("sendButton");
var localVideo = document.getElementById('localVideo');
var url = sendButton.getAttribute('data-href');
var mediaConstraints = {
  	audio: true, // We want an audio track
  	video: true // ...and we want a video track
};
var handleGetUserMediaError;

startButton.addEventListener("click", function(){
	makeConnection();
	startButton.setAttribute("disabled", "");
});

sendButton.addEventListener("click", function () {
	createPeerConnection();
	navigator.mediaDevices.getUserMedia(mediaConstraints)
    .then(function(localStream) {
      	localVideo.srcObject = localStream;
      	localStream.getTracks().forEach(track => myPeerConnection.addTrack(track, localStream));
      	localVideo.play();
    })
    .catch(handleGetUserMediaError);
	// var outgoingMessage = "sadf";
	// sendToServer(outgoingMessage, url);
});
