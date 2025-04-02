<?php include('components/navbar.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jefe de departamento</title>
    
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/docentes.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
     

        <nav class="col-md-3 col-lg-2 sidebar">
    <ul class="list-group">
        <li class="list-group-item">
            <a href="#submenuPlan" class="text-decoration-none option" data-bs-toggle="collapse" aria-expanded="false" aria-controls="submenuPlan" data-page="#">
                Planificación Académica
            </a><br>
        
            <ul class="collapse list-unstyled ps-3" id="submenuPlan">
                <li><a href="#" class="text-decoration-none option" data-page="/views/components/crear_secciones.php">Crear Sección</a></li><br>
                <li><a href="#" class="text-decoration-none option" data-page="/views/components/secciones_programadas.php">Secciones programadas</a></li><br>
                <li><a href="#" class="text-decoration-none option" data-page="/views/components/clases_lista_espera.php">Lista de espera</a></li>
            </ul>
        </li><br><br>

        <li class="list-group-item">
            <a href="#submenuEstu" class="text-decoration-none option" data-bs-toggle="collapse" aria-expanded="false" aria-controls="submenuEstu" data-page="#">
                Estudiantes
            </a><br>
        
            <ul class="collapse list-unstyled ps-3" id="submenuEstu">
                <li><a href="#" class="text-decoration-none option" data-page="/views/components/evaluaciones_docentes.php">Evaluaciones de Docentes</a></li><br>
                <li><a href="#" class="text-decoration-none option" data-page="/views/components/estudiantes_historial.php">Historiales</a></li><br>
        
            </ul>
        </li><br>

       
        <li class="list-group-item">
            <a href="#submenuDoc" class="text-decoration-none option" data-bs-toggle="collapse" aria-expanded="false" aria-controls="submenuDoc" data-page="#">
                Docentes
            </a><br>
        
            <ul class="collapse list-unstyled ps-3" id="submenuDoc">
                <li><a href="#" class="text-decoration-none option" data-page="/views/components/evaluaciones_docentes.php">Ver Ingreso de Notas</a></li><br>
            
        
            </ul>
        </li><br><br>




    </ul>
</nav>




        <!-- Contenido principal -->
        <main class="col-md-9 col-lg-10 content" id="main-content">
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
