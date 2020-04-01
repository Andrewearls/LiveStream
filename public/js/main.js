'use strict';

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var myPeerConnection;
var reportError;

function sendToServer(msg, url) {
	var dataString = JSON.stringify(msg);

	$.ajax({
        type: "POST",
        url: url,
        dataType: "json",
        data: {
        	_token: CSRF_TOKEN,
            data: dataString
        },
        success: function (data) {
           console.log("Data sent: " + data);
        },
        error: function () {
         console.log('Sending Message Error!');
        }
    });
};

function handleICECandidateEvent(event) {
  	if (event.candidate) {
    	sendToServer({
      		type: "new-ice-candidate",
      		// target: targetUsername,
      		candidate: event.candidate
    	},url);
  	}
}

function handleTrackEvent(event) {
  	document.getElementById("received_video").srcObject = event.streams[0];
  	console.log("attempting to play stream");
  	document.getElementById("hangupButton").disabled = false;
}

function handleNegotiationNeededEvent() {
  	myPeerConnection.createOffer().then(function(offer) {
    	return myPeerConnection.setLocalDescription(offer);
  	})
  	.then(function() {
    	sendToServer({
      		// name: myUsername,
      		// target: targetUsername,
      		type: "video-offer",
      		sdp: myPeerConnection.localDescription
    	});
    	console.log("The SDP is: " + JSON.stringify(myPeerConnection.localDescription));
  	})
  	.catch(reportError);
}
/*
 * 
 * Establish a connection object
 * Set the ICE server properties
 * Set the ICE candidate and send it to the server
 * Manage recieved video
 * Create an offer and send it to the server
 *
 */
function createPeerConnection() {
  	myPeerConnection = new RTCPeerConnection({
      	iceServers: [     // Information about ICE servers - Use your own!
        	{
          		urls: "stun:stun.stunprotocol.org"
        	}
      	]
  	});

  	myPeerConnection.onicecandidate = handleICECandidateEvent;
  	myPeerConnection.ontrack = handleTrackEvent;
  	myPeerConnection.onnegotiationneeded = handleNegotiationNeededEvent;
  	// myPeerConnection.onremovetrack = handleRemoveTrackEvent;
  	// myPeerConnection.oniceconnectionstatechange = handleICEConnectionStateChangeEvent;
  	// myPeerConnection.onicegatheringstatechange = handleICEGatheringStateChangeEvent;
  	// myPeerConnection.onsignalingstatechange = handleSignalingStateChangeEvent;
}




