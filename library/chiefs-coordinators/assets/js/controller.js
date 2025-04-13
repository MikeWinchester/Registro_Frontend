import loadEnv from "../../../../assets/js/getEnv.mjs";
const env = await loadEnv();

const authToken = localStorage.getItem("authToken");

const htmlElement = document.documentElement;
const userId = htmlElement.getAttribute('user-id');
const userName = htmlElement.getAttribute('user-name');

// Variables para almacenar datos
let libros = [];
let todasLasCategorias = [];
let tagsSeleccionados = new Set();
let libroActual = null;

// Configuración de paginación
const librosPorPagina = 6;
let paginaActual = 1;
let totalPaginas = 1;
let totalLibros = 0;

// Elementos del DOM
const buscador = document.getElementById('buscador');
const botonBuscar = document.getElementById('boton-buscar');
const librosContainer = document.getElementById('libros-container');
const contadorLibros = document.getElementById('contador-libros');
const filtrosTags = document.getElementById('filtros-tags');
const paginacion = document.getElementById('paginacion');
const modalLibro = new bootstrap.Modal(document.getElementById('modal-libro'));
const visorPdf = document.getElementById('visor-pdf');
const nombreUsuario = document.getElementById('nombre-usuario');
const btnCerrarSesion = document.getElementById('btn-cerrar-sesion');
const modalCerrarSesion = new bootstrap.Modal(document.getElementById('modalCerrarSesion'));
const confirmarCierre = document.getElementById('confirmar-cierre-sesion');
const limpiarFiltros = document.getElementById('limpiar-filtros');
const btnAgregarLibro = document.getElementById('btn-agregar-libro');
const modalLibroForm = new bootstrap.Modal(document.getElementById('modal-libro-form'));
const modalTitulo = document.getElementById('modal-libro-titulo');
const formLibro = document.getElementById('form-libro');
const btnGuardarLibro = document.getElementById('btn-guardar-libro');
const modalConfirmarEliminar = new bootstrap.Modal(document.getElementById('modal-confirmar-eliminar'));
const btnConfirmarEliminar = document.getElementById('btn-confirmar-eliminar');

// Inicializar la aplicación
async function init() {
    nombreUsuario.textContent = userName;
    
    try {
        // Cargar datos iniciales
        const librosData = await obtenerDatosLibros();
        
        if (librosData.categorias && librosData.categorias.length) {
            todasLasCategorias = [...new Set(librosData.categorias.map(cat => cat.nombre))];
            generarFiltrosTags();
        }
        
        configurarEventos();
        
        if (libros.length > 0) {
            renderizarLibros();
            renderizarPaginacion();
            actualizarEstadoPaginacion();
        } else {
            mostrarMensajeNoResultados();
        }
    } catch (error) {
        console.error('Error al iniciar:', error);
        mostrarErrorCarga('No se pudieron cargar los datos iniciales');
    }
}

// Obtener datos de libros desde el endpoint
async function obtenerDatosLibros(pagina = 1, terminoBusqueda = '') {
    try {
        const url = new URL(`${env.API_URL}/books`);
        url.searchParams.append('pagina', pagina);
        url.searchParams.append('porPagina', librosPorPagina);
        
        if (terminoBusqueda) {
            url.searchParams.append('busqueda', terminoBusqueda);
        }
        
        if (tagsSeleccionados.size > 0) {
            tagsSeleccionados.forEach(tag => {
                url.searchParams.append('categorias[]', tag);
            });
        }
        
        const response = await fetch(url.toString(), {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });
        
        if (!response.ok) {
            const errorData = await response.json().catch(() => ({}));
            throw new Error(errorData.message || 'Error al obtener los libros');
        }
        
        const data = await response.json();
        
        if (!data.libros || !Array.isArray(data.libros)) {
            throw new Error('Formato de respuesta inválido');
        }
        
        libros = data.libros.map(libro => ({
            id: libro.id,
            titulo: libro.titulo,
            descripcion: libro.descripcion || '',
            autores: libro.autores || [],
            tags: libro.categorias || [],
            archivo: `${env.API_URL}/books/${libro.id}/file/pdf`,
            imagen: `${env.API_URL}/books/${libro.id}/file/portada`,
        }));
        
        totalLibros = data.total || 0;
        totalPaginas = data.total_paginas || 1;
        paginaActual = data.pagina_actual || 1;
        
        contadorLibros.textContent = `${totalLibros} ${totalLibros === 1 ? 'libro' : 'libros'}`;
        
        return data;
    } catch (error) {
        console.error('Error en obtenerDatosLibros:', error);
        mostrarErrorCarga(error.message);
        throw error;
    }
}

