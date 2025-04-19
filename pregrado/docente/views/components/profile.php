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
   
  

<nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-university me-3"></i>Portal Universitario
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="../dashboard.php">
                            <i class="fas fa-home me-1"></i>Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../components/profile.php">
                            <i class="fas fa-user me-1"></i>Perfil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../components/chat.php">
                            <i class="fas fa-comments me-1"></i>Chat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../components/grades.php">
                            <i class="fas fa-graduation-cap me-1"></i>Notas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../components/requests.php">
                            <i class="fas fa-tasks me-1"></i>Trámites
                        </a>
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

    
    <div class="container-fluid mt-4">
        <div class="row">
            
            <div class="col-md-4">
                <section class="mb-5">
                    <h5 class="section-title">Foto de Perfil</h5>
                    <div class="profile-picture-container" id="div-profile">
                        
                    </div>
                    <div id="loader-area-perfil" class="text-center mt-2" style="display: none;">
                            <div class="spinner-border text-primary" role="status">

                            </div>
                        </div>
                </section>

                <section class="mb-5">
                    <h5 class="section-title">Galería de Fotos</h5>
                    <div class="photo-gallery">
                        <div class="row" id="galeria">
                        
                        </div>
                    </div>
                    <div id="loader-area-galeria" class="text-center mt-2" style="display: none;">
                            <div class="spinner-border text-primary" role="status">

                            </div>
                        </div>
                </section>
            </div>

        
            <div class="col-md-8" id="profile-div">
                
                
                <section class="mb-5">
                    <h4 class="section-title">Acerca de Mí</h4>                    
                    <div class="mb-3">                                                
                        <div id="loader-area-desc" class="text-center mt-2" style="display: none;">
                            <div class="spinner-border text-primary" role="status">

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark" id="desc">Actualizar Descripción</button>
                </section>
               
            </div>
        </div>
    </div>

    <footer class="py-3 mt-4">
        <div class="container text-center">
            <p class="mb-0">
                <i class="fas fa-university me-1"></i> © 2025 Universidad. Todos los derechos reservados.
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
    <script type='module' src="../../assets/js/profile.js"></script>
</body>
</html>