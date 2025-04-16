import loadEnv from "./getEnv.mjs";
import { showToast } from "./toastMessage.mjs";
const env = await loadEnv();
const endpointgetval = `${env.API_URL}/estudiante/get/id`;

async function createTable() {
    const estudianteid = await getVal();
    const tablaAsignaciones = document.querySelector('#table-asig');
    const loader = document.querySelector('#loader-can')

    if (!tablaAsignaciones) {
        console.log('Elemento tabla no existe');
        return;
    }

    loader.style.display = "block";

    try {
        const response = await fetch(`${env.API_URL}/matricula/get/${estudianteid}`, {
            method: "GET",
            headers: {
                
                "Content-Type": "application/json",
                "Authorization" : `Bearer ${localStorage.getItem("authToken")}`
            }
        });

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            return;
        }

        tablaAsignaciones.querySelector('tbody').innerHTML = '';

        jsonResponse.data.forEach((asignatura, index) => {
            const row = document.createElement('tr');

            
            const tdIndex = document.createElement('td');
            tdIndex.textContent = index + 1; 
            row.appendChild(tdIndex);

            
            const tdAsignatura = document.createElement('td');
            tdAsignatura.textContent = asignatura.nombre; 
            const tdHorario = document.createElement('td');
            tdHorario.textContent = asignatura.horario; 
            const tdAula = document.createElement('td');
            tdAula.textContent = asignatura.aula; 
            row.appendChild(tdAsignatura);
            row.appendChild(tdHorario);
            row.appendChild(tdAula);

            
            const tdActions = document.createElement('td');
            const cancelButton = document.createElement('button');
            cancelButton.classList.add('btn', 'btn-cancel');
            cancelButton.textContent = 'Cancelar';
            cancelButton.id = 'cancel';

            cancelButton.addEventListener('click', (event) => cancelMatricula(estudianteid, asignatura.seccion_id, event.target));

            tdActions.appendChild(cancelButton);
            row.appendChild(tdActions);


           
            tablaAsignaciones.querySelector('tbody').appendChild(row);
        });

    } catch (error) {
        console.log(error);
    } finally {
        
        loader.style.display = "none";
        
    }
}


async function cancelMatricula(estudianteid, seccionid, buttonElement) {
    
    const loader = document.querySelector("#loader-can");
    const btnCan  = document.querySelector("#cancel")

    loader.style.display = "block";
    btnCan.disabled = true;

    try {

        const response = await fetch(`${env.API_URL}/matricula/delete/est/${estudianteid}/sec/${seccionid}`, {
            method: "DELETE",
            headers: {
                
                "Content-Type": "application/json",
                "Authorization" : `Bearer ${localStorage.getItem("authToken")}`
            }
        });

        if (!response.ok) {
            console.log("Error al eliminar la matrícula");
            return;
        }

        const rowToDelete = buttonElement.closest("tr");
        if (rowToDelete) {
            rowToDelete.remove();
        }

        let json = { "estudiante_id": estudianteid, "seccion_id": seccionid };
        const response2 = await fetch(`${env.API_URL}/can/estu`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(json)
        });

        if(response2){
            showToast('Se ha canlecado la seccion', 'success')
        }else{
            showToast('no se ha podido cancelar la seccion')
        }

    } catch (error) {
        console.error("Error al cancelar la matrícula:", error);
    } finally {
        
        loader.style.display = "none";
        btnCan.disabled = false;
    }
}

async function getVal(){
    
    const est = localStorage.getItem('estudiante');
    
    const res = await fetch(`${endpointgetval}/${est}`, {
        method: "GET",
        headers: {
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    });

    if (!res.ok) {
        throw new Error("Error al obtener el valor");
    }

    const result = await res.json();
    return result.data.id;

    
}


export {cancelMatricula, createTable};;


