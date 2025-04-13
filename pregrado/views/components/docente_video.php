<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Enlace de Video | Panel Docente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../global_components/assets/css/toastMessage.css">
    <link rel="stylesheet" href="../../assets/css/docente_video.css">
</head>
<body>



<div class="container py-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
            <i class=" Bi bi-cloud-arrow-up"></i>   
                    Enlace de video
                </h4>
            </div>


            <div class="p-4 p-md-5">
                
                    <!-- Información de la clase -->
                    <div class="mb-4">
                        <label class="form-label fw-medium">Asignatura</label>
                        <select class="form-select" id='clase'>
                            <option selected>Matemáticas Avanzadas - Grupo A</option>
                            <option>Álgebra Lineal - Grupo B</option>
                            <option>Cálculo Diferencial - Grupo C</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-medium">Título de la clase</label>
                        <input type="text" id='titulo' class="form-control" placeholder="Ej: Clase 12 - Integrales Definidas">
                    </div>
                    
                    <!-- Área de subida -->
                    <div class="video-upload-box">
                        <div class="upload-icon">
                            <i class="bi bi-link-45deg"></i>
                        </div>
                        <h5>Pegar enlace de video</h5>
                        <p class="text-muted">Soporta YouTube, Vimeo, Google Drive y otros</p>
                        
                        <div class="mt-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
                                <input type="url" id='video-clase' class="form-control" placeholder="https://youtu.be/ejemplo">
                                <p id='error-video'></p>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <span class="platform-badge"><i class="bi bi-youtube"></i> YouTube</span>
                         
                            <span class="platform-badge"><i class="bi bi-google"></i> Drive</span>
                            <span class="platform-badge"><i class="bi bi-cloud"></i> OneDrive</span>
                        </div>
                    </div>
                    
                    <!-- Configuraciones adicionales -->
                    <div class="mb-4">
                        <label class="form-label fw-medium">Descripción (opcional)</label>
                        <textarea id='desc' class="form-control" rows="3" placeholder="Breve descripción del contenido del video..."></textarea>
                    </div>
                    
                 
                    
                    <!-- Botón de enviar -->
                    <div class="d-grid">
                        <button id='subir' class="btn submit-btn">
                            <i class="bi bi-save"></i> Subir enlace
                        </button>
                    </div>
                
            </div>
        </div>
        <div id='toast' class="toast">
            
        </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>