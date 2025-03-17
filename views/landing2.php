<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registro Universitario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Navbar Estilo */
        .navbar {
            background: #0066cc;
            padding: 15px;
        }

        .navbar-brand {
            font-size: 1.9rem;
            font-weight: 700;
            color: #fff !important;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #ffcc00 !important;
        }

        .navbar-nav .nav-link.active {
            color: #ffcc00 !important;
            font-weight: 700;
        }

        /* Hero Section */
        .hero {
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background-color: #0066cc;
            color: #fff;
            padding: 20px;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin-top: 10px;
        }

        .btn-custom {
            background: #ffcc00;
            color: #0066cc;
            font-weight: 700;
            padding: 12px 24px;
            border-radius: 30px;
            transition: all 0.3s;
        }

        .btn-custom:hover {
            background: #fff;
            color: #0066cc;
        }

        /* Sección de Características */
        .section-info {
            padding: 60px 20px;
            text-align: center;
        }

        .section-info h2 {
            font-size: 2.5rem;
            margin-bottom: 40px;
        }

        .info-box {
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .info-box:hover {
            transform: translateY(-10px);
        }

        .info-box i {
            font-size: 3rem;
            color: #0066cc;
        }

        .info-box h3 {
            font-size: 1.6rem;
            margin-top: 20px;
        }

        .info-box p {
            font-size: 1.1rem;
        }

        .info-box .btn-info {
            background: #0066cc;
            color: #fff;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 500;
            margin-top: 20px;
            transition: background 0.3s;
        }

        .info-box .btn-info:hover {
            background: #ffcc00;
            color: #0066cc;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">RegistroUni</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Matrícula</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Admisiones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Biblioteca</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Docentes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Soporte</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div>
            <h1>Bienvenido al Sistema de Registro</h1>
            <p>Gestiona tus trámites académicos de manera eficiente: matrícula, admisiones, recursos y más, todo en un solo lugar.</p>
            <a href="#" class="btn btn-custom">Comenzar Ahora</a>
        </div>
    </section>

    <!-- Sección de Información -->
    <section class="section-info container">
        <h2>Servicios Disponibles</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="info-box">
                    <i class="fas fa-user-graduate"></i>
                    <h3>Matrícula</h3>
                    <p>Inscríbete en los cursos que deseas con un solo clic. Simplifica tu proceso de matrícula.</p>
                    <a href="#" class="btn btn-info">Ver Matrícula</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <i class="fas fa-calendar-check"></i>
                    <h3>Admisiones</h3>
                    <p>Conoce los requisitos y fechas para ingresar a la universidad. Prepárate para el proceso de admisión.</p>
                    <a href="#" class="btn btn-info">Ver Admisiones</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <i class="fas fa-book"></i>
                    <h3>Biblioteca</h3>
                    <p>Accede a miles de recursos académicos para complementar tu aprendizaje. Libros, artículos y más.</p>
                    <a href="#" class="btn btn-info">Ir a la Biblioteca</a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
