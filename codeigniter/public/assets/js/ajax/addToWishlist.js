const addToWishlist = document.getElementById("addToWishlist");
const productId = document.getElementById("product_id");

addToWishlist.onclick = function() {
    var data = `${csrfToken}=${csrfHash}&product=${productId.value}`;
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        if (xmlhttp.readyState == 4) {
            let res = JSON.parse(this.responseText);
            setCSRF(res.csrfToken, res.csrfHash);
            popModal(document.getElementById("modal"), "Wishlist", res.message, [{
                text: "Go to Wishlist",
                ref: `${window.location.origin}/wishlist`
            }, {
                text: "Continue shopping",
                ref: `${window.location.origin}/products`
            }])
        }
    } 
    xmlhttp.open("POST", window.location.origin + '/wishlist/add', true );
    xmlhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded;   charset=UTF-8');
    xmlhttp.responseType = "";
    xmlhttp.send(data);
}

