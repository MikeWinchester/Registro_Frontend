
import loadEnv from "./getEnv.mjs";
import {closeModal, openModal} from "./modal.mjs";
import { showToast } from "./toastMessage.mjs";

const env = await loadEnv();

const endpointdocentehorario = `${env.API_URL}/docentes/horario`
const endpointseccionupdate = `${env.API_URL}/secciones/update`
const endpointsecciondelete = `${env.API_URL}/secciones/delete`

async function desployClass() {
    
    const clasesContainer = document.querySelector('#class-container');
    clasesContainer.innerHTML = '';
    const loader = document.querySelector('#loader-secciones')

    const jefeID = localStorage.getItem('jefeID');
    const carreraid = await getCarreraID(jefeID);

    loader.style.display = 'Block';

    try {
        
        const response = await fetch(`${env.API_URL}/clases`, {
            method: "GET",
            headers: {
                "areaid": carreraid,
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            }
        });

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            return;
        }

        jsonResponse.data.forEach(clase => {
            
            const claseContainer = document.createElement('div');
            claseContainer.classList.add('accordion-item');
            claseContainer.id = `class-${clase.clase_id}`;

            const header = document.createElement('h2');
            header.classList.add('accordion-header');
            header.id = `heading${clase.clase_id}`;

            const button = document.createElement('button');
            button.classList.add('accordion-button');
            button.type = 'button';
            button.dataset.bsToggle = 'collapse';
            button.dataset.bsTarget = `#collapse${clase.clase_id}`;
            button.setAttribute('aria-expanded', 'true');
            button.setAttribute('aria-controls', `collapse${clase.clase_id}`);
            button.textContent = clase.nombre;

            header.appendChild(button);

            const collapseDiv = document.createElement('div');
            collapseDiv.id = `collapse${clase.clase_id}`;
            collapseDiv.classList.add('accordion-collapse', 'collapse', 'show');
            collapseDiv.setAttribute('aria-labelledby', `heading${clase.clase_id}`);
            collapseDiv.dataset.bsParent = "#clasesAccordion";

            const bodyDiv = document.createElement('div');
            bodyDiv.classList.add('accordion-body');

            const seccionesContainer = document.createElement('div');
            seccionesContainer.classList.add('accordion');
            seccionesContainer.id = `secciones${clase.clase_id}`;

            desploySeccion(clase.clase_id, seccionesContainer);

            bodyDiv.appendChild(seccionesContainer);
            collapseDiv.appendChild(bodyDiv);
            claseContainer.appendChild(header);
            claseContainer.appendChild(collapseDiv);

            clasesContainer.appendChild(claseContainer);
        });
    } catch (error) {
        console.log(error);
    } finally{
        loader.style.display = 'none';
    }
}

