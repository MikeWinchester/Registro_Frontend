<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admisiones - Verificar Solicitud</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/navbar.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/loading.css">
    <link rel="stylesheet" href="/admissions/assets/css/check_application_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<?php require __DIR__ . "/../components/navbar.php"?>

<div class="main-container">
    <div class="container">
        <div class="row">
            <!-- Columna izquierda - Formulario de verificación -->
            <div class="col-lg-5 mb-4">
                <div class="verification-card bg-white">
                    <h2 class="mb-4"><i class="bi bi-search me-2"></i>Verificar Estado de Solicitud</h2>
                    <p class="text-muted mb-4">Ingresa tu número de solicitud para verificar el estado y ver los detalles.</p>
                    
                    <div class="mb-3">
                        <label for="numeroSolicitud" class="form-label fw-bold">Número de solicitud</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-file-text"></i></span>
                            <input type="text" class="form-control" id="numeroSolicitud" placeholder="Ej. 123456789" required>
                            <button class="btn btn-primary" type="button" id="submit-btn">
                                <span id="btn-text">Buscar</span>
                                <div id="loading-spinner" class="loading-spinner spinner-border spinner-border-sm text-light ms-2" role="status">
                                    <span class="visually-hidden">Cargando...</span>
                                </div>
                            </button>
                        </div>
                    </div>
                    
                    <div id="resultado" class="mt-4"></div>
                </div>
            </div>
            
            <!-- Columna derecha - Detalles de la solicitud -->
            <div class="col-lg-7 mb-4">
                <div class="solicitud-card bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Solicitud # <span id="solicitud-numero">-----</span></h2>
                        <span id="solicitud-status" class="status-badge status-pendiente">No encontrada</span>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">Nombre completo</div>
                                <div class="info-value" id="nombre-completo">---</div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-label">Número de documento</div>
                                <div class="info-value" id="documento-numero">---</div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-label">Correo electrónico</div>
                                <div class="info-value" id="correo-electronico">---</div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-label">Número de teléfono</div>
                                <div class="info-value" id="telefono-numero">---</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">Centro Regional</div>
                                <div class="info-value" id="centro-regional">---</div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-label">Carrera Principal</div>
                                <div class="info-value" id="carrera-principal">---</div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-label">Carrera Secundaria</div>
                                <div class="info-value" id="carrera-secundaria">---</div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-label">Certificado de secundaria</div>
                                <div class="info-value" id="certificado-secundaria">
                                    <span class="badge bg-secondary">No cargado</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- La sección de observaciones se generará dinámicamente con JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . "/../components/loading.php"?>
<?php require __DIR__ . "/../components/footer.php"?>

<script type="module" src="/admissions/assets/js/applicationController.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>