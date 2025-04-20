<?php
include('../../components/navbar.php');
session_start();

$allowedRoles = ['Estudiante'];
$userRoles = $_SESSION['user_roles'] ?? [];

if (empty($userRoles)) {
    header('Location: ../../login/index.php');
    exit;
}

if (!array_intersect($allowedRoles, $userRoles)) {
    die(header('Location: ../../docente/views/pregrado_docente.php'));
}
?>
<!DOCTYPE html>
<html lang="es" user-id='<?php echo $_SESSION['user_id']?>' user-name='<?php echo $_SESSION['user_name']?>' >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Universitario - Trámites</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Portal Universitario</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="../dashboard.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../components/profile.php">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../components/chat.php">Chat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../components/grades.php">Notas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../components/requests.php">Trámites</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="../components/estudiante.php">
                            <i class="fas fa-tasks me-1"></i>Secciones
                        </a>
                    </li>
                    </ul>
                    <div class="d-flex align-items-center">
                    <div class="user-avatar"><?php echo substr($_SESSION['user_name'], 0, 2); ?></div>
                    <span class="text-light me-3" id="userName"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    <button class="btn btn-outline-light" id="logoutBtn">
                        <i class="fas fa-sign-out-alt me-1"></i>Salir
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Solicitudes de Trámites</h5>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="requestsAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                        Cambio de Carrera
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#requestsAccordion">
                                    <div class="accordion-body">
                                        <form id="careerChangeForm">
                                            <div class="mb-3">
                                                <label for="currentCareer" class="form-label">Carrera Actual</label>
                                                <input type="text" class="form-control" id="currentCareer" value="Ingeniería en Sistemas" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="newCareer" class="form-label">Nueva Carrera</label>
                                                <select class="form-select" id="newCareer" required>
                                                    <option value="">Seleccione una carrera</option>
                                                    <option value="1">Medicina</option>
                                                    <option value="2">Derecho</option>
                                                    <option value="3">Administración de Empresas</option>
                                                    <option value="4">Psicología</option>
                                                    <option value="5">Arquitectura</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="changeReason" class="form-label">Motivo del Cambio</label>
                                                <textarea class="form-control" id="changeReason" rows="3" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Solicitar Cambio</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                        Cancelación de Clases
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#requestsAccordion">
                                    <div class="accordion-body">
                                        <form id="classCancelForm">
                                            <div class="mb-3">
                                                <label for="cancelClass" class="form-label">Clase a Cancelar</label>
                                                <select class="form-select" id="cancelClass" required>
                                                    <option value="">Seleccione una clase</option>
                                                    <option value="1">Programación II</option>
                                                    <option value="2">Base de Datos</option>
                                                    <option value="3">Estadística</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="cancelReason" class="form-label">Motivo de Cancelación</label>
                                                <textarea class="form-control" id="cancelReason" rows="3" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Solicitar Cancelación</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                        Cambio de Centro Regional
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#requestsAccordion">
                                    <div class="accordion-body">
                                        <form id="centerChangeForm">
                                            <div class="mb-3">
                                                <label for="currentCenter" class="form-label">Centro Actual</label>
                                                <input type="text" class="form-control" id="currentCenter" value="Campus Central" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="newCenter" class="form-label">Nuevo Centro</label>
                                                <select class="form-select" id="newCenter" required>
                                                    <option value="">Seleccione un centro</option>
                                                    <option value="1">Campus Norte</option>
                                                    <option value="2">Campus Sur</option>
                                                    <option value="3">Campus Este</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="centerChangeReason" class="form-label">Motivo del Cambio</label>
                                                <textarea class="form-control" id="centerChangeReason" rows="3" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Solicitar Cambio</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                        Pago de Exámenes de Recuperación
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#requestsAccordion">
                                    <div class="accordion-body">
                                        <form id="recoveryExamForm">
                                            <div class="mb-3">
                                                <label for="examClass" class="form-label">Clase para Recuperación</label>
                                                <select class="form-select" id="examClass" required>
                                                    <option value="">Seleccione una clase</option>
                                                    <option value="1">Matemáticas I</option>
                                                    <option value="2">Física</option>
                                                    <option value="3">Química</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Monto a Pagar</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">L.</span>
                                                    <input type="text" class="form-control" value="500.00" readonly>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="paymentMethod" class="form-label">Método de Pago</label>
                                                <select class="form-select" id="paymentMethod" required>
                                                    <option value="">Seleccione un método</option>
                                                    <option value="1">Tarjeta de Crédito/Débito</option>
                                                    <option value="2">Transferencia Bancaria</option>
                                                    <option value="3">Pago en Ventanilla</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Generar Comprobante de Pago</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Trámites en Proceso</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Cambio de Carrera</h6>
                                    <small class="text-warning">Pendiente</small>
                                </div>
                                <p class="mb-1">Solicitud enviada el 15/10/2023</p>
                                <small>De: Ingeniería en Sistemas, A: Medicina</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Trámites Finalizados</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Pago de Examen</h6>
                                    <small class="text-success">Aprobado</small>
                                </div>
                                <p class="mb-1">Matemáticas I - 05/08/2023</p>
                                <small>Comprobante: #PA-2023-00125</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white py-3 mt-4">
        <div class="container text-center">
            <p class="mb-0">© 2023 Universidad Ejemplo. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/requests.js"></script>
</body>
</html>