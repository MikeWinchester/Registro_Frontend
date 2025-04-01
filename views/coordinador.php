<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Coordinador - UNAH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/coordinador.css">
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
                                <i class="fas fa-user-tie"></i>
                                <span>Coordinador UNAH</span>
                            </div>
                        </div>
                        <ul class="nav flex-column sidebar-nav">
                            <li class="nav-item">
                                <a class="nav-link sidebar-option active" href="#" data-page="carga_periodo.php">
                                    <i class="fas fa-calendar-alt me-2"></i>Carga Período
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sidebar-option" href="#" data-page="historial_estudiantes.php">
                                    <i class="fas fa-user-graduate me-2"></i>Historial Estudiantes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sidebar-option" href="#" data-page="cambios_carrera.php">
                                    <i class="fas fa-exchange-alt me-2"></i>Cambios de Carrera
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sidebar-option" href="#" data-page="cancelaciones.php">
                                    <i class="fas fa-calendar-times me-2"></i>Cancelaciones
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sidebar-option" href="#" data-page="cambios_centro.php">
                                    <i class="fas fa-building me-2"></i>Cambios de Centro
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sidebar-option" href="#" data-page="reportes.php">
                                    <i class="fas fa-chart-bar me-2"></i>Reportes
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
        
                <!-- Contenido principal -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 main-content" id="main-content">
                    <!-- Las vistas se cargarán aquí dinámicamente -->
                    <div class="welcome-message text-center py-5">
                        <h3>Bienvenido al Panel de Coordinador</h3>
                        <p class="text-muted">Seleccione una opción del menú para comenzar</p>
                    </div>
                </main>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/coordinador.js"></script>
</body>
</html>