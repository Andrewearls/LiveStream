// Report any event errors
function reportError(data) {
	console.warn("Error in reporting: " + data);
}

// Report any User Media Errors
function handleGetUserMediaError(data) {
  console.warn("User Media Error: " + data);
};

// Transmit an ICE Candidate
function handleICECandidateEvent(event) {
	if (event.candidate) {
  	sendToServer({
  		type: "new-ice-candidate",
  		// target: targetUsername,
  		candidate: event.candidate
  	},url);
	}
}

// Process the recieved ICE Candidate
function handleNewICECandidateMsg(msg) {
  	var candidate = new RTCIceCandidate(msg.candidate);

  	myPeerConnection.addIceCandidate(candidate)
    .catch(reportError("failed to add new ice candidate"));
}

// Attach the recieved stream to a video element
function handleTrackEvent(event) {
  	// console.log("track event: " + JSON.stringify(event));
  	document.getElementById("received_video").srcObject = event.streams[0];
  	document.getElementById("hangupButton").disabled = false;
}

// Starts a call
function handleNegotiationNeededEvent() {
  	myPeerConnection.createOffer().then(function(offer) {
    	return myPeerConnection.setLocalDescription(offer);
  	})
  	.then(function() {
    	sendToServer({
      		// target: targetUsername,
      		type: "video-offer",
      		sdp: myPeerConnection.localDescription
    	}, url);
    	// console.log("The SDP is: " + JSON.stringify(myPeerConnection.localDescription));
  	})
  	.catch(reportError);
}

function handleRecievedMessage(msg) {
  // console.log("Recieved Message: " + msg);
  var msg = JSON.parse(msg);
  var localStream = null;

  // creating the peer connection
  createPeerConnection();

  // recieving the message sdp
  var desc = new RTCSessionDescription(msg.sdp);
  console.log("recieved the msg.sdp: " + JSON.stringify(desc));

  // setting the remote description to the message sdp
  myPeerConnection.setRemoteDescription(desc)
  // .then(function () {
  //   console.log("recieved media constraints");
  //   return navigator.mediaDevices.getUserMedia(mediaConstraints);
  // })
  // .then(function(stream) {
  //   console.log("setting stream");
  //   localStream = stream;
  //   document.getElementById("local_video").srcObject = localStream;

  //   localStream.getTracks().forEach(track => myPeerConnection.addTrack(track, localStream));
  // })
  .then(function() {
    console.log("creating answer");
    return myPeerConnection.createAnswer();
  })
  .then(function(answer) {
    console.log("setting local description");
    return myPeerConnection.setLocalDescription(answer);
  })
  .then(function() {
    console.log("sending answer");
    var msg = {
      name: user,
      // target: targetUsername,
      type: "video-answer",
      sdp: myPeerConnection.localDescription
    };
    sendToServer(msg, url);
    console.log('sent a response message');
  })
  .catch(handleGetUserMediaError);
};