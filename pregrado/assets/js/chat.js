import { abrirModalMandarSoli, abrirModalVerPerfil, abrirModalVerSoli, abrirModalverAmigos } from "./modal.mjs";
import { showToast } from "../../../assets/js/toastMessage.mjs";
import loadEnv from "../../../assets/js/getEnv.mjs";
const env = await loadEnv();

const endpointgetfriendsconmensajes = `${env.API_URL}/solicitud_amistad/get/message`;
const endpointultimomensaje = `${env.API_URL}/mensaje/get/last`;
const endpointgetval = `${env.API_URL}/estudiante/get/id`;
const endpointgetmensajes = `${env.API_URL}/mensaje/get`;
const endpointenviarmensaje = `${env.API_URL}/mensaje/set`;
const endpointobtenerestu = `${env.API_URL}/estudiante/get`;
const endpoinbuscarusuario = `${env.API_URL}/estudiante/get/cuenta`;
const endpointenviarsolicitu = `${env.API_URL}/solicitud_amistad/set/soli`;
const endpointsolipendiente = `${env.API_URL}/solicitud_amistad/get/waiting`;
const endpointmanejosoli = `${env.API_URL}/solicitud_amistad/update`;
const endpointamigos = `${env.API_URL}/solicitud_amistad/get/accept`;
const endpoincarpeta = `${env.API_URL}/`;


