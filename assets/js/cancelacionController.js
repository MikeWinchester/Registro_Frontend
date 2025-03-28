document.addEventListener("DOMContentLoaded", async function () {
    
    await createTable();

});

async function createTable() {
    const tablaAsignaciones = document.querySelector('#table-asig');
    const estudianteid = localStorage.getItem('estudiante');
    if (!tablaAsignaciones) {
        console.log('Elemento tabla no existe');
        return;
    }

    try {
        const response = await fetch("http://localhost:3806/matricula/get", {
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
            cancelButton.addEventListener('click', () => cancelMatricula(estudianteid, asignatura.seccion_id)); 
            tdActions.appendChild(cancelButton);
            row.appendChild(tdActions);

           
            tablaAsignaciones.querySelector('tbody').appendChild(row);
        });

    } catch (error) {
        console.log(error);
    }
}

async function cancelMatricula(estudianteid,seccionid) {
    
    try {
        const response = await fetch("http://localhost:3806/matricula/delete", {
            method: "DELETE",
            headers: {
                "estudianteid": estudianteid,
                "seccionid": seccionid,
                "Content-Type": "application/json"
            }
        });

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            return;
        }

        let json = {"estudiante_id" : estudianteid, "seccion_id": seccionid};

        response = await fetch("http://localhost:3806/can/estu", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body : JSON.stringify(json)
        });

        jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            return;
        }


        console.log("Seccion cancelada correctamente")

    } catch (error) {
        console.log(error);
    }
}
