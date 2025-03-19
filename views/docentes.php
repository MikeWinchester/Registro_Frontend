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

    <link rel="stylesheet" href="../assets/css/docentes.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>

<div class="container-fluid">
    <div class="row">
        
        <nav class="col-md-3 col-lg-2 sidebar">

            <ul class="list-group">
                <li class="list-group-item">
                    <a href="#" id="clases" class="text-decoration-none option" data-page="/views/components/clases.php">Ver Clases Asignadas </a>

                </li><br>
                </li>
                <li class="list-group-item">
                    <a href="#" id="perfil" class="text-decoration-none option" data-page="/views/components/perfilDocente.php">Ver Perfil </a>
                </li><br>
                <li class="list-group-item">
                    <a href="#" id="evaluacion" class="text-decoration-none option" data-page="/views/components/evaluaciones.php">Evaluaciones </a>
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
        document.querySelectorAll(".option").forEach(item => {
            item.addEventListener("click", function(event) {
                event.preventDefault();

                let page = this.getAttribute("data-page");

                fetch(page)
                    .then(response => response.text())
                    .then(data => {
                        let mainContent = document.getElementById("main-content");
                        mainContent.innerHTML = data;
                        let script = document.createElement("script");
                        script.src = "/assets/js/cargarEstudiantes.js";
                        document.body.appendChild(script);
                    })
                    .catch(error => console.error("Error al cargar la página:", error));
            });
        });
});

</script>

<script src="/assets/js/Docente.js"> </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>