// Mostrar error de carga
function mostrarErrorCarga(mensaje = '') {
    librosContainer.innerHTML = `
        <div class="col-12 text-center py-5">
            <div class="empty-state">
                <i class="bi bi-exclamation-triangle" style="font-size: 3rem; color: #dc3545;"></i>
                <h5 class="mt-3">Error al cargar los libros</h5>
                <p class="text-muted">${mensaje || 'Por favor, intenta nuevamente más tarde.'}</p>
                <button class="btn btn-primary mt-2" onclick="location.reload()">
                    <i class="bi bi-arrow-clockwise"></i> Reintentar
                </button>
            </div>
        </div>
    `;
    paginacion.innerHTML = '';
}

// Configurar eventos
function configurarEventos() {
    // Búsqueda con debounce
    let timerBusqueda;
    buscador.addEventListener('input', function() {
        clearTimeout(timerBusqueda);
        timerBusqueda = setTimeout(() => {
            filtrarYRenderizarLibros(this.value);
        }, 500);
    });
    
    botonBuscar.addEventListener('click', function() {
        filtrarYRenderizarLibros(buscador.value);
    });
    
    // Filtros por tags
    filtrosTags.addEventListener('click', function(e) {
        if (e.target.classList.contains('tag-filter')) {
            const tag = e.target.dataset.tag;
            
            if (tagsSeleccionados.has(tag)) {
                tagsSeleccionados.delete(tag);
                e.target.classList.remove('active');
            } else {
                tagsSeleccionados.add(tag);
                e.target.classList.add('active');
            }
            
            filtrarYRenderizarLibros(buscador.value);
        }
    });
    
    // Eventos delegados
    document.addEventListener('click', async function(e) {
        // Botones de ver libro
        if (e.target.classList.contains('ver-libro') || e.target.closest('.ver-libro')) {
            const boton = e.target.classList.contains('ver-libro') ? e.target : e.target.closest('.ver-libro');
            const archivo = boton.dataset.archivo;
            
            visorPdf.src = archivo;
            modalLibro.show();
        }
        
        // Botones de editar libro
        if (e.target.closest('.btn-editar')) {
            const boton = e.target.closest('.btn-editar');
            const id = boton.dataset.id;
            libroActual = libros.find(l => l.id === id);
            
            if (libroActual) {
                abrirModalEditar(libroActual);
            }
        }
        
        // Botones de eliminar libro
        if (e.target.closest('.btn-eliminar')) {
            const boton = e.target.closest('.btn-eliminar');
            const id = boton.dataset.id;
            libroActual = libros.find(l => l.id === id);
            
            if (libroActual) {
                modalConfirmarEliminar.show();
            }
        }
    });
    
    // Paginación
    paginacion.addEventListener('click', async function(e) {
        if (e.target.closest('.page-link')) {
            e.preventDefault();
            const link = e.target.closest('.page-link');
            
            if (link.parentElement.classList.contains('disabled')) return;
            
            let nuevaPagina = paginaActual;
            
            if (link.dataset.action === 'prev') {
                nuevaPagina = Math.max(1, paginaActual - 1);
            } else if (link.dataset.action === 'next') {
                nuevaPagina = Math.min(totalPaginas, paginaActual + 1);
            } else if (link.dataset.page) {
                nuevaPagina = parseInt(link.dataset.page);
            }
            
            if (nuevaPagina !== paginaActual) {
                try {
                    await obtenerDatosLibros(nuevaPagina, buscador.value);
                    renderizarLibros();
                    actualizarEstadoPaginacion();
                    
                    window.scrollTo({
                        top: librosContainer.offsetTop - 20,
                        behavior: 'smooth'
                    });
                } catch (error) {
                    console.error('Error al cambiar de página:', error);
                }
            }
        }
    });
    
    // Botón agregar libro
    btnAgregarLibro.addEventListener('click', function() {
        libroActual = null;
        abrirModalNuevo();
    });
    
    // Botón guardar libro
    btnGuardarLibro.addEventListener('click', async function() {
        await guardarLibro();
    });
    
    // Botón confirmar eliminar
    btnConfirmarEliminar.addEventListener('click', async function() {
        await eliminarLibro();
    });
    
    // Input de autores
    document.getElementById('input-autor').addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && this.value.trim()) {
            e.preventDefault();
            agregarTag(this.value.trim(), 'autores-container', 'input-autor');
            this.value = '';
        }
    });
    
    // Input de tags
    document.getElementById('input-tag').addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && this.value.trim()) {
            e.preventDefault();
            agregarTag(this.value.trim(), 'tags-container', 'input-tag');
            this.value = '';
        }
    });
    
    // Input de portada
    document.getElementById('portada').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('previewPortada');
                preview.src = event.target.result;
                preview.style.display = 'block';
                document.getElementById('portada-icon').style.display = 'none';
                document.getElementById('portada-text').textContent = file.name;
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Input de archivo PDF
    document.getElementById('archivo-pdf').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            document.getElementById('pdf-text').textContent = file.name;
        }
    });
    
    // Otros eventos
    btnCerrarSesion.addEventListener('click', function(e) {
        e.preventDefault();
        modalCerrarSesion.show();
    });
    
    confirmarCierre.addEventListener('click', function() {
        modalCerrarSesion.hide();
        localStorage.removeItem('authToken');
        window.location.href = "/library/login/logout.php";
    });
    
    limpiarFiltros.addEventListener('click', function() {
        tagsSeleccionados.clear();
        document.querySelectorAll('.tag-filter').forEach(btn => {
            btn.classList.remove('active');
        });
        buscador.value = '';
        filtrarYRenderizarLibros();
        
        this.innerHTML = '<i class="bi bi-check-circle me-1"></i> Limpiado';
        setTimeout(() => {
            this.innerHTML = '<i class="bi bi-x-circle me-1"></i> Limpiar';
        }, 2000);
    });
}

