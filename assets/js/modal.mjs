
function openModal() {
    const modal = new bootstrap.Modal(document.getElementById('Modal'));
    modal.show();
}

function closeModal() {
    const modal = new bootstrap.Modal(document.getElementById('Modal'));
    modal.hide();
}

window.onclick = function(event) {
    const modal = document.getElementById("Modal");
    if (event.target === modal) {
        closeModal();
    }
}

export {openModal, closeModal}
