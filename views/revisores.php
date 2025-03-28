<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Revisores - Admisiones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/navbar.css">
    <style>
        .solicitud-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .solicitud-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .badge-estado {
            font-size: 0.9rem;
            padding: 0.35rem 0.65rem;
        }
        .tab-content {
            padding: 20px 0;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #0d6efd;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        .progress {
            height: 10px;
        }
        .nav-pills .nav-link.active {
            background-color: #0d6efd;
        }
        .table-hover tr {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php require __DIR__ . "/components/navbar.php"?>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-person-gear me-2"></i>Panel del Revisor</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <div class="user-avatar me-3" id="user-avatar">U</div>
                            <div>
                                <h6 class="mb-0" id="nombre-revisor">Usuario</h6>
                                <small class="text-muted">Revisor de admisiones</small>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <h6>Progreso de revisión</h6>
                            <div class="progress">
                                <div class="progress-bar" id="progreso-revision" role="progressbar" style="width: 0%"></div>
                            </div>
                            <small class="text-muted"><span id="solicitudes-revisadas">0</span> de <span id="solicitudes-asignadas">0</span> revisadas</small>
                        </div>
                        
                        <hr>
                        
                        <h6>Filtros</h6>
                        <select class="form-select mb-3" id="filtro-estado">
                            <option value="todas">Todas las solicitudes</option>
                            <option value="pendiente">Pendientes</option>
                            <option value="aprobado">Aprobadas</option>
                            <option value="rechazado">Rechazadas</option>
                        </select>
                        
                        <button class="btn btn-outline-primary w-100 mb-2" id="btn-actualizar">
                            <i class="bi bi-arrow-clockwise"></i> Actualizar lista
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-9">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-asignadas-tab" data-bs-toggle="pill" data-bs-target="#pills-asignadas" type="button" role="tab">
                                    <i class="bi bi-list-task me-1"></i> Asignadas a mí
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-todas-tab" data-bs-toggle="pill" data-bs-target="#pills-todas" type="button" role="tab">
                                    <i class="bi bi-card-checklist me-1"></i> Todas las solicitudes
                                </button>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-asignadas" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="tabla-asignadas">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Documento</th>
                                                <th>Carrera</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Las solicitudes se cargarán aquí dinámicamente -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="pills-todas" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="tabla-todas">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Documento</th>
                                                <th>Carrera</th>
                                                <th>Revisor</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Todas las solicitudes se cargarán aquí dinámicamente -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para revisar solicitud -->
    <div class="modal fade" id="modalRevisar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Revisar Solicitud #<span id="modal-id"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Información del solicitante</h6>
                            <p><strong>Nombre:</strong> <span id="modal-nombre"></span></p>
                            <p><strong>Documento:</strong> <span id="modal-documento"></span></p>
                            <p><strong>Correo:</strong> <span id="modal-correo"></span></p>
                            <p><strong>Teléfono:</strong> <span id="modal-telefono"></span></p>
                        </div>
                        <div class="col-md-6">
                            <h6>Información académica</h6>
                            <p><strong>Carrera principal:</strong> <span id="modal-carrera1"></span></p>
                            <p><strong>Carrera secundaria:</strong> <span id="modal-carrera2"></span></p>
                            <p><strong>Centro regional:</strong> <span id="modal-centro"></span></p>
                            <p>
                                <strong>Certificado:</strong> 
                                <span id="modal-certificado" class="badge">No cargado</span>
                            </p>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea class="form-control" id="observaciones" rows="3"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Decisión</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="decision" id="decision-aprobar" value="aprobado">
                            <label class="form-check-label text-success" for="decision-aprobar">
                                <i class="bi bi-check-circle-fill"></i> Aprobar
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="decision" id="decision-rechazar" value="rechazado">
                            <label class="form-check-label text-danger" for="decision-rechazar">
                                <i class="bi bi-x-circle-fill"></i> Rechazar
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="decision" id="decision-pendiente" value="pendiente">
                            <label class="form-check-label text-warning" for="decision-pendiente">
                                <i class="bi bi-hourglass-split"></i> Pendiente
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn-guardar-cambios">
                        <i class="bi bi-save"></i> Guardar cambios
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="loading-overlay">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
    </div>

    <!-- Toast de Error -->
    <div class="toast align-items-center text-white bg-danger position-fixed bottom-0 end-0 m-3" id="error-toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>

    <!-- Toast de Éxito -->
    <div class="toast align-items-center text-white bg-success position-fixed bottom-0 end-0 m-3" id="success-toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="/assets/js/revisorController.js"></script>
</body>
</html>