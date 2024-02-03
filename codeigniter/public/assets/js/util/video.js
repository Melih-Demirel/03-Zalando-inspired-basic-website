let addVideoButton = document.getElementById("addVideo");
let videoContainer = document.getElementById("videoContainer");

addVideoButton.onclick = (event) => {
    event.preventDefault();
    let idOfNewDiv = Math.floor(Math.random()*101);
    while(doesIdExist(idOfNewDiv)){
        idOfNewDiv = Math.floor(Math.random()*101);
    }
    let node = document.createElement('div');
    let videoComponent = `
    <div class="input-group mb-3">
        <input type="text" name="video[]" id="video" class="customInput border form-control" placeholder="https://youtu.be/eIoZxhBKA7c" required value="">
        <div class="input-group-append">
            <span class="input-group-text" id="basic-addon2"><i role="button" class="bi bi-trash fs-4" style="color:red;" onclick="removeVideo(event,`+idOfNewDiv+`)"></i></span>
        </div>
    </div>`;
    node.id = idOfNewDiv;
    node.innerHTML = videoComponent.trim();   
    videoContainer.appendChild(node);
};

function removeVideo(event, id) {
    event.preventDefault();
    let toRemoveNode;
    for(var i = 0; i< videoContainer.childElementCount;i++)
    {
        if(videoContainer.children[i].id == id){
            toRemoveNode = videoContainer.children[i];
        }
    }
    videoContainer.removeChild(toRemoveNode);
}

function doesIdExist(id){
    for(var i = 0; i< videoContainer.childElementCount;i++)
    {
        if(videoContainer.children[i].id == id){
            return true;
        }
    }
    return false;
}