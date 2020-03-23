var pc;
var dc;

function makeConnection() {
	pc = new RTCPeerConnection();
	dc = pc.createDataChannel("my channel");
	console.log("pc " + pc.connectionState);
	console.log("dc " + dc.label);
}


