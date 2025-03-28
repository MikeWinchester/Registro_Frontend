import loadEnv from "./getEnv.mjs";
const env = await loadEnv();

// Verificar autenticación
const token = localStorage.getItem("token");
if (!token) {
    window.location.href = "/login";
    throw new Error("No autenticado");
}

// Decodificar token
const payload = JSON.parse(atob(token.split(".")[1]));
const usuarioId = payload.id;

// Estado global
let solicitudesAsignadas = [];
let solicitudesTotales = [];
let solicitudActual = null;

// Elementos del DOM
const elementos = {
    tablaAsignadas: document.querySelector('#tabla-asignadas tbody'),
    tablaTodas: document.querySelector('#tabla-todas tbody'),
    btnActualizar: document.getElementById('btn-actualizar'),
    filtroEstado: document.getElementById('filtro-estado'),
    progresoRevision: document.getElementById('progreso-revision'),
    contadorRevisadas: document.getElementById('solicitudes-revisadas'),
    contadorAsignadas: document.getElementById('solicitudes-asignadas'),
    modalRevisar: {
        id: document.getElementById('modal-id'),
        nombre: document.getElementById('modal-nombre'),
        documento: document.getElementById('modal-documento'),
        correo: document.getElementById('modal-correo'),
        telefono: document.getElementById('modal-telefono'),
        carrera1: document.getElementById('modal-carrera1'),
        carrera2: document.getElementById('modal-carrera2'),
        centro: document.getElementById('modal-centro'),
        certificado: document.getElementById('modal-certificado'),
        observaciones: document.getElementById('observaciones')
    }
};

cargarDatosUsuario();
cargarSolicitudes();
configurarEventos();

// Configurar eventos
function configurarEventos() {
    elementos.btnActualizar.addEventListener('click', cargarSolicitudes);
    elementos.filtroEstado.addEventListener('change', filtrarSolicitudes);
    
    document.getElementById('btn-guardar-cambios').addEventListener('click', guardarCambios);
    
    // Delegación de eventos para botones dinámicos
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('btn-revisar') || e.target.closest('.btn-revisar')) {
            const btn = e.target.classList.contains('btn-revisar') ? e.target : e.target.closest('.btn-revisar');
            const solicitudId = parseInt(btn.dataset.id);
            const solicitud = [...solicitudesAsignadas, ...solicitudesTotales].find(s => s.solicitud_id === solicitudId);
            if (solicitud) abrirModalRevisar(solicitud);
        }
    });
}

// Cargar datos del usuario
async function cargarDatosUsuario() {
    try {
        const response = await fetch(`${env.API_URL}/users/${usuarioId}`, {
            headers: { 'Authorization': `Bearer ${token}` }
        });
        
        if (!response.ok) throw new Error('Error al cargar usuario');
        
        const data = await response.json();
        if (data.success) {
            document.getElementById('nombre-revisor').textContent = data.usuario.nombre_completo;
            document.getElementById('user-avatar').textContent = data.usuario.nombre_completo.charAt(0).toUpperCase();
        }
    } catch (error) {
        console.error('Error cargando usuario:', error);
    }
}

// Cargar solicitudes
async function cargarSolicitudes() {
    mostrarLoading(true);
    
    try {
        const response = await fetch(`${env.API_URL}/revisores/${usuarioId}/solicitudes`, {
            headers: { 'Authorization': `Bearer ${token}` }
        });

        if (!response.ok) {
            const errorText = await response.text();
            throw new Error(errorText || 'Error en la respuesta');
        }

        const data = await response.json();
        
        if (!data.success) {
            throw new Error(data.message || 'Error en los datos');
        }

        solicitudesAsignadas = data.asignadas || [];
        solicitudesTotales = data.todas || [];
        
        actualizarTablas();
        actualizarProgreso();

    } catch (error) {
        console.error('Error cargando solicitudes:', error);
        mostrarError(error.message || 'Error al cargar solicitudes');
    } finally {
        mostrarLoading(false);
    }
}

// Actualizar tablas
function actualizarTablas() {
    const estadoFiltro = elementos.filtroEstado.value;
    
    // Filtrar solicitudes
    const asignadasFiltradas = estadoFiltro === 'todas' 
        ? solicitudesAsignadas 
        : solicitudesAsignadas.filter(s => s.estado === estadoFiltro);
    
    const todasFiltradas = estadoFiltro === 'todas'
        ? solicitudesTotales
        : solicitudesTotales.filter(s => s.estado === estadoFiltro);

    // Llenar tablas
    llenarTabla(elementos.tablaAsignadas, asignadasFiltradas, true);
    llenarTabla(elementos.tablaTodas, todasFiltradas, false);
}

// Llenar una tabla con datos
function llenarTabla(tabla, datos, esAsignada) {
    tabla.innerHTML = datos.length > 0 
        ? datos.map(solicitud => crearFila(solicitud, esAsignada)).join('')
        : `<tr><td colspan="${esAsignada ? 7 : 8}" class="text-center py-4">No hay solicitudes</td></tr>`;
}

