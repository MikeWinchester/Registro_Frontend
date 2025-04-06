function showModalConfirmation(titulo, mensaje, callback) {
    const modal = document.createElement("div");
    modal.classList.add("modal");

    modal.innerHTML = `
        <div class="modal-content">
            <h2>${titulo}</h2>
            <p>${mensaje}</p>
            <button id="confirmar">Sí</button>
            <button id="cancelar">No</button>
        </div>
    `;

    document.body.appendChild(modal);

    document.getElementById("confirmar").addEventListener("click", () => {
        callback(true);  // Llamar al callback con 'true' si confirma
        document.body.removeChild(modal);  // Cerrar el modal
    });

    document.getElementById("cancelar").addEventListener("click", () => {
        callback(false);  // Llamar al callback con 'false' si cancela
        document.body.removeChild(modal);  // Cerrar el modal
    });
}

export { showModalConfirmation };