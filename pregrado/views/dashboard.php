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
<html lang="es" user-id='<?php echo $_SESSION['user_id']?>' user-name='<?php echo $_SESSION['user_name']?>'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Universitario - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Portal Universitario</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="../views/dashboard.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/components/profile.php">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/components/chat.php">Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/components/grades.php">Notas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/components/requests.php">Trámites</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <span class="text-light me-3" id="userName">Juan Pérez</span>
                    <button class="btn btn-outline-light" id="logoutBtn">Salir</button>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Columna izquierda -->
            <div class="col-md-8">
                <section class="mb-5">
                    <h2 class="section-title">Información Académica</h2>
                    <div class="academic-info">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-card">
                                    <h3>Certificado Académico</h3>
                                    <p>Descarga tu certificado académico en formato PDF.</p>
                                    <button class="btn btn-dark" id="downloadCertBtn">Descargar Certificado</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-card">
                                    <h3>Índice Académico</h3>
                                    <div class="gpa-display">
                                        <span class="gpa-value">3.8</span>
                                        <span class="gpa-label">de 4.0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mb-5">
                    <h2 class="section-title">Clases Actuales</h2>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Clase</th>
                                    <th>Profesor</th>
                                    <th>Horario</th>
                                    <th>Aula</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Programación II</td>
                                    <td>Dr. Carlos Martínez</td>
                                    <td>Lunes y Miércoles 8:00-10:00</td>
                                    <td>B-205</td>
                                </tr>
                                <tr>
                                    <td>Base de Datos</td>
                                    <td>Ing. Laura Fernández</td>
                                    <td>Martes y Jueves 10:30-12:30</td>
                                    <td>Lab-3</td>
                                </tr>
                                <tr>
                                    <td>Estadística</td>
                                    <td>Lic. Roberto Sánchez</td>
                                    <td>Viernes 14:00-16:00</td>
                                    <td>A-102</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            <!-- Columna derecha -->
            <div class="col-md-4">
                <section class="mb-5">
                    <h2 class="section-title">Notas Recientes</h2>
                    <div class="grades-summary">
                        <div class="grade-item">
                            <div class="grade-course">Programación II</div>
                            <div class="grade-value">85%</div>
                        </div>
                        <div class="grade-item">
                            <div class="grade-course">Base de Datos</div>
                            <div class="grade-value">92%</div>
                        </div>
                        <div class="grade-item">
                            <div class="grade-course">Estadística</div>
                            <div class="grade-value">78%</div>
                        </div>
                        <a href="grades.html" class="btn btn-outline-dark w-100 mt-3">Ver todas las notas</a>
                    </div>
                </section>

                <section class="mb-5">
                    <h2 class="section-title">Mensajes Recientes</h2>
                    <div class="messages-preview">
                        <div class="message-preview">
                            <div class="message-sender">María González</div>
                            <div class="message-content">Hola, ¿ya viste las notas de Física?</div>
                            <div class="message-time">10:30 AM</div>
                        </div>
                        <div class="message-preview">
                            <div class="message-sender">Carlos Rodríguez</div>
                            <div class="message-content">¿Vas a la reunión de mañana?</div>
                            <div class="message-time">Ayer</div>
                        </div>
                        <a href="chat.html" class="btn btn-outline-dark w-100 mt-3">Ver todos los mensajes</a>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white py-3 mt-4">
        <div class="container text-center">
            <p class="mb-0">© 2023 Universidad Ejemplo. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/auth.js"></script>
    <script src="/js/dashboard.js"></script>
</body>
</html>