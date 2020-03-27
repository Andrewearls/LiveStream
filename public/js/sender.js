var startButton = document.getElementById("startButton");
var sendButton = document.getElementById("sendButton");
var url = sendButton.getAttribute('data-href');


startButton.addEventListener("click", function(){
	makeConnection();
	startButton.setAttribute("disabled", "");
});

sendButton.addEventListener("click", function () {
	createPeerConnection();
	var outgoingMessage = "sadf";
	sendMsg(outgoingMessage, url);
});
