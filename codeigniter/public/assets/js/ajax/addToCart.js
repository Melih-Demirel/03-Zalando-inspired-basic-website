const addToCart = document.getElementById("addToCart");
const size = document.getElementById("size");

addToCart.onclick = function () {
    var data = `${csrfToken}=${csrfHash}&product=${size.value}`;
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        if (xmlhttp.readyState == 4) {
            let res = JSON.parse(this.responseText);
            setCSRF(res.csrfToken, res.csrfHash);
            const modalE = document.getElementById("modal");
            if (!res.data.hasOwnProperty('stock')) {
                return popModal(modalE, "Cart", res.message, [{
                    text: "Go to cart",
                    ref: `${window.location.origin}/cart`
                }, {
                    text: "Continue",
                    ref: `${window.location.origin}/products`
                }]);
            }
            popModal(modalE, "Notify", res.message, [{
                text: "Notify me when in stock",
                ref: `${window.location.origin}/notify/${size.value}`
            }, {
                text: "Continue",
                ref: `${window.location.origin}/products`
            }])
            
        }

    }
    xmlhttp.open("POST", window.location.origin + '/cart/add' , true);
    xmlhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded;charset=UTF-8');
    xmlhttp.responseType = "";
    xmlhttp.send(data);

}