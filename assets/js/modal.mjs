

// Para abrir el modal usando Bootstrap:
export function openModal() {
    const modal = new bootstrap.Modal(document.getElementById('Modal'));
    modal.show();
}

// Para cerrar el modal usando Bootstrap:
export function closeModal() {
    const modal = new bootstrap.Modal(document.getElementById('Modal'));
    modal.hide();
}

window.onclick = function(event) {
    const modal = document.getElementById("Modal");
    if (event.target === modal) {
        closeModal();
    }
}
