import loadEnv from "./getEnv.mjs";
import { showToast } from "./toastMessage.mjs";
const env = await loadEnv();

async function crearSeccion(){
    let clase = document.querySelector("#optionClass select").value;
    let docente = document.querySelector("#optionDoc select").value;
    let aula = document.querySelector('#optionAula select').value

    let diasSeleccionados = [];
    document.querySelectorAll(".form-check-input:checked").forEach(checkbox => {
        diasSeleccionados.push(checkbox.nextElementSibling.textContent.trim());
    });

    const dias = diasSeleccionados.map(dia => dia.substring(0, 3)).join(", ");

    let horaInicio = document.querySelector("#h_ini").value;
    let horaFin = document.querySelector("#h_final").value;

    
    let cupos = document.querySelector("#cupos").value;

    const seccion = {"docente_id" : docente, "aula_id" : aula, "horario" : `${horaInicio}-${horaFin}`, "cupo_maximo" : cupos, "clase_id" : clase, "dias" : dias, "periodo_academico" : '2025-I'};

    try {
        await fetch(`${env.API_URL}/secciones/create`, {
            method: "POST", 
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(seccion)
        }).then(response => response.json())
        .then(result =>{
            let p_suc = document.querySelector("#mensaje");

            console.log(result);
            if (!result || result.error) {  
                showToast(result.error, 'error');
            } else {
                showToast(result.message, 'success');
            }
        }).catch(error => console.error("Error en la creacion:", error));

        vaciar();

    } catch (error) {
        console.error("Error al enviar Seccion:", error);
    }  
    
}

function vaciar(){
    
    document.querySelectorAll("select").forEach(select => {
        select.selectedIndex = 0;
    });

    
    document.querySelectorAll(".form-check-input").forEach(checkbox => {
        checkbox.checked = false;
    });

    
    document.querySelectorAll("input[type='time'], input[type='number']").forEach(input => {
        input.value = "";
    });
    
}

export {crearSeccion};