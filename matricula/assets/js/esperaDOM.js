import { eliminarSeccion } from "../../../assets/js/desployEspera.js";

document.querySelector("#data-table").addEventListener("click", function (event) {
    if (event.target.classList.contains("btn-eliminar")) {
        const seccionId = event.target.dataset.id;
        eliminarSeccion(seccionId);
    }
});