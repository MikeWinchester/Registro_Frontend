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
            const todosLosLibrosDisponibles = [...librosData.libros];
            
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
            
            const response = await fetch(url.toString());
            
            if (!response.ok) {
                const errorData = await response.json().catch(() => ({}));
                throw new Error(errorData.message || 'Error al obtener los libros');
            }
            
            const data = await response.json();
            
            if (!data.libros || !Array.isArray(data.libros)) {
                throw new Error('Formato de respuesta inválido');
            }
            
            libros = data.libros.map(libro => ({
                id: libro.libro_id,
                uuid: libro.id,
                titulo: libro.titulo,
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
                const id = parseInt(boton.dataset.id);
                libroActual = libros.find(l => l.id === id) || todosLosLibrosDisponibles.find(l => l.libro_id === id);
                
                if (libroActual) {
                    abrirModalEditar(libroActual);
                }
            }
            
            // Botones de eliminar libro
            if (e.target.closest('.btn-eliminar')) {
                const boton = e.target.closest('.btn-eliminar');
                const id = parseInt(boton.dataset.id);
                libroActual = libros.find(l => l.id === id) || todosLosLibrosDisponibles.find(l => l.libro_id === id);
                
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
        btnGuardarLibro.addEventListener('click', function() {
            guardarLibro();
        });
        
        // Botón confirmar eliminar
        btnConfirmarEliminar.addEventListener('click', function() {
            eliminarLibro();
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
        
        // Otros eventos
        btnCerrarSesion.addEventListener('click', function(e) {
            e.preventDefault();
            modalCerrarSesion.show();
        });
        
        confirmarCierre.addEventListener('click', function() {
            modalCerrarSesion.hide();
            localStorage.removeItem('authToken');
            window.location.href = "/biblioteca/login/logout.php";
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
                    <div class="card-img-top libro-imagen" 
                         style="background-image: url('${libro.imagen}')">
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
        document.getElementById('autores-container').innerHTML = '<input type="text" id="input-autor" placeholder="Escribe un autor y presiona Enter">';
        document.getElementById('tags-container').innerHTML = '<input type="text" id="input-tag" placeholder="Escribe una categoría y presiona Enter">';
        
        // Limpiar vista previa de portada
        document.getElementById('previewPortada').style.display = 'none';
        document.getElementById('portada-icon').style.display = 'block';
        document.getElementById('portada-text').textContent = 'Haz clic para seleccionar una imagen';
        
        modalLibroForm.show();
    }
    
    // Abrir modal para editar libro
    function abrirModalEditar(libro) {
        // Configurar el formulario
        document.getElementById('libro-id').value = libro.id;
        document.getElementById('titulo').value = libro.titulo;
        modalTitulo.textContent = `Editar Libro: ${libro.titulo}`;
        
        // Configurar autores
        const autoresContainer = document.getElementById('autores-container');
        autoresContainer.innerHTML = libro.autores.map(autor => `
            <span class="tag">
                ${autor}
                <span class="remove-tag" onclick="this.parentElement.remove()">&times;</span>
            </span>
        `).join('') + '<input type="text" id="input-autor" placeholder="Escribe un autor y presiona Enter">';
        
        // Configurar tags
        const tagsContainer = document.getElementById('tags-container');
        tagsContainer.innerHTML = libro.tags.map(tag => `
            <span class="tag">
                ${tag}
                <span class="remove-tag" onclick="this.parentElement.remove()">&times;</span>
            </span>
        `).join('') + '<input type="text" id="input-tag" placeholder="Escribe una categoría y presiona Enter">';
        
        // Configurar vista previa de portada
        const preview = document.getElementById('previewPortada');
        preview.src = libro.imagen;
        preview.style.display = 'block';
        document.getElementById('portada-icon').style.display = 'none';
        document.getElementById('portada-text').textContent = 'Portada actual del libro';
        
        modalLibroForm.show();
    }
    
    // Agregar tag (autor o categoría)
    function agregarTag(valor, containerId, inputId) {
        const container = document.getElementById(containerId);
        const existingTags = Array.from(container.querySelectorAll('.tag')).map(tag => tag.textContent.replace('×', '').trim());
        
        if (!existingTags.includes(valor)) {
            const tagElement = document.createElement('span');
            tagElement.className = 'tag';
            tagElement.innerHTML = `${valor} <span class="remove-tag" onclick="this.parentElement.remove()">&times;</span>`;
            
            const input = document.getElementById(inputId);
            container.insertBefore(tagElement, input);
        }
    }
    
    // Guardar libro (nuevo o edición)
    function guardarLibro() {
        // Validar formulario
        const titulo = document.getElementById('titulo').value.trim();
        if (!titulo) {
            alert('El título del libro es requerido');
            return;
        }
        
        const archivoPdf = document.getElementById('archivo-pdf').files[0];
        if (!libroActual && !archivoPdf) {
            alert('El archivo PDF es requerido');
            return;
        }
        
        // Obtener datos del formulario
        const libroId = document.getElementById('libro-id').value;
        const esNuevo = !libroId;
        
        const autores = Array.from(document.getElementById('autores-container').querySelectorAll('.tag'))
            .map(tag => tag.textContent.replace('×', '').trim());
        
        const tags = Array.from(document.getElementById('tags-container').querySelectorAll('.tag'))
            .map(tag => tag.textContent.replace('×', '').trim());
        
        const portada = document.getElementById('portada').files[0];
        
        // Aquí iría la lógica para enviar los datos al backend
        // Por ahora solo mostramos un mensaje de éxito
        const mensaje = esNuevo ? 
            'Libro creado exitosamente (simulación)' : 
            'Libro actualizado exitosamente (simulación)';
        
        alert(mensaje);
        
        // Cerrar el modal y recargar los datos
        modalLibroForm.hide();
        filtrarYRenderizarLibros(buscador.value);
    }
    
    // Eliminar libro
    function eliminarLibro() {
        if (!libroActual) return;
        
        // Aquí iría la lógica para eliminar el libro en el backend
        // Por ahora solo mostramos un mensaje de éxito
        alert(`Libro "${libroActual.titulo}" eliminado exitosamente (simulación)`);
        
        // Cerrar el modal y recargar los datos
        modalConfirmarEliminar.hide();
        filtrarYRenderizarLibros(buscador.value);
    }
    
    // Inicializar la aplicación
    init();
