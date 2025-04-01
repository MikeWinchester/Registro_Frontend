import loadEnv from "./getEnv.mjs";
const env = await loadEnv();

async function forma03(){

    const est = localStorage.getItem('estudiante');
    const divPerMain = document.querySelector('#divPersonal');

    try {

        const response = await fetch(`${env.API_URL}/estudiante/get`,{
            method : "GET",
            headers : {
                "estudianteid" : est
            }
        });

        const jsonResponse = await response.json();
        const data = jsonResponse.data[0];

        const datosPersonales = 
        `<div class="col-md-6">
            <p><strong>Nombre:</strong> ${data.nombre_completo}</p>
            <p><strong>Carrera:</strong> ${data.nombre_carrera} </p>
        </div>
        
        <div class="col-md-6">
            <p><strong>Centro Universitario:</strong> ${data.nombre_centro}</p>
            
        </div>`

        divPerMain.innerHTML = datosPersonales;

        clasesMat(est);

    } catch (error) {
        console.log(error)
    }

}

async function clasesMat(est) {

    const tableMat = document.querySelector('#tableMain')
    

    try {

        const response = await fetch(`${env.API_URL}/matricula/get`,{
            method : "GET",
            headers : {
                "estudianteid" : est
            }
        });

        const jsonResponse = await response.json();
        let divMatriculado = '';

        console.log(jsonResponse.data);

        jsonResponse.data.forEach(data => {
            divMatriculado += 
            `<tr>
                <td>${data.codigo}</td>
                <td>${data.nombre}</td>
                <td>${data.horario.substr(0,5).replace(":", "")}</td>
                <td>${data.horario.split("-")[0]}</td>
                <td>${data.horario.split("-")[1]}</td>
                <td>${data.dias}</td>
                <td>${data.edificio}</td>
                <td>${data.aula}</td>
                <td>${data.UV}</td>
                <td>${data.periodo_academico.split("-")[1]}</td>
            </tr>`
        });

        tableMat.innerHTML = divMatriculado;

    } catch (error) {
        console.log(error)
    }
} 

export {forma03};