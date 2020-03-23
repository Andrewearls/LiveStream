var pc = new RTCPeerConnection();
var dc = pc.createDataChannel("my channel");
console.log("pc " + pc.connectionState);
console.log("dc " + dc.label);