// Generar filtros de tags
function generarFiltrosTags() {
    filtrosTags.innerHTML = todasLasCategorias.map(tag => `
        <button class="btn btn-sm btn-outline-primary tag-filter" data-tag="${tag}">
            ${tag}
        </button>
    `).join('');
}

// Filtrar y renderizar libros
async function filtrarYRenderizarLibros(terminoBusqueda = '') {
    try {
        await obtenerDatosLibros(1, terminoBusqueda);
        
        if (libros.length === 0) {
            mostrarMensajeNoResultados();
        } else {
            renderizarLibros();
            renderizarPaginacion();
            actualizarEstadoPaginacion();
        }
    } catch (error) {
        console.error('Error al filtrar libros:', error);
        mostrarMensajeNoResultados();
    }
}

// Mostrar mensaje sin resultados
function mostrarMensajeNoResultados() {
    librosContainer.innerHTML = `
        <div class="col-12 text-center py-5">
            <div class="empty-state">
                <i class="bi bi-search" style="font-size: 3rem; color: #6c757d;"></i>
                <h5 class="mt-3">No se encontraron libros</h5>
                <p class="text-muted">Prueba con otros filtros o términos de búsqueda</p>
            </div>
        </div>
    `;
    paginacion.innerHTML = '';
}

// Renderizar los libros
function renderizarLibros() {
    librosContainer.innerHTML = libros.map(libro => `
        <div class="col libro-card" data-id="${libro.id}" data-tags="${libro.tags.join(',')}">
            <div class="card h-100 shadow-sm">
                <div class="card-img-top libro-imagen" style="background-color: #f8f9fa;">
                    <div class="libro-loading">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                    </div>
                    <img src="${libro.imagen}" 
                         onload="this.style.opacity = '1'; this.parentNode.querySelector('.libro-loading').style.display = 'none';" 
                         style="width: auto; height: auto; max-width: 100%; max-height: 100%; object-fit: contain; opacity: 0; transition: opacity 0.3s;"
                         onerror="this.src='/biblioteca/assets/images/book-cover-placeholder.png'" 
                         alt="${libro.titulo}">
                    <div class="tags-container">
                        ${libro.tags.map(tag => `<span class="badge bg-primary me-1">${tag}</span>`).join('')}
                    </div>
                    <div class="admin-actions">
                        <button class="btn btn-warning btn-admin btn-editar" data-id="${libro.id}" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-admin btn-eliminar" data-id="${libro.id}" title="Eliminar">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">${libro.titulo}</h5>
                    <p class="card-text text-muted">
                        <small>
                            <i class="bi bi-person me-1"></i>
                            ${libro.autores.join(', ')}
                        </small>
                    </p>
                </div>
                <div class="card-footer bg-transparent">
                    <button class="btn btn-sm btn-outline-primary ver-libro" 
                            data-id="${libro.id}" 
                            data-archivo="${libro.archivo}">
                        <i class="bi bi-eye me-1"></i> Ver libro
                    </button>
                </div>
            </div>
        </div>
    `).join('');
}

