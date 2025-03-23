
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
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/docentes.css">
    

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
                        document.getElementById("main-content").innerHTML = data;
                    })
                    .catch(error => console.error("Error al cargar la página:", error));
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
