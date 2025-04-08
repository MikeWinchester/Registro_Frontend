<?php include('components/navbar.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes</title>
    
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
   <!-- <link rel="stylesheet" href="../assets/css/docentes.css">-->
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
                        Asignaturas 
                    </a><br>
                
                    <ul class="collapse list-unstyled ps-3" id="submenuPlan">
                        <li><a href="#" class="text-decoration-none option" data-page="components/estudiante_adicionar_asignatura.php">Adicionar Asignatura</a></li><br>
                        <li><a href="#" class="text-decoration-none option" data-page="components/estudiante_cancelar_asignatura.php">Cancelar Asignatura</a></li><br>
                        <li><a href="#" class="text-decoration-none option" data-page="components/estudiante_lista_espera_asignatura.php">Asignaturas en lista de espera</a></li><br>
                        <li><a href="#" class="text-decoration-none option" data-page="components/estudiante_clases_canceladas.php">Asignaturas canceladas</a></li>
                    </ul>
                </li><br><br>

                <li class="nav-item">
                    <a href="#"  class="nav-link sidebar-option option" data-page="components/forma03.php">Forma 03</a>
                </li>
            </ul>
        </div>
        </nav>

    
        <main class="col-md-9 col-lg-9 content p-4 bg-white shadow rounded" id="main-content">
            <h2 class="text-center text-secondary">Selecciona una opción del menú</h2>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


<script src="/assets/js/ayncEstudiante.js" type='module'></script>

</body>
</html>