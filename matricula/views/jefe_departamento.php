<?php
include('../../components/navbar.php');
session_start();

$allowedRoles = ['Jefe'];
$userRoles = $_SESSION['user_roles'] ?? [];

if (empty($userRoles)) {
    header('Location: ../login/index.php');
    exit;
}

if (!array_intersect($allowedRoles, $userRoles)) {
    die(header('Location: ../login/forbidden.php'));
}
?>

<!DOCTYPE html>
<html lang="es" user-id='<?php echo $_SESSION['user_id']?>' user-name='<?php echo $_SESSION['user_name']?>'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jefe de departamento</title>
    
    <link rel="stylesheet" href="../assets/css/navbar.css">

    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <!--<link rel="stylesheet" href="../assets/css/docentes.css">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">



</head>
<body>


<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
    
        <nav class="col-md-2 col-lg-3 d-md-block bg-unah-blue sidebar-container">

        <div class="sidebar">
        <ul class="nav flex-column sidebar-nav">
        <li class="nav-item">
            <a href="#submenuPlan" class="nav-link sidebar-option" data-bs-toggle="collapse" aria-expanded="false" aria-controls="submenuPlan" data-page="#">
               <i class="bi bi-calendar-event me-2"></i> Planificación Académica
            </a><br>
        
            <ul class="collapse list-unstyled ps-3" id="submenuPlan">
                <li><a href="#" class="text-decoration-none option" data-page="/views/components/crear_secciones.php"><i class="bi bi-dot"></i>Crear Sección</a></li><br>
                <li><a href="#" class="text-decoration-none option" data-page="/views/components/secciones_programadas.php"><i class="bi bi-dot"></i>Secciones programadas</a></li><br>
                <li><a href="#" class="text-decoration-none option" data-page="/views/components/clases_lista_espera.php"><i class="bi bi-dot"></i>Lista de espera</a></li>
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

<script type='module' src="/assets/js/asyncJefeMatricula.js"></script>
<script type='module' src="/assets/js/sendSeccion.js"></script>
<script type='module' src="/assets/js/deploySeccion.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>