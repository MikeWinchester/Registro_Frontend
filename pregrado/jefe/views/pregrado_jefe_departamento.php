
<?php
include('../../../components/navbar.php');
session_start();

$allowedRoles = ['Jefe'];
$userRoles = $_SESSION['user_roles'] ?? [];

if (empty($userRoles)) {
    header('Location: ../../login/index.php');
    exit;
}

if (!array_intersect($allowedRoles, $userRoles)) {
    die(header('Location: ../../coordinador/views/coordinador.php'));
}
?>
<!DOCTYPE html>
<html lang="es" user-id='<?php echo $_SESSION['user_id']?>' user-name='<?php echo $_SESSION['user_name']?>' >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jefe de departamento</title>
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    
    <link rel="stylesheet" href="../../../assets/css/navbar.css">
    
    <link rel="stylesheet" href="../../../assets/css/sidebar.css">
</head>
<body>



<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
    
        <nav class="col-md-2 col-lg-3 d-md-block bg-unah-blue sidebar-container">

        <div class="sidebar">
        <ul class="nav flex-column sidebar-nav">
     

        <li class="nav-item">
            <a href="#submenuEstu" class="nav-link sidebar-option" data-bs-toggle="collapse" aria-expanded="false" aria-controls="submenuEstu" data-page="#"> <i class="bi bi-person-lines-fill me-2"></i>
                Estudiantes
            </a><br>
        
            <ul class="collapse list-unstyled ps-3" id="submenuEstu">
                <li><a href="#" class="text-decoration-none option" data-page="/pregrado/jefe/views/components/evaluaciones_docentes_calificacion.php"><i class="bi bi-dot"></i>Evaluaciones de Docentes</a></li><br>
                <li><a href="#" class="text-decoration-none option" data-page="/pregrado/jefe/views/components/estudiantes_historial.php"><i class="bi bi-dot"></i>Historiales</a></li><br>
        
            </ul>
        </li><br>

       
        <li class="nav-item">
            <a href="#submenuDoc" class="nav-link sidebar-option" data-bs-toggle="collapse" aria-expanded="false" aria-controls="submenuDoc" data-page="#">
                 <i class="bi bi-person-check me-2"></i>
                Docentes
            </a><br>
        
            <ul class="collapse list-unstyled ps-3" id="submenuDoc">
                <li><a href="#" class="text-decoration-none option" data-page="/pregrado/jefe/views/components/evaluaciones_docentes.php"> <i class="bi bi-dot"></i> Ver Ingreso de Notas</a></li><br>
            
        
            </ul>
        </li><br><br>




    </ul>
    </div>
</nav>




        <!-- Contenido principal -->
        <main class="col-md-9 col-lg-9 content" id="main-content">
            <h2>Selecciona una opción del menú</h2>
        </main>
    </div>
</div>

<script type='module' src="../assets/js/asyncJefeMatricula.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>