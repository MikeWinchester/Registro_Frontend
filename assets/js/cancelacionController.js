import loadEnv from "./getEnv.mjs";
const env = await loadEnv();

async function createTable() {
    const tablaAsignaciones = document.querySelector('#table-asig');
    const estudianteid = localStorage.getItem('estudiante');
    if (!tablaAsignaciones) {
        console.log('Elemento tabla no existe');
        return;
    }

    try {
        const response = await fetch(`${env.API_URL}/matricula/get`, {
            method: "GET",
            headers: {
                "estudianteid": estudianteid,
                "Content-Type": "application/json"
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

            cancelButton.addEventListener('click', (event) => cancelMatricula(estudianteid, asignatura.seccion_id, event.target));

            tdActions.appendChild(cancelButton);
            row.appendChild(tdActions);


           
            tablaAsignaciones.querySelector('tbody').appendChild(row);
        });

    } catch (error) {
        console.log(error);
    }
}

//Cancelar matricula (error: no se elimina la fila en el front)
async function cancelMatricula(estudianteid, seccionid, buttonElement) {
    try {
        const response = await fetch(`${env.API_URL}/matricula/delete`, {
            method: "DELETE",
            headers: {
                "estudianteid": estudianteid,
                "seccionid": seccionid,
                "Content-Type": "application/json"
            }
        });

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
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
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(json)
        });

        const jsonResponse2 = await response2.json();

        if (!jsonResponse2.data || jsonResponse2.data.length === 0) {
            console.log("Error en la segunda petición");
            return;
        }

        console.log("Sección cancelada correctamente y eliminada de la tabla");

    } catch (error) {
        console.log("Error al cancelar la matrícula:", error);
    }
}

export {cancelMatricula, createTable};

    
await createTable();


