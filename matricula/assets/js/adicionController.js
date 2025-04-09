import loadEnv from "./getEnv.mjs";
import { showToast } from "../../../global_components/assets/js/toastMessage.mjs";

const env = await loadEnv();

async function desployContent() {
    const select = document.querySelector("#area");
    const selectAsig = document.querySelector("#asignatura");
    const loader = document.querySelector("#loader-area");
    const btn = document.querySelector('#agregar')
    const authToken = localStorage.getItem("authToken");

    if (!select) {
        console.log("Contenedor de área desconocido");
        return;
    }

    loader.style.display = "block";
    select.disabled = true;
    btn.disabled = true;

    try {
        const response = await fetch(`${env.API_URL}/departamentos/get`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization" : `Bearer ${authToken}`
            }
        });

        const jsonResponse = await response.json();

        select.innerHTML = `<option disabled selected>Seleccione un área de estudio</option>`;

        console.log(jsonResponse.error);
        jsonResponse.data.forEach(dep => {
            let option = document.createElement("option");
            option.value = dep.departamento_id;
            option.textContent = dep.nombre;
            select.appendChild(option);
        });

    } catch (error) {
        console.log(error);
        selectAsig.innerHTML = '';
    } finally{
        loader.style.display = "none";
        select.disabled = false;
    }
}


async function desployClases(carreraid) {
    const select = document.querySelector("#asignatura");
    const selectSec = document.querySelector("#seccion");
    const loader = document.querySelector("#loader-asignatura");
    const estId = localStorage.getItem('estudiante');
    const authToken = localStorage.getItem("authToken");

    if (!select || !loader) {
        console.log("Select o loader no encontrado");
        return;
    }

    loader.style.display = "block";
    select.disabled = true;

    try {
        const response = await fetch(`${env.API_URL}/clases/estu`, {
            method: "GET",
            headers: {
                "areaid": carreraid,
                "estudianteid": estId,
                "Authorization" : `Bearer ${authToken}`
            }
        });

        const jsonResponse = await response.json();

        select.innerHTML = `<option disabled selected>Seleccione una asignatura</option>`;

        console.log(jsonResponse.error);

        const options = await Promise.all(jsonResponse.data.map(async (clase) => {
            const cumple = await checkClase(clase.clase_id);
            let option = document.createElement("option");
            option.value = clase.clase_id;
            option.textContent = clase.nombre;
            if (!cumple) {
                option.disabled = true;
            }
            return option;
        }));

        options.forEach(option => {
            select.appendChild(option);
        });

    } catch (error) {
        console.log(error);
        selectSec.innerHTML = '';
    } finally {
        
        loader.style.display = "none";
        select.disabled = false;
    }
}

async function desploySeccion(claseid) {
    
    const select = document.querySelector("#seccion");
    const estu = localStorage.getItem('estudiante');
    const loader = document.querySelector("#loader-seccion");
    const authToken = localStorage.getItem("authToken");

    if (!select) {
        console.log("Contenedor de área desconocido");
        return;
    }

    loader.style.display = "block";
    select.disabled = true;

    try {

        const response = await fetch(`${env.API_URL}/secciones/get/clase/estu`, {
            method: "GET",
            headers: {
                "claseid" : claseid,
                "estudianteid" : estu,
                "Authorization" : `Bearer ${authToken}`,
                "Content-Type": "application/json"
            }
        });


        const jsonResponse = await response.json();

        console.log(jsonResponse.error);

        select.innerHTML = `<option disabled selected>Seleccione una seccion</option>`;

        const cuposEsperaPromises = jsonResponse.data.map(seccion => 
            seccion.cupo_maximo > 0 ? Promise.resolve(null) : seccionLlena(seccion.seccion_id)
        );

        const cuposEspera = await Promise.all(cuposEsperaPromises);

        jsonResponse.data.forEach((seccion, index) => {
            let option = document.createElement("option");
            option.value = seccion.seccion_id;

            if (seccion.cupo_maximo > 0) {
                option.textContent = `${seccion.nombre_completo} ${seccion.horario} ${seccion.cupo_maximo}`;
            } else {
                const cupos = cuposEspera[index]['en_espera']
                option.textContent = `Sección en espera: ${cupos}`;
            }

            select.appendChild(option);
        });

    } catch (error) {
        console.log(error);
        
    } finally {
        
        loader.style.display = "none";
        select.disabled = false;
    }
}

async function checkClase(claseid){

    const est = localStorage.getItem('estudiante');
    const authToken = localStorage.getItem("authToken");

    try {
        const response = await fetch(`${env.API_URL}/matricula/check`, {
            method: "GET",
            headers: {
                "estudianteid" : est,
                "claseid" : claseid,
                "Authorization" : `Bearer ${authToken}`,
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`                
            }
        });

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            console.log("No hay clases disponibles");
            return;
        }

        const data = jsonResponse.data;

        return data['cumple'] != 0 ? true : false;

    } catch (error) {
        console.log(error);
    }
}

async function addMateria() {
    const selectSec = document.querySelector('#seccion');
    const selectCla = document.querySelector('#asignatura');
    const estudianteid = localStorage.getItem('estudiante');
    const fecha = new Date();
    const anio = fecha.getFullYear();
    const mes = String(fecha.getMonth() + 1).padStart(2, '0'); 
    const dia = String(fecha.getDate()).padStart(2, '0');
    const btn = document.querySelector('#agregar')
    const authToken = localStorage.getItem("authToken");
    

    const fechaFormateada = `${anio}-${mes}-${dia}`;

    try {
        btn.disabled = true;
        let matricula = {"estudiante_id" : estudianteid, "seccion_id" : selectSec.value, "fechaInscripcion" : fechaFormateada, 'clase_id' : selectCla.value};
        
        vaciarSelects();
        
        await fetch(`${env.API_URL}/matricula/set`, {
            method: "POST", 
            headers: {
                "Content-Type": "application/json",
                "Authorization" : `Bearer ${authToken}`
            },
            body: JSON.stringify(matricula)
        })
        .then(response => response.json()) 
        .then(result => {  
            if(result.error){
                showToast(result.error, 'error');
            }else if(result.message == 'Conflicto de horario'){
                showToast(result.message, 'error');
            }
            else{
                showToast(result.message, 'success');
            }
        })
        .catch(error => console.error("Error en la matrícula:", error)); 
        
        

    } catch (error) {
        console.error("Error al enviar matricula:", error);
    }  
    
}

async function seccionLlena(seccionid) {
    const authToken = localStorage.getItem("authToken");
    try {
        let response = await fetch(`${env.API_URL}/esp/count`, {
            method: "GET", 
            headers: {
                "seccionid" : seccionid,
                "Content-Type": "application/json",
                "Authorization" : `Bearer ${authToken}`
            },
        });
        
        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            console.log("No hay clases disponibles");
            return;
        }

        return jsonResponse.data;
        

    } catch (error) {
        console.error("Error al enviar matricula:", error);
    }  
}

function vaciarSelects(){
    let selects = document.querySelectorAll('select');

    selects.forEach(select => {
        if (select.selectedIndex !== 0) {  
            select.selectedIndex = 0;
        }
    }); 
    
    
}

export {seccionLlena, addMateria, desploySeccion, desployClases, desployContent};

