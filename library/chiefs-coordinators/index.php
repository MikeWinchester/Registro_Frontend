<?php
session_start();

$allowedRoles = ['Jefe', 'Coordinador'];
$userRoles = $_SESSION['user_roles'] ?? [];

if (empty($userRoles)) {
    header('Location: ../login/index.php');
    exit;
}

if (!array_intersect($allowedRoles, $userRoles)) {
    die(header('Location: ../login/forbidden.php'));
}
?>
<!DOCTYPE html>
<html lang="es" user-id='<?php echo $_SESSION['user_id']?>' user-name='<?php echo $_SESSION['user_name']?>'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual Universitaria - Panel Administrativo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="/library/chiefs-coordinators/assets/css/styles.css">
    <style>
        /* Estilos adicionales para modales */
        #modalCerrarSesion .modal-dialog,
        #modal-confirmar-eliminar .modal-dialog {
            max-width: 400px;
            margin: 1.75rem auto;
        }

        #modalCerrarSesion .modal-content,
        #modal-confirmar-eliminar .modal-content {
            padding: 1rem;
        }

        #modalCerrarSesion .modal-body,
        #modal-confirmar-eliminar .modal-body {
            padding: 1rem;
            font-size: 0.95rem;
        }

        #modalCerrarSesion .modal-footer,
        #modal-confirmar-eliminar .modal-footer {
            padding: 0.75rem 1rem;
            justify-content: center;
        }

        #modal-libro-form .modal-dialog {
            max-width: 800px;
        }

        #modal-libro-form .modal-body {
            max-height: 70vh;
            overflow-y: auto;
            padding: 1.5rem;
        }

        .file-input-container {
            margin-bottom: 1rem;
        }

        .file-input-label {
            height: 150px;
            padding: 1rem;
        }

        #previewPortada {
            max-height: 140px;
            max-width: 100%;
            object-fit: contain;
        }

        .tags-input-container {
            max-height: 120px;
            overflow-y: auto;
            padding: 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            margin-bottom: 0.5rem;
        }

        .tags-input-container .tag {
            margin-bottom: 0.25rem;
        }

        #archivo-pdf {
            margin-top: 0.5rem;
        }

        #modal-libro-form .modal-footer {
            padding: 0.75rem 1.5rem;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="bg-dark text-white py-2 fixed-top" style="background-color: #001a3d !important;">
        <div class="container-fluid px-3">
            <div class="d-flex align-items-center">
                <!-- Logo/Brand -->
                <div class="d-flex align-items-center me-3">
                    <img src="https://www.unah.edu.hn/themes/portalunah-new/assets/images/logo-unah-blanco.png" alt="Logo UNAH" style="height: 40px;" class="me-2">
                    <span class="fs-4 fw-bold" style="color: #ffcc00;">Panel Administrativo</span>
                </div>
                
                <!-- Barra de búsqueda -->
                <div class="flex-grow-1 mx-3 d-none d-md-block">
                    <div class="input-group" style="max-width: 500px;">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-secondary"></i>
                        </span>
                        <input type="text" id="buscador" class="form-control border-start-0" placeholder="Buscar libros..." style="padding-left: 0;">
                        <button class="btn btn-warning" type="button" id="boton-buscar" style="background-color: #ffcc00;">
                            Buscar
                        </button>
                    </div>
                </div>
                
                <!-- Iconos de acción -->
                <div class="d-flex align-items-center gap-3">
                    <!-- Botón agregar libro -->
                    <button class="btn btn-success d-flex align-items-center" id="btn-agregar-libro">
                        <i class="bi bi-plus-lg me-1"></i>
                        <span class="d-none d-lg-inline">Agregar Libro</span>
                    </button>
                    
                    <!-- Dropdown de perfil -->
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle d-flex align-items-center gap-2" 
                                id="dropdownPerfil" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
                            <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 36px; height: 36px; background-color: #ffcc00;">
                                <i class="bi bi-person-fill text-dark"></i>
                            </div>
                            <span id="nombre-usuario" class="d-none d-lg-inline"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownPerfil">
                            <li><a class="dropdown-item" href="#" id="btn-cerrar-sesion">
                                <i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión
                            </a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Botón de búsqueda para móviles -->
                <button class="btn btn-light d-md-none ms-2 rounded-circle" type="button" id="btn-toggle-search" style="width: 40px; height: 40px;">
                    <i class="bi bi-search"></i>
                </button>
            </div>
            
            <!-- Barra de búsqueda para móviles (oculta inicialmente) -->
            <div class="d-md-none mt-2" id="mobile-search-container" style="display: none;">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar libros..." id="buscador-mobile">
                    <button class="btn btn-warning" type="button" id="boton-buscar-mobile" style="background-color: #ffcc00;">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="container mt-1 pt-2">
        <div class="row">
            <!-- Filtros (columna izquierda) -->
            <div class="col-lg-3 col-md-4 mb-4 filters-column">
                <div class="card sticky-top">
                    <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #001a3d; color: white;">
                        <h5 class="mb-0"><i class="bi bi-funnel me-2"></i>Filtrar por categorías</h5>
                        <button class="btn btn-sm btn-outline-light" id="limpiar-filtros">
                            <i class="bi bi-x-circle me-1"></i> Limpiar
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2" id="filtros-tags">
                            <!-- Los tags se generarán con JavaScript -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resultados (columna derecha) -->
            <div class="col-lg-9 col-md-8">
                <div class="card lista-libros">
                    <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-book me-2"></i>Libros disponibles</h5>
                        <div id="contador-libros" class="badge rounded-pill" style="background-color: #001a3d;">0 libros</div>
                    </div>
                    <div class="card-body libros-scrollable">
                        <div id="libros-container" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                            <!-- Los libros se generarán con JavaScript -->
                        </div>

                        <!-- Paginación -->
                        <nav aria-label="Paginación de libros" class="mt-4">
                            <ul class="pagination justify-content-center" id="paginacion">
                                <!-- La paginación se generará con JavaScript -->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal para visualizar el libro -->
    <div class="modal fade" id="modal-libro" tabindex="-1" aria-labelledby="modal-libro-label" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #001a3d; color: white;">
                    <h5 class="modal-title" id="modal-libro-label"><i class="bi bi-book me-2"></i>Visualizador de libro</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="height: 70vh; padding: 0;">
                    <iframe id="visor-pdf" src="" style="width: 100%; height: 100%; border: none;"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para agregar/editar libro -->
    <div class="modal fade" id="modal-libro-form" tabindex="-1" aria-labelledby="modal-libro-form-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #001a3d; color: white;">
                    <h5 class="modal-title" id="modal-libro-form-label"><i class="bi bi-book me-2"></i><span id="modal-libro-titulo">Agregar Nuevo Libro</span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-libro">
                        <input type="hidden" id="libro-id" value="">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título del Libro*</label>
                            <input type="text" class="form-control" id="titulo" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" rows="3"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Autores*</label>
                            <div class="tags-input-container" id="autores-container">
                                <input type="text" id="input-autor" class="form-control" placeholder="Escribe un autor y presiona Enter">
                            </div>
                            <small class="text-muted">Presiona Enter después de escribir cada autor</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Categorías/Tags*</label>
                            <div class="tags-input-container" id="tags-container">
                                <input type="text" id="input-tag" class="form-control" placeholder="Escribe una categoría y presiona Enter">
                            </div>
                            <small class="text-muted">Presiona Enter después de escribir cada categoría</small>
                        </div>
                        
                        <div class="mb-3 file-input-container">
                            <label class="form-label">Portada del Libro</label>
                            <label for="portada" class="file-input-label" id="file-input-label">
                                <img id="previewPortada" src="" alt="Vista previa de la portada" style="display: none;">
                                <i class="bi bi-image fs-1" id="portada-icon"></i>
                                <small id="portada-text">Haz clic para seleccionar una imagen</small>
                            </label>
                            <input type="file" class="form-control d-none" id="portada" accept="image/*">
                        </div>
                        
                        <div class="mb-3 file-input-container">
                            <label for="archivo-pdf" class="form-label">Archivo PDF*</label>
                            <input type="file" class="form-control" id="archivo-pdf" accept=".pdf" required>
                            <small id="pdf-text" class="text-muted"></small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btn-guardar-libro">Guardar Libro</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación de eliminación -->
    <div class="modal fade" id="modal-confirmar-eliminar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro que deseas eliminar este libro? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btn-confirmar-eliminar">Eliminar Libro</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación de cierre de sesión -->
    <div class="modal fade" id="modalCerrarSesion" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar cierre de sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro que deseas cerrar la sesión?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmar-cierre-sesion">Cerrar sesión</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JS personalizado -->
    <script type="module" src="/library/chiefs-coordinators/assets/js/controller.js"></script>
    <script>
        // Ajustar el modal del formulario cuando se muestra
        document.getElementById('modal-libro-form').addEventListener('shown.bs.modal', function () {
            const modalBody = this.querySelector('.modal-body');
            modalBody.style.maxHeight = `calc(100vh - ${this.querySelector('.modal-header').offsetHeight + this.querySelector('.modal-footer').offsetHeight + 60}px)`;
        });

        // Ajustar el modal de confirmación cuando se muestra
        document.getElementById('modalCerrarSesion').addEventListener('shown.bs.modal', function () {
            this.querySelector('.modal-dialog').style.maxWidth = '400px';
        });

        document.getElementById('modal-confirmar-eliminar').addEventListener('shown.bs.modal', function () {
            this.querySelector('.modal-dialog').style.maxWidth = '400px';
        });
    </script>
</body>
</html>