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
    
    event.preventDefault();
    const endPoint = window.location.origin + "/seller/removeImage";
    var data = `${csrfToken}=${csrfHash}&imageId=${id}`;
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        if (xmlhttp.readyState == 4){
            let res = JSON.parse(this.responseText);
            setCSRF(res.csrfToken, res.csrfHash);
            const modalElement = ;
            popModal(document.getElementById("modal"), "Removing Image", res.message, [{
                text: "Close",
                ref: null,
            }]);
        }
    } 
    xmlhttp.open( "POST", endPoint, true );
    xmlhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded;   charset=UTF-8');
    xmlhttp.responseType = "";
    xmlhttp.send(data);
}