'use strict';

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var myPeerConnection;
var url;
var user = "not set";

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
  	// myPeerConnection.onnegotiationneeded = handleNegotiationNeededEvent;
  	// myPeerConnection.onremovetrack = handleRemoveTrackEvent;
  	// myPeerConnection.oniceconnectionstatechange = handleICEConnectionStateChangeEvent;
  	// myPeerConnection.onicegatheringstatechange = handleICEGatheringStateChangeEvent;
  	// myPeerConnection.onsignalingstatechange = handleSignalingStateChangeEvent;
    // alert('clicked the send button');
}




