


<?php
    include('components/navbar.php'); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Docente</title>

    <link rel="stylesheet" href="../assets/css/docentes.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
   

</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar (Opciones del docente) -->
        <nav class="col-md-3 col-lg-2 sidebar">
           
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="#" class="text-decoration-none option clases" data-page="components/clases.php">Ver Clases Asignadas </a>
                </li><br>
                <li class="list-group-item">
                    <a href="#" class="text-decoration-none option" data-page="components/perfilDocente.php">Ver Perfil </a>
                </li><br>
                <li class="list-group-item">
                    <a href="#" class="text-decoration-none option" data-page="components/evaluaciones.php">Evaluaciones </a>
                </li><br>
                <li class="list-group-item">
                    <a href="#" class="text-decoration-none option" data-page="materiales.php">Materiales de Clase </a>
                </li>
            </ul>
        </nav>

       
        
        <main class="col-md-9 col-lg-10 content" id="main-content">
   
     
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

<script src="/views/public/js/docente.js"></script>
<script src="/views/public/js/seccionesDocentes.js"> </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>