async function chatDom() {
    const est = await getVal();
    const btnAgregar = document.querySelector('#addUser');
    const btnviewsSolicitud = document.querySelector('#viewsSolicitud');
    const btnviewsFriends = document.querySelector('#viewsFriends');
    
    btnviewsFriends.addEventListener('click', async () => {
        await verAmigos(est);
    })
    btnAgregar.addEventListener('click', async() => {
        await mandarSoli(est);
    });
    btnviewsSolicitud.addEventListener('click', async() => {
        await verSolicitudes(est);
    });

    const response = await fetch(endpointgetfriendsconmensajes, {
        method: "GET",
        headers: {
            "usuarioid": est,
            "Content-Type": "application/json",
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    });

    const result = await response.json();
    const container = document.querySelector('#lista-contactos');
    container.innerHTML = ''; 

    for (const amigo of result.data) {
        const div = document.createElement('div');
        div.innerHTML = '';
        div.classList.add('contact', 'active');
        div.dataset.contactId = amigo.amigo_id;
        console.log(amigo);
        div.innerHTML = `
            <img src="${endpoincarpeta}${amigo.foto_perfil}" alt="${amigo.nombre_amigo}" class="contact-avatar perfil-img">
            <div class="contact-info">
                <div class="contact-name">${amigo.nombre_amigo}</div>
        `;
        const mensajeHTML = await obtenerUltimoMensaje(est, amigo.amigo_id);
        div.innerHTML += mensajeHTML;

        div.addEventListener('click', async() => {
            const idAmigo = div.dataset.contactId;
            const nombreAmigo = amigo.nombre_amigo;  

            await obtenerMensaje(est, idAmigo, nombreAmigo);  
        });

        container.appendChild(div);
    }
}

async function obtenerUltimoMensaje(est, usuario) {
    
    const response = await fetch(endpointultimomensaje, {
        method: "GET",
        headers: {
            'emisorid': est,
            'receptorid': usuario,
            "Content-Type": "application/json",
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    });
    const jsonResponse = await response.json();

    return `
        <div class="contact-preview">
            ${jsonResponse.data?.mensaje ?? 'Sin mensajes'}
        </div>
        </div>
    `;
}

async function getVal(){
    
    const est = localStorage.getItem('estudiante');
    
    
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

async function obtenerMensaje(idUsuario, idAmigo, nombre_amigo) {
    document.querySelector('#btnEnviar').disabled = false;
    document.querySelector('#mensajeInput').disabled = false;
    const btnView = document.querySelector('#viewProfileBtn');
    btnView.disabled = false;

    btnView.addEventListener('click', async() => {
        verPerfil(idAmigo);
    });

    const response = await fetch(endpointgetmensajes, {
        method: "GET",
        headers: {
            'remitenteid': idUsuario,
            'destinatarioid': idAmigo,
            "Content-Type": "application/json",
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    });

    const result = await response.json();
    const mensajes = result.data || [];
    const perfilContainer = document.querySelector('#title-chat');
    const chatContainer = document.querySelector('#chat-messages');
    chatContainer.innerHTML = ''; 

    perfilContainer.innerHTML = `<h2 class="chat-title">${nombre_amigo}</h2>`; 

    mensajes.forEach(msg => {
        const div = document.createElement('div');
        const hora = new Date(msg.fecha_envio).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

        if (msg.tipo_mensaje === 'recibido') {
            div.classList.add('message', 'received');
            div.innerHTML = `
                <img src="https://via.placeholder.com/40?text=MG" alt="Avatar" class="message-avatar perfil-img">
                <div class="message-content-container">
                    <div class="message-sender">${msg.nombre_remitente || 'Amigo'}</div>
                    <div class="message-content">${msg.mensaje}</div>
                    <div class="message-time">${hora}</div>
                </div>
            `;
        } else {
            div.classList.add('message', 'sent');
            div.innerHTML = `
                <div class="message-content-container">
                    <div class="message-content">${msg.mensaje}</div>
                    <div class="message-time">${hora}</div>
                </div>
            `;
        }

        chatContainer.appendChild(div);
    });

    chatContainer.scrollTop = chatContainer.scrollHeight;
    await iniciarChat(idUsuario, idAmigo, nombre_amigo);
}

let currentListener = null;

async function iniciarChat(idUsuario, idAmigo, nombre_amigo) {
    const btn = document.querySelector('#btnEnviar');

    if (currentListener) {
        btn.removeEventListener('click', currentListener);
    }

    currentListener = async () => {
        const inputMensaje = document.querySelector('#mensajeInput');
        const mensaje = inputMensaje.value.trim();
    
        if (mensaje.length === 0) return;
    
        await fetch(endpointenviarmensaje, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            },
            body: JSON.stringify({
                remitente_id: idUsuario,
                destinatario_id: idAmigo,
                mensaje
            })
        });
    
        inputMensaje.value = '';
        await chatDom();
        await obtenerMensaje(idUsuario, idAmigo, nombre_amigo);
    };

    btn.addEventListener('click', currentListener);
}


async function verPerfil(idAmigo){

    const titulo = document.querySelector('#title-h5');
    const cuenta = document.querySelector('#cuenta');
    const desc = document.querySelector('#desc');
    const carrera = document.querySelector('#carrera');
    const indice = document.querySelector('#indice');
    const perfil = document.querySelector('#perfil');

    await fetch(endpointobtenerestu, {
        method : "GET",
        headers : {
            'estudianteid' : idAmigo,
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    }).then(response => response.json())
    .then(result => {

        const data = result.data;

        titulo.innerHTML = data['nombre_completo'];
        cuenta.innerHTML = data['numero_cuenta'];
        desc.innerHTML = data['descripcion'];
        carrera.innerHTML = data['nombre_carrera'];
        indice.innerHTML = data['indice_global'];
        perfil.src = endpoincarpeta+''+data['foto_perfil'];
        perfil.alt = data['nombre_completo'];

    })

    abrirModalVerPerfil();
}


async function mandarSoli(est) {
    const btnBuscar = document.querySelector('#seach-user');
    const inputUsuario = document.querySelector('#accountNumber');
    const userInfoTable = document.getElementById('userInfoTable');
    const sendRequestBtn = document.getElementById('sendRequestBtn');
    

    btnBuscar.addEventListener('click', async () =>{
        await fetch(endpoinbuscarusuario, {
            method : "GET",
            headers : {
                'cuenta' : inputUsuario.value,
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            }
        }).then(response => response.json())
        .then(result => {
            if(result.message){
                userInfoTable.innerHTML = `
                                        <tr>
                                            <td>${inputUsuario.value}</td>
                                            <td>${result.data.nombre_completo}</td>
                                            <td>${result.data.nombre_carrera}</td>
                                        </tr>
                                    `;
                document.getElementById('userInfoSection').style.display = 'block';
                sendRequestBtn.addEventListener('click' , async () => {
                    await enviarSolicitud(est, result.data.usuario_id)
                })
            }else{
                console.log(result.error)
            }
        })
    })

    abrirModalMandarSoli();
}

async function enviarSolicitud(usuario_emisor, usuario_receptor) {
    const data = {'usuario_emisor' : usuario_emisor, 'usuario_receptor' : usuario_receptor}
    console.log(data);
    await fetch(endpointenviarsolicitu, {
        method : "POST",
        headers : {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        },
        body : JSON.stringify(data)
    }).then(response => response.json())
    .then(result => {
        if(result.error){
            showToast(result.error, 'error', 3000)
        }else{
            showToast(result.message, 'success', 3000)
        }
        console.log(result);
    })
}

async function verSolicitudes(est){
    await searchEsp(est);

    const btnCon = document.querySelectorAll('.accept-request');
    const btnNeg = document.querySelectorAll('.reject-request');

    btnCon.forEach(btn => {
        btn.addEventListener('click', async () => {
            manejo_solicitud(btn.id, est);
        });
    });

    btnNeg.forEach(btn => {
        btn.addEventListener('click', async () => {
            manejo_solicitud(btn.id, est);
        });
    });

    abrirModalVerSoli();
}

async function searchEsp(est) {
    const tablePend = document.querySelector('#pendingRequestsTable');
    
    tablePend.innerHTML = ''; 

    await fetch(endpointsolipendiente, {
        method: "GET",
        headers: {
            'usuarioid': est,
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    }).then(response => response.json())
    .then(result => {
        if (result.data && result.data.length > 0) {
            result.data.forEach(usuario => {
                tablePend.innerHTML += `
                    <tr>
                        <td>${usuario.nombre_amigo}</td>
                        <td>${usuario.numero_cuenta}</td>
                        <td>${usuario.nombre_carrera}</td>
                        <td>${usuario.fecha_envio}</td>
                        <td>
                            <button id='aceptar-${usuario.amigo_id}' class="btn btn-sm btn-success me-1 accept-request">Aceptar</button>
                            <button id='rechazar-${usuario.amigo_id}' class="btn btn-sm btn-danger reject-request">Rechazar</button>
                        </td>
                    </tr>
                `;
            });
        } else {
            tablePend.innerHTML = '<tr><td colspan="5">No hay solicitudes pendientes.</td></tr>';
        }
    }).catch(error => {
        console.error('Error al cargar las solicitudes:', error);
        tablePend.innerHTML = '<tr><td colspan="5">Error al cargar las solicitudes.</td></tr>';
    });
}

async function manejo_solicitud(id_emisor, id_receptor){
    let estadoid = 0;
    
    if(id_emisor.split("-")[0] == 'aceptar'){
        estadoid = 1;
    }else{
        estadoid = 2;
    }

    const data = {'estadoid' : estadoid ,'emisorid' : id_emisor.split('-')[1], 'receptorid' : id_receptor}
    console.log(data);

    await fetch(endpointmanejosoli, {
        method : "PUT",
        headers : {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        },
        body : JSON.stringify(data)
    }).then(response => response.json())
    .then(result => {
        showToast('Se ha mandado la solicitud', 'success', 2000);
        
    })
}

async function verAmigos(est){

    await desplegarAmigos(est);

    const btnEnviar = document.querySelectorAll(".btn-iniciar");

    btnEnviar.forEach(async btn => {
        btn.addEventListener('click', async()=>{
            await obtenerMensaje(est, btn.id.split("-")[1], btn.dataset.usuario)
            
        })
    });

    abrirModalverAmigos();
}

async function desplegarAmigos(est){
    const divAmigos = document.querySelector('#friendsListContainer');
    divAmigos.innerHTML = '';
    await fetch(endpointamigos, {
        method : "GET", 
        headers : {
            'usuarioid' : est,
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    }).then(response => response.json())
    .then(result => {
        
        result.data.forEach(amigos => {
            const amigo = `<div class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="${endpoincarpeta}${amigos.foto_perfil}" class="rounded-circle me-3 perfil-img" alt="Foto perfil">
                                    <div>
                                        <h6 class="mb-0">${amigos.nombre_amigo}</h6>
                                        <small class="text-muted">${amigos.numero_cuenta} - ${amigos.nombre_carrera}</small>
                                    </div>
                                </div>
                                <button data-usuario='${amigos.nombre_amigo}' class="btn btn-sm btn-outline-dark btn-iniciar" id='chat-${amigos.amigo_id}'>iniciar Chat</button>
                            </div>`;  

            divAmigos.innerHTML += amigo;
        });

    })
}

async function cicloChatDom() {
    try {
        await chatDom();
    } catch (err) {
        console.error("Error en chatDom:", err);
    } finally {
        // Esperar 20 segundos antes de volver a ejecutar
        setTimeout(cicloChatDom, 60000);
    }
}

cicloChatDom();




