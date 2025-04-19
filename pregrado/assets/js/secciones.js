import loadEnv from "../../../assets/js/getEnv.mjs";
import { showToast } from "../../../assets/js/toastMessage.mjs";
const env = await loadEnv();

const endpointobtenersecciones = `${env.API_URL}/matricula/get/estu/${localStorage.getItem('estudiante')}`;
const endpointobtenerrecursos = `${env.API_URL}/secciones/resources`;
const endpointobtenermiembros = `${env.API_URL}/secciones/members`;
const endpointcarpeta = `${env.API_URL}`;

async function desploySeccions() {
    const div_seccioness = document.querySelector('#secciones-container');
    div_seccioness.innerHTML = '';

    await fetch(endpointobtenersecciones, {
        method : "GET",
        headers : {
             "Content-Type": "application/json",
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    }).then(response => response.json())
    .then(result => {

        if(result.message){

            result.data.forEach(seccion => {
                const secciones = `<div class="seccion-card" data-seccion-id=${seccion.seccion_id}>
                                        <h3><i class="bi bi-calculator"></i> ${seccion.nombre}</h3>
                                        <p><i class="bi bi-person"></i> ${seccion.docente}</p>
                                        <p><i class="bi bi-calendar-week"></i> ${seccion.dias}</p>
                                        <button id='btn-${seccion.seccion_id}' class="btn ver-detalle-btn" data-seccion="${seccion.nombre}">
                                            <i class="bi bi-eye"></i> Ver detalles
                                        </button>
                                    </div>`
                div_seccioness.innerHTML = secciones;
            });

        }else{
            showToast('No hay secciones disponibles', 'error');
        }

    })
}

async function insertDetails(nombre, id){
    const header = document.querySelector('#seccion-header');
    const div_recurso = document.querySelector('#clases');
    div_recurso.innerHTML = '';

    header.innerHTML = `<h2><i class="bi bi-calculator"></i> ${nombre}</h2>
                            <button class="btn btn-volver">
                                <i class="bi bi-arrow-left"></i> Volver
                            </button>`

    await fetch(`${endpointobtenerrecursos}/${id}`, {
        method : "GET",
        headers : {
             "Content-Type": "application/json",
             'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    }).then(response => response.json())
    .then(result => {

        if(result.message){

            result.data.forEach(recurso => {
                
                const recursos = `<div class="clase-item" data-video-url=${recurso.video}>
                                    <h4><i class="bi bi-play-circle"></i> ${recurso.titulo}</h4>
                                    <p>${recurso.descripcion}</p>
                                    <div class="video-container">
                                        <iframe src="${recurso.video}" allowfullscreen></iframe>
                                    </div>
                                </div>`
                div_recurso.innerHTML += recursos;
            });

        }else{
            div_recurso.innerHTML += 'No hay recursos disponibles';
        }

    })
    
    await insertMembers(id);

    showDetails();
    

}

async function insertMembers(id){
    
    const div_miembros = document.querySelector('#integrantes-container');

    await fetch(`${endpointobtenermiembros}/${id}`, {
        method : "GET",
        headers : {
             "Content-Type": "application/json",
             'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    }).then(response => response.json())
    .then(result => {
        
        if(result.message){

            const docente = result.data.docente;

            const div_docente = ` <div class="integrante-card">
                                    <img src="${endpointcarpeta}/${docente.foto}" alt="Profesor" class="integrante-avatar">
                                    <div>
                                        <h4>${docente.nombre}</h4>
                                        <span class="integrante-role profesor">Profesor</span>
                                        <p><small>${docente.cuenta}</small></p>
                                    </div>
                                </div>`

            div_miembros.innerHTML = div_docente;

            const estudiantes = result.data.estudiantes;

            estudiantes.forEach(estudiante => {
                
                const div_estudiante = `<div class="integrante-card">
                                            <img src="${endpointcarpeta}/${estudiante.estudiante_foto}" alt="Estudiante" class="integrante-avatar">
                                            <div>
                                                <h4>${estudiante.estudiante_nombre}</h4>
                                                <span class="integrante-role">Estudiante</span>
                                                <p><small>${estudiante.estudiante_cuenta}</small></p>
                                            </div>
                                        </div>`;

                div_miembros.innerHTML += div_estudiante;
            });

        }
    })

}

async function showDetails(){
    document.querySelector('.secciones-container').style.display = 'none';
    document.querySelector(`#seccion`).style.display = 'block';

    document.querySelector('.btn-volver').addEventListener('click', function() {
        document.querySelector('.secciones-container').style.display = 'grid';
        document.querySelector('.seccion-detalle').style.display = 'none';
    });

    
    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            const tabId = this.getAttribute('data-tab');
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            document.getElementById(tabId).classList.add('active');
        });
    });

    document.querySelectorAll('.clase-item').forEach(item => {
        item.addEventListener('click', function() {
            const iframe = this.querySelector('iframe');
            iframe.src = this.getAttribute('data-video-url');
            this.querySelector('.video-container').style.display = 'block';
        });
    });
}

async function btnEvent(){
    const btn_secciones = document.querySelectorAll('.ver-detalle-btn');

    btn_secciones.forEach(btn => {
        btn.addEventListener('click', async () => insertDetails(btn.dataset.seccion, btn.id.split('-')[1]));
    });
}

async function manejador(){
    await desploySeccions();
    await btnEvent();
}

manejador();