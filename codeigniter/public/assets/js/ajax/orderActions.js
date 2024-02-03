function completeOrder(orderItem) {
    var data = `${csrfToken}=${csrfHash}&orderItem=${orderItem}`;
    const XMLHttp = new XMLHttpRequest();
    XMLHttp.onload = function () {
        if (XMLHttp.readyState != 4){
            let res = JSON.parse(this.responseText);
            setCSRF(res.csrfToken, res.csrfHash);
            popModal(document.getElementById("modal"), "Complete order", res.message, [{
                text: "Close",
                behaviour: `${window.location.origin}/seller/orders`
            }]);
        }        
    } 
    XMLHttp.open( "POST", `${window.location.origin}/order/complete`, true );
    XMLHttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    XMLHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded;charset=UTF-8');
    XMLHttp.responseType = "application/json";
    XMLHttp.send(data);
}

function cancelOrder(orderItem) {
    var data = `${csrfToken}=${csrfHash}&orderItem=${orderItem}`;
    const XMLHttp = new XMLHttpRequest();
    XMLHttp.onload = function () {
        if (XMLHttp.readyState == 4){
            let res = JSON.parse(this.responseText);
            setCSRF(res.csrfToken, res.csrfHash);
            popModal(document.getElementById("modal"), "Cancel Order", res.message, [{
                text: "Close",
                ref: `${window.location.origin}/seller/orders`
            }]);
        }
    } 
    XMLHttp.open( "POST", window.location.origin +"/order/cancel", true );
    XMLHttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    XMLHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded;charset=UTF-8');
    XMLHttp.responseType = "";
    XMLHttp.send(data);
}