import loadEnv from '../../../../assets/js/getEnv.mjs';
const env = await loadEnv();

// Estado global
let solicitudesAsignadas = [];
let solicitudesTotales = [];
let solicitudActual = null;
let currentPage = 1;
const perPage = 10;
let token = localStorage.getItem('authToken') || '';
let totalSolicitudesAsignadas = 0;

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
    },
    pagination: document.getElementById('pagination'),
    btnVerCertificado: document.getElementById('btn-ver-certificado'),
    btnGuardarCambios: document.getElementById('btn-guardar-cambios'),
    modalCertificado: {
        id: document.getElementById('certificado-id'),
        contenido: document.getElementById('certificado-contenido'),
        cargando: document.getElementById('certificado-cargando'),
        error: document.getElementById('certificado-error')
    },
    navbarUsername: document.getElementById('navbar-username'),
    btnLogout: document.getElementById('btn-logout'),
    nombreRevisor: document.getElementById('nombre-revisor'),
    userAvatar: document.getElementById('user-avatar'),
    modalConfirmarGuardar: new bootstrap.Modal(document.getElementById('modalConfirmarGuardar')),
    confirmarGuardarCambios: document.getElementById('confirmar-guardar-cambios'),
    modalCerrarSesion: new bootstrap.Modal(document.getElementById('modalCerrarSesion')),
    confirmarCierreSesion: document.getElementById('confirmar-cierre-sesion')
};

// Obtener datos del usuario de los atributos del HTML
const usuarioId = document.documentElement.getAttribute('user-id');
const usuarioNombre = document.documentElement.getAttribute('user-name');

// Configurar el nombre del usuario
function configurarUsuario() {
    elementos.nombreRevisor.textContent = usuarioNombre;
    elementos.userAvatar.textContent = usuarioNombre.charAt(0).toUpperCase();
    elementos.navbarUsername.textContent = usuarioNombre;
}

// Configurar eventos
function configurarEventos() {
    elementos.btnActualizar.addEventListener('click', () => {
        currentPage = 1;
        cargarSolicitudes();
    });
    
    elementos.filtroEstado.addEventListener('change', () => {
        currentPage = 1;
        cargarSolicitudes();
    });
    
    elementos.btnLogout.addEventListener('click', () => {
        elementos.modalCerrarSesion.show();
    });

    elementos.confirmarCierreSesion.addEventListener('click', () => {
        localStorage.removeItem('authToken');
        window.location.href = '/admissions/login/logout.php';
    });

    elementos.btnVerCertificado.addEventListener('click', verCertificado);

    elementos.btnGuardarCambios.addEventListener('click', () => {
        elementos.modalConfirmarGuardar.show();
    });

    elementos.confirmarGuardarCambios.addEventListener('click', guardarCambios);

    // Delegación de eventos para botones dinámicos
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('btn-revisar') || e.target.closest('.btn-revisar')) {
            const btn = e.target.classList.contains('btn-revisar') ? e.target : e.target.closest('.btn-revisar');
            const solicitudId = btn.dataset.id;
            const solicitud = [...solicitudesAsignadas, ...solicitudesTotales].find(s => s.solicitud_uuid === solicitudId);
            if (solicitud) abrirModalRevisar(solicitud);
        }
        
        if (e.target.classList.contains('page-link') || e.target.closest('.page-link')) {
            e.preventDefault();
            const pageLink = e.target.classList.contains('page-link') ? e.target : e.target.closest('.page-link');
            const page = parseInt(pageLink.dataset.page);
            if (!isNaN(page) && page !== currentPage) {
                currentPage = page;
                cargarSolicitudes();
            }
        }
    });
}

