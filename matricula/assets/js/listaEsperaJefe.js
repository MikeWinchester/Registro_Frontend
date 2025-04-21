import loadEnv from "../../../assets/js/getEnv.mjs";
import { getCarreraID } from "./deploySeccion.js";

const env = await loadEnv();
const endpointgetval = `${env.API_URL}/jefe/get/id`;

const htmlElement = document.documentElement;
const userId = htmlElement.getAttribute('user-id');


async function getEspera() {
    const val = await getVal();
    const bodyTable = document.querySelector('#body-table');
    const dep = await getCarreraID(val);
    const loader = document.querySelector('#loader-espera')

    loader.style.display = 'Block';
    try {
        const response = await fetch(`${env.API_URL}/esp/dep/${dep}`, {
            method: "GET",
            headers: {
                
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            }
        });

        const jsonResponse = await response.json();

        bodyTable.innerHTML = '';  

        jsonResponse.data.forEach(clase => {
            
            const column = `
                <tr id="${clase.estudiante_id}-${clase.seccion_id}">
                    <td>${clase.codigo}</td>
                    <td>${clase.nombre}</td>
                    <td>${clase.horario.split("-")[0].replace(":", "")}</td>
                    <td>${clase.edificio}</td>
                    <td>${clase.aula}</td>
                    <td>${clase.periodo_academico}</td>
                    <td>${clase.solicitudes}</td>
                </tr>
            `;

            
            bodyTable.innerHTML += column;
        });


    } catch (error) {
        console.log(error);
    } finally{
        loader.style.display = 'none';
    }
}

async function getVal(){
    
    const est = userId;
    
    
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

export {getEspera};

                        