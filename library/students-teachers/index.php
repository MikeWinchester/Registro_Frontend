<?php
session_start();

$allowedRoles = ['Estudiante', 'Docente'];
$userRoles = $_SESSION['user_roles'] ?? [];

if (empty($userRoles)) {
    header('Location: ../login/index.php');
    exit;
}

if (!array_intersect($allowedRoles, $userRoles)) {
    header('Location: ../chiefs-coordinators/index.php');
}
?>
<!DOCTYPE html>
<html lang="es" user-id='<?php echo $_SESSION['user_id']?>' user-name='<?php echo $_SESSION['user_name']?>'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual Universitaria</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="/library/students-teachers/assets/css/styles.css">
</head>
<body>
    <!-- Header -->
    <header class="bg-dark text-white py-2 fixed-top" style="background-color: #001a3d !important;">
        <div class="container-fluid px-3">
            <div class="d-flex align-items-center">
                <!-- Logo/Brand -->
                <div class="d-flex align-items-center me-3">
                    <img src="https://www.unah.edu.hn/themes/portalunah-new/assets/images/logo-unah-blanco.png" alt="Logo UNAH" style="height: 40px;" class="me-2">
                    <span class="fs-5" style="color:rgb(255, 255, 255);">Biblioteca Virtual</span>
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
                    <button class="btn btn-outline-light position-relative p-2" id="btn-favoritos" title="Favoritos" style="border: none;">
                        <i class="bi bi-heart fs-5"></i>
                        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill" id="contador-favoritos">0</span>
                    </button>
                    
                    <button class="btn btn-outline-light position-relative p-2" id="btn-guardados" title="Guardados" style="border: none;">
                        <i class="bi bi-bookmark fs-5"></i>
                        <span class="badge bg-warning position-absolute top-0 start-100 translate-middle rounded-pill text-dark" id="contador-guardados">0</span>
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

    <!-- Offcanvas para Favoritos -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasFavoritos">
        <div class="offcanvas-header" style="background-color: #001a3d; color: white;">
            <h5 class="offcanvas-title"><i class="bi bi-heart-fill me-2"></i>Mis Favoritos</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-search p-3" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar en favoritos..." id="buscar-favoritos">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
        <div class="offcanvas-body" id="lista-favoritos">
            <!-- Los favoritos se cargarán aquí -->
        </div>
    </div>

    <!-- Offcanvas para Guardados -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasGuardados">
        <div class="offcanvas-header" style="background-color: #001a3d; color: white;">
            <h5 class="offcanvas-title"><i class="bi bi-bookmark-fill me-2"></i>Libros Guardados</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-search p-3" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar en guardados..." id="buscar-guardados">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
        <div class="offcanvas-body" id="lista-guardados">
            <!-- Los libros guardados se cargarán aquí -->
        </div>
    </div>

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

    <!-- Modal de confirmación de cierre de sesión -->
    <div class="modal fade" id="modalCerrarSesion" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Cerrar sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <p>¿Estás seguro que deseas cerrar la sesión?</p>
                </div>
                <div class="modal-footer justify-content-center py-3">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger px-4" id="confirmar-cierre-sesion">Cerrar sesión</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JS personalizado -->
    <script type="module" src="/library/students-teachers/assets/js/script.js"></script>
</body>
</html>