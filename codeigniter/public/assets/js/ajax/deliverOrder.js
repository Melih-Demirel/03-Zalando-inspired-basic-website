function completeOrder(item) {
    var data = `${csrfToken}=${csrfHash}&orderItem=${item}`;
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        if (xmlhttp.readyState != 4)
            return;

        let res = JSON.parse(this.responseText);
        setCSRF(res.csrfToken, res.csrfHash);
        popModal(document.getElementById("modal"), "Deliver order", res.message, [{
            text: "Close",
            ref: `${window.location.origin}/seller/orders`
        }]);
    } 
    xmlhttp.open( "POST", `${window.location.origin}/order/complete`, true );
    xmlhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded;   charset=UTF-8');
    xmlhttp.responseType = "application/json";
    xmlhttp.send(data);
}