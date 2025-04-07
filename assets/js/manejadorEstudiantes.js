import loadEnv from "./getEnv.mjs";
import { showToast } from "./toastMessage.mjs";
const env = await loadEnv();


async function cargarEstudiantes() {
    let clase = document.getElementById("claseSeleccionada").value;
    let container = document.getElementById("estudiantesContainer");
    const loader = document.querySelector('#loader-lista');
    const select = document.querySelector('#claseSeleccionada'); 

    if(loader){
        loader.style.display = 'block';
    }
    select.disabled = true;

    if (!clase) return; 

    try {
        container.innerHTML = '';
        let response = await fetch(`${env.API_URL}/matricula/estudiantes`, {
            method : "GET",
            headers : {
                "seccionid" : clase,
                "Content-Type" : 'application/json'
            }
        });
        let result = await response.json(); 

        if (!result.data || result.data.length === 0) {
            showToast("No hay estudiantes sin calificar", "error");
            
            return;
        }

        let html = `<h5>Lista de Estudiantes</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Estudiante</th>
                                <th>Número de Cuenta</th>
                                <th>Calificación</th>
                                <th> Observacion </th>
                            </tr>
                        </thead>
                        <tbody>`;


        let obs = await obtenerObservaciones();
        result.data.forEach(est => {
            
            html += `<tr>
                        <td>${est.nombre_completo}</td>
                        <td>${est.numero_cuenta}</td>


                         <td><input id='${est.estudiante_id}' type="number" class="form-control notas" min="0" max="20" id="nota_${est.estudiante_id}"></td>

                        <td><select id='observacion'>
                        <option value ="" disabled selected >OBS</option>
                        ${obs}
                        </select></td>
                     </tr>`;
        });

        html += `</tbody></table>`;
        container.innerHTML = html;

        if(result.message){
            showToast(result.message, 'success');
        }

    } catch (error) {
        showToast("No hay estudiantes sin calificar", "error");
    } finally {
        if(loader){
            loader.style.display = 'none';
        }
        select.disabled = false;
    }
}

async function obtenerObservaciones(){
    try {
        let response = await fetch(`${env.API_URL}/observacion/get`, {
            method : "GET",
        });

        let result = await response.json(); 

        let html = '';

        result.data.forEach(obs => {
            
            html += `<option value=${obs.observacion_id}>${obs.observacion}</option>`;
        });

        return html;
    } catch (error) {
        console.error("Error al obtener estudiantes:", error);
    }
}

async function guardarNotas(){
    const btn = document.querySelector('#guardarNotas');
    const notas = document.querySelectorAll('.notas');
    const obs = document.querySelector('#observacion');

    btn.disabled = true;

    let clase = document.getElementById("claseSeleccionada").value;
    let est = {};
    let num = 0;

    notas.forEach(nota => {
        num += 1;
        if(nota.value){
           est[`Estudiante${num}`] = {'estudiante_id' : nota.id , 'seccion_id' : clase, 'nota': nota.value , 'observacion_id' : obs.value};
        }
    });

    console.log(JSON.stringify(est));
    try {
        let response = await fetch(`${env.API_URL}/notas/asignar`, {
            method: "POST", 
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(est)
        });

        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }
        
        console.log("Notas guardadas correctamente");

    } catch (error) {
        console.error("Error al enviar notas:", error);
    }  finally{
        btn.disabled = false;
    }
}

export {cargarEstudiantes, guardarNotas};



