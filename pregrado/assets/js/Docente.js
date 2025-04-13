import { showToast } from "../../../assets/js/toastMessage.mjs";
import loadEnv from "./getEnv.mjs";
const env = await loadEnv();
const endpointgetval = `${env.API_URL}/docentes/get/id`;
const endpointvalidacion = `${env.API_URL}/notas/validate`;
const endpointupdatedata = `${env.API_URL}/docentes/upload`;
const endpointuploadvideo = `${env.API_URL}/docentes/video`;
const val = await getVal();

async function cargarClases() {
    const loader = document.querySelector('#loader-clases');

    loader.style.display = 'Block';
    try {
        if (!val) {
            console.log("No se encontró el ID del docente");
            return;
        }

        const response = await fetch(`${env.API_URL}/clases/doc`, {
            method: "GET",
            headers: {
                'docenteid': val,
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            },
        });

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
    } finally {
        loader.style.display = 'none';
    }
}

async function cargarSecciones(claseId) {
    
    try {
        if (!claseId) {
            console.log("No se encontró el ID de la clase");
            return "";
        }

        const response = await fetch(`${env.API_URL}/secciones/get/clase/doc`, {
            method: "GET",
            headers: {
                "claseid": claseId,
                "docenteid" : val,
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            },
        });

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
                    <a href="/pregrado/views/components/Lista_estudiantes.php?Id=${seccion.seccion_id}" 
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


async function cargarPerfil() {
    
    const loader = document.querySelector('#loader-perfil');
    const mainContent = document.querySelector("#main-content");

    loader.style.display = 'block';
    mainContent.innerHTML = '';

    try {
        if(!val) {
            console.log('No se encontró el ID del docente');
            return;
        }

        const response = await fetch(`${env.API_URL}/docentes/get`, {
            method: "GET",
            headers: {
                "docenteid": val,
                "Content-Type": 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            }
        });

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();

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
    
    const loader = document.querySelector('#loader-clases')

    loader.style.display = 'Block';
    
    try {

        if(!val){
            console.log('No se encontro el ID del docente');
            return;
        }

        const response = await fetch(`${env.API_URL}/secciones/docente`, {
            method : "GET",
            headers : {
                "docenteid" : val,
                "Content-Type" : 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            }
        });

        const jsonResponse = await response.json();
        

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

    } catch (error) {
        console.error("Error al obtener las secciones:", error);
    } finally{
        loader.style.display = 'none';
    }
}

async function dataDom() {
    const btnSave = document.querySelector('#saveChange');

    btnSave.addEventListener('click', async() => {
        datosDocente();
    })
}

async function datosDocente() {
    const file = document.querySelector('#picture').files[0];
    const desc = document.querySelector('#desc').value;

    const toBase64 = file => new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });

    const base64Image = file ? await toBase64(file) : null;

    const payload = {
        'foto_perfil' : base64Image, 
        'descripcion' : desc,
        'docente_id' : localStorage.getItem('docente')
    };

    const response = await fetch(endpointupdatedata, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        },
        body: JSON.stringify(payload)
    });

    const result = await response.json();
    console.log(result);
}


async function getVal(){
    
    const est = localStorage.getItem('docente');
    
    
    const res = await fetch(endpointgetval, {
        method: "GET",
        headers: {
            "id": est,
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    });
    
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
    
    const result = await res.json();

    return result;
}

async function videoDom() {
    const select = document.querySelector('#clase');
    const video = document.querySelector('#video-clase');
    const error = document.querySelector('#error-video');

    await clasesAsig(select);

    const btn = document.querySelector('#subir');
    btn.addEventListener('click', async () => {
        if (validarEnlace(video.value)) {
            error.textContent = ''; 
            await subirVideo();
        } else {
            error.textContent = 'Enlace no válido';
        }
    });

    video.addEventListener('keyup', () => {
        if (validarEnlace(video.value)) {
            error.textContent = ''; 
        } else {
            error.textContent = 'Enlace no válido';
        }
    });
}

function validarEnlace(url) {
    const regex = /(?:https?:\/\/)?(?:www\.)?(?:drive\.google\.com\/file\/d\/[a-zA-Z0-9_-]+|(?:youtube\.com\/watch\?v=|youtu\.be\/)[\w-]{11}|onedrive\.live\.com\/[^\s]+)/;
    return regex.test(url);
}

async function clasesAsig(select){

    await fetch(`${env.API_URL}/secciones/docente`, {
        method: "GET",
        headers: {
            'docenteid': val,
            "Content-Type": "application/json",
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        },
    }).then(response => response.json())
    .then(result => {
        
        select.innerHTML = `<option value="" selected disabled > Selecciones una asignatura</option>`;

        result.data.forEach(clase => {
            let option = document.createElement('option');
            option.value = clase.seccion_id;
            option.innerHTML = `${clase.nombre} - ${clase.horario.split('-')[0].replace(":","")}`
            select.appendChild(option);
        });

    })
}

async function subirVideo(){
    const select = document.querySelector('#clase');
    const titulo = document.querySelector('#titulo');
    const video = document.querySelector('#video-clase');
    const desc = document.querySelector('#desc');

    const data = {
        'seccion_id' : select.value,
        'titulo' : titulo.value,
        'video' : video.value,
        'descripcion' : desc.value
    }
    console.log(data);

    await fetch(endpointuploadvideo, {
        method : "POST",
        headers : {
            "Content-Type": "application/json",
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        },
        body : JSON.stringify(data)
    }).then(response => response.json())
    .then(result => {
        if(result.error){
            showToast(result.error, 'error', 3000);
        }else{
            showToast(result.message, 'success', 3000);
        }
    })
    

    
}

export {cargarClases, cargarPerfil, listarClases, validateDate, dataDom, videoDom};

