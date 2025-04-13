<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Universitario - Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/styles.css">
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
            <!-- Columna izquierda - Foto y galería -->
            <div class="col-md-4">
                <section class="mb-5">
                    <h2 class="section-title">Foto de Perfil</h2>
                    <div class="profile-picture-container" id="div-profile">
                    
                        
                    </div>
                </section>

                <section class="mb-5">
                    <h2 class="section-title">Galería de Fotos</h2>
                    <div class="photo-gallery">
                        <div class="row" id="galeria">
                            
                           
                        </div>
                    </div>
                </section>
            </div>

            <!-- Columna derecha - Información -->
            <div class="col-md-8" id="profile-div">
                
                    
                

                <section class="mb-5" >
                    <h2 class="section-title">Acerca de Mí</h2>
                        <div class="mb-3">
                            <label for="bio" class="form-label">Descripción</label>
                            <textarea class="form-control" id="bio" rows="5">Soy un estudiante de Ingeniería en Sistemas apasionado por la programación y la tecnología. Me gusta participar en proyectos extracurriculares y aprender cosas nuevas cada día.</textarea>
                        </div>
                        <button type="submit" class="btn btn-dark" id="desc">Actualizar Descripción</button>
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
    <script type='module' src="../../assets/js/profile.js"></script>
</body>
</html>