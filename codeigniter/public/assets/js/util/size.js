let addSizeBtn = document.getElementById("addSize");
let sizeStockContainer = document.getElementById("sizeStockContainer");

if(sizeStockContainer.childElementCount == 1){
    let firstChild = sizeStockContainer.children[0];
    firstChild.getElementsByTagName("button")[0].classList = "fw-bolder border-danger btn btn-outline-danger disabled"
}

addSizeBtn.onclick = (event) => {
    event.preventDefault();
    let idOfNewDiv = Math.floor(Math.random()*101);
    while(doesIdExist(idOfNewDiv)){
        idOfNewDiv = Math.floor(Math.random()*101);
    }
    let node = document.createElement('div');
    let sizeComponent = `<div class="row my-2">
                        <div class="col my-1 mx-1 w-100">
                            <input type="text" name="size[]" id="size" class="customInput" placeholder="S" required>
                        </div>
                        <div class="col my-1 mx-1 w-100">
                            <input type="number" name="stock[]" id="stock" class="customInput" placeholder="0" min="0" required>
                        </div>
                        <div class="my-1 mx-1 col-auto">
                            <button type="button" class="fw-bolder border-danger btn btn-outline-danger" onclick="removeSize(event,`+idOfNewDiv+`)">Remove</button>
                        </div>
                    </div>`;
    node.id = idOfNewDiv;
    node.innerHTML = sizeComponent.trim();   
    sizeStockContainer.appendChild(node);
    if(sizeStockContainer.childElementCount > 1){
        let firstChild = sizeStockContainer.children[0];
        firstChild.getElementsByTagName("button")[0].classList = "fw-bolder border-danger btn btn-outline-danger"
    }
};

function removeSize(event, id) {
    event.preventDefault();
    let toRemoveNode;
    for(var i = 0; i< sizeStockContainer.childElementCount;i++)
    {
        if(sizeStockContainer.children[i].id == id){
            toRemoveNode = sizeStockContainer.children[i];
        }
    }
    sizeStockContainer.removeChild(toRemoveNode);
    if(sizeStockContainer.childElementCount == 1){
        let firstChild = sizeStockContainer.children[0];
        firstChild.getElementsByTagName("button")[0].classList = "fw-bolder border-danger btn btn-outline-danger disabled"
    }
}

function doesIdExist(id){
    for(var i = 0; i< sizeStockContainer.childElementCount;i++)
    {
        if(sizeStockContainer.children[i].id == id){
            return true;
        }
    }
    return false;
}