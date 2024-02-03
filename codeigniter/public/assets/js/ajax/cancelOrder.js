function cancelOrder(item) {
    var data = `${csrfToken}=${csrfHash}&orderItem=${item}`;
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        if (xmlhttp.readyState == 4){
            let res = JSON.parse(this.responseText);
            setCSRF(res.csrfToken, res.csrfHash);
            popModal(document.getElementById("modal"), "Cancel Order", res.message, [{
                text: "Close",
                ref: `${window.location.origin}/auth`
            }]);
        }
    } 
    xmlhttp.open( "POST", window.location.origin +"/order/cancel", true );
    xmlhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded;   charset=UTF-8');
    xmlhttp.responseType = "";
    xmlhttp.send(data);
}