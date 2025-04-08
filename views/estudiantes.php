<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Estudiantes - UNAH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style_estudiantes.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>
    <!-- Navbar -->
    <?php require __DIR__ . "/components/navbar.php"?>

    <section>

        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-3 col-lg-2 d-md-block bg-unah-blue sidebar-container">
                    <div class="sidebar">
                        <div class="sidebar-header">
                            <div class="sidebar-brand">
                            <i class="bi bi-person-fill fs-4 text-warning"></i>
                                <span>Estudiante UNAH</span>
                            </div>
                        </div>
                        <ul class="nav flex-column sidebar-nav">
                            <li class="nav-item">
                                <a class="nav-link active custom-link" href="#perfil" data-bs-toggle="tab">
                                    <i class="bi bi-person"></i> Perfil
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link custom-link" href="#notas" data-bs-toggle="tab">
                                    <i class="bi bi-journal-text"></i> Notas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link custom-link" href="#certificado" data-bs-toggle="tab">
                                    <i class="bi bi-file-earmark-text"></i> Certificado
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link custom-link" href="#solicitudes" data-bs-toggle="tab">
                                    <i class="bi bi-envelope"></i> Solicitudes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link custom-link" href="#chat" data-bs-toggle="tab">
                                    <i class="bi bi-chat-dots"></i> Chat
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link custom-link" href="#recuperar" data-bs-toggle="tab">
                                    <i class="bi bi-shield-lock"></i> Contraseña
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
        
                <!-- Contenido principal -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 main-content" id="main-content">
                    <!-- Las vistas se cargarán aquí dinámicamente -->
                    <div class="welcome-message text-center py-5">
                        <h3>Bienvenido al Panel de Estudiantes</h3>
                        <p class="text-muted">Seleccione una opción del menú para comenzar</p>
                    </div>
                </main>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/esutidantes.js"></script>
</body>
</html>