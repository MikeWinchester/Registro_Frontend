<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Perfil Docente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    
    <style>

  
:root {
    --primary-blue: #1a4b8c;
    --secondary-blue: #2a6fba;
    --light-blue: #e8f2fc;
    --accent-yellow: #ffc107;
    --success-green: #28a745;
    --danger-red: #dc3545;
}



.profile-card {
    max-width: 700px;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.08);
    border: none;
    overflow: hidden;
    margin: 0 auto;
    background-color: white;
}

.card-header {
    background-color: var(--secondary-blue);
    color: white;
    padding: 1.5rem;
    border-bottom: none;
    text-align: center;
}

.profile-pic-container {
    width: 180px;
    height: 180px;
    border-radius: 50%;
    border: 5px solid white;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    overflow: hidden;
    position: relative;
    margin: 0 auto 1rem;
    background-color: #f1f1f1;
    cursor: pointer;
    transition: all 0.3s;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="%23cccccc" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>');
    background-repeat: no-repeat;
    background-position: center;
    background-size: 50%;
}

.profile-pic-container:hover {
    transform: scale(1.03);
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}

.profile-pic {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: relative;
    z-index: 1;
}

.upload-btn {
    position: absolute;
    bottom: 0;
    right: 0;
    background-color: var(--accent-yellow);
    color: var(--primary-blue);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    transition: all 0.3s;
    z-index: 2;
}

.upload-btn:hover {
    background-color: #e0a800;
    transform: scale(1.1);
}

.select-photo-btn {
    background-color: var(--primary-blue);
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 0.875rem;
    display: inline-flex;
    align-items: center;
    margin-top: 10px;
    transition: all 0.3s;
}

.select-photo-btn:hover {
    background-color: var(--secondary-blue);
    transform: translateY(-2px);
}

.submit-btn {
    background-color: var(--primary-blue);
    color: white;
    border: none;
    font-weight: 600;
    padding: 10px 25px;
    border-radius: 6px;
    transition: all 0.3s;
}

