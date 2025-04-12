import { showToast } from "../../../global_components/assets/js/toastMessage.mjs";
import { guardarFechasMat, guardarFechasNotas, guardarFechasAddCan } from "./admin.js";

const selectFechaMatIni = document.querySelector('#fechaMatriculaInicio');
const selectFechaMatFin = document.querySelector('#fechaMatriculaFin');
const selectFechaNotasIni = document.querySelector('#registroNotasInicio');
const selectFechaNotasFin = document.querySelector('#registroNotasFin');
const selectFechaAdiCanIni = document.querySelector('#periodoAdicionInicio');
const selectFechaAdiCanFin = document.querySelector('#periodoAdicionFin');
const btnSendDates = document.querySelector('#save');

btnSendDates.addEventListener('click', async() => {

    btnSendDates.disabled = true;
    
    
    try {
        const mat = await guardarFechasMat(selectFechaMatIni.value, selectFechaMatFin.value);
        const not = await guardarFechasNotas(selectFechaNotasIni.value, selectFechaNotasFin.value);
        const add = await guardarFechasAddCan(selectFechaAdiCanIni.value, selectFechaAdiCanFin.value);
        
        if(mat && not && add) {
            showToast("Fechas guardadas correctamente", 'success');
        }
    } catch (error) {
        showToast("Error al guardar fechas", 'error');
    } finally {
        // Volver a habilitar el botón
        btnSendDates.disabled = false;
    }
});