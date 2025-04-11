<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Perfil Docente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1a4b8c;
            --secondary-blue: #2a6fba;
            --light-blue: #e8f2fc;
            --accent-yellow: #ffc107;
            --light-yellow: #fff8e1;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
        }
        
        .profile-card {
            max-width: 750px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.08);
            border: none;
            overflow: hidden;
        }
        
        .card-header {
            background-color: var(--secondary-blue);
            color: white;
            padding: 1.5rem;
            border-bottom: none;
        }
        
        .profile-pic {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        
        .divider {
            border-top: 1px solid rgba(0,0,0,0.08);
            margin: 1.8rem 0;
            position: relative;
        }
        
        .divider:after {
            content: "";
            position: absolute;
            top: -1px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 2px;
            background: var(--accent-yellow);
        }
        
        .form-control, .form-select {
            border-radius: 6px;
            padding: 10px 15px;
            border: 1px solid rgba(0,0,0,0.1);
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 0.25rem rgba(26, 75, 140, 0.15);
        }
        
        .btn-primary {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-blue);
            border-color: var(--secondary-blue);
        }
        
        .btn-outline-primary {
            color: var(--primary-blue);
            border-color: var(--primary-blue);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-blue);
        }
        
        .file-upload-btn {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }
        
        .file-upload-btn input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        
        .info-section {
            background-color: var(--light-blue);
            border-left: 4px solid var(--accent-yellow);
        }
        
        .section-title {
            color: var(--primary-blue);
            font-weight: 600;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
        }
        
        .section-title i {
            margin-right: 10px;
            color: var(--accent-yellow);
        }
        
        .submit-btn {
            background-color: var(--accent-yellow);
            color: var(--primary-blue);
            border: none;
            font-weight: 600;
            padding: 12px 24px;
            transition: all 0.3s;
        }
        
        .submit-btn:hover {
            background-color: #e0a800;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .info-badge {
            background-color: var(--light-yellow);
            color: var(--primary-blue);
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="profile-card bg-white mx-auto">
            <!-- Encabezado con título -->
            <div class="card-header text-center">
                <h3 class="mb-0">
                    <i class="bi bi-person-badge"></i> Presentacion del Docente
                </h3>
                <p class="mb-0 mt-2 opacity-75">Complete su perfil profesional</p>
            </div>
            
            <!-- Contenido del formulario -->
            <div class="p-4 p-md-5">
                <form enctype="multipart/form-data">
                    <!-- Sección 1: Foto de Perfil -->
                    <div class="text-center mb-5">
                        <img src="placeholder-profile.jpg" class="profile-pic rounded-circle mb-4" id="profilePreview">
                        <div class="d-flex justify-content-center">
                            <label class="btn btn-outline-primary file-upload-btn">
                                <i class="bi bi-cloud-arrow-up"></i> Subir Nueva Foto
                                <input type="file" name="foto_perfil" accept="image/*" class="d-none">
                            </label>
                        </div>
                        <div class="mt-3">
                            <span class="info-badge badge rounded-pill px-3 py-2">
                                <i class="bi bi-info-circle me-1"></i> JPG o PNG (Máx. 2MB)
                            </span>
                        </div>
                    </div>
                    
                    <div class="divider"></div>
                    
                    <!-- Sección 2: Video de Presentación -->
                    <div class="mb-4">
                        <h5 class="section-title">
                            <i class="bi bi-camera-reels"></i> Video de Presentación
                        </h5>
                        <div class="mb-4">
                            <label class="form-label fw-medium">Enlace del video</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-link-45deg"></i></span>
                                <input type="url" class="form-control" placeholder="https://youtu.be/ejemplo" name="video_url">
                            </div>
                            <div class="form-text text-muted mt-1">Pegue el enlace de YouTube o Vimeo</div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-medium">Descripción breve</label>
                            <textarea class="form-control" rows="3" placeholder="Describa su enfoque de enseñanza, metodología y experiencia..."></textarea>
                        </div>
                    </div>
                    
                    <!-- Sección de instrucciones -->
                    <div class="info-section rounded p-4 mb-4">
                        <h6 class="d-flex align-items-center fw-bold mb-3">
                            <i class="bi bi-lightbulb me-2"></i> Recomendaciones
                        </h6>
                        <ul class="mb-0 ps-3">
                            <li class="mb-2">Use una foto profesional con fondo claro</li>
                            <li class="mb-2">El video debe ser horizontal (16:9) y de 1-2 minutos</li>
                            <li class="mb-2">Asegúrese que el enlace del video sea accesible públicamente</li>
                            <li>La descripción debe ser clara y concisa</li>
                        </ul>
                    </div>
                    
                    <!-- Botón de enviar -->
                    <div class="d-grid gap-2 mt-5">
                        <button type="submit" class="btn submit-btn">
                            <i class="bi bi-save me-2"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script para previsualizar la imagen seleccionada
        document.querySelector('input[name="foto_perfil"]').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('profilePreview').src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>