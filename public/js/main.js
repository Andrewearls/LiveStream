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
            o: dataString
        },
        success: function (data) {
           alert('Success');

        },
        error: function () {
         alert('Error');
        }
    });
};




