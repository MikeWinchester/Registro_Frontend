<?php include('components/navbar.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes</title>
    
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
                    <a href="#submenuPlan" class="text-decoration-none option" data-bs-toggle="collapse" aria-expanded="false" aria-controls="submenuPlan">
                        Asignaturas 
                    </a><br>
                
                    <ul class="collapse list-unstyled ps-3" id="submenuPlan">
                        <li><a href="#" class="text-decoration-none option" data-page="components/estudiante_adicionar_asignatura.php">Adicionar Asignatura</a></li><br>
                        <li><a href="#" class="text-decoration-none option" data-page="components/estudiante_cancelar_asignatura.php">Cancelar Asignatura</a></li><br>
                        <li><a href="#" class="text-decoration-none option" data-page="components/estudiante_lista_espera_asignatura.php">Asignaturas en lista de espera</a></li><br>
                        <li><a href="#" class="text-decoration-none option" data-page="components/estudiante_clases_canceladas.php">Asignaturas canceladas</a></li>
                    </ul>
                </li><br><br>

                <li class="list-group-item">
                    <a href="#" class="text-decoration-none option" data-page="components/perfil_estudiante.php">Perfil</a>
                </li>
            </ul>
        </nav>

    
        <main class="col-md-9 col-lg-10 content p-4 bg-white shadow rounded" id="main-content">
            <h2 class="text-center text-secondary">Selecciona una opción del menú</h2>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".option").forEach(link => {
            link.addEventListener("click", function(event) {
                event.preventDefault();
                let page = this.getAttribute("data-page");

                if (page && page !== "") {
                    fetch(page)
                        .then(response => {
                            if (response.ok) {
                                return response.text();
                            } else {
                                throw new Error("Error al cargar la vista: " + response.status);
                            }
                        })
                        .then(data => {
                            document.getElementById("main-content").innerHTML = data; // Cargar la vista en el main
                        })
                        .catch(error => {
                            console.error("Error al cargar la vista:", error);
                            document.getElementById("main-content").innerHTML = "<p>Error al cargar la vista. Intenta más tarde.</p>";
                        });
                }
            });
        });
    });
</script>

</body>
</html>
