
function openModal() {
    const modal = new bootstrap.Modal(document.getElementById('Modal'));
    modal.show();
}

function closeModal() {
    const modalElement = document.getElementById('Modal');
    const modal = bootstrap.Modal.getInstance(modalElement);

    if (modal) {
        modal.hide();
    } else {
        bootstrap.Modal.getOrCreateInstance(modalElement).hide();
    }
}


window.onclick = function(event) {
    const modal = document.getElementById("Modal");
    if (event.target === modal) {
        closeModal();
    }
}

export {openModal, closeModal}
