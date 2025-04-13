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
let favoritos = [];
let guardados = [];
let todosLosLibrosDisponibles = [];

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
const btnFavoritos = document.getElementById('btn-favoritos');
const btnGuardados = document.getElementById('btn-guardados');
const contadorFavoritos = document.getElementById('contador-favoritos');
const contadorGuardados = document.getElementById('contador-guardados');
const nombreUsuario = document.getElementById('nombre-usuario');
const btnCerrarSesion = document.getElementById('btn-cerrar-sesion');
const modalCerrarSesion = new bootstrap.Modal(document.getElementById('modalCerrarSesion'));
const confirmarCierre = document.getElementById('confirmar-cierre-sesion');
const limpiarFiltros = document.getElementById('limpiar-filtros');

// Mostrar loader
function showLoader(container) {
    container.innerHTML = `
        <div class="d-flex justify-content-center align-items-center py-5">
            <div class="loader"></div>
            <span class="ms-3">Cargando...</span>
        </div>
    `;
}

// Mostrar placeholders de carga
function mostrarPlaceholders() {
    librosContainer.innerHTML = `
        <div class="col-12">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                ${Array(6).fill().map(() => `
                <div class="col">
                    <div class="card h-100">
                        <div class="loading-placeholder" style="height: 200px; border-radius: 10px 10px 0 0;"></div>
                        <div class="card-body">
                            <div class="loading-placeholder mb-2" style="height: 24px; width: 80%; border-radius: 4px;"></div>
                            <div class="loading-placeholder" style="height: 18px; width: 60%; border-radius: 4px;"></div>
                        </div>
                    </div>
                </div>
                `).join('')}
            </div>
        </div>
    `;
}

// Inicializar la aplicación
async function init() {
    nombreUsuario.textContent = userName;
    
    try {
        mostrarPlaceholders();
        
        // Cargar datos iniciales
        const [librosData, favoritosData, guardadosData] = await Promise.all([
            obtenerDatosLibros(),
            cargarFavoritos(),
            cargarGuardados()
        ]);
        
        todosLosLibrosDisponibles = [...librosData.libros];
        
        if (librosData.categorias && librosData.categorias.length) {
            todasLasCategorias = [...new Set(librosData.categorias.map(cat => cat.nombre))];
            generarFiltrosTags();
        }
        
        configurarEventos();
        actualizarContadores();
        
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
        showLoader(librosContainer);
        
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
                'Authorization': `Bearer ${authToken}`,
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
            autores: libro.autores || [],
            tags: libro.categorias || [],
            archivo: `${env.API_URL}/books/${libro.id}/file/pdf`,
            imagen: libro.portada ? `${env.API_URL}/books/${libro.id}/file/portada` : '/biblioteca/assets/images/book-cover-placeholder.png',
            imagenFallback: '/biblioteca/assets/images/book-cover-placeholder.png'
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

// Cargar favoritos desde el backend
async function cargarFavoritos() {
    try {
        const listaFavoritos = document.getElementById('lista-favoritos');
        if (listaFavoritos) showLoader(listaFavoritos);
        
        const response = await fetch(`${env.API_URL}/favorites?user_id=${userId}`, {
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${authToken}`,
                'Accept': 'application/json'
            }
        });
        
        if (!response.ok) {
            throw new Error('Error al cargar favoritos');
        }
        
        const data = await response.json();
        
        if (Array.isArray(data)) {
            favoritos = data.map(libro => libro.id);
        } else {
            favoritos = [];
        }
        
        actualizarContadores();
        return data;
    } catch (error) {
        console.error('Error al cargar favoritos:', error);
        favoritos = [];
        throw error;
    }
}

// Cargar guardados desde el backend
async function cargarGuardados() {
    try {
        const listaGuardados = document.getElementById('lista-guardados');
        if (listaGuardados) showLoader(listaGuardados);
        
        const response = await fetch(`${env.API_URL}/saved?user_id=${userId}`, {
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${authToken}`,
                'Accept': 'application/json'
            }
        });
        
        if (!response.ok) {
            throw new Error('Error al cargar guardados');
        }
        
        const data = await response.json();
        
        if (Array.isArray(data)) {
            guardados = data.map(libro => libro.id);
        } else {
            guardados = [];
        }
        
        actualizarContadores();
        return data;
    } catch (error) {
        console.error('Error al cargar guardados:', error);
        guardados = [];
        throw error;
    }
}

// Alternar favorito
async function toggleFavorito(libroId) {
    try {
        const response = await fetch(`${env.API_URL}/favorites/toggle?user_id=${userId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${authToken}`,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                libroId: libroId,
                user_id: userId
            })
        });
        
        if (!response.ok) {
            throw new Error('Error al actualizar favorito');
        }
        
        const result = await response.json();
        
        if (result.esFavorito) {
            if (!favoritos.includes(libroId)) {
                favoritos.push(libroId);
            }
        } else {
            favoritos = favoritos.filter(id => id !== libroId);
        }
        
        actualizarContadores();
        actualizarBotonesLibro(libroId);
        return result.esFavorito;
        
    } catch (error) {
        console.error('Error en toggleFavorito:', error);
        throw error;
    }
}

