function removeImage(event, id) {
    event.preventDefault();

    // First remove from Client view:

    let imageContainer = document.getElementById("imageContainer");
    let toRemoveNode;
    for(var i = 0; i< imageContainer.childElementCount;i++)
    {
        if(imageContainer.children[i].id == id){
            toRemoveNode = imageContainer.children[i];
        }
    }
    imageContainer.removeChild(toRemoveNode);

    //Second make request to delete on server.
    var data = `${csrfToken}=${csrfHash}&imageId=${id}`;
    const XMLHttp = new XMLHttpRequest();
    XMLHttp.onload = function () {
        if (XMLHttp.readyState == 4){
            let res = JSON.parse(this.responseText);
            setCSRF(res.csrfToken, res.csrfHash);
            popModal(document.getElementById("modal"), "Remove image", res.message, [{
                text: "Close",
                ref: null,
            }]);
        } 
    } 
    XMLHttp.open( "POST", window.location.origin + "/products/removeImage", true );
    XMLHttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    XMLHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded;charset=UTF-8');
    XMLHttp.responseType = "";
    XMLHttp.send(data);
}