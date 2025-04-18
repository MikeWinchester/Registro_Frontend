import loadEnv from "../../../assets/js/getEnv.mjs";
import { showToast } from "../../../assets/js/toastMessage.mjs";
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

async function desployTable(){
    const estudianteid = await getVal();
    const tableContainer = document.querySelector('#data-can');
    const loader = document.querySelector('#loader-can')
    let table = ''

    loader.style.display = 'Block'
    try {
        
        const response = await fetch(`${env.API_URL}/can/estu/${estudianteid}`, {
            method : "GET",
            headers : {
                
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            }
        })

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            return;
        }

        jsonResponse.data.forEach(seccion => {
            const hora = seccion.horario
            const h_ini = hora.split("-")[0];

            table +=`
                    <tr>
                        <td>${seccion.codigo}</td>
                        <td>${seccion.nombre}</td>
                        <td>${h_ini.replace(":", "")}</td>
                        <td>${hora}</td>
                        <td>${seccion.dias}</td>
                        <td>${seccion.edificio}</td>
                        <td>${seccion.aula}</td>
                    </tr>`
        });

        tableContainer.innerHTML = table;

    } catch (error) {
        console.error(error);
    } finally {
        
        loader.style.display = "none";
     
    }
}

async function desployTableEsp() {
    const estudianteid = await getVal();
    const tableContainer = document.querySelector("#data-table");
    const loader = document.querySelector('#loader-esp')

    try {
        loader.style.display = "block";

        const response = await fetch(`${env.API_URL}/esp/estu/${estudianteid}`, {
            method: "GET",
            headers: {
                
                "Content-Type": "application/json",
                "Authorization" : `Bearer ${localStorage.getItem("authToken")}`
            }
        });

        const jsonResponse = await response.json();
        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            console.log("No hay clases disponibles");
            tableContainer.innerHTML = "<tr><td colspan='9'>No hay clases disponibles</td></tr>";
            return;
        }

        const fragment = document.createDocumentFragment();

        jsonResponse.data.forEach(seccion => {
            const row = document.createElement("tr");
            row.id = `seccion-${seccion.seccion_id}`;

            const [h_ini, h_fin] = seccion.horario.split("-");

            row.innerHTML = `
                <td>${seccion.codigo}</td>
                <td>${seccion.nombre}</td>
                <td>${h_ini.replace(":", "")}</td>
                <td>${h_ini}</td>
                <td>${h_fin}</td>
                <td>${seccion.dias}</td>
                <td>${seccion.edificio}</td>
                <td>${seccion.aula}</td>
                <td><button class="btn btn-info btn-eliminar" data-id="${seccion.seccion_id}">Eliminar</button></td>
            `;

            fragment.appendChild(row);
        });

        tableContainer.innerHTML = ""; 
        tableContainer.appendChild(fragment);

    } catch (error) {
        console.error(error);
    } finally {
        DOMEvent()
        loader.style.display = "none";
        
    }
}

async function eliminarSeccion(seccionId) {
    const estudianteid = await getVal();

    console.log(estudianteid + " " + seccionId);

    try {
        const response = await fetch(`${env.API_URL}/esp/eliminar/sec/${seccionId}/est/${estudianteid}`, {
            method: "DELETE",
            headers: { 
                
                "Content-Type": "application/json",
                "Authorization" : `Bearer ${localStorage.getItem("authToken")}`
            }
        });

        document.querySelector(`#seccion-${seccionId}`)?.remove();
        console.log(`Sección ${seccionId} eliminada correctamente`);
        
    } catch (error) {
        console.error("Error al eliminar:", error);
    }
}

function DOMEvent(){
    const btns = document.querySelectorAll('.btn-eliminar');
 
    btns.forEach(btn => {
     btn.addEventListener("click", async () => {
         const id = btn.getAttribute("data-id");
         await eliminarSeccion(id);
     });
     });

     
}

async function fetchData(url, headers = {}) {
    try {
        const response = await fetch(url, { method: "GET", headers });
        if (!response.ok) throw new Error(`Error ${response.status}: ${response.statusText}`);
        return await response.json();
    } catch (error) {
        console.error("Fetch error:", error);
        return null; 
    }
}


async function forma03() {
    const est = await getVal();
    const divPerMain = document.querySelector("#divPersonal");

    const jsonResponse = await fetchData(`${env.API_URL}/estudiante/get/${est}`, {  'Authorization': `Bearer ${localStorage.getItem('authToken')}`});

    if (jsonResponse) {
        const { nombre_completo, nombre_carrera, nombre_centro } = jsonResponse.data;

        divPerMain.innerHTML = `
            <div class="col-md-6">
                <p><strong>Nombre:</strong> ${nombre_completo}</p>
                <p><strong>Carrera:</strong> ${nombre_carrera}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Centro Universitario:</strong> ${nombre_centro}</p>
            </div>
        `;
    }

    clasesMat(est);
}


async function clasesMat(est) {
    const tableMat = document.querySelector("#tableMain");

    const jsonResponse = await fetchData(`${env.API_URL}/matricula/get/${est}`, { 'Authorization': `Bearer ${localStorage.getItem('authToken')}`});

    if (jsonResponse && jsonResponse.data.length > 0) {
        tableMat.innerHTML = jsonResponse.data.map(({ codigo, nombre, horario, dias, edificio, aula, UV, periodo_academico }) => {
            const [horaInicio, horaFin] = horario.split("-").map(h => h.trim());
            return `
                <tr>
                    <td>${codigo}</td>
                    <td>${nombre}</td>
                    <td>${horaInicio.replace(":", "")}</td>
                    <td>${horaInicio}</td>
                    <td>${horaFin}</td>
                    <td>${dias}</td>
                    <td>${edificio}</td>
                    <td>${aula}</td>
                    <td>${UV}</td>
                    <td>${periodo_academico.split("-")[1]}</td>
                </tr>
            `;
        }).join(""); 
    }
}




export {cancelMatricula, createTable, desployTable, desployTableEsp, eliminarSeccion, forma03};