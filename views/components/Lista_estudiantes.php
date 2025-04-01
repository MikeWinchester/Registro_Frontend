<?php
    include('components/navbar.php');

    $Id = isset($_GET['Id']) ? $_GET['Id'] : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudiantes</title>
 
    
    <link rel="stylesheet" href="../../assets/css/lista_estudiantes.css">


    
   
</head>


<body>

    <section class="student-list-section">
        <h2 class="section-title">Lista de Estudiantes</h2>

        <div class="table-wrapper" id="main-content">
            
                    <tr>Cargando...</tr>
                    
                
        </div>

        <button class="btn-download">Descargar Lista</button>
    </section>


    <script type='module' src="/assets/js/listaEstudiante.js"></script>

    <script src="/assets/js/descargarEstudiantes.js"></script>
</body>
</html>
