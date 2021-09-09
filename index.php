<?php
session_start();
require_once('db.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Anonymouse ChatBox</title>
<style>
* {
    box-sizing: border-box;
}

body,
html {
    height: 100%;
}

body {
    max-width: 400px;
    margin: 0 auto;
    background: #ddd;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 14px;
}

form {
	clear: both;
    float: none;
    margin: 10px 7px 0;
}

textarea {
	width: 100%;
    padding: 7px 12px;
    resize: vertical;
}

.clearfix {
    display: block;
    width: 100%;
    overflow: hidden;
    clear: both;
    height: 1px;
}

.message {
   border-radius: 7px;
   padding: 7px 12px;
   float: left;
   width: auto;
   clear: both;
   margin: 5px 7px;
   max-width: 85%;
   background-color: #e4e6eb;
}


.message.isme {
    float: right;
    background-color: rgb(0, 132, 255);
}

.name {
    font-size: 11px;
    color: #65676b;
}

.date {
    display: none;
}

.txt {
    line-height: 1;
    margin-bottom: 3px;
    color: #050505;
}

.message.isme .txt {
    color: #fff;
}

.message.isme .name {
    color: #ddd;
}

.messages-wrap {
    overflow: hidden;
    clear: both;
    width: 100%;
    background: #fff;
}

.welcome-form {
    text-align: center;
	background: #fff;
	display: flex;
	align-items: center;
	flex-wrap: wrap;
	justify-content: center;
	height: 166px;
	position: absolute;
	left: 0;
	right: 0;
	margin: 0 auto;
	max-width: 426px;
	top: 30%;
}
.msg-form input[type="submit"] {
    margin-bottom: 10px;
    width: 100%;
    text-transform: uppercase;
    padding: 8px 4px;
}

a.exit-chat {
    position: fixed;
    right: 4px;
    top: 4px;
}

</style>
</head>
<body onload="scrollBottom()">

	<?php 
	if( isset( $_SESSION["username"] ) && isset( $_SESSION["user_id"] ) ) : ?>
		<a class="exit-chat" href="?exit=true">Exit Chat</a>
		<div class="messages-wrap">
			<div id="push-messages"></div>
			<div class="clearfix"></div>
			<form class="msg-form" method="post" id="msg-form">
				<textarea name="your-message" placeholder="Type Message..." rows="5" required></textarea>
				<input type="submit" value="Send">
			</form>
		</div>
	<?php else: ?>
		<form class="welcome-form" method="post">
			<h3>Welcome to Anonymouse ChatBox</h3>
			<label>Enter Your Name: <input type="text" name="your-name"></label>
			<input type="submit" value="Enter">
		</form>
	<?php endif; ?>

<script>
function scrollBottom() {
    window.scrollTo(0, document.body.scrollHeight);
}

// Load Messages
function loadMsg() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        document.getElementById("push-messages").innerHTML = this.responseText;
    };
    xhttp.open("GET", "load-messages.php");
    xhttp.send();
}
loadMsg();

// Load Msg every 3 second
setInterval(function () {
    loadMsg();
}, 3000);

// Handle Message Submit
window.addEventListener("load", function () {
    
    // form elements
    const form = document.getElementById("msg-form");

    function sendMsg() {
        const XHR = new XMLHttpRequest();

        // form element
        const FD = new FormData(form);

        // successful submission
        XHR.addEventListener("load", function (event) {
            if (event.target.responseText == "true") {
                loadMsg();
                form.reset();
            }
        });

        // error msg
        XHR.addEventListener("error", function (event) {
            alert("Oops! Something went wrong.");
        });

        // Set post request
        XHR.open("POST", "send-messages.php");

        // The data sent
        XHR.send(FD);
    }

    // submit event.
    form.addEventListener("submit", function (event) {
        event.preventDefault();
        sendMsg();
    });
});

window.onload = function (e) {
    scrollBottom();
};

</script>
</body>
</html>