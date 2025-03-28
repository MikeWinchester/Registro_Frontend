<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <link rel="stylesheet" href="/assets/css/navbar.css">
    <link rel="stylesheet" href="/assets/css/sidebar.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php require __DIR__ . "/components/navbar.php";?>
    <div class="container-fluid">
        <div class="row">
            <?php
                require __DIR__ . "/components/sidebar.php";
                render([
                    ["id" => "clases", "label" => "Ver Clases Asignadas", "href" => "/views/components/pollo.php"],
                    ["id" => "perfil", "label" => "Ver Perfil", "href" => "/views/components/pan.php"],
                    ["id" => "evaluacion", "label" => "Evaluaciones", "href" => "/views/components/queso.php"]
                ]);
            ?>
            <main class="col-md-9 col-lg-10 content" id="main-content">

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
                    .then(response => response.text())
                    .then(data => {
                        let mainContent = document.getElementById("main-content");
                        mainContent.innerHTML = data;

                        
                        document.querySelectorAll("script[data-dynamic]").forEach(script => script.remove());

                        
                        let script = document.createElement("script");
                        script.dataset.dynamic = "true"; 
                        if (page.includes("evaluaciones.php")) {
                            script.src = "/assets/js/manejadorEstudiantes.js";
                        }

                        if (script.src) {
                            document.body.appendChild(script);
                        }
                    })
                    .catch(error => console.error("Error al cargar la página:", error));
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>