function crearFila(solicitud, esAsignada) {
    // Normalizar el estado (asegurar minúsculas)
    const estado = String(solicitud.estado).toLowerCase();
    const estadoValido = ['aprobado', 'rechazado', 'pendiente'].includes(estado) 
        ? estado 
        : 'pendiente';
    
    const fecha = new Date(solicitud.fecha_registro).toLocaleDateString();
    const estadoClass = {
        'aprobado': 'table-success',
        'rechazado': 'table-danger',
        'pendiente': ''
    }[estadoValido] || '';

    return `
        <tr class="${estadoClass}" data-id="${solicitud.solicitud_id}">
            <td>${solicitud.codigo || solicitud.solicitud_id}</td>
            <td>${solicitud.nombre_completo || 'No disponible'}</td>
            <td>${solicitud.numero_documento || 'N/A'}</td>
            <td>${solicitud.carrera_principal || 'No especificada'}</td>
            ${!esAsignada ? `<td>${solicitud.revisor_nombre || 'Sin asignar'}</td>` : ''}
            <td>${fecha}</td>
            <td><span class="badge ${getBadgeClass(estadoValido)}">${getEstadoText(estadoValido)}</span></td>
            <td>
                <button class="btn btn-sm btn-outline-primary btn-revisar" data-id="${solicitud.solicitud_id}">
                    <i class="bi bi-eye"></i> Revisar
                </button>
            </td>
        </tr>
    `;
}

// Abrir modal de revisión
function abrirModalRevisar(solicitud) {
    solicitudActual = solicitud;
    
    // Llenar datos en el modal
    elementos.modalRevisar.id.textContent = solicitud.codigo || solicitud.solicitud_id;
    elementos.modalRevisar.nombre.textContent = solicitud.nombre_completo || 'No disponible';
    elementos.modalRevisar.documento.textContent = solicitud.numero_documento || 'N/A';
    elementos.modalRevisar.correo.textContent = solicitud.correo || 'No proporcionado';
    elementos.modalRevisar.telefono.textContent = solicitud.numero_telefono || 'No proporcionado';
    elementos.modalRevisar.carrera1.textContent = solicitud.carrera_principal || 'No especificada';
    elementos.modalRevisar.carrera2.textContent = solicitud.carrera_secundaria || 'No especificada';
    elementos.modalRevisar.centro.textContent = solicitud.centro_regional || 'No especificado';
    elementos.modalRevisar.observaciones.value = solicitud.observaciones || '';
    
    // Estado del certificado
    elementos.modalRevisar.certificado.className = solicitud.certificado_secundaria 
        ? 'badge bg-success' 
        : 'badge bg-secondary';
    elementos.modalRevisar.certificado.innerHTML = solicitud.certificado_secundaria 
        ? '<i class="bi bi-check-circle-fill"></i> Cargado' 
        : '<i class="bi bi-x-circle-fill"></i> No cargado';
    
    // Seleccionar estado actual con protección
    const estadoActual = ['aprobado', 'rechazado', 'pendiente'].includes(solicitud.estado) 
        ? solicitud.estado 
        : 'pendiente';
    
    const radioButton = document.querySelector(`input[name="decision"][value="${estadoActual}"]`);
    if (radioButton) {
        // Desmarcar todos primero
        document.querySelectorAll('input[name="decision"]').forEach(rb => rb.checked = false);
        radioButton.checked = true;
    } else {
        console.warn(`No se encontró radio button para estado: ${estadoActual}`);
        document.querySelector('input[name="decision"][value="pendiente"]').checked = true;
    }
    
    // Mostrar modal
    new bootstrap.Modal(document.getElementById('modalRevisar')).show();
}

// Guardar cambios
async function guardarCambios() {
    if (!solicitudActual) return;
    
    const datos = {
        solicitud_id: solicitudActual.solicitud_id,
        estado: document.querySelector('input[name="decision"]:checked')?.value || 'pendiente',
        observaciones: elementos.modalRevisar.observaciones.value,
        revisor_id: usuarioId
    };
    
    try {
        mostrarLoading(true);
        
        const response = await fetch(`${env.API_URL}/revisores/actualizar`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(datos)
        });

        const responseText = await response.text();
        const data = responseText ? JSON.parse(responseText) : {};

        if (!response.ok || !data.success) {
            throw new Error(data.message || 'Error al guardar');
        }

        mostrarExito('Cambios guardados correctamente');
        cargarSolicitudes();
        bootstrap.Modal.getInstance(document.getElementById('modalRevisar')).hide();

    } catch (error) {
        console.error('Error guardando cambios:', error);
        mostrarError(error.message || 'Error al guardar cambios');
    } finally {
        mostrarLoading(false);
    }
}

// Funciones auxiliares
function actualizarProgreso() {
    const total = solicitudesAsignadas.length;
    const revisadas = solicitudesAsignadas.filter(s => s.estado === 'aprobado' || s.estado === 'rechazado').length;
    
    elementos.contadorAsignadas.textContent = total;
    elementos.contadorRevisadas.textContent = revisadas;
    elementos.progresoRevision.style.width = total > 0 ? `${(revisadas / total) * 100}%` : '0%';
}

function filtrarSolicitudes() {
    actualizarTablas();
}

function getBadgeClass(estado) {
    return {
        'aprobado': 'bg-success',
        'rechazado': 'bg-danger',
        'pendiente': 'bg-warning text-dark'
    }[estado] || 'bg-secondary';
}

function getEstadoText(estado) {
    return {
        'aprobado': 'Aprobado',
        'rechazado': 'Rechazado',
        'pendiente': 'Pendiente'
    }[estado] || 'Desconocido';
}

function mostrarLoading(mostrar) {
    const overlay = document.getElementById('loading-overlay');
    if (overlay) overlay.style.display = mostrar ? 'flex' : 'none';
}

function mostrarError(mensaje) {
    const toastEl = document.getElementById('error-toast');
    const toastBody = toastEl.querySelector('.toast-body');
    toastBody.textContent = mensaje;
    new bootstrap.Toast(toastEl).show();
}

function mostrarExito(mensaje) {
    const toastEl = document.getElementById('success-toast');
    const toastBody = toastEl.querySelector('.toast-body');
    toastBody.textContent = mensaje;
    new bootstrap.Toast(toastEl).show();
}