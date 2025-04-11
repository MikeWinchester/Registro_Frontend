<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración - Reinicio de Claves</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1a4b8c;
            --secondary-blue: #2a6fba;
            --light-blue: #e8f2fc;
            --accent-yellow: #ffc107;
            --light-yellow: #fff8e1;
            --dark-gray: #343a40;
        }
        
        body {
            background-color: #f8f9fa;
        }
        
        .admin-card {
            max-width: 1000px;
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
        
        .profile-pic-sm {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
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
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-blue);
            border-color: var(--secondary-blue);
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
        
        .action-btn {
            background-color: var(--accent-yellow);
            color: var(--primary-blue);
            border: none;
            font-weight: 600;
            padding: 8px 16px;
            transition: all 0.3s;
            border-radius: 6px;
        }
        
        .action-btn:hover {
            background-color: #e0a800;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .table-custom {
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table-custom thead {
            background-color: var(--primary-blue);
            color: white;
        }
        
        .table-custom th {
            font-weight: 500;
        }
        
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-active {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .search-box {
            position: relative;
        }
        
        .search-box i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-blue);
        }
        
        .search-box input {
            padding-left: 40px;
        }
        
        .pagination .page-item.active .page-link {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
        }
        
        .pagination .page-link {
            color: var(--primary-blue);
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
                            <i class="bi bi-key"></i> Administración de Claves Docentes
                        </h3>
                        <p class="mb-0 mt-2 opacity-75">Reinicio de contraseñas y gestión de acceso</p>
                    </div>
                    <div>
                        <span class="badge bg-light text-dark">
                            <i class="bi bi-person-fill-gear"></i> Jefe de Departamento
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Contenido principal -->
            <div class="p-4 p-md-5">
                <!-- Filtros y búsqueda -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="search-box">
                            <i class="bi bi-search"></i>
                            <input type="text" class="form-control" placeholder="Buscar docente...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end">
                            <select class="form-select w-auto me-2">
                                <option selected>Filtrar por departamento</option>
                                <option>Matemáticas</option>
                                <option>Ciencias</option>
                                <option>Humanidades</option>
                                <option>Idiomas</option>
                            </select>
                            <button class="btn btn-primary">
                                <i class="bi bi-funnel"></i> Filtrar
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Tabla de docentes -->
                <div class="table-responsive">
                    <table class="table table-custom table-hover">
                        <thead>
                            <tr>
                                <th>Docente</th>
                                <th>Departamento</th>
                                <th>Último acceso</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://randomuser.me/api/portraits/women/32.jpg" class="profile-pic-sm me-3">
                                        <div>
                                            <div class="fw-medium">María González</div>
                                            <small class="text-muted">mgonzalez@instituto.edu</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Matemáticas</td>
                                <td>05/10/2023 14:32</td>
                                <td><span class="status-badge status-active">Activo</span></td>
                                <td>
                                    <button class="btn btn-sm action-btn me-2" data-bs-toggle="modal" data-bs-target="#resetModal">
                                        <i class="bi bi-arrow-repeat"></i> Reiniciar
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-eye"></i> Ver
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://randomuser.me/api/portraits/men/45.jpg" class="profile-pic-sm me-3">
                                        <div>
                                            <div class="fw-medium">Carlos Mendoza</div>
                                            <small class="text-muted">cmendoza@instituto.edu</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Ciencias</td>
                                <td>30/09/2023 09:15</td>
                                <td><span class="status-badge status-active">Activo</span></td>
                                <td>
                                    <button class="btn btn-sm action-btn me-2" data-bs-toggle="modal" data-bs-target="#resetModal">
                                        <i class="bi bi-arrow-repeat"></i> Reiniciar
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-eye"></i> Ver
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://randomuser.me/api/portraits/women/68.jpg" class="profile-pic-sm me-3">
                                        <div>
                                            <div class="fw-medium">Laura Jiménez</div>
                                            <small class="text-muted">ljimenez@instituto.edu</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Humanidades</td>
                                <td>15/09/2023 11:47</td>
                                <td><span class="status-badge status-inactive">Inactivo</span></td>
                                <td>
                                    <button class="btn btn-sm action-btn me-2" data-bs-toggle="modal" data-bs-target="#resetModal">
                                        <i class="bi bi-arrow-repeat"></i> Reiniciar
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-eye"></i> Ver
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://randomuser.me/api/portraits/men/22.jpg" class="profile-pic-sm me-3">
                                        <div>
                                            <div class="fw-medium">Roberto Sánchez</div>
                                            <small class="text-muted">rsanchez@instituto.edu</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Idiomas</td>
                                <td>28/10/2023 16:20</td>
                                <td><span class="status-badge status-active">Activo</span></td>
                                <td>
                                    <button class="btn btn-sm action-btn me-2" data-bs-toggle="modal" data-bs-target="#resetModal">
                                        <i class="bi bi-arrow-repeat"></i> Reiniciar
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-eye"></i> Ver
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Paginación -->
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Anterior</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Siguiente</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Modal de reinicio de clave -->
    <div class="modal fade" id="resetModal" tabindex="-1" aria-labelledby="resetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetModalLabel">
                        <i class="bi bi-shield-lock text-warning me-2"></i> Reiniciar Contraseña
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Esta acción generará una nueva contraseña temporal para el docente.
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" class="profile-pic-sm me-3">
                            <div>
                                <h6 class="mb-0">María González</h6>
                                <small class="text-muted">Profesora de Matemáticas</small>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Nueva contraseña temporal</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="TempPass1234" id="newPassword">
                                <button class="btn btn-outline-secondary" type="button" id="generateNewPass">
                                    <i class="bi bi-arrow-repeat"></i> Generar
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="forceChange">
                            <label class="form-check-label" for="forceChange">
                                Forzar cambio de contraseña en próximo acceso
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning text-dark">
                        <i class="bi bi-check-circle me-1"></i> Confirmar Reinicio
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Generador de contraseña
        document.getElementById('generateNewPass').addEventListener('click', function() {
            const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789';
            let password = '';
            for (let i = 0; i < 10; i++) {
                password += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            document.getElementById('newPassword').value = password;
        });
        
        // Ejemplo de búsqueda (simulada)
        document.querySelector('.search-box input').addEventListener('input', function(e) {
            console.log('Buscando:', e.target.value);
            // Aquí iría la lógica real de búsqueda
        });
    </script>
</body>
</html>