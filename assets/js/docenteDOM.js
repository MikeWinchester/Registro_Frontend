import { guardarNotas, cargarEstudiantes } from "./manejadorEstudiantes.js";


const select = document.getElementById("claseSeleccionada");
const btnNotas = document.querySelector("#guardarNotas");

btnNotas.addEventListener("click", async() => {
    await guardarNotas();
});
select.addEventListener("change", async() => {
    await cargarEstudiantes();
});
    
