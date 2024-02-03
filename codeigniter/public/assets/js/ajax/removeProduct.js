function removeProduct(event, productId) {
    event.preventDefault();
    const endPoint = ;
    var data = `${csrfToken}=${csrfHash}&product=${productId}`;
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        if (xmlhttp.readyState == 4){
            let res = JSON.parse(this.responseText);
            setCSRF(res.csrfToken, res.csrfHash);
            popModal(document.getElementById("modal"), "Remove product", res.message, [{
                text: "Close",
                ref: `${window.location.origin}/seller/products`
            }]);
        }
    } 
    xmlhttp.open( "POST", window.location.origin + "/products/delete", true );
    xmlhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded;   charset=UTF-8');
    xmlhttp.responseType = "";
    xmlhttp.send(data);    
}