async function desploySeccion(claseId, seccionesContainer) {
    const jefeID = localStorage.getItem('jefeID');
    try {

        const response = await fetch(`${env.API_URL}/secciones/get/clase`, {
            method: "GET",
            headers: {
                "claseid": claseId,
                "jefeid" : jefeID,
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            }
        });

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            
            return;
        }
       
        jsonResponse.data.forEach(seccion => {
            
            const seccionItem = document.createElement('div');
            seccionItem.classList.add('accordion-item');
            
            const seccionHeader = document.createElement('h2');
            seccionHeader.classList.add('accordion-header');
            seccionHeader.id = `headingSeccion${seccion.seccion_id}`;
            
            const seccionButton = document.createElement('button');
            seccionButton.classList.add('accordion-button');
            seccionButton.type = 'button';
            seccionButton.dataset.bsToggle = 'collapse';
            seccionButton.dataset.bsTarget = `#collapseSeccion${seccion.seccion_id}`;
            seccionButton.setAttribute('aria-expanded', 'true');
            seccionButton.setAttribute('aria-controls', `collapseSeccion${seccion.seccion_id}`);
            seccionButton.textContent = `seccion ${seccion.horario.substr(0,5).replace(':', '')}`;

            seccionHeader.appendChild(seccionButton);

            const seccionCollapseDiv = document.createElement('div');
            seccionCollapseDiv.id = `collapseSeccion${seccion.seccion_id}`;
            seccionCollapseDiv.classList.add('accordion-collapse', 'collapse');
            seccionCollapseDiv.setAttribute('aria-labelledby', `headingSeccion${seccion.seccion_id}`);
            seccionCollapseDiv.dataset.bsParent = `#secciones${claseId}`;

            const seccionBodyDiv = document.createElement('div');
            seccionBodyDiv.classList.add('accordion-body');

            const table = document.createElement('table');
            table.classList.add('table', 'table-bordered');

            const thead = document.createElement('thead');
            const headerRow = document.createElement('tr');
            headerRow.innerHTML = `
                <th>Docente</th>
                <th>Aula</th>
                <th>Cupos</th>
                <th>Horario</th>
                <th>Acciones</th>
            `;
            thead.appendChild(headerRow);
            table.appendChild(thead);

            const tbody = document.createElement('tbody');
            
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${seccion.nombre_completo}</td>
                <td>${seccion.aula}</td>
                <td>${seccion.cupo_maximo}</td>
                <td>${seccion.horario}</td>
                <td><button id=${seccion.seccion_id} class="btn btn-info secciones">Editar</button></td>
            `;
            tbody.appendChild(row);
        

            table.appendChild(tbody);
            seccionBodyDiv.appendChild(table);
            seccionCollapseDiv.appendChild(seccionBodyDiv);
            seccionItem.appendChild(seccionHeader);
            seccionItem.appendChild(seccionCollapseDiv);

            seccionesContainer.appendChild(seccionItem);

            
            modalDOM(seccion.seccion_id);
            
            
        });
    } catch (error) {
        console.log(error);
    }
}

async function getCarreraID(jefeID){
    try {
        
        const response = await fetch(`${env.API_URL}/jefe/getDep`, {
            method: "GET",
            headers: {
                "jefeid": jefeID,
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            }
        });

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            return;
        }

        const carreraid = jsonResponse.data

        
        return carreraid.departamentoid

    } catch (error) {
        console.error("Error al obtener las clases:", error);
    }
}
    
function modalDOM(id){
    const btn = document.getElementById(`${id}`);

    btn.addEventListener('click', async () =>{
        openModal();
        await desployDocentes(btn.id);
        updateDOM(btn.id);
    }) 

}

async function desployDocentes(id){
    const selectDocentes = document.querySelector('#modal-docente');
    const jefeID = localStorage.getItem('jefeID');
    const depid = await getCarreraID(jefeID);

    await fetch(endpointdocentehorario, {
        method : "GET",
        headers : {
            "areaid" : depid,
            "seccionid" : id,
            "jefeid" : jefeID,
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`

        }
    }).then(response => response.json())
    .then(result => {
        selectDocentes.innerHTML = '<option value="" disabled selected>Seleccione un docente</option>'


        console.log(result);
        result.data.forEach(docente => {
            let option = document.createElement('option');
            option.value = docente.docente_id;
            option.innerHTML = docente.nombre_completo
            selectDocentes.appendChild(option);
        });
    });
}

async function updateDOM(seccionid){
    const btn = document.querySelector('#btn-1');
    const btnEliminar = document.querySelector("#btnEliminar");

    const newBtn = btn.cloneNode(true)
    btn.parentNode.replaceChild(newBtn, btn)
    const newbtnEliminar = btnEliminar.cloneNode(true)
    btnEliminar.parentNode.replaceChild(newbtnEliminar, btnEliminar);

    newBtn.addEventListener('click', async () => {
        await updateSeccion(seccionid);  
        closeModal();                    
    });
    newbtnEliminar.addEventListener('click', async () => {
        await deleteSeccion(seccionid)
        closeModal();
    })

}

async function updateSeccion(seccionid) {
    const selectDocentes = document.querySelector('#modal-docente').value;
    const selectCupos = document.querySelector('#editarCupos').value;

    const data = {
        'cupos': selectCupos,
        'seccion_id': seccionid,
        'docenteid': selectDocentes
    };
    
    try {
        const response = await fetch(endpointseccionupdate, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.error) {
            showToast(result.error, 'error');
        } else {
            showToast(result.message, 'success');
        }

    } catch (error) {
        showToast("Error al actualizar la sección", 'error');
        console.error("Error:", error);
    } finally{
        await desployClass();
    }
}

async function deleteSeccion(seccionid){
    const selectDocentes = document.querySelector('#modal-docente').value;
    const selectCupos = document.querySelector('#editarCupos').value;

    const data = {
        'cupos': selectCupos,
        'seccion_id': seccionid,
        'docenteid': selectDocentes,
        'Authorization': `Bearer ${localStorage.getItem('authToken')}`
    };
    
    try {
        console.log(seccionid);
        const response = await fetch(endpointsecciondelete, {
            method: "DELETE",
            headers: {
                "seccionid" : seccionid,
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            },
        });

        const result = await response.json();

        if (result.error) {
            showToast(result.error, 'error');
            closeModal();
        } else {
            showToast(result.message, 'success');
            closeModal(); 
        }

    } catch (error) {
        showToast("Error al eliminar la sección", 'error');
        console.error("Error:", error);
    }
    finally{
        await desployClass();
    }
}

export {desployClass, desploySeccion};