async function cargarSolicitudes() {
    mostrarLoading(true);
    
    try {
        const estadoFiltro = elementos.filtroEstado.value;
        const url = new URL(`${env.API_URL}/revisores/${usuarioId}/solicitudes`);
        
        url.searchParams.append('page', currentPage);
        url.searchParams.append('per_page', perPage);
        
        // Solo enviar el filtro si no es 'todas'
        if (estadoFiltro !== 'todas') {
            // Convertir el estado a femenino antes de enviarlo
            let estadoFemenino = estadoFiltro;
            if (estadoFiltro === 'aprobado') estadoFemenino = 'aprobada';
            if (estadoFiltro === 'rechazado') estadoFemenino = 'rechazada';
            url.searchParams.append('estado', estadoFemenino);
        }

        const response = await fetch(url, {
            headers: { 
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            const errorText = await response.text();
            if (response.status === 401) {
                localStorage.removeItem('authToken');
                window.location.href = '/login';
                return;
            }
            throw new Error(errorText || `Error ${response.status}`);
        }

        const data = await response.json();
        
        if (!data.success) {
            throw new Error(data.message || 'Error en los datos recibidos');
        }

        solicitudesAsignadas = data.asignadas || [];
        solicitudesTotales = data.todas || [];
        totalSolicitudesAsignadas = data.total_asignadas || 0;
        
        // Convertir estados a femenino en las solicitudes recibidas
        solicitudesAsignadas = solicitudesAsignadas.map(s => {
            if (s.estado === 'aprobado') s.estado = 'aprobada';
            if (s.estado === 'rechazado') s.estado = 'rechazada';
            return s;
        });
        
        solicitudesTotales = solicitudesTotales.map(s => {
            if (s.estado === 'aprobado') s.estado = 'aprobada';
            if (s.estado === 'rechazado') s.estado = 'rechazada';
            return s;
        });
        
        actualizarTablas();
        actualizarProgreso();
        actualizarPaginacion(totalSolicitudesAsignadas, data.total_pages || 1);

    } catch (error) {
        console.error('Error cargando solicitudes:', error);
        mostrarError(error.message || 'Error al cargar solicitudes');
    } finally {
        mostrarLoading(false);
    }
}

// Actualizar tablas
function actualizarTablas() {
    llenarTabla(elementos.tablaAsignadas, solicitudesAsignadas, true);
    llenarTabla(elementos.tablaTodas, solicitudesTotales, false);
}

// Llenar una tabla con datos
function llenarTabla(tabla, datos, esAsignada) {
    tabla.innerHTML = datos.length > 0 
        ? datos.map(solicitud => crearFila(solicitud, esAsignada)).join('')
        : `<tr><td colspan="${esAsignada ? 7 : 8}" class="text-center py-4">No hay solicitudes</td></tr>`;
}

function crearFila(solicitud, esAsignada) {
    let estado = String(solicitud.estado).toLowerCase();
    // Asegurar que el estado esté en femenino
    if (estado === 'aprobado') estado = 'aprobada';
    if (estado === 'rechazado') estado = 'rechazada';
    
    const estadoValido = ['aprobada', 'rechazada', 'pendiente'].includes(estado) 
        ? estado 
        : 'pendiente';
    
    const fecha = new Date(solicitud.fecha_registro).toLocaleDateString();
    const estadoClass = {
        'aprobada': 'table-success',
        'rechazada': 'table-danger',
        'pendiente': ''
    }[estadoValido] || '';

    // Función para manejar valores no proporcionados
    const getValue = (value, defaultValue = 'No proporcionado') => {
        return value && value !== 'null' && value !== 'undefined' ? value : defaultValue;
    };

    return `
        <tr class="${estadoClass}" data-id="${solicitud.solicitud_uuid}">
            <td>${getValue(solicitud.codigo || solicitud.solicitud_uuid, 'N/A')}</td>
            <td>${getValue(solicitud.nombre_completo, 'No disponible')}</td>
            <td>${getValue(solicitud.numero_documento, 'N/A')}</td>
            <td>${getValue(solicitud.carrera_principal, 'No especificada')}</td>
            ${!esAsignada ? `<td>${getValue(solicitud.revisor_nombre, 'Sin asignar')}</td>` : ''}
            <td>${fecha}</td>
            <td><span class="badge ${getBadgeClass(estadoValido)}">${getEstadoText(estadoValido)}</span></td>
            <td>
                <button class="btn btn-sm btn-outline-primary btn-revisar" data-id="${solicitud.solicitud_uuid}" style="border-color: #001a3d; color: #001a3d;">
                    <i class="bi bi-eye"></i> Revisar
                </button>
            </td>
        </tr>
    `;
}

// Actualizar paginación
function actualizarPaginacion(totalItems, totalPages) {
    const paginationContainer = document.createElement('nav');
    paginationContainer.setAttribute('aria-label', 'Page navigation');
    
    const paginationList = document.createElement('ul');
    paginationList.className = 'pagination';
    
    // Botón Anterior
    const prevItem = document.createElement('li');
    prevItem.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
    prevItem.innerHTML = `
        <a class="page-link" href="#" aria-label="Previous" data-page="${currentPage - 1}">
            <span aria-hidden="true">&laquo;</span>
        </a>
    `;
    paginationList.appendChild(prevItem);
    
    // Números de página
    const startPage = Math.max(1, currentPage - 2);
    const endPage = Math.min(totalPages, currentPage + 2);
    
    for (let i = startPage; i <= endPage; i++) {
        const pageItem = document.createElement('li');
        pageItem.className = `page-item ${i === currentPage ? 'active' : ''}`;
        pageItem.innerHTML = `<a class="page-link" href="#" data-page="${i}">${i}</a>`;
        paginationList.appendChild(pageItem);
    }
    
    // Botón Siguiente
    const nextItem = document.createElement('li');
    nextItem.className = `page-item ${currentPage >= totalPages ? 'disabled' : ''}`;
    nextItem.innerHTML = `
        <a class="page-link" href="#" aria-label="Next" data-page="${currentPage + 1}">
            <span aria-hidden="true">&raquo;</span>
        </a>
    `;
    paginationList.appendChild(nextItem);
    
    paginationContainer.appendChild(paginationList);
    
    // Actualizar el contenedor de paginación
    elementos.pagination.innerHTML = '';
    elementos.pagination.appendChild(paginationContainer);
}

// Abrir modal de revisión
function abrirModalRevisar(solicitud) {
    solicitudActual = solicitud;
    
    // Función para manejar valores no proporcionados
    const getValue = (value, defaultValue = 'No proporcionado') => {
        return value && value !== 'null' && value !== 'undefined' ? value : defaultValue;
    };
    
    // Llenar datos en el modal
    elementos.modalRevisar.id.textContent = getValue(solicitud.codigo || solicitud.solicitud_uuid, 'N/A');
    elementos.modalRevisar.nombre.textContent = getValue(solicitud.nombre_completo, 'No disponible');
    elementos.modalRevisar.documento.textContent = getValue(solicitud.numero_documento, 'N/A');
    elementos.modalRevisar.correo.textContent = getValue(solicitud.correo);
    elementos.modalRevisar.telefono.textContent = getValue(solicitud.numero_telefono);
    elementos.modalRevisar.carrera1.textContent = getValue(solicitud.carrera_principal, 'No especificada');
    elementos.modalRevisar.carrera2.textContent = getValue(solicitud.carrera_secundaria, 'No especificada');
    elementos.modalRevisar.centro.textContent = getValue(solicitud.centro_regional, 'No especificado');
    elementos.modalRevisar.observaciones.value = getValue(solicitud.observaciones, '');
    
    // Estado del certificado
    const tieneCertificado = !!solicitud.certificado_secundaria;
    elementos.modalRevisar.certificado.className = tieneCertificado 
        ? 'badge bg-success' 
        : 'badge bg-secondary';
    elementos.modalRevisar.certificado.innerHTML = tieneCertificado 
        ? '<i class="bi bi-check-circle-fill"></i> Cargado' 
        : '<i class="bi bi-x-circle-fill"></i> No cargado';
    
    // Habilitar/deshabilitar botón de ver certificado
    elementos.btnVerCertificado.disabled = !tieneCertificado;
    
    // Seleccionar estado actual (convertir a femenino si es necesario)
    let estadoActual = solicitud.estado.toLowerCase();
    if (estadoActual === 'aprobado') estadoActual = 'aprobada';
    if (estadoActual === 'rechazado') estadoActual = 'rechazada';
    
    const radioButton = document.querySelector(`input[name="decision"][value="${estadoActual}"]`);
    if (radioButton) {
        document.querySelectorAll('input[name="decision"]').forEach(rb => rb.checked = false);
        radioButton.checked = true;
    }
    
    // Mostrar modal
    new bootstrap.Modal(document.getElementById('modalRevisar')).show();
}

async function verCertificado() {
    if (!solicitudActual) return;
    
    const modalCertificado = new bootstrap.Modal(document.getElementById('modalCertificado'));
    elementos.modalCertificado.id.textContent = solicitudActual.codigo || solicitudActual.solicitud_uuid;
    
    // Mostrar estado de carga
    elementos.modalCertificado.contenido.innerHTML = '';
    elementos.modalCertificado.cargando.classList.remove('d-none');
    elementos.modalCertificado.error.classList.add('d-none');
    
    modalCertificado.show();
    
    try {
        const response = await fetch(`${env.API_URL}/revisores/certificado/${solicitudActual.solicitud_uuid}`, {
            headers: { 'Authorization': `Bearer ${token}` }
        });

        if (!response.ok) {
            throw new Error('Error al obtener el certificado');
        }

        const data = await response.json();
        
        if (!data.success || !data.certificado) {
            throw new Error('Certificado no disponible');
        }

        // Mostrar el certificado según su tipo MIME
        let contenidoHTML = '';
        const mimeType = data.mime_type || 'image/jpeg'; // Por defecto asumimos imagen
        
        if (mimeType.startsWith('image/')) {
            // Es una imagen
            contenidoHTML = `
                <img src="data:${mimeType};base64,${data.certificado}" 
                     alt="Certificado de estudios" 
                     class="img-fluid">
            `;
        } else if (mimeType === 'application/pdf') {
            // Es un PDF - mostramos un visor embebido
            contenidoHTML = `
                <embed src="data:${mimeType};base64,${data.certificado}" 
                       type="${mimeType}" 
                       width="100%" 
                       height="500px">
            `;
        } else {
            // Otro tipo de archivo
            contenidoHTML = `
                <div class="alert alert-info">
                    <i class="bi bi-file-earmark"></i> 
                    Certificado en formato ${mimeType}
                </div>
            `;
        }

        elementos.modalCertificado.contenido.innerHTML = contenidoHTML;

    } catch (error) {
        console.error('Error cargando certificado:', error);
        elementos.modalCertificado.error.textContent = error.message || 'Error al cargar el certificado';
        elementos.modalCertificado.error.classList.remove('d-none');
    } finally {
        elementos.modalCertificado.cargando.classList.add('d-none');
    }
}

async function guardarCambios() {
    elementos.modalConfirmarGuardar.hide();
    
    if (!solicitudActual) return;
    
    // Obtener el estado y convertirlo a femenino si es necesario
    let estado = document.querySelector('input[name="decision"]:checked')?.value || 'pendiente';
    if (estado === 'aprobado') estado = 'aprobada';
    if (estado === 'rechazado') estado = 'rechazada';
    
    const datos = {
        solicitud_uuid: solicitudActual.solicitud_uuid,
        estado: estado,
        observaciones: elementos.modalRevisar.observaciones.value,
        revisor_uuid: usuarioId
    };

    try {
        mostrarLoading(true);
        
        const response = await fetch(`${env.API_URL}/revisores/actualizar`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(datos)
        });

        const responseData = await response.json();

        if (!response.ok || !responseData.success) {
            throw new Error(responseData.message || 'Error al guardar');
        }

        mostrarExito('Cambios guardados correctamente');
        
        // Actualizar el estado local inmediatamente
        const estadoActualizado = datos.estado;
        solicitudesAsignadas = solicitudesAsignadas.map(s => 
            s.solicitud_uuid === solicitudActual.solicitud_uuid ? 
            {...s, estado: estadoActualizado} : s
        );
        
        solicitudesTotales = solicitudesTotales.map(s => 
            s.solicitud_uuid === solicitudActual.solicitud_uuid ? 
            {...s, estado: estadoActualizado} : s
        );
        
        // Actualizar UI
        actualizarTablas();
        actualizarProgreso();
        
        // Cerrar modal
        bootstrap.Modal.getInstance(document.getElementById('modalRevisar')).hide();

    } catch (error) {
        mostrarError(error.message || 'Error al guardar cambios');
    } finally {
        mostrarLoading(false);
    }
}

// Funciones auxiliares
function actualizarProgreso() {
    // Solo calculamos el progreso basado en todas las solicitudes asignadas, no filtradas
    const total = totalSolicitudesAsignadas;
    const revisadas = solicitudesAsignadas.filter(s => {
        let estado = String(s.estado).toLowerCase();
        if (estado === 'aprobado') estado = 'aprobada';
        if (estado === 'rechazado') estado = 'rechazada';
        return estado === 'aprobada' || estado === 'rechazada';
    }).length;
    
    elementos.contadorAsignadas.textContent = total;
    elementos.contadorRevisadas.textContent = revisadas;
    
    const porcentaje = total > 0 ? Math.round((revisadas / total) * 100) : 0;
    elementos.progresoRevision.style.width = `${porcentaje}%`;
    elementos.progresoRevision.setAttribute('aria-valuenow', porcentaje);
    elementos.progresoRevision.textContent = `${porcentaje}%`;
    
    // Actualizar clase según progreso
    elementos.progresoRevision.className = 'progress-bar progress-bar-striped progress-bar-animated';
    if (porcentaje === 100) {
        elementos.progresoRevision.classList.add('bg-success');
    } else if (porcentaje >= 50) {
        elementos.progresoRevision.classList.add('bg-info');
    } else {
        elementos.progresoRevision.classList.add('bg-warning');
    }
}

function getBadgeClass(estado) {
    return {
        'aprobada': 'bg-success',
        'rechazada': 'bg-danger',
        'pendiente': 'bg-warning text-dark'
    }[estado] || 'bg-secondary';
}

function getEstadoText(estado) {
    return {
        'aprobada': 'Aprobada',
        'rechazada': 'Rechazada',
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
    const toast = new bootstrap.Toast(toastEl);
    toast.show();
}

function mostrarExito(mensaje) {
    const toastEl = document.getElementById('success-toast');
    const toastBody = toastEl.querySelector('.toast-body');
    toastBody.textContent = mensaje;
    const toast = new bootstrap.Toast(toastEl);
    toast.show();
}

// Inicializar la aplicación
function init() {
    configurarUsuario();
    configurarEventos();
    cargarSolicitudes();
}

init();