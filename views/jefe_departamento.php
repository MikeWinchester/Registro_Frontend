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

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".option").forEach(item => {
        item.addEventListener("click", function(event) {
            event.preventDefault(); 

            let page = this.getAttribute("data-page");

            fetch(page)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Página no encontrada");
                    }
                    return response.text();
                })
                .then(data => {
                    let mainContent = document.getElementById("main-content");
                    mainContent.innerHTML = data;

                    document.querySelectorAll("script[data-dynamic]").forEach(script => script.remove());

                    let scriptSrc = null;
                    if (page.includes("planificacion.php")) { 
                        scriptSrc = "/assets/js/jefeDepartamento.js";
                    }

                    if (scriptSrc) {
                        let script = document.createElement("script");
                        script.src = scriptSrc;
                        script.dataset.dynamic = "true";
                        document.body.appendChild(script);

                        script.onload = function() {
                            setTimeout(deploySeccion, 500); 
                        };
                    }
                })
                .catch(error => {
                    console.error("Error al cargar la página:", error);
                    document.getElementById("main-content").innerHTML = "<p style='color:red;'>Error al cargar el contenido.</p>";
                });
        });
    });
});
</script>

<script src="/assets/js/jefeDepartamento.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
