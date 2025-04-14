<?php

session_start();

$allowedRoles = ['Administrador'];
$userRoles = $_SESSION['user_roles'] ?? [];

if (empty($userRoles)) {
    header('Location: ../login/index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración - Agregar Docente</title>
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
            
        }
        
        .admin-card {
            max-width: 800px;
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
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        
        .divider {
            border-top: 1px solid rgba(0,0,0,0.08);
            margin: 1.5rem 0;
            position: relative;
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
        
        .required-field:after {
            content: " *";
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="admin-card bg-white mx-auto">
            <!-- Encabezado con título -->
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">
                            <i class="bi bi-person-plus"></i> Agregar Nuevo Docente
                        </h3>
                        <p class="mb-0 mt-2 opacity-75">Complete el formulario para registrar un nuevo docente</p>
                    </div>
                    <a href="#" class="btn btn-outline-light">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
            
            <!-- Contenido del formulario -->
            <div class="p-4 p-md-5">
                <form>
                    <!-- Sección 1: Información Básica -->
                    <h5 class="section-title">
                        <i class="bi bi-person-vcard"></i> Información Personal
                    </h5>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label required-field">Nombres</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required-field">Apellidos</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required-field">Documento de Identidad</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required-field">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required-field">Género</label>
                            <select class="form-select" required>
                                <option value="" selected disabled>Seleccionar...</option>
                                <option>Masculino</option>
                                <option>Femenino</option>
                                <option>Otro</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Foto de Perfil</label>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <img src="placeholder-profile.jpg" class="profile-pic rounded-circle" id="profilePreview">
                                </div>
                                <label class="btn btn-outline-primary file-upload-btn">
                                    <i class="bi bi-cloud-arrow-up"></i> Seleccionar
                                    <input type="file" accept="image/*" class="d-none">
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="divider"></div>
                    
                    <!-- Sección 2: Información de Contacto -->
                    <h5 class="section-title">
                        <i class="bi bi-telephone"></i> Información de Contacto
                    </h5>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label required-field">Correo Electrónico</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required-field">Teléfono</label>
                            <input type="tel" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label required-field">Carrera</label>
                            <input type="carrera" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label required-field">Departamento</label>
                            <input type="depa" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label required-field">Centro Regional</label>
                            <input type="centro" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Dirección</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    
                    <div class="divider"></div>
                    
                    <!-- Sección 3: Información Académica 
                    <h5 class="section-title">
                        <i class="bi bi-book"></i> Información Académica
                    </h5>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label required-field">Título Profesional</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Especialización</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Años de Experiencia</label>
                            <input type="number" class="form-control" min="0">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Áreas de Enseñanza</label>
                            <select class="form-select" multiple>
                                <option>Matemáticas</option>
                                <option>Ciencias</option>
                                <option>Lenguaje</option>
                                <option>Historia</option>
                                <option>Inglés</option>
                                <option>Arte</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="divider"></div> -->
                    
                    <!-- Sección 4: Credenciales de Acceso -->
                    <h5 class="section-title">
                        <i class="bi bi-shield-lock"></i> Credenciales de Acceso
                    </h5>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label required-field">Nombre de Usuario</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required-field">Contraseña Temporal</label>
                            <div class="input-group">
                                <input type="password" class="form-control" required value="Docente2023">
                                <button class="btn btn-outline-secondary" type="button" id="generatePassword">
                                    <i class="bi bi-arrow-repeat"></i> Generar
                                </button>
                            </div>
                            <div class="form-text">El docente deberá cambiar esta contraseña en su primer acceso</div>
                        </div>
                    </div>
                    
                    <!-- Botones de acción -->
                    <div class="d-flex justify-content-between mt-5">
                        <button type="reset" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </button>
                        <button type="submit" class="btn submit-btn">
                            <i class="bi bi-save"></i> Registrar Docente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script para previsualizar la imagen seleccionada
        document.querySelector('input[type="file"]').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('profilePreview').src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
        
        // Generador de contraseña temporal
        document.getElementById('generatePassword').addEventListener('click', function() {
            const randomString = Math.random().toString(36).slice(-8);
            this.closest('.input-group').querySelector('input').value = 'Docente' + randomString;
        });
    </script>
</body>
</html>