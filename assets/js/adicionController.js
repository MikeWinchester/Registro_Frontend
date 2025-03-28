import loadEnv from "./getEnv.mjs";
const env = await loadEnv();

async function desployContent() {
    const select = document.querySelector("#area");

    if (!select) {
        console.log("Contenedor de área desconocido");
        return;
    }

    try {
        const response = await fetch(`${env.API_URL}/carreras`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        });

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            console.log("No hay carreras disponibles");
            return;
        }

        // Limpiar select y añadir opción por defecto
        select.innerHTML = `<option disabled selected>Seleccione un área de estudio</option>`;

        jsonResponse.data.forEach(carrera => {
            let option = document.createElement("option");
            option.value = carrera.carrera_id;
            option.textContent = carrera.nombre_carrera;
            select.appendChild(option);
        });

    } catch (error) {
        console.log(error);
    }
}


async function desployClases(carreraid) {
    
    const select = document.querySelector("#asignatura");

    if (!select) {
        console.log("Contenedor de área desconocido");
        return;
    }

    try {
        const response = await fetch(`${env.API_URL}/clases`, {
            method: "GET",
            headers: {
                "carreraid" : carreraid,
                "Content-Type": "application/json"
            }
        });

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            console.log("No hay clases disponibles");
            return;
        }

        select.innerHTML = `<option disabled selected>Seleccione una asignatura</option>`;

        jsonResponse.data.forEach(clase => {
            let option = document.createElement("option");
            option.value = clase.clase_id;
            option.textContent = clase.nombre;
            select.appendChild(option);
        });

    } catch (error) {
        console.log(error);
    }
}


async function desploySeccion(claseid) {
    
    const select = document.querySelector("#seccion");

    if (!select) {
        console.log("Contenedor de área desconocido");
        return;
    }

    try {
        const response = await fetch(`${env.API_URL}/secciones/get/clase`, {
            method: "GET",
            headers: {
                "claseid" : claseid,
                "Content-Type": "application/json"
            }
        });

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            console.log("No hay clases disponibles");
            return;
        }

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
                const cupos = cuposEspera[index][0]['en_espera']
                option.textContent = `Sección en espera: ${cupos}`;
            }

            select.appendChild(option);
        });

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

    const fechaFormateada = `${anio}-${mes}-${dia}`;

    try {
        let matricula = {"estudiante_id" : estudianteid, "seccion_id" : selectSec.value, "fechaInscripcion" : fechaFormateada, 'clase_id' : selectCla.value};
        
        let response = await fetch(`${env.API_URL}/matricula/set`, {
            method: "POST", 
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(matricula)
        });
        
        console.log(response);

    } catch (error) {
        console.error("Error al enviar matricula:", error);
    }  
    
}

async function seccionLlena(seccionid) {
    try {
        let response = await fetch(`${env.API_URL}/esp/count`, {
            method: "GET", 
            headers: {
                "seccionid" : seccionid,
                "Content-Type": "application/json"
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

export {seccionLlena, addMateria, desploySeccion, desployClases, desployContent};

