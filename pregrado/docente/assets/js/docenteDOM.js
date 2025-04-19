import { guardarNotas, cargarEstudiantes } from "./manejadorEstudiantes.js";


function docenteDOM(){
    const select = document.querySelector("#claseSeleccionada");
    const btnNotas = document.querySelector("#guardarNotas");

    btnNotas.addEventListener("click", async() => {
        await guardarNotas();
    });
    select.addEventListener("change", async() => {
        await cargarEstudiantes();
        btnNotas.disabled = false;
    });
        
}

export {docenteDOM}
