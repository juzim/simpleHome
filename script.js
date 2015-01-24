window.onload = function() {
	var buttons = document.getElementsByClassName('button'),
		messageBox = document.getElementById('message');

	for (index = 0; index < buttons.length; ++index) {
	   	document.getElementById(buttons[index].getAttribute('id')).addEventListener("click", openLink, false);
	}	
}

function openLink(e) {
	var link = e.currentTarget.getAttribute('link'),
    	xmlHttp = new XMLHttpRequest();
	xmlHttp.open("GET", link, true);
	xmlHttp.addEventListener("load", ajaxCallback, false);
	xmlHttp.send(null);
    function ajaxCallback(event){
    	var response = JSON.parse(event.currentTarget.response);
    	if (response.error) {
	    	showMessage('Error: ' + response.error);
    		return;	
    	}
    	showMessage('Done');
    }
};

function showMessage(message) {
	var messageBox = document.getElementById('message');

	messageBox.innerHTML = message;
	messageBox.className = "message";
	setTimeout(hideMessage, 3000);
}

function hideMessage() {
	var messageBox = document.getElementById('message');

	messageBox.className = "message hidden";
}