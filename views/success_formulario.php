<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Exitoso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>
    <?php require __DIR__ . "/components/navbar.php"; ?>
    <div class="container main-container d-flex justify-content-center align-items-center">
        <div class="alert alert-success w-100 w-md-50">
            <h4 class="alert-heading">¡Éxito!</h4>
            <p>Su número de solicitud es <strong>1234</strong>.</p>
            <hr>
            <p class="mb-0">Haga clic en el enlace para monitorear el estado de su solicitud.</p>
            <a href="estado_solicitud.php" class="btn btn-primary mt-3">Ver estado de la solicitud</a>
        </div>
    </div>
    <?php require __DIR__ . "/components/footer.php"; ?>
    <script>
        document.getElementById("req-number").textContent = localStorage.getItem("idSolicitud");
    </script>
    <script type="module" src="/assets/js//admisionesController.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
