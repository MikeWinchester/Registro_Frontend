<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Universitario - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #0d6efd;
            --dark-blue: #052c65;
            --light-blue: #e7f1ff;
            --accent-yellow: #ffc107;
            --white: #ffffff;
            --gray-light: #f8f9fa;
        }
        
        body {
         
            background-color: var(--gray-light);
            color: #333;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--dark-blue) 100%) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .section-title {
            color: var(--dark-blue);
            font-weight: 600;
            border-bottom: 2px solid var(--accent-yellow);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            display: inline-block;
        }
        
        .info-card {
            background-color: var(--white);
            border-radius: 0.5rem;
            padding: 1.5rem;
            height: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 4px solid var(--primary-blue);
        }
        
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        
        .gpa-display {
            background-color: var(--light-blue);
            padding: 1.5rem;
            border-radius: 0.5rem;
            text-align: center;
        }
        
        .gpa-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-blue);
            display: block;
        }
        
        .gpa-label {
            font-size: 1rem;
            color: #6c757d;
        }
        
        .table {
            background-color: var(--white);
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .table thead {
            background-color: var(--primary-blue);
            color: white;
        }
        
        .table th {
            font-weight: 500;
        }
        
        .table-hover tbody tr:hover {
            background-color: var(--light-blue);
        }
        
        .grades-summary, .messages-preview {
            background-color: var(--white);
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .grade-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
        }
        
        .grade-item:last-child {
            border-bottom: none;
        }
        
        .grade-course {
            font-weight: 500;
        }
        
        .grade-value {
            background-color: var(--light-blue);
            color: var(--dark-blue);
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-weight: 600;
        }
        
        .message-preview {
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        }
        
        .message-preview:hover {
            background-color: var(--light-blue);
        }
        
        .message-sender {
            font-weight: 600;
            color: var(--dark-blue);
        }
        
        .message-content {
            color: #6c757d;
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .message-time {
            font-size: 0.8rem;
            color: #adb5bd;
            text-align: right;
        }
        
        .btn-dark {
            background-color: var(--dark-blue);
            border-color: var(--dark-blue);
        }
        
        .btn-outline-dark {
            color: var(--dark-blue);
            border-color: var(--dark-blue);
        }
        
        .btn-outline-dark:hover {
            background-color: var(--dark-blue);
            color: white;
        }
        
        .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        #downloadCertBtn {
            background-color: var(--accent-yellow);
            color: var(--dark-blue);
            border: none;
            font-weight: 500;
        }
        
        #downloadCertBtn:hover {
            background-color: #e0a800;
        }
        
        footer {
            background: linear-gradient(135deg, var(--dark-blue) 0%, var(--primary-blue) 100%);
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--accent-yellow);
            color: var(--dark-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 10px;
        }
        
        @media (max-width: 768px) {
            .section-title {
                font-size: 1.25rem;
            }
            
            .gpa-value {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-university me-2"></i>Portal Universitario
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
                    <div class="user-avatar">JP</div>
                    <span class="text-light me-3" id="userName">Juan Pérez</span>
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
                                    <h3><i class="fas fa-file-certificate me-2"></i>Certificado Académico</h3>
                                    <p class="text-muted">Descarga tu certificado académico en formato PDF.</p>
                                    <button class="btn" id="downloadCertBtn">
                                        <i class="fas fa-download me-1"></i>Descargar Certificado
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-card">
                                    <h3><i class="fas fa-chart-line me-2"></i>Índice Académico</h3>
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
                                <tr>
                                    <td>Inteligencia Artificial</td>
                                    <td>Dra. Ana Ramírez</td>
                                    <td>Lunes y Jueves 16:00-18:00</td>
                                    <td><span class="badge bg-primary">C-301</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            <!-- Columna derecha -->
            <div class="col-lg-4">
                <section class="mb-5">
                    <h5 class="section-title">
                        <i class="fas fa-star me-2"></i>Notas Recientes
                    </h5>
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
                        <div class="grade-item">
                            <div class="grade-course">
                                <i class="fas fa-robot me-1 text-primary"></i>Inteligencia Artificial
                            </div>
                            <div class="grade-value">88%</div>
                        </div>
                        <a href="grades.html" class="btn btn-outline-dark w-100 mt-3">
                            <i class="fas fa-arrow-right me-1"></i>Ver todas las notas
                        </a>
                    </div>
                </section>

                <section class="mb-5">
                    <h5 class="section-title">
                        <i class="fas fa-envelope me-2"></i>Mensajes Recientes
                    </h5>
                    <div class="messages-preview">
                        <div class="message-preview">
                            <div class="d-flex justify-content-between">
                                <div class="message-sender">María González</div>
                                <div class="message-time">10:30 AM</div>
                            </div>
                            <div class="message-content">Hola, ¿ya viste las notas de Física? Parece que salieron muy bien...</div>
                        </div>
                        <div class="message-preview">
                            <div class="d-flex justify-content-between">
                                <div class="message-sender">Carlos Rodríguez</div>
                                <div class="message-time">Ayer</div>
                            </div>
                            <div class="message-content">¿Vas a la reunión de mañana? Necesitamos preparar el proyecto...</div>
                        </div>
                        <div class="message-preview">
                            <div class="d-flex justify-content-between">
                                <div class="message-sender">Prof. Martínez</div>
                                <div class="message-time">Lun</div>
                            </div>
                            <div class="message-content">Recordatorio: Entrega del proyecto la próxima semana...</div>
                        </div>
                        <a href="chat.html" class="btn btn-outline-dark w-100 mt-3">
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
                <i class="fas fa-university me-1"></i> © 2023 Universidad Ejemplo. Todos los derechos reservados.
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
    <script>
        // Aquí iría el JavaScript para funcionalidades específicas
        document.getElementById('logoutBtn').addEventListener('click', function() {
            // Lógica para cerrar sesión
            console.log('Sesión cerrada');
        });
        
        document.getElementById('downloadCertBtn').addEventListener('click', function() {
            // Lógica para descargar certificado
            console.log('Descargando certificado...');
        });
    </script>
</body>
</html>