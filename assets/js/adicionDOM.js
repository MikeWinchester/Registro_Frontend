import { desployClases, desploySeccion, addMateria, getVal } from "./adicionController.js";

async function domObj(){
    const selectArea = document.querySelector('#area');
    const selectAsig = document.querySelector('#asignatura');
    const selectSec = document.querySelector('#seccion');
    const btnAdd = document.querySelector('#agregar');
    const val = await getVal();

    selectArea.addEventListener('change', async () => {
        await desployClases(selectArea.value, val);
    });
    selectAsig.addEventListener('change', async () => {
        await desploySeccion(selectAsig.value, val);
    });
    btnAdd.addEventListener('click', async () => {
        await addMateria(val);
    });
    selectSec.addEventListener('change', async() => {
        btnAdd.disabled = false;
    });
}

export {domObj};
