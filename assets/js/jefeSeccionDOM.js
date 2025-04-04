import { clases, docentes, centroRegional, getCarreraID, aulas, getFacId } from "./deploySeccion.js";
import { crearSeccion } from "./sendSeccion.js";

async function objDOM(){
    const clasesContainer = document.querySelector('#optionClass');
    const docentesContainer = document.querySelector('#optionDoc');
    const centroContainer = document.querySelector('#optionCentro');
    const btnCrear = document.querySelector('#btnCrear');
    const jefeID = localStorage.getItem('jefeID');
    const facId = await getFacId(jefeID)
    const carreraid = await getCarreraID(jefeID);


    await clases(clasesContainer, carreraid);
    await docentes(docentesContainer, carreraid);
    await centroRegional(centroContainer, jefeID);

    const selectCentro = document.querySelector('#selectCentro')

    selectCentro.addEventListener('change', async () => {
        await aulas(selectCentro.value, facId)
    });
    btnCrear.addEventListener('click', async () => {
        await crearSeccion();
    });
}

export {objDOM}