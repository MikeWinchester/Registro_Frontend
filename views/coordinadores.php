
<?php
    include('components/navbar.php');  
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Docente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Registro_Frontend/assets/css/docentes/docentes.css">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar (Opciones del docente) -->
        <nav class="col-md-3 col-lg-2 sidebar">
           
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="#" class="text-decoration-none option" data-page="components/cargaAcademica.php">Carga Academica </a>
                </li>
                <li class="list-group-item">
                    <a href="#" class="text-decoration-none option" data-page="components/infoEstudiantes.php">Estudiantes</a>
                </li>
                <li class="list-group-item">
                    <a href="#" class="text-decoration-none option" data-page="components/evaluaciones.php">Cambios de carrera</a>
                </li>
               
            </ul>
        </nav>

       
        

        <main class="col-md-9 col-lg-10 content" id="main-content">
    <div class="row">
        <!-- Sección de estadísticas -->
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="stat-card bg-lightblue text-white">
                <h4>Clases Asignadas</h4>
                <p class="lead">12 Clases</p>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="stat-card bg-lightblue text-white">
                <h4>Evaluaciones Pendientes</h4>
                <p class="lead">5 Evaluaciones</p>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="stat-card bg-lightblue text-white">
                <h4>Materiales Subidos</h4>
                <p class="lead">8 Archivos</p>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="stat-card bg-lightblue text-white">
                <h4>Alertas</h4>
                <p class="lead">1 Nueva</p>
            </div>
        </div>
    </div>
</main>


    
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Seleccionamos todos los enlaces con la clase "option"
        document.querySelectorAll(".option").forEach(item => {
            item.addEventListener("click", function(event) {
                event.preventDefault(); // Evita que la página recargue

                let page = this.getAttribute("data-page"); // Obtiene la página a cargar

                fetch(page) // Carga la página con AJAX
                    .then(response => response.text()) // Convierte la respuesta en texto
                    .then(data => {
                        document.getElementById("main-content").innerHTML = data; // Inserta el contenido en la vista
                    })
                    .catch(error => console.error("Error al cargar la página:", error));
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
