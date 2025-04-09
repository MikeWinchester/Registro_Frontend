import loadEnv from "./getEnv.mjs";
import { closeModal } from "./modal.mjs";
import { showToast } from "./toastMessage.mjs";

const env = await loadEnv();


function quitarTildes(texto) {
    return texto.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}

async function crearSeccion(){

    let clase = document.querySelector("#optionClass select");
    let docente = document.querySelector("#optionDoc select");
    let aula = document.querySelector('#optionAula select');
    let edificio = document.querySelector('#selectEdi');
    let btnCrear = document.querySelector('#btnCrear');
    let inputCupos = document.querySelector('#cupos');

    let jefeID = localStorage.getItem('jefeID');

    let diasSeleccionados = [];
    document.querySelectorAll(".form-check-input:checked").forEach(checkbox => {
        diasSeleccionados.push(checkbox.nextElementSibling.textContent.trim());
    });

    const dias = diasSeleccionados
    .map(dia => quitarTildes(dia.substring(0, 3)))
    .join(", ");

    let horaInicio = document.querySelector("#hora_ini").value;
    let horaFin = document.querySelector("#hora_fin").value;

    
    let cupos = document.querySelector("#cupos").value;

    const seccion = {"docente_id" : docente.value, "aula_id" : aula.value, "horario" : `${horaInicio}-${horaFin}`, "cupo_maximo" : cupos, "clase_id" : clase.value, "dias" : dias, "periodo_academico" : '2025-I', 'jefeID' : jefeID};

    try {
        
        await fetch(`${env.API_URL}/secciones/create`, {
            method: "POST", 
            headers: {
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            },
            body: JSON.stringify(seccion)
        }).then(response => response.json())
        .then(result =>{

            if (!result || result.error) {  
                showToast(result.error, 'error');
            } else {
                showToast(result.message, 'success');
            }
        }).catch(error => console.error("Error en la creacion:", error));

        vaciar();

    } catch (error) {
        console.error("Error al enviar Seccion:", error);
    } finally{
        docente.disabled = true;
        aula.disabled = true;
        edificio.disabled = true;
        inputCupos.disabled = true;
        btnCrear.disabled = true;
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

function asigModalDOM() {
    const btnSuc = document.querySelector('#confirmar');
    const btnCan = document.querySelector('#cancelar');

    const newBtnSuc = btnSuc.cloneNode(true);
    btnSuc.parentNode.replaceChild(newBtnSuc, btnSuc);

    newBtnSuc.addEventListener('click', async () => {
        await crearSeccion();
        closeModal();
    });

    btnCan.addEventListener('click', () => {
        closeModal();
    });
}


export {crearSeccion, asigModalDOM};