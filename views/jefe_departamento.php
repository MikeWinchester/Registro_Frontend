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
                    <a href="#" id="plan" class="text-decoration-none option" data-page="../views/components/planificacion.php">Planificación Académica</a>
                </li>
            </ul>
        </nav>

        <!-- Contenido principal -->
        <main class="col-md-9 col-lg-10 content" id="main-content">
            <h2>Selecciona una opción del menú</h2>
        </main>
    </div>
</div>

<script src="/assets/js/asyncJefeMatricula.js"></script>
<script src="/assets/js/sendSeccion.js"></script>
<script src="/assets/js/jefeSeccionController.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
