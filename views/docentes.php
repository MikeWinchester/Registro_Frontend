<?php
    include('components/navbar.php');

    $docente = isset($_GET['Docente']) ? $_GET['Docente'] : null;
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Docente</title>

    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">

   <!-- <link rel="stylesheet" href="../assets/css/docentes.css">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


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



        </main>


<script type="module" src="/assets/js/ayncDocente.js"> </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>