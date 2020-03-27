var startButton = document.getElementById("startButton");
var sendButton = document.getElementById("sendButton");
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
      	document.getElementById("localVideo").srcObject = localStream;
      	localStream.getTracks().forEach(track => myPeerConnection.addTrack(track, localStream));
    })
    .catch(handleGetUserMediaError);
	// var outgoingMessage = "sadf";
	// sendMsg(outgoingMessage, url);
});
