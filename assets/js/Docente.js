import loadEnv from "./getEnv.mjs";
const env = await loadEnv();

async function cargarClases(docenteID) {
    try {
        if (!docenteID) {
            console.log("No se encontró el ID del docente");
            return;
        }

        const response = await fetch(`${env.API_URL}/clases/doc`, {
            method: "GET",
            headers: {
                'docenteid': docenteID,
                "Content-Type": "application/json",
            },
        });

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();
        const data = jsonResponse.data;
        const container = document.querySelector("#clasesAccordion");

        if (!container) return;

        if (!data || data.length === 0) {
            container.innerHTML = `<p class="text-warning text-center">No hay clases asignadas.</p>`;
            return;
        }

        let periodos = {};
        data.forEach(clase => {
            if (!periodos[clase.periodo_academico]) {
                periodos[clase.periodo_academico] = [];
            }
            periodos[clase.periodo_academico].push(clase);
        });

        let html = "";

        for (const [periodo, clases] of Object.entries(periodos)) {
            let periodoId = `periodo${periodo.replace(/\s/g, '')}`;
            html += `
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading${periodoId}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapse${periodoId}" aria-expanded="true">
                            ${periodo}
                        </button>
                    </h2>
                    <div id="collapse${periodoId}" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <div class="accordion" id="secciones${periodoId}">
            `;

            for (const clase of clases) {
                let claseId = `clase${clase.clase_id}`;
                let seccionesHTML = await cargarSecciones(clase.clase_id);

                html += `
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading${claseId}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse${claseId}" aria-expanded="false">
                                ${clase.nombre} - ${clase.codigo}
                            </button>
                        </h2>
                        <div id="collapse${claseId}" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Aula</th>
                                            <th>Cupos</th>
                                            <th>Horario</th>
                                            <th>Lista de Estudiantes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${seccionesHTML}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                `;
            }

            html += `
                        </div> 
                    </div> 
                </div>
            `;
        }

        container.innerHTML = html;
    } catch (error) {
        console.error("Error al obtener las clases:", error);
    }
}

async function cargarSecciones(claseId) {
    try {
        if (!claseId) {
            console.log("No se encontró el ID de la clase");
            return "";
        }

        const response = await fetch(`${env.API_URL}/secciones/get/clase`, {
            method: "GET",
            headers: {
                "claseid": claseId,
                "Content-Type": "application/json",
            },
        });

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            return `<tr><td colspan="4" class="text-center text-warning">No hay secciones disponibles.</td></tr>`;
        }

        return jsonResponse.data.map(seccion => `
            <tr>
                <td>${seccion.aula}</td>
                <td>${seccion.cupo_maximo}</td>
                <td>${seccion.horario}</td>
                <td>
                    <a href="/views/components/Lista_estudiantes.php?Id=${seccion.seccion_id}" 
                       class="btn btn-info btn-sm">
                        Ver Lista
                    </a>
                </td>
            </tr>
        `).join("");
    } catch (error) {
        console.error("Error al obtener las secciones:", error);
        return `<tr><td colspan="4" class="text-center text-danger">Error al cargar las secciones.</td></tr>`;
    }
}

async function crearClaseConSecciones(docenteID, claseData, seccionesData) {
    try {
        if (!docenteID) {
            console.error("No se encontró el ID del docente");
            return;
        }

        // Crear la clase
        const claseResponse = await fetch(`${env.API_URL}/clases/create`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ ...claseData, docente_id: docenteID }),
        });

        if (!claseResponse.ok) throw new Error("Error al crear la clase");

        const claseJson = await claseResponse.json();
        const nuevaClaseID = claseJson.data.clase_id; 

        
        for (const seccion of seccionesData) {
            await fetch(`${env.API_URL}/secciones/create`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ ...seccion, clase_id: nuevaClaseID }),
            });
        }

        console.log("Clase y secciones creadas exitosamente");
        cargarClases(docenteID); 
    } catch (error) {
        console.error("Error al crear la clase y sus secciones:", error);
    }
}


async function cargarPerfil(docenteID) {
    try {

        if(!docenteID){
            console.log('No se encontro el ID del docente');
            return;
        }

        
        const response = await fetch(`${env.API_URL}/docentes/get`, {
            method : "GET",
            headers : {
                "docenteid" : docenteID,
                "Content-Type" : 'application/json'
            }
        }
        );

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();

        const mainContent = document.querySelector("#main-content");
        if (!mainContent) {
            return;
        }

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            mainContent.innerHTML = `<div class="alert alert-warning text-center">No se encontró información del perfil.</div>`;
            return;
        }

        const perfil = jsonResponse.data[0];
        console.perfil;

        let perfilHTML = `
            <div class="card">
                <div class="card-body text-center">
                    <img src="/Registro_Frontend/assets/images/perfil.jpg" alt="Foto de perfil" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
                    <h4 class="card-title">${perfil.nombre_completo}</h4>
                    <p class="card-text">📧 Correo: ${perfil.correo}</p>
                    <p class="card-text">🔢 Número de Cuenta: ${perfil.numero_cuenta}</p>
                    <p class="card-text">🔢 Centro: ${perfil.nombre_centro}</p>
                    <p class="card-text">🏫 Departamento: ${perfil.nombre_carrera}</p>
                    <p class="card-text">📅 Fecha de ingreso: 10/08/2015</p>
                    <button class="btn btn-primary mt-2">Editar Perfil</button>
                </div>
                <div class="card-footer">
                    <a href="#" class="text-muted">Ver más detalles</a>
                </div>
            </div>
        `;

        // Reemplazar el contenido del `#main-content`

        mainContent.innerHTML = perfilHTML;
    } catch (error) {
        console.error("Error al obtener el perfil:", error);
    }
}

async function listarClases(docenteID) {
    
    try {

        if(!docenteID){
            console.log('No se encontro el ID del docente');
            return;
        }

        const response = await fetch(`${env.API_URL}/secciones/docente`, {
            method : "GET",
            headers : {
                "docenteid" : docenteID,
                "Content-Type" : 'application/json'
            }
        });

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();
        

        const mainContent = document.querySelector("#claseSeleccionada");
        if (!mainContent) {
            return;
        }

        let listaHTML = ``;

        if (jsonResponse.data && jsonResponse.data.length > 0) {
            jsonResponse.data.forEach((clase, index) => {
                listaHTML += `
                   <option value="${clase.seccion_id}">${clase.nombre} - ${clase.codigo}</option>
                `;
            });
        } else {
            listaHTML += `<tr><td colspan='5' class='text-center'>No se encontraron secciones.</td></tr>`;
        }

        mainContent.innerHTML += listaHTML;

    } catch (error) {
        console.error("Error al obtener las secciones:", error);
    }
}

export {cargarClases, cargarPerfil, listarClases};

