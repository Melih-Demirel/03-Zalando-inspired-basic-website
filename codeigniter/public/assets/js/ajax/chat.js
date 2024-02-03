var objDiv = document.getElementById("messages");
objDiv.scrollTop = objDiv.scrollHeight;

function sendMessage(chatId, chattingTo){  
    const message = document.getElementById('message');
    var data = `${csrfToken}=${csrfHash}&chat=${chatId}&msg=${message.value}`;
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        if (xmlhttp.readyState == 4) {
            let res = JSON.parse(this.responseText);
            setCSRF(res.csrfToken, res.csrfHash);
            popModal(document.getElementById("modal"), "Send message", res.message, [{
                text: "Close",
                ref: `${window.location.origin}/chat/${chattingTo}`
            }]);
        }
            
    } 
    xmlhttp.open( "POST", window.location.origin + "/chat/addMessage", true );
    xmlhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded;   charset=UTF-8');
    xmlhttp.responseType = "";
    xmlhttp.send(data);
}
