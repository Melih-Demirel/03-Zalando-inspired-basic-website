 function popModal(modalElement, title, text, buttons) {
    modalElement.querySelector(".modal-title").innerHTML = title;
    modalElement.querySelector(".modal-body").innerHTML = text;
    modalElement.querySelector(".modal-footer").innerHTML = '';
    buttons.forEach(button => {
        let elem = document.createElement("a");
        elem.innerHTML = button.text;
        elem.classList.add("btn");
        elem.classList.add(`btn-outline-primary`);
        if (button.ref == null)
            elem.setAttribute("data-bs-dismiss", "modal");
        else
            elem.href = button.ref;
        modalElement.querySelector(".modal-footer").appendChild(elem);
    });
    bootstrap.Modal.getOrCreateInstance(modalElement).show();
}