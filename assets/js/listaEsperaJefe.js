import loadEnv from "./getEnv.mjs";
import { getCarreraID } from "./deploySeccion.js";
const env = await loadEnv();

async function getEspera() {
    const jefeID = localStorage.getItem('jefeID'); 
    const bodyTable = document.querySelector('#body-table');
    const dep = await getCarreraID(jefeID);

    try {
        const response = await fetch(`${env.API_URL}/esp/dep`, {
            method: "GET",
            headers: {
                "departamentoid": dep
            }
        });

        const jsonResponse = await response.json();

        console.log(bodyTable)

        bodyTable.innerHTML = '';  

        jsonResponse.data.forEach(clase => {
            
            const column = `
                <tr id="${clase.estudiante_id}-${clase.seccion_id}">
                    <td>${clase.codigo}</td>
                    <td>${clase.nombre}</td>
                    <td>${clase.horario.split("-")[1].replace(":", "")}</td>
                    <td>${clase.edificio}</td>
                    <td>${clase.aula}</td>
                    <td>${clase.periodo_academico}</td>
                </tr>
            `;

            
            bodyTable.innerHTML += column;
        });


    } catch (error) {
        console.log(error);
    }
}


export {getEspera};

                        