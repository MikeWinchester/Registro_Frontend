
<?php
include('../../components/navbar.php');
session_start();

$allowedRoles = ['Estudiante', 'Docente'];
$userRoles = $_SESSION['user_roles'] ?? [];

if (empty($userRoles)) {
    header('Location: ../../login/index.php');
    exit;
}

if (!array_intersect($allowedRoles, $userRoles)) {
    die(header('Location: ../../login/forbidden.php'));
}
?>
<!DOCTYPE html>
<html lang="es" user-id='<?php echo $_SESSION['user_id']?>' user-name='<?php echo $_SESSION['user_name']?>' >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Universitario - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
            Portal Universitario
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="../views/dashboard.php">
                            <i class="fas fa-home me-1"></i>Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/components/profile.php">
                            <i class="fas fa-user me-1"></i>Perfil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/components/chat.php">
                            <i class="fas fa-comments me-1"></i>Chat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/components/grades.php">
                            <i class="fas fa-graduation-cap me-1"></i>Notas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/components/requests.php">
                            <i class="fas fa-tasks me-1"></i>Trámites
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

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Columna izquierda -->
            <div class="col-lg-8">
                <section class="mb-5">
                    <h4 class="section-title">
                        <i class="fas fa-graduation-cap me-2"></i>Información Académica
                    </h4>
                    <div class="academic-info">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="info-card">
                                    <h6><i class="fas fa-file-certificate me-2"></i>Certificado Académico</h6>
                                    <p class="text-muted">Descarga tu certificado académico en formato PDF.</p>
                                    <button class="btn" id="downloadCertBtn">
                                        <i class="fas fa-download me-1"></i>Descargar Certificado
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-card">
                                    <h6><i class="fas fa-chart-line me-2"></i>Índice Académico</h6>
                                    <div class="gpa-display">
                                        <span class="gpa-value">3.8</span>
                                        <span class="gpa-label">Promedio de 4.0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mb-5">
                    <h4 class="section-title">
                        <i class="fas fa-calendar-alt me-2"></i>Clases Actuales
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-book me-1"></i>Clase</th>
                                    <th><i class="fas fa-chalkboard-teacher me-1"></i>Profesor</th>
                                    <th><i class="fas fa-clock me-1"></i>Horario</th>
                                    <th><i class="fas fa-door-open me-1"></i>Aula</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Programación II</td>
                                    <td>Dr. Carlos Martínez</td>
                                    <td>Lunes y Miércoles 8:00-10:00</td>
                                    <td><span class="badge bg-primary">B-205</span></td>
                                </tr>
                                <tr>
                                    <td>Base de Datos</td>
                                    <td>Ing. Laura Fernández</td>
                                    <td>Martes y Jueves 10:30-12:30</td>
                                    <td><span class="badge bg-primary">Lab-3</span></td>
                                </tr>
                                <tr>
                                    <td>Estadística</td>
                                    <td>Lic. Roberto Sánchez</td>
                                    <td>Viernes 14:00-16:00</td>
                                    <td><span class="badge bg-primary">A-102</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            <!-- Columna derecha -->
            <div class="col-lg-4">
                <section class="mb-5">
                    <h6 class="section-title">
                        <i class="fas fa-star me-2"></i>Notas Recientes
                    </h6>
                    <div class="grades-summary">
                        <div class="grade-item">
                            <div class="grade-course">
                                <i class="fas fa-laptop-code me-1 text-primary"></i>Programación II
                            </div>
                            <div class="grade-value">85%</div>
                        </div>
                        <div class="grade-item">
                            <div class="grade-course">
                                <i class="fas fa-database me-1 text-primary"></i>Base de Datos
                            </div>
                            <div class="grade-value">92%</div>
                        </div>
                        <div class="grade-item">
                            <div class="grade-course">
                                <i class="fas fa-chart-bar me-1 text-primary"></i>Estadística
                            </div>
                            <div class="grade-value">78%</div>
                        </div>
                        <a href="../views/components/grades.php" class="btn btn-outline-dark w-100 mt-3">
                            <i class="fas fa-arrow-right me-1"></i>Ver todas las notas
                        </a>
                    </div>
                </section>

                <section class="mb-5">
                    <h6 class="section-title">
                        <i class="fas fa-envelope me-2"></i>Mensajes Recientes
                    </h6>
                    <div class="messages-preview">
                        <div class="message-preview">
                            <div class="d-flex justify-content-between">
                                <div class="message-sender">María González</div>
                                <div class="message-time">10:30 AM</div>
                            </div>
                            <div class="message-content">Hola, ¿ya viste las notas de Física?</div>
                        </div>
                        <div class="message-preview">
                            <div class="d-flex justify-content-between">
                                <div class="message-sender">Carlos Rodríguez</div>
                                <div class="message-time">Ayer</div>
                            </div>
                            <div class="message-content">¿Vas a la reunión de mañana?</div>
                        </div>
                        <a href="../views/components/chat.php" class="btn btn-outline-dark w-100 mt-3">
                            <i class="fas fa-arrow-right me-1"></i>Ver todos los mensajes
                        </a>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <footer class="py-3 mt-4">
        <div class="container text-center">
            <p class="mb-0">
                <i class="fas fa-university me-1"></i> © 2025 Universidad  Todos los derechos reservados.
            </p>
            <div class="mt-2">
                <a href="#" class="text-white mx-2"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/auth.js"></script>
    <script src="/js/dashboard.js"></script>
</body>
</html>