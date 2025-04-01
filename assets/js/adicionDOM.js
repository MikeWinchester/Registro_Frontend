import { desployClases, desploySeccion, addMateria } from "./adicionController.js";

function domObj(){
    const selectArea = document.querySelector('#area');
    const selectAsig = document.querySelector('#asignatura');
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
}

export {domObj};
