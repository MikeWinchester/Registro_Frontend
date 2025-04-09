import loadEnv from "./getEnv.mjs";
import { showToast } from "./toastMessage.mjs";

const env = await loadEnv();
const endpointperfilestu = `${env.API_URL}/estudiante/get/cuenta`
const endpointhistestu = `${env.API_URL}/estudiante/get/hist`

async function jefehistDOM(){
    const btn = document.querySelector('#searchBtn')

    btn.addEventListener('click', async() => {
        await getPerfil();
        await getNotas();
    })
}

async function getPerfil(){
    const cuenta = document.querySelector('#inputCuenta');
    const perfil_estu = document.querySelector('#info')

    console.log("eva");
    
    fetch(endpointperfilestu, {
        method : "GET",
        headers : {
            "cuenta" : cuenta.value,
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    }).then(response => response.json())
    .then(result => {

        let perfil = 
        `<div class="col-md-6">
            <p><strong>Nombre:</strong> ${result['data'].nombre_completo}</p>
            <p><strong>Carrera:</strong> ${result['data'].nombre_carrera}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Centro Universitario:</strong> ${result['data'].nombre_centro}</p>
            <p><strong>Índice Global:</strong> ${result['data'].indice_global}</p>
            <p><strong>Índice de Período:</strong> ${result['data'].indice_periodo}</p>
        </div>`

        perfil_estu.innerHTML = perfil;
    });

}

async function getNotas(){
    const cuenta = document.querySelector('#inputCuenta');
    const tabla_estu = document.querySelector('#body-table')
    
    fetch(endpointhistestu, {
        method : "GET",
        headers : {
            "cuenta" : cuenta.value,
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    }).then(response => response.json())
    .then(result => {
        
        result['data'].forEach(clase => {
            let hist = 
            `<tr>
                <td>${clase.codigo}</td>
                <td>${clase.nombre}</td>
                <td>${clase.UV}</td>
                <td>${clase.horario.split("-")[0].replace(":","")}</td>
                <td>${clase.periodo_academico.split("-")[0]}</td>
                <td>${clase.periodo_academico.split("-")[1]}</td>
                <td>${clase.calificacion}</td>
                <td>${clase.observacion}</td>
            </tr>`;

            tabla_estu.innerHTML += hist;
        });
    });

}



export {jefehistDOM};