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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiante</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
       
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/estudiante.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../../assets/css/toastMessage.css">
 
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
    <div class="container">

        <!-- Listado de secciones -->
        <div class="secciones-container" id='secciones-container'>
            

            
        </div>

        
        <div id="seccion" class="seccion-detalle">
            <div class="seccion-header" id='seccion-header'>
                
            </div>

            <div class="tabs">
                <div class="tab active" data-tab="clases">Videos</div>
                <div class="tab" data-tab="integrantes">Integrantes</div>
            
            </div>

            <!-- Contenido de pestañas -->
            <div id="clases" class="tab-content active">
                
              
            </div>

            <!-- Pestaña de Integrantes -->
            <div id="integrantes" class="tab-content">
                <div class="search-container" style="margin-bottom:20px">
                    <input type="text" placeholder="Buscar integrantes..." style="padding:8px;width:100%;max-width:300px">
                </div>
                
                <div class="integrantes-container" id='integrantes-container'>
                    <!-- Profesor -->
                   

                    <!-- Estudiantes -->
                    

                    
                </div>
            </div>

            </div>
        </div>
    </div>

    

    <script src="../../assets/js/secciones.js" type="module"></script>
</body>
</html>