import loadEnv from "./getEnv.mjs";
import { showToast } from "./toastMessage.mjs";

const env = await loadEnv();
const endpointperfilestu = `${env.API_URL}/estudiante/get/cuenta`

async function jefehistDOM(){
    const btn = document.querySelector('#searchBtn')

    btn.addEventListener('click', async() => {
        await getPerfil();
    })
}

async function getPerfil(){
    const cuenta = document.querySelector('#inputCuenta');
    const perfil = document.querySelector('#info')
    
    fetch(endpointperfilestu, {
        method : "GET",
        headers : {
            "cuenta" : cuenta.value
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
            <p><strong>Índice Global:</strong> 85.4</p>
            <p><strong>Índice de Período:</strong> 87.2</p>
        </div>`
    });

}

function calcularIndice(){
    
}


export {jefehistDOM};