// Renderizar paginación
function renderizarPaginacion() {
    if (totalPaginas <= 1) {
        paginacion.innerHTML = '';
        return;
    }
    
    let paginacionHTML = `
        <li class="page-item">
            <a class="page-link" href="#" data-action="prev">
                <i class="bi bi-chevron-left"></i>
            </a>
        </li>
    `;
    
    const paginasMostrar = [];
    const rango = 2;
    let inicio = Math.max(1, paginaActual - rango);
    let fin = Math.min(totalPaginas, paginaActual + rango);
    
    if (paginaActual - rango > 1) {
        paginasMostrar.push(1);
        if (paginaActual - rango > 2) {
            paginasMostrar.push('...');
        }
    }
    
    for (let i = inicio; i <= fin; i++) {
        paginasMostrar.push(i);
    }
    
    if (paginaActual + rango < totalPaginas) {
        if (paginaActual + rango < totalPaginas - 1) {
            paginasMostrar.push('...');
        }
        paginasMostrar.push(totalPaginas);
    }
    
    paginasMostrar.forEach(pagina => {
        if (pagina === '...') {
            paginacionHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        } else {
            paginacionHTML += `
                <li class="page-item ${pagina === paginaActual ? 'active' : ''}">
                    <a class="page-link" href="#" data-page="${pagina}">${pagina}</a>
                </li>
            `;
        }
    });
    
    paginacionHTML += `
        <li class="page-item">
            <a class="page-link" href="#" data-action="next">
                <i class="bi bi-chevron-right"></i>
            </a>
        </li>
    `;
    
    paginacion.innerHTML = paginacionHTML;
    actualizarEstadoPaginacion();
}

// Actualizar estado de paginación
function actualizarEstadoPaginacion() {
    const pageLinks = paginacion.querySelectorAll('.page-link');
    
    pageLinks.forEach(link => {
        link.parentElement.classList.remove('active', 'disabled');
    });
    
    pageLinks.forEach(link => {
        if (link.dataset.page && parseInt(link.dataset.page) === paginaActual) {
            link.parentElement.classList.add('active');
        }
    });
    
    const prevBtn = paginacion.querySelector('[data-action="prev"]');
    if (prevBtn) {
        prevBtn.parentElement.classList.toggle('disabled', paginaActual === 1);
    }
    
    const nextBtn = paginacion.querySelector('[data-action="next"]');
    if (nextBtn) {
        nextBtn.parentElement.classList.toggle('disabled', paginaActual === totalPaginas);
    }
}

