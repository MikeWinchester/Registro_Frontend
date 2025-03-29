import { clases, docentes, centroRegional, getCarreraID, aulas } from "./deploySeccion.js";
import { crearSeccion } from "./sendSeccion.js";

const clasesContainer = document.querySelector('#optionClass');
const docentesContainer = document.querySelector('#optionDoc');
const centroContainer = document.querySelector('#optionCentro');
const btnCrear = document.querySelector('#btnCrear');
const carreraid = await getCarreraID();

await clases(clasesContainer, carreraid);
await docentes(docentesContainer, carreraid);
await centroRegional(centroContainer);

const selectCentro = document.querySelector('#selectCentro')

selectCentro.addEventListener('change', async () => {
    await aulas(selectCentro.value)
});
btnCrear.addEventListener('click', async () => {
    await crearSeccion();
});