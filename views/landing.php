<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registro UNAH</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
  
     <link rel="stylesheet" href="../assets/css/landing.css">
    
</head>
<body>

  


<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="../assets/images/puma.png" alt="Logo UNAH" style="height: 40px; margin-right: 10px;">
            UNAH Registro
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="?page=formulario_admisiones">Estudiantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#biblioteca">Biblioteca Virtual</a>
                </li>
                
                <!-- Menú desplegable para Docentes -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="docentesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Docentes
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="docentesDropdown">
                        <li><a class="dropdown-item" href="?page=plataforma_docente">Docentes</a></li>
                        <li><a class="dropdown-item" href="?page=capacitaciones">Coordinadores</a></li>
                        <li><a class="dropdown-item" href="?page=material_academico">Jefe de Carrera</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="?page=formulario_admisiones">Admisiones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-warning" href="?page=login">Acceder</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <section class="hero bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Bienvenido al Sistema de Registro UNAH</h1>
            <p class="lead">Accede a los servicios de matrícula, biblioteca, docentes y admisiones.</p>
            <a href="#matricula" class="btn btn-light btn-lg">Comienza Aquí</a>
        </div>
    </section>



    <section class="section-info container">
        <h2>Servicios Disponibles</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="info-box">
                    <i class="fas fa-user-graduate"></i>
                    <h3>Matrícula</h3>
                    <p>Inscríbete en los cursos que deseas con un solo clic. Simplifica tu proceso de matrícula.</p>
                    <a href="#" class="btn btn-info">Ver máss</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <i class="fas fa-calendar-check"></i>
                    <h3>Admisiones</h3>
                    <p>Conoce los requisitos y fechas para ingresar a la universidad. Prepárate para el proceso de admisión.</p>
                    <a href="#" class="btn btn-info">Ver más</a>
                </div>
            </div>
            <div class="col-md-4">
            <div class="info-box">
        <i class="fas fa-exchange-alt"></i>
        <h3>Cambios de Carrera</h3>
        <p>Solicita tu cambio de carrera y obtén toda la información sobre el proceso. ¡Haz crecer tu futuro académico!</p>
        <a href="#" class="btn btn-info">Ver más </a>
    </div>
</div>
        </div>

        <div class="row g-4 mt-5">
            <div class="col-md-4">
                <div class="info-box">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <h3>Docentes</h3>
                    <p>Consulta información sobre nuestros docentes, horarios de clases y más.</p>
                    <a href="#" class="btn btn-info">Ver Docentes</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <i class="fas fa-headset"></i>
                    <h3>Soporte</h3>
                    <p>¿Tienes dudas? Nuestro equipo de soporte está disponible 24/7 para ayudarte.</p>
                    <a href="#" class="btn btn-info">Contacto Soporte</a>
                </div>
            </div>
        </div>
    </section>







    <footer class="text-white text-center py-4">
        <p>&copy; 2025 Universidad Nacional Autónoma de Honduras | Todos los derechos reservados</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

