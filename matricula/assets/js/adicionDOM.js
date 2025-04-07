import { desployClases, desploySeccion, addMateria } from "./adicionController.js";

function domObj(){
    const selectArea = document.querySelector('#area');
    const selectAsig = document.querySelector('#asignatura');
    const selectSec = document.querySelector('#seccion');
    const btnAdd = document.querySelector('#agregar');

    selectArea.addEventListener('change', async () => {
        await desployClases(selectArea.value);
    });
    selectAsig.addEventListener('change', async () => {
        await desploySeccion(selectAsig.value);
    });
    btnAdd.addEventListener('click', async () => {
        await addMateria();
    });
    selectSec.addEventListener('change', async() => {
        btnAdd.disabled = false;
    });
}

export {domObj};
