import loadEnv from "./getEnv.mjs";
const env = await loadEnv();
const endpointgetval = `${env.API_URL}/docentes/get/id`;
const endpointvalidacion = `${env.API_URL}/notas/validate`;

async function cargarClases() {
    const val = await getVal();
    const loader = document.querySelector('#loader-clases');

    loader.style.display = 'Block';
    try {
        if (!val) {
            console.log("No se encontró el ID del docente");
            return;
        }

        const response = await fetch(`${env.API_URL}/clases/doc/${val}`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            },
        });

        const jsonResponse = await response.json();
        if(jsonResponse.message){
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
        }
    } catch (error) {
        console.error("Error al obtener las clases:", error);
    } finally {
        loader.style.display = 'none';
    }
}

async function cargarSecciones(claseId) {
    const val = await getVal();
    try {
        if (!claseId) {
            console.log("No se encontró el ID de la clase");
            return "";
        }

        const response = await fetch(`${env.API_URL}/secciones/get/clase/${claseId}/doc/${val}`, {
            method: "GET",
            headers: {
                
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            },
        });

        const jsonResponse = await response.json();

        if(jsonResponse.message){
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
        }
    } catch (error) {
        console.error("Error al obtener las secciones:", error);
        return `<tr><td colspan="4" class="text-center text-danger">Error al cargar las secciones.</td></tr>`;
    }
}


async function cargarPerfil() {
    const val = await getVal();
    const loader = document.querySelector('#loader-perfil');
    const mainContent = document.querySelector("#main-content");

    loader.style.display = 'block';
    mainContent.innerHTML = '';

    try {
        if(!val) {
            console.log('No se encontró el ID del docente');
            return;
        }

        const response = await fetch(`${env.API_URL}/docentes/get/${val}`, {
            method: "GET",
            headers: {
                "Content-Type": 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            }
        });

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();

        if(jsonResponse.message){
            if (!jsonResponse.data || jsonResponse.data.length === 0) {
                mainContent.innerHTML = `
                    <div class="alert alert-warning text-center mx-auto" style="max-width: 500px;">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>No se encontró información del perfil
                    </div>`;
                return;
            }
    
            const perfil = jsonResponse.data;
            
            const perfilHTML = `
                <div class="profile-card">
                    <div class="profile-header">
                        <h3><i class="bi bi-person-badge"></i> Perfil Docente</h3>
                    </div>
                    <div class="profile-img-container">
                        <img src="/Registro_Frontend/assets/images/perfil.jpg" alt="Foto de perfil" class="profile-img">
                    </div>
                    <div class="profile-body">
                        <h4 class="profile-name">${perfil.nombre_completo}</h4>
                        
                        <div class="profile-detail">
                            <i class="bi bi-envelope-fill"></i>
                            <span>${perfil.correo}</span>
                        </div>
                        
                        <div class="profile-detail">
                            <i class="bi bi-credit-card-fill"></i>
                            <span>${perfil.numero_cuenta}</span>
                        </div>
                        
                        <div class="profile-detail">
                            <i class="bi bi-building"></i>
                            <span>${perfil.nombre_centro}</span>
                        </div>
                        
                        <div class="profile-detail">
                            <i class="bi bi-journals"></i>
                            <span>${perfil.nombre_carrera}</span>
                        </div>
                        
                        <div class="profile-detail">
                            <i class="bi bi-calendar-event"></i>
                            <span>Fecha de ingreso: 10/08/2015</span>
                        </div>
                        
                        <button class="btn btn-edit">
                            <i class="bi bi-pencil-square"></i> Editar Perfil
                        </button>
                    </div>
                    <div class="profile-footer">
                        <a href="#" class="more-link">
                            <i class="bi bi-three-dots"></i> Ver más detalles
                        </a>
                    </div>
                </div>
            `;
    
            mainContent.innerHTML = perfilHTML;
        }
    } catch (error) {
        console.error("Error al obtener el perfil:", error);
        mainContent.innerHTML = `
            <div class="alert alert-danger text-center mx-auto" style="max-width: 500px;">
                <i class="bi bi-x-circle-fill me-2"></i>Error al cargar el perfil
            </div>`;
    } finally {
        loader.style.display = 'none';
    }
}

async function listarClases() {
    const val = await getVal();
    const loader = document.querySelector('#loader-clases')

    loader.style.display = 'Block';
    
    try {

        if(!val){
            console.log('No se encontro el ID del docente');
            return;
        }

        const response = await fetch(`${env.API_URL}/secciones/docente/${val}`, {
            method : "GET",
            headers : {
                
                "Content-Type" : 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            }
        });

        const jsonResponse = await response.json();
        

        if(jsonResponse.message){
            const mainContent = document.querySelector("#claseSeleccionada");
            if (!mainContent) {
                return;
            }

            let listaHTML = ``;

            if (jsonResponse.data && jsonResponse.data.length > 0) {
                jsonResponse.data.forEach((clase, index) => {
                    listaHTML += `
                    <option value="${clase.seccion_id}">${clase.codigo} - ${clase.nombre} - ${clase.horario.split("-")[0].replace(":", "")}</option>
                    `;
                });
            } else {
                listaHTML += `<tr><td colspan='5' class='text-center'>No se encontraron secciones.</td></tr>`;
            }

            mainContent.innerHTML += listaHTML;
        }

    } catch (error) {
        console.error("Error al obtener las secciones:", error);
    } finally{
        loader.style.display = 'none';
    }
}

async function getVal(){
    
    const est = localStorage.getItem('docente');
    
    
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

async function validateDate(){
    
    const res = await fetch(endpointvalidacion, {
        method: "GET",
        headers: {
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    });

    if (!res.ok) {
        throw new Error("Error al obtener el valor");
    }
    
    const result = await res.json();

    return result;
}

export {cargarClases, cargarPerfil, listarClases, validateDate};

