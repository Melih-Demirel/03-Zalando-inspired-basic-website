const pickUpBtn = document.getElementById("pickUpBtn");
const pickUp = document.getElementById("pickUp");
const deliveryBtn = document.getElementById("deliveryBtn");
const delivery = document.getElementById("delivery");
const confirmButton = document.getElementById("continueBtn");

function toggle(div1, div2) {
    if (!div1.classList.contains("d-none"))
        return;
    div1.classList.remove('d-none');
    div2.classList.add('d-none');
    for (var node of div1.getElementsByTagName("*")){
        node.disabled = false;
    }
    for (var node of div2.getElementsByTagName("*")) {
        node.disabled = true;
    }
}
deliveryBtn.addEventListener('click', () => {
    toggle(delivery, pickUp);
 });
pickUpBtn.addEventListener('click', () => {
   toggle(pickUp, delivery);
});