// Abrir modal para nuevo libro
function abrirModalNuevo() {
    // Limpiar el formulario
    formLibro.reset();
    document.getElementById('libro-id').value = '';
    modalTitulo.textContent = 'Agregar Nuevo Libro';
    
    // Limpiar tags y autores
    document.getElementById('autores-container').innerHTML = '<input type="text" id="input-autor" class="form-control" placeholder="Escribe un autor y presiona Enter">';
    document.getElementById('tags-container').innerHTML = '<input type="text" id="input-tag" class="form-control" placeholder="Escribe una categoría y presiona Enter">';
    
    // Limpiar vista previa de portada
    document.getElementById('previewPortada').style.display = 'none';
    document.getElementById('portada-icon').style.display = 'block';
    document.getElementById('portada-text').textContent = 'Haz clic para seleccionar una imagen';
    
    // Limpiar archivo PDF
    document.getElementById('archivo-pdf').value = '';
    document.getElementById('pdf-text').textContent = 'Haz clic para seleccionar un archivo PDF';
    
    // Reconfigurar eventos de input
    document.getElementById('input-autor').addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && this.value.trim()) {
            e.preventDefault();
            agregarTag(this.value.trim(), 'autores-container', 'input-autor');
            this.value = '';
        }
    });
    
    document.getElementById('input-tag').addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && this.value.trim()) {
            e.preventDefault();
            agregarTag(this.value.trim(), 'tags-container', 'input-tag');
            this.value = '';
        }
    });
    
    modalLibroForm.show();
}

// Abrir modal para editar libro
function abrirModalEditar(libro) {
    // Configurar el formulario
    document.getElementById('libro-id').value = libro.id;
    document.getElementById('titulo').value = libro.titulo;
    document.getElementById('descripcion').value = libro.descripcion;
    modalTitulo.textContent = `Editar Libro: ${libro.titulo}`;
    
    // Configurar autores
    const autoresContainer = document.getElementById('autores-container');
    autoresContainer.innerHTML = libro.autores.map(autor => `
        <span class="tag badge bg-secondary me-1">
            ${autor}
            <span class="remove-tag ms-1" onclick="this.parentElement.remove()">&times;</span>
        </span>
    `).join('') + '<input type="text" id="input-autor" class="form-control mt-2" placeholder="Escribe un autor y presiona Enter">';
    
    // Configurar tags
    const tagsContainer = document.getElementById('tags-container');
    tagsContainer.innerHTML = libro.tags.map(tag => `
        <span class="tag badge bg-secondary me-1">
            ${tag}
            <span class="remove-tag ms-1" onclick="this.parentElement.remove()">&times;</span>
        </span>
    `).join('') + '<input type="text" id="input-tag" class="form-control mt-2" placeholder="Escribe una categoría y presiona Enter">';
    
    // Configurar vista previa de portada
    const preview = document.getElementById('previewPortada');
    preview.src = libro.imagen;
    preview.style.display = 'block';
    document.getElementById('portada-icon').style.display = 'none';
    document.getElementById('portada-text').textContent = 'Portada actual del libro';
    
    // Configurar archivo PDF
    document.getElementById('archivo-pdf').value = '';
    document.getElementById('pdf-text').textContent = 'Dejar en blanco para mantener el archivo actual';
    
    // Reconfigurar eventos de input
    document.getElementById('input-autor').addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && this.value.trim()) {
            e.preventDefault();
            agregarTag(this.value.trim(), 'autores-container', 'input-autor');
            this.value = '';
        }
    });
    
    document.getElementById('input-tag').addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && this.value.trim()) {
            e.preventDefault();
            agregarTag(this.value.trim(), 'tags-container', 'input-tag');
            this.value = '';
        }
    });
    
    modalLibroForm.show();
}

// Agregar tag (autor o categoría)
function agregarTag(valor, containerId, inputId) {
    const container = document.getElementById(containerId);
    const existingTags = Array.from(container.querySelectorAll('.tag')).map(tag => tag.textContent.replace('×', '').trim());
    
    if (!existingTags.includes(valor)) {
        const tagElement = document.createElement('span');
        tagElement.className = 'tag badge bg-secondary me-1';
        tagElement.innerHTML = `${valor} <span class="remove-tag ms-1" onclick="this.parentElement.remove()">&times;</span>`;
        
        const input = document.getElementById(inputId);
        container.insertBefore(tagElement, input);
    }
}