.submit-btn:hover {
    background-color: var(--secondary-blue);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.form-control, .form-select {
    border-radius: 6px;
    padding: 10px 15px;
    border: 1px solid rgba(0,0,0,0.1);
    margin-bottom: 1rem;
    transition: all 0.3s;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 0.25rem rgba(26, 75, 140, 0.15);
}

.divider {
    border-top: 1px solid rgba(0,0,0,0.1);
    margin: 1.5rem 0;
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

.file-input {
    display: none;
}

.section-title {
    color: var(--primary-blue);
    text-align: center;
    margin-bottom: 1.5rem;
    font-weight: 600;
}

.btn-outline-secondary {
    border-radius: 6px;
    padding: 10px 25px;
    transition: all 0.3s;
}

.btn-outline-secondary:hover {
    background-color: #f8f9fa;
}

.alert-validation {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1000;
    display: none;
    min-width: 300px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255,255,255,0.8);
    z-index: 9999;
    display: none;
    justify-content: center;
    align-items: center;
}

.spinner {
    width: 3rem;
    height: 3rem;
    color: var(--primary-blue);
}

.btn-outline-danger {
    border-radius: 20px;
    padding: 5px 15px;
    font-size: 0.875rem;
}

.character-counter {
    font-size: 0.75rem;
    text-align: right;
    color: #6c757d;
    margin-top: -0.5rem;
    margin-bottom: 1rem;
}

.max-reached {
    color: var(--danger-red);
    font-weight: bold;
}

.photo-actions {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 10px;
}


    </style>



   
</head>
<body>
    <!-- Alerta para validaciones 
    <div class="alert alert-danger alert-validation" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <span id="alert-message"></span>
    </div>

    Overlay de carga 
    <div class="loading-overlay">
        <div class="spinner-border spinner" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
    </div>-->

    <div class="container py-5">
        <div class="profile-card">
            <!-- Encabezado -->
            <div class="card-header">
                <h3 class="mb-0">
                    <i class="bi bi-person-gear"></i> Actualizar Perfil Docente
                </h3>
                <p class="mb-0 mt-2 opacity-75">Complete su información profesional</p>
            </div>
            
            <!-- Contenido -->
            <div class="p-4 p-md-5">
                <form id="profileForm">
                    <!-- Foto de perfil - Área clickeable -->
                    <div class="text-center mb-5">
                        <label for="fileUpload" class="profile-pic-container">
                            <img src="https://randomuser.me/api/portraits/women/45.jpg" class="profile-pic" id="profileImage">
                            <span class="upload-btn" title="Cambiar foto">
                                <i class="bi bi-camera"></i>
                            </span>
                        </label>
                        <input type="file" id="fileUpload" class="file-input" accept="image/jpeg, image/png">
                        
                        <div class="photo-actions">
                            <button type="button" id="btnSelectPhoto" class="select-photo-btn">
                                <i class="bi bi-folder2-open me-1"></i> Seleccionar Foto
                            </button>
                            <button type="button" id="btnRemovePhoto" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </div>
                        
                        <small class="text-muted d-block mt-2">Formatos: JPG, PNG (Máx. 2MB)</small>
                    </div>
                    
                    <div class="divider"></div>
                    
                    <!-- Información personal -->
                    <div class="mb-4">
                        <h5 class="section-title">
                            <i class="bi bi-pencil-square"></i> Descripción Profesional
                        </h5>
                        
                       
                        <div class="mb-4">
                            <label class="form-label fw-medium">Biografía profesional * (Máx. 500 caracteres)</label>
                            <textarea class="form-control" id="bio" rows="5" maxlength="500" placeholder="Describa su experiencia, metodología de enseñanza y logros profesionales..." required>Profesora con 8 años de experiencia en educación superior, especializada en métodos innovadores para la enseñanza de matemáticas avanzadas. Mi enfoque se centra en el aprendizaje práctico y la resolución de problemas reales.</textarea>
                            <div class="character-counter">
                                <span id="charCount">0</span>/500 caracteres
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-medium">Áreas de interés </label>
                            <input type="text" class="form-control" id="interests" value="Matemáticas aplicadas, Educación STEM" placeholder="Ej: Álgebra, Geometría, Educación a distancia">
                        </div>
                    </div>
                    
                    <!-- Botones -->
                    <div class="d-flex justify-content-between mt-5">
                        <button type="button" id="btnCancel" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </button>
                        <button type="submit" class="btn submit-btn">
                            <i class="bi bi-save"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elementos del DOM
            const fileUpload = document.getElementById('fileUpload');
            const btnSelectPhoto = document.getElementById('btnSelectPhoto');
            const profileImage = document.getElementById('profileImage');
            const btnRemovePhoto = document.getElementById('btnRemovePhoto');
            const btnCancel = document.getElementById('btnCancel');
            const profileForm = document.getElementById('profileForm');
            const bioTextarea = document.getElementById('bio');
            const charCount = document.getElementById('charCount');
            const alertBox = document.querySelector('.alert-validation');
            const alertMessage = document.getElementById('alert-message');
            const loadingOverlay = document.querySelector('.loading-overlay');
            
            // Valores por defecto
            const defaultImage = 'https://randomuser.me/api/portraits/women/45.jpg';
            let currentImage = defaultImage;
            let formData = new FormData();
            
            // Inicializar contador de caracteres
            charCount.textContent = bioTextarea.value.length;
            if(bioTextarea.value.length >= 500) {
                charCount.classList.add('max-reached');
            }
            
            // Mostrar alerta de validación
            function showAlert(message, type = 'danger') {
                alertBox.className = `alert alert-${type} alert-validation`;
                alertMessage.textContent = message;
                alertBox.style.display = 'block';
                
                setTimeout(() => {
                    alertBox.style.display = 'none';
                }, 5000);
            }
            
            // Mostrar carga
            function showLoading() {
                loadingOverlay.style.display = 'flex';
            }
            
            // Ocultar carga
            function hideLoading() {
                loadingOverlay.style.display = 'none';
            }
            
            // Seleccionar imagen desde archivos
            function handleFileSelect(file) {
                if (!file) return;
                
                // Validaciones
                const validTypes = ['image/jpeg', 'image/png'];
                const maxSize = 2 * 1024 * 1024; // 2MB
                
                if (!validTypes.includes(file.type)) {
                    showAlert('Solo se permiten archivos JPG o PNG');
                    fileUpload.value = '';
                    return;
                }
                
                if (file.size > maxSize) {
                    showAlert('El archivo no debe exceder los 2MB');
                    fileUpload.value = '';
                    return;
                }
                
                // Mostrar previsualización
                const reader = new FileReader();
                reader.onload = function(event) {
                    profileImage.src = event.target.result;
                    currentImage = event.target.result;
                    
                    // Agregar al FormData para enviar
                    formData.append('profileImage', file);
                    
                    showAlert('Imagen cargada correctamente', 'success');
                };
                reader.readAsDataURL(file);
            }
            
            // Botón para seleccionar foto
            btnSelectPhoto.addEventListener('click', function() {
                fileUpload.click();
            });
            
            // Cambio de archivo seleccionado
            fileUpload.addEventListener('change', function(e) {
                handleFileSelect(e.target.files[0]);
            });
            
            // Eliminar foto
            btnRemovePhoto.addEventListener('click', function() {
                profileImage.src = defaultImage;
                currentImage = defaultImage;
                fileUpload.value = '';
                formData.delete('profileImage');
                showAlert('Foto eliminada', 'info');
            });
            
            // Cancelar cambios
            btnCancel.addEventListener('click', function() {
                if(confirm('¿Está seguro que desea cancelar? Los cambios no guardados se perderán.')) {
                    window.location.reload();
                }
            });
            
            // Contador de caracteres para biografía
            bioTextarea.addEventListener('input', function() {
                const currentLength = this.value.length;
                charCount.textContent = currentLength;
                
                if(currentLength >= 500) {
                    charCount.classList.add('max-reached');
                } else {
                    charCount.classList.remove('max-reached');
                }
            });
            
            // Hacer click en toda el área de la foto para seleccionar archivo
            profileImage.addEventListener('click', function(e) {
                if(e.target === profileImage) {
                    fileUpload.click();
                }
            });
            
            // Enviar formulario
            profileForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validación básica
                if(!profileForm.checkValidity()) {
                    showAlert('Por favor complete todos los campos requeridos');
                    return;
                }
                
                // Mostrar carga
                showLoading();
                
                // Preparar datos para enviar
                formData.append('professionalTitle', document.getElementById('professionalTitle').value);
                formData.append('specialization', document.getElementById('specialization').value);
                formData.append('bio', document.getElementById('bio').value);
                formData.append('interests', document.getElementById('interests').value);
                
                // Simulación de envío al servidor (reemplazar con AJAX real)
                setTimeout(() => {
                    hideLoading();
                    showAlert('Perfil actualizado correctamente', 'success');
                    
                    // Aquí iría el código real para enviar al servidor
                    /*
                    fetch('/api/update-profile', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        hideLoading();
                        if(data.success) {
                            showAlert('Perfil actualizado correctamente', 'success');
                        } else {
                            showAlert(data.message || 'Error al actualizar el perfil');
                        }
                    })
                    .catch(error => {
                        hideLoading();
                        showAlert('Error de conexión: ' + error.message);
                    });
                    */
                }, 2000);
            });
        });
    </script>
</body>
</html>