function sendToServer(msg) {
	msg.userName = user;
	msg.sdp = myPeerConnection.localDescription;
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
         console.log('Could not send message!');
        }
    });
};