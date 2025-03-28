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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .main-container {
            min-height: calc(100vh - 120px);
            padding: 2rem 0;
        }
        .verification-card, .solicitud-card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 2rem;
            height: 100%;
        }
        .info-item {
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
            padding-bottom: 0.5rem;
        }
        .info-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 0.3rem;
        }
        .info-value {
            font-size: 1.1rem;
        }
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
        }
        .status-pendiente {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-aprobado {
            background-color: #d4edda;
            color: #155724;
        }
        .status-rechazado {
            background-color: #f8d7da;
            color: #721c24;
        }
        #resultado {
            margin-top: 1.5rem;
        }
        .loading-spinner {
            display: none;
            width: 2rem;
            height: 2rem;
        }
        .observaciones-section {
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>

<?php require __DIR__ . "/components/navbar.php"?>

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

<?php require __DIR__ . "/components/loading.php"?>
<?php require __DIR__ . "/components/footer.php"?>

<script type="module" src="/assets/js/solicitudController.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>