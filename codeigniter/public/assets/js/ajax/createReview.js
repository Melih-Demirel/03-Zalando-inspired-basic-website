const rating = document.getElementById('rating');
const comment = document.getElementById('comment');
const productId = document.getElementById('product_id');

async function createReview() {
    if(comment.value !=""){
        var data = `${csrfToken}=${csrfHash}&product_id=${productId.value}&comment=${comment.value}&rating=${rating.value}`;
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function () {
            if (xmlhttp.readyState == 4) {
                let res = JSON.parse(this.responseText);
                setCSRF(res.csrfToken, res.csrfHash);
                popModal(document.getElementById("modal"), "Create Review", res.message, [{
                    text: "Continue",
                    ref: `${window.location.origin}/auth`
                }]);
            }
        } 
        xmlhttp.open( "POST", `${window.location.origin}/review/add`, true );
        xmlhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded;   charset=UTF-8');
        xmlhttp.responseType = "";
        xmlhttp.send(data);
    }
    comment.focus();
}