// Alternar guardado
async function toggleGuardado(libroId) {
    try {
        const response = await fetch(`${env.API_URL}/saved/toggle?user_id=${userId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${authToken}`,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                libroId: libroId,
                user_id: userId
            })
        });
        
        if (!response.ok) {
            throw new Error('Error al actualizar guardado');
        }
        
        const result = await response.json();
        
        if (result.esGuardado) {
            if (!guardados.includes(libroId)) {
                guardados.push(libroId);
            }
        } else {
            guardados = guardados.filter(id => id !== libroId);
        }
        
        actualizarContadores();
        actualizarBotonesLibro(libroId);
        return result.esGuardado;
        
    } catch (error) {
        console.error('Error en toggleGuardado:', error);
        throw error;
    }
}

// Actualizar botones de un libro específico
function actualizarBotonesLibro(libroId) {
    const libroCard = document.querySelector(`.libro-card[data-id="${libroId}"]`);
    if (libroCard) {
        const btnFavorito = libroCard.querySelector('.btn-favorito');
        const btnGuardar = libroCard.querySelector('.btn-guardar');
        
        if (btnFavorito) {
            btnFavorito.classList.toggle('activo', favoritos.includes(libroId));
            const icono = btnFavorito.querySelector('i');
            icono.className = favoritos.includes(libroId) ? 'bi bi-heart-fill' : 'bi bi-heart';
        }
        
        if (btnGuardar) {
            btnGuardar.classList.toggle('activo', guardados.includes(libroId));
            const icono = btnGuardar.querySelector('i');
            icono.className = guardados.includes(libroId) ? 'bi bi-bookmark-fill' : 'bi bi-bookmark';
        }
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
                <button class="btn btn-primary mt-2" onclick="location.reload()" style="background-color: #001a3d; border-color: #001a3d;">
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
        // Botones de favorito
        if (e.target.closest('.btn-favorito')) {
            const boton = e.target.closest('.btn-favorito');
            const id = boton.dataset.id;
            const libro = libros.find(l => l.id === id) || 
                          todosLosLibrosDisponibles.find(l => l.id === id);
            
            if (!libro) return;
            
            try {
                boton.disabled = true;
                const icono = boton.querySelector('i');
                icono.className = 'bi bi-arrow-repeat';
                
                const esFavorito = await toggleFavorito(id);
                
                boton.classList.toggle('activo', esFavorito);
                icono.className = esFavorito ? 'bi bi-heart-fill' : 'bi bi-heart';
                
            } catch (error) {
                console.error('Error al actualizar favorito:', error);
                const eraFavorito = favoritos.includes(id);
                boton.classList.toggle('activo', eraFavorito);
                icono.className = eraFavorito ? 'bi bi-heart-fill' : 'bi bi-heart';
            } finally {
                boton.disabled = false;
            }
        }
        
        // Botones de guardar
        if (e.target.closest('.btn-guardar')) {
            const boton = e.target.closest('.btn-guardar');
            const id = boton.dataset.id;
            const libro = libros.find(l => l.id === id) || 
                          todosLosLibrosDisponibles.find(l => l.id === id);
            
            if (!libro) return;
            
            try {
                boton.disabled = true;
                const icono = boton.querySelector('i');
                icono.className = 'bi bi-arrow-repeat';
                
                const esGuardado = await toggleGuardado(id);
                
                boton.classList.toggle('activo', esGuardado);
                icono.className = esGuardado ? 'bi bi-bookmark-fill' : 'bi bi-bookmark';
                
            } catch (error) {
                console.error('Error al actualizar guardado:', error);
                const eraGuardado = guardados.includes(id);
                boton.classList.toggle('activo', eraGuardado);
                icono.className = eraGuardado ? 'bi bi-bookmark-fill' : 'bi bi-bookmark';
            } finally {
                boton.disabled = false;
            }
        }
        
        // Botones de ver libro
        if (e.target.closest('.btn-ver-libro') || e.target.closest('.ver-libro')) {
            const boton = e.target.closest('.btn-ver-libro') || e.target.closest('.ver-libro');
            const archivo = boton.dataset.archivo;
            
            // Mostrar spinner en el botón
            const spinner = boton.querySelector('.spinner-border');
            if (spinner) {
                spinner.classList.remove('d-none');
            }
            boton.disabled = true;
            
            // Configurar el iframe
            visorPdf.style.width = '100%';
            visorPdf.style.height = '100%';
            visorPdf.style.border = 'none';
            
            // Cargar el PDF con parámetros para ocultar controles
            visorPdf.src = `${archivo}#toolbar=0&navpanes=0`;
            
            // Configurar protección contra descarga (limitada por políticas de seguridad)
            visorPdf.onload = function() {
                try {
                    // Intentar deshabilitar el menú contextual
                    visorPdf.contentDocument.oncontextmenu = function() {
                        return false;
                    };
                    
                    // Intentar ocultar elementos de descarga
                    setTimeout(() => {
                        try {
                            const iframeDoc = visorPdf.contentDocument || visorPdf.contentWindow.document;
                            const downloadElements = iframeDoc.querySelectorAll('[download], [type="download"]');
                            downloadElements.forEach(el => el.style.display = 'none');
                        } catch (e) {
                            console.log("No se puede modificar el contenido del PDF");
                        }
                    }, 1000);
                } catch (error) {
                    console.log("Restricciones de seguridad del navegador");
                }
                
                // Ocultar spinner y mostrar modal
                if (spinner) {
                    spinner.classList.add('d-none');
                }
                boton.disabled = false;
                modalLibro.show();
            };
        }
        
        // Botones de eliminar en offcanvas
        if (e.target.closest('.btn-remove')) {
            const boton = e.target.closest('.btn-remove');
            const id = boton.dataset.id;
            const accion = boton.dataset.action;
            const libro = todosLosLibrosDisponibles.find(l => l.id === id);
            
            if (!libro) return;
            
            try {
                boton.disabled = true;
                
                if (accion === 'favorito') {
                    await toggleFavorito(id);
                } else if (accion === 'guardado') {
                    await toggleGuardado(id);
                }
                
                const item = boton.closest('.libro-offcanvas');
                item.style.transition = 'all 0.3s ease';
                item.style.opacity = '0';
                setTimeout(() => {
                    actualizarListas();
                }, 300);
            } catch (error) {
                console.error('Error al eliminar:', error);
                boton.disabled = false;
            }
        }
        
        // Botones de toggle en las listas
        if (e.target.closest('.toggle-from-list')) {
            const boton = e.target.closest('.toggle-from-list');
            const id = boton.dataset.id;
            const accion = boton.dataset.action;
            const libro = todosLosLibrosDisponibles.find(l => l.id === id);
            
            if (!libro) return;
            
            try {
                boton.disabled = true;
                const icono = boton.querySelector('i');
                icono.className = 'bi bi-arrow-repeat';
                
                if (accion === 'guardar') {
                    const esGuardado = await toggleGuardado(id);
                    boton.classList.toggle('activo', esGuardado);
                    icono.className = esGuardado ? 'bi bi-bookmark-fill' : 'bi bi-bookmark';
                } else if (accion === 'favorito') {
                    const esFavorito = await toggleFavorito(id);
                    boton.classList.toggle('activo', esFavorito);
                    icono.className = esFavorito ? 'bi bi-heart-fill' : 'bi bi-heart';
                }
                
            } catch (error) {
                console.error('Error al actualizar:', error);
                if (accion === 'guardar') {
                    const eraGuardado = guardados.includes(id);
                    boton.classList.toggle('activo', eraGuardado);
                    icono.className = eraGuardado ? 'bi bi-bookmark-fill' : 'bi bi-bookmark';
                } else {
                    const eraFavorito = favoritos.includes(id);
                    boton.classList.toggle('activo', eraFavorito);
                    icono.className = eraFavorito ? 'bi bi-heart-fill' : 'bi bi-heart';
                }
            } finally {
                boton.disabled = false;
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
    
    // Otros eventos
    btnFavoritos.addEventListener('click', async function() {
        try {
            await cargarFavoritos();
            actualizarListas();
            new bootstrap.Offcanvas(document.getElementById('offcanvasFavoritos')).show();
        } catch (error) {
            console.error('Error al cargar favoritos:', error);
        }
    });
    
    btnGuardados.addEventListener('click', async function() {
        try {
            await cargarGuardados();
            actualizarListas();
            new bootstrap.Offcanvas(document.getElementById('offcanvasGuardados')).show();
        } catch (error) {
            console.error('Error al cargar guardados:', error);
        }
    });
    
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
        <button class="btn btn-sm btn-outline-primary tag-filter" data-tag="${tag}" style="border-color: #001a3d; color: #001a3d;">
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
                         onload="this.style.opacity = '1'; this.parentNode.querySelector('.libro-loading').style.display = 'none'; this.closest('.libro-card').querySelector('.btn-ver-libro').disabled = false;" 
                         style="width: auto; height: auto; max-width: 100%; max-height: 100%; object-fit: contain; opacity: 0; transition: opacity 0.3s;"
                         onerror="this.src='${libro.imagenFallback}'" 
                         alt="${libro.titulo}">
                    <div class="tags-container">
                        ${libro.tags.map(tag => `<span class="badge me-1" style="background-color: #001a3d;">${tag}</span>`).join('')}
                    </div>
                    <button class="btn-accion-libro btn-favorito ${favoritos.includes(libro.id) ? 'activo' : ''}" 
                            data-id="${libro.id}">
                        <i class="bi ${favoritos.includes(libro.id) ? 'bi-heart-fill' : 'bi-heart'}"></i>
                    </button>
                    <button class="btn-accion-libro btn-guardar ${guardados.includes(libro.id) ? 'activo' : ''}" 
                            data-id="${libro.id}">
                        <i class="bi ${guardados.includes(libro.id) ? 'bi-bookmark-fill' : 'bi-bookmark'}"></i>
                    </button>
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
                    <button class="btn btn-sm btn-outline-primary btn-ver-libro" disabled data-id="${libro.id}" data-archivo="${libro.archivo}" style="border-color: #001a3d; color: #001a3d;">
                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
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

// Actualizar listas de favoritos/guardados
async function actualizarListas() {
    try {
        const [favoritosData, guardadosData] = await Promise.all([
            cargarFavoritos(),
            cargarGuardados()
        ]);
        
        favoritos = favoritosData.map(libro => libro.id);
        guardados = guardadosData.map(libro => libro.id);
        
        const listaFavoritos = document.getElementById('lista-favoritos');
        const listaGuardados = document.getElementById('lista-guardados');
        
        const favoritosItems = favoritosData.map(libroFav => {
            const libroCompleto = todosLosLibrosDisponibles.find(l => l.id === libroFav.id) || libroFav;
            return crearItemLista({
                id: libroFav.id,
                titulo: libroCompleto.titulo || libroFav.titulo,
                autores: libroCompleto.autores || libroFav.autores || [],
                archivo: `${env.API_URL}/books/${libroFav.id}/file/pdf`,
                esGuardado: guardados.includes(libroFav.id)
            }, 'favorito');
        }).join('') || '<p class="text-muted p-3">No tienes libros favoritos</p>';
        
        const guardadosItems = guardadosData.map(libroGuardado => {
            const libroCompleto = todosLosLibrosDisponibles.find(l => l.id === libroGuardado.id) || libroGuardado;
            return crearItemLista({
                id: libroGuardado.id,
                titulo: libroCompleto.titulo || libroGuardado.titulo,
                autores: libroCompleto.autores || libroGuardado.autores || [],
                archivo: `${env.API_URL}/books/${libroGuardado.id}/file/pdf`,
                esFavorito: favoritos.includes(libroGuardado.id)
            }, 'guardado');
        }).join('') || '<p class="text-muted p-3">No tienes libros guardados</p>';
        
        listaFavoritos.innerHTML = favoritosItems;
        listaGuardados.innerHTML = guardadosItems;
        
        actualizarContadores();
    } catch (error) {
        console.error('Error al actualizar listas:', error);
    }
}

// Crear item para listas
function crearItemLista(libro, tipo) {
    const esFavorito = tipo === 'favorito' || libro.esFavorito;
    const esGuardado = tipo === 'guardado' || libro.esGuardado;
    
    return `
    <div class="libro-offcanvas">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h6>${libro.titulo}</h6>
                <p class="text-muted small"><i class="bi bi-person"></i> ${libro.autores.join(', ')}</p>
            </div>
            <button class="btn btn-sm btn-outline-${tipo === 'favorito' ? 'danger' : 'primary'} btn-remove" 
                    data-id="${libro.id}" data-action="${tipo}">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="d-flex gap-2 mt-2">
            <button class="btn btn-sm btn-outline-primary flex-grow-1 ver-libro" 
                    data-id="${libro.id}" data-archivo="${libro.archivo}" style="border-color: #001a3d; color: #001a3d;">
                <i class="bi bi-eye me-1"></i> Ver
            </button>
            <button class="btn btn-sm btn-outline-${tipo === 'favorito' ? 'primary' : 'danger'} toggle-from-list ${tipo === 'favorito' && esGuardado ? 'activo' : tipo === 'guardado' && esFavorito ? 'activo' : ''}" 
                    data-id="${libro.id}" data-action="${tipo === 'favorito' ? 'guardar' : 'favorito'}" style="${tipo === 'favorito' ? 'border-color: #001a3d; color: #001a3d;' : 'border-color: #dc3545; color: #dc3545;'}">
                <i class="bi ${tipo === 'favorito' ? (esGuardado ? 'bi-bookmark-fill' : 'bi-bookmark') : (esFavorito ? 'bi-heart-fill' : 'bi-heart')}"></i>
            </button>
        </div>
    </div>
    `;
}

// Actualizar contadores
function actualizarContadores() {
    contadorFavoritos.textContent = favoritos.length;
    contadorGuardados.textContent = guardados.length;
}

// Inicializar la aplicación
init();