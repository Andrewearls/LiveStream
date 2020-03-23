var startButton = document.getElementById("startButton");
var sendButton = document.getElementById("sendButton");
var localChat = document.getElementById("localChat");

function sendMessage(msg) {
	let obj = {
	    "message": msg,
	    "timestamp": new Date()
	}
	// dc.send(JSON.stringify(obj));
	console.log("state " + dc.readyState);
	console.log(msg);
};

startButton.addEventListener("click", function(){
	makeConnection();
	startButton.setAttribute("disabled", "");
	localChat.removeAttribute("disabled");
});

sendButton.addEventListener("click", function () {
	var outgoingMessage = localChat.value;
	sendMessage(outgoingMessage);
})
