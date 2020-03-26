'use strict';

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

function sendMsg(msg, url) {
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
           alert(data);

        },
        error: function () {
         alert('Error');
        }
    });
};




