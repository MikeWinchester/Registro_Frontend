import { clases, docentes, centroRegional, getCarreraID, aulas, getFacId, getHorario } from "./deploySeccion.js";
import { asigModalDOM } from "./sendSeccion.js";
import { openModal } from "./modal.mjs";

async function objDOM(){
    const clasesContainer = document.querySelector('#optionClass');
    const docentesContainer = document.querySelector('#optionDoc');
    const centroContainer = document.querySelector('#optionCentro');
    const btnCrear = document.querySelector('#btnCrear');
    const jefeID = localStorage.getItem('jefeID');
    const facId = await getFacId(jefeID)
    const carreraid = await getCarreraID(jefeID);
    const checkboxes = document.querySelectorAll(".form-check-input");
    
    await clases(clasesContainer, carreraid);
    await docentes(docentesContainer, carreraid);
    await centroRegional(centroContainer, jefeID);

    const selectCentro = document.querySelector('#selectCentro')

    selectCentro.addEventListener('change', async () => {
        await aulas(selectCentro.value, facId)
    });
    btnCrear.addEventListener('click', () => {
        openModal();
        asigModalDOM();
    });
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
          
          const selectedDays = Array.from(document.querySelectorAll('.form-check-input:checked'))
            .map(cb => cb.nextElementSibling.textContent.trim().substr(0,3).normalize("NFD").replace(/[\u0300-\u036f]/g, ""));
          
          
          if(selectedDays.length > 0) {
          
            getHorario(selectedDays.join(','))

          }
        });
    });


}

export {objDOM}