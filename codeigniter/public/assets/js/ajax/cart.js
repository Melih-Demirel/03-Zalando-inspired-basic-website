function deleteCartItem(cartItemId) {
    var data = `${csrfToken}=${csrfHash}&cartItem=${cartItemId}`;
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        if (xmlhttp.readyState == 4) {
            let res = JSON.parse(this.responseText);
            setCSRF(res.csrfToken, res.csrfHash);
            popModal(document.getElementById("modal"), "Remove cart item", res.message, [{
                text: "Close",
                ref: `${window.location.origin}/cart/`
            }]);
        }
    } 
    xmlhttp.open("POST", window.location.origin + "/cart/remove", true );
    xmlhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded;   charset=UTF-8');
    xmlhttp.responseType = "";
    xmlhttp.send(data);


}