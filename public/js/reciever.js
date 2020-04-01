var playButton;
var url;

$( document ).ready(function() {
  var playButton = document.getElementById('play_button');
  var url = playButton.getAttribute('data-href');
});
  
function handleGetUserMediaError(data) {
  console.log("User Media Error: " + JSON.stringify(data));
};

function handleRecievedMessage(msg) {
	console.log("Recieved Message: " + msg);
  var msg = JSON.parse(msg);
	var localStream = null;

  // targetUsername = msg.name;
  createPeerConnection();

  console.log("message SDP: " + msg.sdp);
  var desc = new RTCSessionDescription(msg.sdp);

  myPeerConnection.setRemoteDescription(desc).then(function () {
    	return navigator.mediaDevices.getUserMedia(mediaConstraints);
  })
  .then(function(stream) {
    localStream = stream;
    document.getElementById("local_video").srcObject = localStream;

    localStream.getTracks().forEach(track => myPeerConnection.addTrack(track, localStream));
  })
  .then(function() {
   	return myPeerConnection.createAnswer();
  })
  .then(function(answer) {
   	return myPeerConnection.setLocalDescription(answer);
  })
  .then(function() {
   	var msg = {
     	// name: myUsername,
     	// target: targetUsername,
     	type: "video-answer",
     	sdp: myPeerConnection.localDescription
   	};
 		sendToServer(msg, url);
	})
	.catch(handleGetUserMediaError);
};