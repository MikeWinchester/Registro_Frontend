<?php
include('../../global_components/views/navbar.php');
session_start();

$allowedRoles = ['Estudiante', 'Docente'];
$userRoles = $_SESSION['user_roles'] ?? [];

if (empty($userRoles)) {
    header('Location: ../login/index.php');
    exit;
}

if (!array_intersect($allowedRoles, $userRoles)) {
    die(header('Location: ../login/forbidden.php'));
}
?>

<?php include('components/navbar.php'); ?>

<!DOCTYPE html>
<html lang="es" user-id='<?php echo $_SESSION['user_id']?>' user-name='<?php echo $_SESSION['user_name']?>'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Docente</title>

    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">

   <!-- <link rel="stylesheet" href="../assets/css/docentes.css">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel='stylesheet' href="../../global_components/assets/css/toastMessage.css"></link>

</head>
<body>

<div class="container-fluid">
    <div class="row">
        
        <nav class= "col-md-2 col-lg-3 d-md-block bg-unah-blue sidebar-container">


        <div class="sidebar">

            <ul class="nav flex-column sidebar-nav">



            <li class="list-group-item">
                    <a href="#" id="perfil" class="nav-link sidebar-option option"  data-page="/views/components/perfilDocente.php">  <i class="bi bi-person-circle me-2"></i>Perfil </a>
                </li><br>

                
                <li class="nav-item">
                    <a href="#" id="clases" class="nav-link sidebar-option option" data-page="/views/components/clases.php">  <i class="bi bi-calendar-check me-2"></i>Ver Clases Asignadas </a>

                </li><br>
                </li>
               
                <li class="list-group-item">
                    <a href="#" id="evaluacion" class="nav-link sidebar-option option"  data-page="/views/components/evaluaciones.php">   <i class="bi bi-clipboard-check me-2"></i> Evaluaciones </a>
                </li><br>
               
            </ul>
            </div>
        </nav>


        
        <main class="col-md-9 col-lg-9 content" id="main-content">


            <div id="toast" class="toast">

            </div>
        </main>
       


<script type="module" src="/pregrado/assets/js/ayncDocente.js"> </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>