// Guardar libro (nuevo o edición)
async function guardarLibro() {
    // Validar formulario
    const titulo = document.getElementById('titulo').value.trim();
    if (!titulo) {
        mostrarAlerta('El título del libro es requerido', 'danger');
        return;
    }
    
    const libroId = document.getElementById('libro-id').value;
    const esNuevo = !libroId;
    
    const archivoPdf = document.getElementById('archivo-pdf').files[0];
    if (esNuevo && !archivoPdf) {
        mostrarAlerta('El archivo PDF es requerido para nuevos libros', 'danger');
        return;
    }
    
    // Obtener datos del formulario
    const descripcion = document.getElementById('descripcion').value.trim();
    
    const autores = Array.from(document.getElementById('autores-container').querySelectorAll('.tag'))
        .map(tag => tag.textContent.replace('×', '').trim());
    
    const categorias = Array.from(document.getElementById('tags-container').querySelectorAll('.tag'))
        .map(tag => tag.textContent.replace('×', '').trim());
    
    const portada = document.getElementById('portada').files[0];
    
    try {
        // Crear FormData para enviar archivos
        const formData = new FormData();
        formData.append('titulo', titulo);
        formData.append('descripcion', descripcion);
        
        // Agregar autores y categorías como JSON
        autores.forEach(autor => {
            formData.append('autores[]', autor);
        });
        
        categorias.forEach(categoria => {
            formData.append('categorias[]', categoria);
        });
        
        if (archivoPdf) {
            formData.append('archivo_pdf', archivoPdf);
        }
        
        if (portada) {
            formData.append('portada', portada);
        }
        
        let response;
        let url;
        
        if (esNuevo) {
            // Crear nuevo libro
            url = `${env.API_URL}/books`;
            response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${authToken}`
                },
                body: formData
            });
        } else {
            // Actualizar libro existente
            url = `${env.API_URL}/books/${libroId}`;
            response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${authToken}`
                },
                body: formData
            });
        }
        
        const data = await response.json();
        
        if (!response.ok) {
            throw new Error(data.message || 'Error al guardar el libro');
        }
        
        // Mostrar mensaje de éxito
        mostrarAlerta(data.message || (esNuevo ? 'Libro creado exitosamente' : 'Libro actualizado exitosamente'), 'success');
        
        // Cerrar el modal y recargar los datos
        modalLibroForm.hide();
        await filtrarYRenderizarLibros(buscador.value);
        
    } catch (error) {
        console.error('Error al guardar el libro:', error);
        mostrarAlerta(error.message || 'Error al guardar el libro', 'danger');
    }
}

// Eliminar libro
async function eliminarLibro() {
    if (!libroActual) return;
    
    try {
        const response = await fetch(`${env.API_URL}/books/${libroActual.id}`, {
            method: 'DELETE',
            headers: {
                'Authorization': `Bearer ${authToken}`,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (!response.ok) {
            throw new Error(data.message || 'Error al eliminar el libro');
        }
        
        // Mostrar mensaje de éxito
        mostrarAlerta(data.message || `Libro "${libroActual.titulo}" eliminado exitosamente`, 'success');
        
        // Cerrar el modal y recargar los datos
        modalConfirmarEliminar.hide();
        await filtrarYRenderizarLibros(buscador.value);
        
    } catch (error) {
        console.error('Error al eliminar el libro:', error);
        mostrarAlerta(error.message || 'Error al eliminar el libro', 'danger');
    }
}

// Mostrar alerta
function mostrarAlerta(mensaje, tipo = 'info') {
    const alerta = document.createElement('div');
    alerta.className = `alert alert-${tipo} alert-dismissible fade show fixed-top mx-auto mt-3`;
    alerta.style.maxWidth = '500px';
    alerta.style.zIndex = '1100';
    alerta.role = 'alert';
    alerta.innerHTML = `
        ${mensaje}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    document.body.appendChild(alerta);
    
    // Auto cerrar después de 5 segundos
    setTimeout(() => {
        const bsAlert = new bootstrap.Alert(alerta);
        bsAlert.close();
    }, 5000);
}

// Inicializar la aplicación
init();