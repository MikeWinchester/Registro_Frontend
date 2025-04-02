import loadEnv from "./getEnv.mjs";
const env = await loadEnv();

async function desployContent() {
    const select = document.querySelector("#area");

    if (!select) {
        console.log("Contenedor de área desconocido");
        return;
    }

    try {
        const response = await fetch(`${env.API_URL}/departamentos/get`, {
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

        jsonResponse.data.forEach(dep => {
            let option = document.createElement("option");
            option.value = dep.departamento_id;
            option.textContent = dep.nombre;
            select.appendChild(option);
        });

    } catch (error) {
        console.log(error);
    }
}


async function desployClases(carreraid) {
    const select = document.querySelector("#asignatura");
    const estId = localStorage.getItem('estudiante');
    
    if (!select) {
        console.log("Contenedor de área desconocido");
        return;
    }

    try {
        const response = await fetch(`${env.API_URL}/clases/estu`, {
            method: "GET",
            headers: {
                "areaid": carreraid,
                "estudianteid": estId
            }
        });

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            console.log("No hay clases disponibles");
            return;
        }

        select.innerHTML = `<option disabled selected>Seleccione una asignatura</option>`;

        const options = await Promise.all(jsonResponse.data.map(async (clase) => {
            const cumple = await checkClase(clase.clase_id); // Esperamos el resultado de checkClase
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

async function checkClase(claseid){

    const est = localStorage.getItem('estudiante');

    try {
        const response = await fetch(`${env.API_URL}/matricula/check`, {
            method: "GET",
            headers: {
                "estudianteid" : est,
                "claseid" : claseid,
                "Content-Type": "application/json"
            }
        });

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            console.log("No hay clases disponibles");
            return;
        }

        const data = jsonResponse.data[0];

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

    const fechaFormateada = `${anio}-${mes}-${dia}`;

    try {
        let matricula = {"estudiante_id" : estudianteid, "seccion_id" : selectSec.value, "fechaInscripcion" : fechaFormateada, 'clase_id' : selectCla.value};
        const p_suc = document.querySelector('#sucess')
        vaciarSelects();
        
        await fetch(`${env.API_URL}/matricula/set`, {
            method: "POST", 
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(matricula)
        })
        .then(response => response.json()) 
        .then(result => {  
            let p_suc = document.querySelector("#mensaje");  
        
            if (!result || result.error) {  
                p_suc.innerHTML = "No se ha podido matricular";
            } else {
                p_suc.innerHTML = "Se ha matriculado con éxito";
            }
        })
        .catch(error => console.error("Error en la matrícula:", error)); 
        
        

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

function vaciarSelects(){
    let selects = document.querySelectorAll('select');

    selects.forEach(select => {
        if (select.selectedIndex !== 0) {  
            select.selectedIndex = 0;
        }
    });    
    
}

export {seccionLlena, addMateria, desploySeccion, desployClases, desployContent};

